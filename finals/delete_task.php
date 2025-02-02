<?php
require_once 'config.php';

if (isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];

    // Validate task_id as an integer
    if (filter_var($task_id, FILTER_VALIDATE_INT)) {
        // Use prepared statements for security
        $stmt = $db->prepare("DELETE FROM `task` WHERE `task_id` = ?");
        $stmt->bind_param("i", $task_id);

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: index.php");
            exit;
        } else {
            die("Error deleting task: " . $db->error);
        }
    } else {
        die("Invalid Task ID");
    }
} else {
    die("Task ID not provided");
}
?>
