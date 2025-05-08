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

//add
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_journal'])){
    $entry_title = trim($_POST['entry_title']);
    $entry_text = trim($_POST['entry_text']);
    $tags = trim($_POST['tags']);
    $image_path = NULL;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK){
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_name = basename($_FILES['image']['name']);
        $image_directory = '../uploads/journal_images/';


        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $image_type = mime_content_type($image_tmp_name);

        if (!in_array($image_type, $allowed_types)){
            $_SESSION['error_message'] = 'Invalid image type. Only JPG, PNG, and GIF are allowed.';
            header("Location: ../views/journal");
            exit;
        }

        $max_size = 5 * 1024 * 1024;

        if ($_FILES['image']['size'] > $max_size){
            $_SESSION['error_message'] = 'Image size exceeds the limit of 5MB.';
            header("Location: ../views/journal");
            exit;
        }


        $image_name = uniqid() . '_' . $image_name;
        $image_path = 'uploads/journal_images/' . $image_name;
        
        if (move_uploaded_file($image_tmp_name, $image_directory . $image_name)){
            $_SESSION['success_message'] = 'Image uploaded successfully.';
        }

        else {
            $_SESSION['error_message'] = 'Failed to upload the image. Please try again.';
            header("Location: ../views/journal");
            exit;
        }
    }

    $stmt = $conn->prepare("INSERT INTO journal_entries (user_id, entry_title, entry_text, tags, image_path)
                            VALUES (:user_id, :entry_title, :entry_text, :tags, :image_path)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':entry_title', $entry_title);
    $stmt->bindParam(':entry_text', $entry_text);
    $stmt->bindParam(':tags', $tags);
    $stmt->bindParam(':image_path', $image_path);
    
    if ($stmt->execute()){
        $_SESSION['success_message'] = 'Journal entry added successfully';
    }

    else {
        $_SESSION['error_message'] = 'There was an error. Please try again.';
    }

    header("Location: ../views/journal");
    exit;
}

//idit
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['edit_journal'])){
    $journal_id = $_POST['journal_id'];
    $entry_title = trim($_POST['entry_title']);
    $entry_text = trim($_POST['entry_text']);
    $tags = trim($_POST['tags']);
    $image_path = NULL;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK){
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_name = basename($_FILES['image']['name']);
        $image_directory = '../uploads/journal_images/';

        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $image_type = mime_content_type($image_tmp_name);

        if (!in_array($image_type, $allowed_types)){
            $_SESSION['error_message'] = 'Invalid image type. Only JPG, PNG, and GIF are allowed.';
            header("Location: ../views/journal");
            exit;
        }

        $max_size = 5 * 1024 * 1024;
        if ($_FILES['image']['size'] > $max_size){
            $_SESSION['error_message'] = 'Image size exceeds the limit of 5MB.';
            header("Location: ../views/journal");
            exit;
        }

        $image_name = uniqid() . '_' . $image_name;
        $image_path = 'uploads/journal_images/' . $image_name;

        if (!move_uploaded_file($image_tmp_name, $image_directory . $image_name)){
            $_SESSION['error_message'] = 'Failed to upload the image. Please try again.';
            header("Location: ../views/journal");
            exit;
        }
    } 
    
    else {
        // No new image uploaded, retain the existing image path
        $stmt = $conn->prepare("SELECT image_path FROM journal_entries WHERE id = :id AND user_id = :user_id");
        $stmt->bindParam(':id', $journal_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $entry = $stmt->fetch(PDO::FETCH_ASSOC);
        $image_path = $entry['image_path']; // Retain the old image path
    }

    $stmt = $conn->prepare("UPDATE journal_entries SET entry_title = :entry_title, entry_text = :entry_text, 
                            tags = :tags, image_path = :image_path
                            WHERE id = :id AND user_id = :user_id");
    $stmt->bindParam(':id', $journal_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':entry_title', $entry_title);
    $stmt->bindParam(':entry_text', $entry_text);
    $stmt->bindParam(':tags', $tags);
    $stmt->bindParam(':image_path', $image_path);

    if ($stmt->execute()){
        $_SESSION['success_message'] = 'Journal entry updated successfully';
    } 
    
    else {
        $_SESSION['error_message'] = 'There was an error. Please try again.';
    }

    header("Location: ../views/journal");
    exit;
}

//delete
if (isset($_GET['delete_id'])){
    $journal_id = $_GET['delete_id'];

    $stmt = $conn->prepare("DELETE FROM journal_entries WHERE id = :id AND user_id = :user_id");
    $stmt->bindParam(':id', $journal_id);
    $stmt->bindParam(':user_id', $user_id);

    if ($stmt->execute()){
        $_SESSION['success_message'] = 'Journal deleted successfully.';
    }

    else {
        $_SESSION['error_message'] = 'There was an error. Please try again';
    }

    header("Location: ../views/journal");
    exit;
}

//display
$stmt = $conn->prepare("SELECT * FROM journal_entries WHERE user_id = :user_id ORDER BY created_at ASC");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$journals = $stmt->fetchAll();


if (isset($_SESSION['error_message'])){
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

if (isset($_SESSION['success_message'])){
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

