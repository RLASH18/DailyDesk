<?php

session_start();
include_once '../config/db.php';

if (!isset($_SESSION['user_id'])){
    header("Location: ../auth/login");
    exit;
}

$user_id = $_SESSION['user_id'];

$error_message = '';
$success_message = '';
$info_message = '';

$stmt = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update_profile'])){
    $username = htmlspecialchars(trim($_POST['username'] ?? '')) ;
    $current_password = htmlspecialchars(trim($_POST['current_password'] ?? ''));
    $new_password = htmlspecialchars(trim($_POST['new_password'] ?? ''));
    $confirm_password = htmlspecialchars(trim($_POST['confirm_password'] ?? ''));

    $username_changed = $username !== $user['username'];
    $profile_picture_uploaded = isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK;

    // If nothing was changed
    if (!$username_changed && empty($current_password) && empty($new_password) && empty($confirm_password) && !$profile_picture_uploaded){
        $_SESSION['info_message'] = 'There is no change at all.';
        header("Location: ../views/settings");
        exit;   
    }

    //username change
    if ($username_changed){

        if (strlen($username) < 3 || strlen($username) > 15 ){
            $_SESSION['error_message'] = 'Username must be between 3 and 15.';
        }

        else {
            $stmt = $conn->prepare("UPDATE users SET username = :username WHERE id = :user_id");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':username', $username);
    
            if ($stmt->execute()){
                $_SESSION['success_message'] = 'Username updated successfully.';
            }
    
            else {
                $_SESSION['error_message'] = 'There was an error. Please try again.';
            }
        }

    }

    // Password change
    if (!empty($current_password) || !empty($new_password) || !empty($confirm_password)){
        if (empty($current_password)){
            $_SESSION['error_message']= 'Current password is required.';
        } 
        
        elseif (empty($new_password)){
            $_SESSION['error_message'] = 'New password is required.';
        } 
        
        elseif (strlen($new_password) < 8){
            $_SESSION['error_message'] = 'Password must be at least 8 characters long.';
        } 
        
        elseif ($new_password !== $confirm_password){
            $_SESSION['error_message'] = 'Passwords do not match.';
        } 
        
        elseif (!password_verify($current_password, $user['password_hash'])){
            $_SESSION['error_message'] = 'Current password is incorrect.';
        } 

        else {
            $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("UPDATE users SET password_hash = :new_password_hash WHERE id = :user_id");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':new_password_hash', $new_password_hash);

            if ($stmt->execute()){
                $_SESSION['success_message'] = 'Password updated successfully.';
            } 
            
            else {
                $_SESSION['error_message'] = 'Error updating password.';
            }
        }
    }

    // Profile picture upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK){
        $profile_picture = $_FILES['profile_picture'];
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $image_extension = strtolower(pathinfo($profile_picture['name'], PATHINFO_EXTENSION));

        // Validate image
        $check = getimagesize($profile_picture['tmp_name']);

        if ($check === false){
            $_SESSION['error_message'] = 'File is not an image';
        } 
        
        elseif (!in_array($image_extension, $allowed_types)){
            $_SESSION['error_message'] = 'Only JPG, JPEG, PNG & GIF files are allowed';
        } 
        
        elseif ($profile_picture['size'] > 2000000){ // 2MB limit
            $_SESSION['error_message'] = 'File is too large (max 2MB)';
        } 
        
        else {
            $upload_directory = '../uploads/profile_pics/';
            
            if (!is_dir($upload_directory)) {
                mkdir($upload_directory, 0755, true);
            }

            $image_name = uniqid('profile_', true) . '.' . $image_extension;
            $image_path = $upload_directory . $image_name;

            if (move_uploaded_file($profile_picture['tmp_name'], $image_path)){
                // Delete old profile picture if exists
                if (!empty($user['profile_pic']) && $user['profile_pic'] !== 'default.png' && file_exists($upload_directory . $user['profile_pic'])){
                    unlink($upload_directory . $user['profile_pic']);
            }
            
                
                // Update database
                $stmt = $conn->prepare("UPDATE users SET profile_pic = :profile_pic WHERE id = :user_id");
                $stmt->bindParam(':user_id', $user_id);
                $stmt->bindParam(':profile_pic', $image_name);
                
                if ($stmt->execute()){
                    $_SESSION['success_message'] = 'Profile picture updated successfully';
                } 
                
                else {
                    $_SESSION['error_message'] = 'Error updating profile picture';
                }
            } 
            
            else {
                $_SESSION['error_message'] = 'Error uploading file';
            }
        }
    }

    header("Location: ../views/settings");
    exit;
}

// Handle account deletion
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete_account'])) {
    $delete_password = htmlspecialchars(trim($_POST['delete_password'] ?? ''));
    
    if (empty($delete_password)) {
        $_SESSION['error_message'] = 'Password is required to delete account.';
    } 

    elseif (!password_verify($delete_password, $user['password_hash'])) {
        $_SESSION['error_message'] = 'Incorrect password.';
    } 

    else {
        try {
            // Start transaction
            $conn->beginTransaction();
            
            // Delete user's profile picture if it exists
            if (!empty($user['profile_pic']) && $user['profile_pic'] !== 'default.png') {
                $profile_pic_path = '../uploads/profile_pics/' . $user['profile_pic'];
                if (file_exists($profile_pic_path)) {
                    unlink($profile_pic_path);
                }
            }
            
            // Delete user's data from related tables first (if any)
            // Add your related table deletions here if needed
            // Example: $conn->prepare("DELETE FROM user_posts WHERE user_id = :user_id")->execute([':user_id' => $user_id]);
            
            // Finally, delete the user
            $stmt = $conn->prepare("DELETE FROM users WHERE id = :user_id");
            $stmt->bindParam(':user_id', $user_id);
            
            if ($stmt->execute()) {
                $conn->commit();
                
                // Clear session and redirect to login
                session_destroy();
                header("Location: ../index?message=account_deleted");
                exit;
            } 
            
            else {
                throw new Exception("Failed to delete user. Please try again.");
            }
        } 
        
        catch (Exception $e) {
            $conn->rollBack();
            $_SESSION['error_message'] = 'Error deleting account. Please try again.';
        }
    }
    
    header("Location: ../views/settings");
    exit;
}

if (isset($_SESSION['error_message'])){
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

if (isset($_SESSION['success_message'])){
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['info_message'])){
    $info_message = $_SESSION['info_message'];
    unset($_SESSION['info_message']);
}
