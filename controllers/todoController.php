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

//add
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_todo'])){
    $task =  trim($_POST['task']);
    $priority = trim($_POST['priority']);
    $status = trim($_POST['status']);
    $due_date = trim($_POST['due_date']);

    if (empty($task) || empty($priority) || empty($status) || empty($due_date)){
        $_SESSION['error_message'] = 'All fields are required';
        header("Location: ../views/todo");
        exit;
    }

    else {
        $stmt = $conn->prepare("INSERT INTO tasks (user_id, task, priority, status, due_date)
                                VALUES (:user_id, :task, :priority, :status, :due_date)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':task', $task);
        $stmt->bindParam(':priority', $priority);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':due_date', $due_date);
        
        if ($stmt->execute()){
            $_SESSION['success_message'] = 'To-Do added successfully.';
            header("Location: ../views/todo");
            exit;
        }

        else {
            $_SESSION['error_message'] = 'There was an error. Please try again.';
        }

        header("Location: ../views/todo");
        exit;
    }
}

//idit
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['edit_todo'])){
    $task_id = $_POST['task_id'];
    $task =  trim($_POST['task']);
    $priority = trim($_POST['priority']);
    $status = trim($_POST['status']);
    $due_date = trim($_POST['due_date']);

    $stmt = $conn->prepare("UPDATE tasks SET task = :task, priority = :priority, status = :status, due_date = :due_date
                            WHERE id = :id AND user_id = :user_id");
    $stmt->bindParam(':id', $task_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':task', $task);
    $stmt->bindParam(':priority', $priority);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':due_date', $due_date);
        
    if ($stmt->execute()){
        $_SESSION['success_message'] = 'To-Do updated successfully.';
    }

    else {
        $_SESSION['error_message'] = 'There was an error. Please try again.';
    }

    header("Location: ../views/todo");
    exit;
}

//delete
if (isset($_GET['delete_id'])){
    $task_id = $_GET['delete_id'];

    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = :id AND user_id = :user_id");
    $stmt->bindParam(':id', $task_id);
    $stmt->bindParam(':user_id', $user_id);

    if ($stmt->execute()){
        $_SESSION['success_message'] = 'To-Do deleted successfully.';
    }

    else {
        $_SESSION['error_message'] = 'There was an error. Please try again.';
    }

    header("Location: ../views/todo");
    exit;
}

//mark as done
if (isset($_GET['complete_id'])){
    $task_id = $_GET['complete_id'];

    $stmt = $conn->prepare("SELECT status FROM tasks WHERE id = :id AND user_id = :user_id");
    $stmt->bindParam(':id', $task_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    $check_task = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($check_task){
        if ($check_task['status'] === 'Done'){
            $_SESSION['info_message'] = 'Task is already done.';
        }

        else {
            $stmt = $conn->prepare("UPDATE tasks SET status = 'Done' WHERE id = :id AND user_id = :user_id");
            $stmt->bindParam(':id', $task_id);
            $stmt->bindParam(':user_id', $user_id);

            if ($stmt->execute()){
                $_SESSION['success_message'] = 'Task marked as done.';
            }

            else {
                $_SESSION['error_message'] = 'There was an error. Please try again.';
            }
        }
    }

    else {
        $_SESSION['error_message'] = 'Task not found.';
    }

    header("Location: ../views/todo");
    exit;
}

//display
$stmt = $conn->prepare("SELECT * FROM tasks WHERE user_id = :user_id ORDER BY due_date ASC");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$tasks = $stmt->fetchAll();

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

