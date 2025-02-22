<!DOCTYPE html>
<html>
<head>
    <title>Add Task</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Add Task</h1>
    <?php if(isset($errors) && !empty($errors)): ?>
        <ul style="color: red;">
            <?php foreach($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="POST" action="tasks.php?action=add">
        <label for="title">Title:</label><br>
        <input type="text" name="title" id="title" required><br><br>

        <label for="description">Description:</label><br>
        <textarea name="description" id="description"></textarea><br><br>

        <label for="due_date">Due Date (YYYY-MM-DD):</label><br>
        <input type="date" name="due_date" id="due_date"><br><br>

        <label for="status">Status:</label><br>
        <select name="status" id="status">
            <option value="pending" selected>Pending</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>
        </select><br><br>

        <label for="priority">Priority:</label><br>
        <select name="priority" id="priority">
            <option value="low">Low</option>
            <option value="medium" selected>Medium</option>
            <option value="high">High</option>
        </select><br><br>

        <label for="category_id">Category ID:</label><br>
        <input type="number" name="category_id" id="category_id"><br><br>

        <label for="is_recurring">Recurring Task:</label>
        <input type="checkbox" name="is_recurring" id="is_recurring"><br><br>

        <label for="recurring_interval">Recurring Interval (daily, weekly, monthly):</label><br>
        <input type="text" name="recurring_interval" id="recurring_interval"><br><br>

        <button type="submit">Add Task</button>
    </form>
    <br>
    <a href="tasks.php">Back to Task List</a>
</body>
</html>
