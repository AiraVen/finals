<!DOCTYPE html>
<html lang="en">
<head>
  <title>Todo List</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <nav>
    <a class="heading" href="#">ToDo App</a>
  </nav>
  <div class="container">
    <div class="input-area">
      <form method="POST" action="add_task.php">
        <input type="text" name="task" placeholder="write your tasks here..." required />
        <input type="hidden" name="status" value="Pending" />
        <button class="btn" name="add">Add Task</button>
      </form>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Tasks</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        require 'config.php';

        try {
          // Fetch all tasks from the database, ordered by task_id
          $stmt = $conn->query("SELECT * FROM task ORDER BY task_id ASC");

          $count = 1;
          while ($fetch = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
          <tr class="border-bottom">
            <td><?php echo $count++; ?></td>
            <td><?php echo htmlspecialchars($fetch['task']); ?></td>
            <td><?php echo htmlspecialchars($fetch['status']); ?></td>
            <td colspan="2" class="action">
              <?php
              if ($fetch['status'] != "Done") {
                echo '<a href="update_task.php?task_id=' . htmlspecialchars($fetch['task_id']) . '" class="btn-completed">Mark as Completed</a>';
              }
              ?>
              <a href="delete_task.php?task_id=<?php echo htmlspecialchars($fetch['task_id']); ?>" class="btn-remove">Delete</a>
            </td>
          </tr>
        <?php
          } // End of while loop
        } catch (PDOException $e) {
          die("Error: " . $e->getMessage());
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
