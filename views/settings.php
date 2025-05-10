<?php include '../controllers/settingsController.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DailyDesk - Profile Settings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/settings.css">
</head>

<body>

    <?php include '../includes/sidebar.php'; ?>

    <main class="main container-fluid" id="main">
        <h1 class="my-4">Profile Settings</h1>

        <?php include '../includes/message.php'; ?>

        <div class="row mt-4">
            <div class="col-12 mb-xl-0 mb-4">
                <div class="card mb-4">
                    <div class="card-body p-0">

                        <form action="../controllers/settingsController.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="update_profile" value="1">
                            <div class="card shadow-lg" style="border-radius: 1rem;">

                                <div class="row g-0">

                                    <div class="col-md-4 profile-pic-section text-center d-flex flex-column align-items-center justify-content-center">
                                        <div class="profile-pic-wrapper">
                                            <img src="../uploads/profile_pics/<?= htmlspecialchars($user['profile_pic'] ?? 'default.png'); ?>"
                                                alt="Profile Picture"
                                                class="profile-pic"
                                                id="profile-pic-preview">
                                            <label for="profile_picture" class="profile-camera-btn">
                                                <i class="fas fa-camera"></i>
                                            </label>
                                            <input type="file" name="profile_picture" id="profile_picture" class="hidden-input" onchange="previewImage(event)">
                                        </div>
                                    </div>

                                    <!-- Form Column -->
                                    <div class="col-md-8 d-flex align-items-center">
                                        <div class="card-body p-4 p-lg-5 text-black">

                                            <div class="mb-3">
                                                <label for="username" class="form-label">Change Username</label>
                                                <input type="text" name="username" id="username" class="form-control" value="<?= htmlspecialchars($user['username']); ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="text" name="email" id="email" class="form-control" value="<?= htmlspecialchars($user['email']); ?>" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="current_password" class="form-label">Current Password</label>
                                                <input type="password" name="current_password" id="current_password" class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label for="new_password" class="form-label">New Password</label>
                                                <input type="password" name="new_password" id="new_password" class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label for="new_password" class="form-label">Confirm New Password</label>
                                                <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                                            </div>

                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="togglePassword">
                                                <label class="form-check-label mb-4" for="togglePassword">Show Passwords</label>
                                            </div>

                                            <div class="d-grid gap-2 d-sm-flex">
                                                <button type="submit" class="btn btn-primary responsive-btn" name="update_profile">
                                                    <i class="fas fa-user-edit me-2"></i> Update Profile
                                                </button>

                                                <button type="button" class="btn btn-danger responsive-btn" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                                    <i class="fas fa-trash-alt me-2"></i> Delete Account
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Account Modal -->
        <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAccountModalLabel">Delete Account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger"><i class="fas fa-exclamation-triangle me-2"></i>Warning: This action cannot be undone!</p>
                        <p>Are you sure you want to delete your account? All your data will be permanently removed.</p>
                        <form action="../controllers/settingsController.php" method="POST">
                            <input type="hidden" name="delete_account" value="1">
                            <div class="mb-3">
                                <label for="delete_password" class="form-label">Enter your password to confirm</label>
                                <input type="password" class="form-control" id="delete_password" name="delete_password" required>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-danger">Delete Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/show-password.js"></script>
    <script src="../assets/js/message.js"></script>
</body>

</html>