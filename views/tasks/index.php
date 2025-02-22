<!DOCTYPE html>
<html>
<head>
    <title>Tasks</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Tasks</h1>
    <a href="tasks.php?action=add">Add Task</a>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Category</th>
                <th>Recurring</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($tasks)): ?>
                <?php foreach($tasks as $task): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($task->title); ?></td>
                        <td><?php echo htmlspecialchars($task->description); ?></td>
                        <td><?php echo htmlspecialchars($task->due_date); ?></td>
                        <td><?php echo htmlspecialchars($task->status); ?></td>
                        <td><?php echo htmlspecialchars($task->priority); ?></td>
                        <td><?php echo htmlspecialchars($task->category_id); ?></td>
                        <td><?php echo $task->is_recurring ? 'Yes (' . htmlspecialchars($task->recurring_interval) . ')' : 'No'; ?></td>
                        <td>
                            <a href="tasks.php?action=edit&id=<?php echo $task->getId(); ?>">Edit</a> |
                            <a href="tasks.php?action=delete&id=<?php echo $task->getId(); ?>" onclick="return confirm('Are you sure you want to delete this task?');">Delete</a> |
                            <?php if($task->status !== 'completed'): ?>
                                <a href="tasks.php?action=complete&id=<?php echo $task->getId(); ?>">Mark as Completed</a>
                            <?php endif; ?>
                            <?php if($task->is_recurring && $task->status === 'completed'): ?>
                                | <a href="tasks.php?action=handleRecurring&id=<?php echo $task->getId(); ?>">Handle Recurring</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No tasks found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <br>
    <a href="categories.php">Manage Categories</a>
</body>
</html>
