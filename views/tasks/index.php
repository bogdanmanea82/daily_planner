<?php require_once '../views/header.php'; ?>

<div class="container">
    <h1>Tasks</h1>
    <a href="tasks.php?action=create" class="btn btn-primary">Add New Task</a>
    
    <div class="tasks-list">
        <?php foreach ($tasks as $task): ?>
            <div class="task-item">
                <h3><?= htmlspecialchars($task->title) ?></h3>
                <p><?= htmlspecialchars($task->description) ?></p>
                <div class="task-meta">
                    <span class="due-date">Due: <?= htmlspecialchars($task->due_date) ?></span>
                    <span class="category">Category: <?= htmlspecialchars($task->category_name) ?></span>
                    <span class="status">Status: <?= htmlspecialchars($task->status) ?></span>
                </div>
                <div class="task-actions">
                    <a href="tasks.php?action=edit&id=<?= $task->id ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="tasks.php?action=delete&id=<?= $task->id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once '../views/footer.php'; ?>