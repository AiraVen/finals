<?php
require 'config.php';

try {
    // Get the task and status from the form
    $task = trim($_POST['task']);
    $status = trim($_POST['status']);

    // Validate inputs
    if (empty($task) || empty($status)) {
        die("Error: Task and Status are required.");
    }

    // Prepare the SQL query with placeholders
    $stmt = $conn->prepare("INSERT INTO task (task, status) VALUES (:task, :status)");

    // Bind parameters to prevent SQL injection
    $stmt->bindParam(':task', $task);
    $stmt->bindParam(':status', $status);

    // Execute the query
    $stmt->execute();

    // Redirect to the homepage after successful addition
    header('Location: index.php');
    exit(); // Ensure no further code is executed after the redirect
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
