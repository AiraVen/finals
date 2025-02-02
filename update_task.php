<?php
require_once 'config.php';

if (isset($_GET['task_id']) && !empty($_GET['task_id'])) {
    $task_id = intval($_GET['task_id']); // Sanitize input

    try {
        // Prepare the SQL query with a placeholder
        $stmt = $conn->prepare("UPDATE task SET status = 'Done' WHERE task_id = :task_id");

        // Bind the parameter to prevent SQL injection
        $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Redirect to the homepage after successful update
        header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        die("Error updating task: " . $e->getMessage());
    }
} else {
    die("Invalid task ID.");
}
?>
