<?php

session_start();
require_once '../config/db.php';

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error_message'] = 'All fields are required';
        header("Location: ../auth/register");
        exit;
    }

    if (strlen($username) < 3 || strlen($username) > 15 ){
        $_SESSION['error_message'] = 'Username must be between 3 and 15.';
        header("Location: ../auth/register");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = 'Invalid email format';
        header("Location: ../auth/register");
        exit;
    }

    if ($password != $confirm_password) {
        $_SESSION['error_message'] = 'Password do not match';
        header("Location: ../auth/register");
        exit;
    }

    if (strlen($password) < 8){
        $_SESSION['error_message'] = 'Password must be at least 8 characters long.';
        header("Location: ../auth/register");
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_user) {
        $_SESSION['error_message'] = 'Username or Email already exist!';
        header("Location: ../auth/register");
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash)
                                    VALUES (:username, :email, :password_hash)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password_hash', $hashed_password);


    if ($stmt->execute()) {
        $_SESSION['success_message'] = 'Registration successful! You can now login.';
        header("Location: ../auth/login");
        exit;
    } 
    
    else {
        $_SESSION['error_message'] = 'Something went wrong. Please try again.';
        header("Location: ../auth/register");
        exit;
    }
}

if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register to DailyDesk</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>

<body>
    
    <section class="vh-100" style="background-color: #FFFFFF;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">

                    <?php include '../includes/message.php'; ?>

                    <div class="card shadow-lg" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block d-sm-block">
                                <img src="../assets/images/dailydesk-bg.jpg"
                                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>

                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form action="register.php" class="form" method="POST">

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fa-solid fa-book-open fa-2x me-3" style="color: #124265;"></i>
                                            <span class="h1 fw-bold mb-0" style="color: #444444;">DailyDesk</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Register your account</h5>

                                        <div class="input-group mb-4">
                                            <span class="input-group-text"><i class="ri-user-fill"></i></span>
                                            <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="Username" required />
                                        </div>

                                        <div class="input-group mb-4">
                                            <span class="input-group-text"><i class="ri-mail-fill"></i></span>
                                            <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email" required />
                                        </div>

                                        <div class="input-group mb-4">
                                            <span class="input-group-text"><i class="ri-lock-fill"></i></span>
                                            <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" required />
                                        </div>

                                        <div class="input-group mb-4">
                                            <span class="input-group-text"><i class="ri-lock-password-fill"></i></span>
                                            <input type="password" id="confirm_password" name="confirm_password" class="form-control form-control-lg" placeholder="Confirm Password" required />
                                        </div>

                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="togglePassword">
                                            <label class="form-check-label mb-4" for="togglePassword">Show Password</label>
                                        </div>                                        

                                        <div class="pt-1 mb-4">
                                            <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-lg custom-btn"
                                                type="submit">Register</button>
                                        </div>

                                        <p class="mb-5 pb-lg-2" style="color: #444444;">Already have an account? <a href="../auth/login"
                                                style="color: #124265;">Login here</a></p>

                                        <a href="#!" class="small text-muted">Terms of use.</a>
                                        <a href="#!" class="small text-muted">Privacy policy</a>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/show-password.js"></script>
    <script src="../assets/js/message.js"></script>
</body>
</html>