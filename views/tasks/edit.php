<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Edit Task</h1>
    <?php if(isset($errors) && !empty($errors)): ?>
        <ul style="color: red;">
            <?php foreach($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="POST" action="tasks.php?action=edit&id=<?php echo $task->getId(); ?>">
        <label for="title">Title:</label><br>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($task->title); ?>" required><br><br>

        <label for="description">Description:</label><br>
        <textarea name="description" id="description"><?php echo htmlspecialchars($task->description); ?></textarea><br><br>

        <label for="due_date">Due Date (YYYY-MM-DD):</label><br>
        <input type="date" name="due_date" id="due_date" value="<?php echo htmlspecialchars($task->due_date); ?>"><br><br>

        <label for="status">Status:</label><br>
        <select name="status" id="status">
            <option value="pending" <?php if($task->status === 'pending') echo 'selected'; ?>>Pending</option>
            <option value="in_progress" <?php if($task->status === 'in_progress') echo 'selected'; ?>>In Progress</option>
            <option value="completed" <?php if($task->status === 'completed') echo 'selected'; ?>>Completed</option>
        </select><br><br>

        <label for="priority">Priority:</label><br>
        <select name="priority" id="priority">
            <option value="low" <?php if($task->priority === 'low') echo 'selected'; ?>>Low</option>
            <option value="medium" <?php if($task->priority === 'medium') echo 'selected'; ?>>Medium</option>
            <option value="high" <?php if($task->priority === 'high') echo 'selected'; ?>>High</option>
        </select><br><br>

        <label for="category_id">Category ID:</label><br>
        <input type="number" name="category_id" id="category_id" value="<?php echo htmlspecialchars($task->category_id); ?>"><br><br>

        <label for="is_recurring">Recurring Task:</label>
        <input type="checkbox" name="is_recurring" id="is_recurring" <?php echo $task->is_recurring ? 'checked' : ''; ?>><br><br>

        <label for="recurring_interval">Recurring Interval (daily, weekly, monthly):</label><br>
        <input type="text" name="recurring_interval" id="recurring_interval" value="<?php echo htmlspecialchars($task->recurring_interval); ?>"><br><br>

        <button type="submit">Update Task</button>
    </form>
    <br>
    <a href="tasks.php">Back to Task List</a>
</body>
</html>
