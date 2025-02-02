<?php
require_once 'config.php';

// Check if task_id is set and not empty
if (isset($_GET['task_id']) && !empty($_GET['task_id'])) {
    $task_id = intval($_GET['task_id']); // Sanitize input

    try {
        // Prepare the SQL query with a placeholder
        $stmt = $conn->prepare("DELETE FROM task WHERE task_id = :task_id");

        // Bind the parameter to prevent SQL injection
        $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Redirect back to the homepage after successful deletion
        header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        die("Error deleting task: " . $e->getMessage());
    }
} else {
    die("Invalid task ID.");
}
?>
