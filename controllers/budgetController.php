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
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_budget'])){
    $type = trim($_POST['type']);
    $amount = trim($_POST['amount']);
    $description = trim($_POST['description']);
    $category = trim($_POST['category']);
    $date_logged = trim($_POST['date_logged']);

    if (empty($type) || empty($amount) || empty($description) || empty($category) || empty($date_logged)){
        $_SESSION['error_message'] = 'All fields are required';
        header("Location: ../views/budget");
        exit;
    }

    if (!is_numeric($amount) || $amount <= 0){
        $_SESSION['error_message'] = 'Amount must be a valid number greater than 0';
        header("Location: ../views/budget");
        exit;
    }

    else {
        $stmt = $conn->prepare("INSERT INTO budget_entries (user_id, type, amount, description, category, date_logged)
                                VALUES (:user_id, :type, :amount, :description, :category, :date_logged)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':date_logged', $date_logged);

        if ($stmt->execute()){
            $_SESSION['success_message'] = 'Budget Tracker added successfully.';
            header("Location: ../views/budget");
            exit;
        }

        else {
            $_SESSION['error_message'] = 'There was an error. Please try again.';
        }
        
        header("Location: ../views/budget");
        exit;
    }
}

//idit
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['edit_budget'])){
    $budget_id = $_POST['budget_id'];
    $type = trim($_POST['type']);
    $amount = trim($_POST['amount']);
    $description = trim($_POST['description']);
    $category = trim($_POST['category']);
    $date_logged = trim($_POST['date_logged']);

    $stmt = $conn->prepare("UPDATE budget_entries SET type = :type, amount = :amount, description = :description, category = :category,
                            date_logged = :date_logged WHERE id = :id AND user_id = :user_id");
    $stmt->bindParam(':id', $budget_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':date_logged', $date_logged);

    if ($stmt->execute()){
        $_SESSION['success_message'] = 'Budget updated successfully.';
    }

    else {
        $_SESSION['error_message'] = 'There was an error. Please try again.';
    }

    header("Location: ../views/budget");
    exit;
}

//delete
if (isset($_GET['delete_id'])){
    $budget_id = $_GET['delete_id'];

    $stmt = $conn->prepare("DELETE FROM budget_entries WHERE id = :id AND user_id = :user_id");
    $stmt->bindParam(':id', $budget_id);
    $stmt->bindParam(':user_id', $user_id);

    if ($stmt->execute()){
        $_SESSION['success_message'] = 'Budget deleted successfully.';
    }

    else {
        $_SESSION['error_message'] = 'There was an error. Please try again.';
    }

    header("Location: ../views/budget");
    exit;
}

//display
$stmt = $conn->prepare("SELECT * FROM budget_entries WHERE user_id = :user_id ORDER BY date_logged ASC");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$budgets = $stmt->fetchAll();

if (isset($_SESSION['error_message'])){
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

if (isset($_SESSION['success_message'])){
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

