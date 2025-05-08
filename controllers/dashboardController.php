<?php

session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id'])){
    header("Location: ../auth/login");
    exit;
}

$user_id = $_SESSION['user_id'];

#task
$stmt = $conn->prepare("SELECT COUNT(*) AS total_task FROM tasks WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$total_task = $stmt->fetch(PDO::FETCH_ASSOC)['total_task'];

#journel
$stmt = $conn->prepare("SELECT COUNT(*) AS total_journal_entry FROM journal_entries WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$total_journal_entry = $stmt->fetch(PDO::FETCH_ASSOC)['total_journal_entry'];

#income and expense
$stmt = $conn->prepare("SELECT SUM(amount) AS total_income FROM budget_entries WHERE user_id = :user_id AND type = 'income'");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$total_income = $stmt->fetchColumn() ?: 0;

$stmt = $conn->prepare("SELECT SUM(amount) AS total_expenses FROM budget_entries WHERE user_id = :user_id AND type = 'expense'");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$total_expenses = $stmt->fetchColumn()?: 0;

$total_balance = $total_income - $total_expenses;

#recent act
$stmt = $conn->prepare("SELECT 'Task' AS type, task AS title, created_at FROM tasks WHERE user_id = :user_id
                        UNION 
                        SELECT 'Journal' AS type, entry_title AS title, created_at FROM journal_entries WHERE user_id = :user_id
                        UNION
                        SELECT type AS type, description AS title, created_at FROM budget_entries WHERE user_id = :user_id
                        ORDER BY created_at DESC LIMIT 5");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$recent_activities = $stmt->fetchAll(PDO::FETCH_ASSOC);



// Calculate productivity metrics for radar chart

// Tasks completed in last 7 days
$stmt = $conn->prepare("SELECT COUNT(*) AS completed_tasks FROM tasks WHERE user_id = :user_id 
                        AND status = 'Done' AND created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$completed_tasks = $stmt->fetchColumn() ?: 0;

// Journal entries in last 7 days
$stmt = $conn->prepare("SELECT COUNT(*) AS journal_count FROM journal_entries WHERE user_id = :user_id 
                        AND created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$recent_journal_entries = $stmt->fetchColumn() ?: 0;

// Budget entries in last 7 days
$stmt = $conn->prepare("SELECT COUNT(*) AS budget_count FROM budget_entries WHERE user_id = :user_id 
                        AND created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$recent_budget_entries = $stmt->fetchColumn() ?: 0;

// Tasks by priority
$stmt = $conn->prepare("SELECT priority, COUNT(*) as count FROM tasks WHERE user_id = :user_id GROUP BY priority");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$tasks_by_priority = [
    'Low' => 0,
    'Medium' => 0,
    'High' => 0
];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $tasks_by_priority[$row['priority']] = (int)$row['count'];
}

// Convert productivity data to JSON for JavaScript
$productivity_data = json_encode([
    'labels' => ['Tasks', 'Journal', 'Budget', 'Task Priority'],
    'data' => [
        $completed_tasks,
        $recent_journal_entries,
        $recent_budget_entries,
        // Task priority score (weighted: High=3, Medium=2, Low=1)
        ($tasks_by_priority['High'] * 3 + $tasks_by_priority['Medium'] * 2 + $tasks_by_priority['Low']) / 
            max(1, ($tasks_by_priority['High'] + $tasks_by_priority['Medium'] + $tasks_by_priority['Low']))
    ]
]);

