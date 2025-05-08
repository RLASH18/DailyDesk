<?php

require_once '../config/db.php';

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT username, email, profile_pic FROM users WHERE id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user){
    $username = htmlspecialchars($user['username']);
    $email = htmlspecialchars($user['email']);
    $profile_pic = !empty($user['profile_pic']) ? $user['profile_pic'] : 'default.png';

}

else {
    header("Location: ../auth/login");
    exit;
}

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
      
<header class="header" id="header">
    <div class="header__container">
        <a href="../views/dashboard" class="header__logo">
            <i class="ri-book-open-fill"></i>
            <span>DailyDesk</span>
        </a>
            
        <button class="header__toggle" id="header-toggle">
            <i class="ri-menu-line"></i>
        </button>
    </div>
</header>

<nav class="sidebar" id="sidebar"> 
    <div class="sidebar__container">
        <div class="sidebar__user"> 
            <div class="sidebar__img">
                <img src="../uploads/profile_pics/<?= htmlspecialchars($profile_pic); ?>" alt="Profile Picture">
            </div>
   
            <div class="sidebar__info">
                <h3>@<?=$username; ?></h3>
                <span><?= $email; ?></span>
            </div>
        </div>
    
        <div class="sidebar__content">
            <div>
                <h3 class="sidebar__title">MANAGE</h3>

                <div class="sidebar__list">
                    <a href="../views/dashboard" class="sidebar__link">
                        <i class="ri-dashboard-fill"></i>
                        <span>Dashboard</span>
                    </a>
                     
                    <a href="../views/todo" class="sidebar__link">
                        <i class="ri-todo-fill"></i>
                        <span>To-Do List</span>
                    </a>

                    <a href="../views/journal" class="sidebar__link">
                        <i class="ri-booklet-fill"></i>
                        <span>Journal Notes</span>
                    </a>

                    <a href="../views/budget" class="sidebar__link">
                        <i class="ri-wallet-3-fill"></i>
                        <span>Budget Tracker</span>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="sidebar__title">SETTINGS</h3>

                <div class="sidebar__list">
                    <a href="../views/settings" class="sidebar__link">
                        <i class="ri-user-settings-fill"></i>
                        <span>Profile Settings</span>
                    </a>
                </div>
            </div>
        </div>
    
        <div class="sidebar__actions">
            <button>
                <i class="ri-moon-clear-fill sidebar__link sidebar__theme" id="theme-button">
                    <span>Theme</span>
                </i>
            </button>
   
            <a class="sidebar__link" href="../auth/logout">
                <i class="ri-logout-box-r-fill"></i>
                <span>Log Out</span>
            </a>
        </div>
    </div>
</nav>

<script src="../assets/js/sidebar.js"></script>