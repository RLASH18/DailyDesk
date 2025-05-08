<?php

session_start();
require_once '../config/db.php';

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_input = trim($_POST['user_input']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :user_input 
                            OR username = :user_input");
    $stmt->bindParam(':user_input', $user_input);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];

        header("Location: ../views/dashboard");
        exit;
    } 
    
    else {
        $_SESSION['error_message'] = 'Invalid username or password';
        header("Location: ../auth/login");
        exit;
    }
}

if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

if (isset($_SESSION['success_message'])){
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to DailyDesk</title>
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

                                    <form action="login.php" class="form" method="POST">

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fa-solid fa-book-open fa-2x me-3" style="color: #124265;"></i>
                                            <span class="h1 fw-bold mb-0" style="color: #444444;">DailyDesk</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Login to your account</h5>

                                        <div class="input-group mb-4">
                                            <span class="input-group-text"><i class="ri-user-fill"></i></span>
                                            <input type="text" id="user_input" name="user_input" class="form-control form-control-lg" placeholder="Username or Email" required />
                                        </div>

                                        <div class="input-group mb-4">
                                            <span class="input-group-text"><i class="ri-lock-fill"></i></span>
                                            <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" required />
                                        </div>

                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="togglePassword">
                                            <label class="form-check-label mb-4" for="togglePassword">Show Password</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-lg custom-btn"
                                                type="submit">Login</button>
                                        </div>

                                        <p class="mb-5 pb-lg-2" style="color: #444444;">Don't have an account? <a href="../auth/register"
                                                style="color: #124265;">Register here</a></p>

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