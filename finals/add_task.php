<?php
require_once 'config.php';

if (isset($_POST['add'])) {
    $task = trim($_POST['task']);

    if (!empty($task)) {
        // Use prepared statements to prevent SQL injection
        $stmt = $db->prepare("INSERT INTO `task` (task, status) VALUES (?, 'Pending')");
        $stmt->bind_param("s", $task);

        if ($stmt->execute()) {
            $stmt->close();
            header('Location: index.php');
            exit;
        } else {
            die("Error inserting task: " . $db->error);
        }
    } else {
        echo "Task cannot be empty!";
    }
}
?>
