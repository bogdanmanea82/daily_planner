// public/index.php
<?php
require_once '../config/Database.php';
require_once '../src/Models/BaseModel.php';
require_once '../src/Models/Task.php';
require_once '../src/Models/Category.php';
require_once '../src/Repositories/TaskRepository.php';
require_once '../src/Repositories/CategoryRepository.php';
require_once '../src/Services/TaskService.php';
require_once '../src/Services/CategoryService.php';

$db = Database::getInstance();
$taskRepository = new TaskRepository($db);
$categoryRepository = new CategoryRepository($db);
$taskService = new TaskService($taskRepository);
$categoryService = new CategoryService($categoryRepository);

// Get today's tasks
$todayTasks = $taskService->getTasksForDay(date('Y-m-d'));
$categories = $categoryService->getAllCategories();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daily Planner - Dashboard</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <header class="main-header">
            <h1>Daily Planner</h1>
            <nav class="main-nav">
                <a href="/" class="active">Dashboard</a>
                <a href="/tasks.php">Tasks</a>
                <a href="/categories.php">Categories</a>
                <a href="/analytics.php">Analytics</a>
            </nav>
        </header>

        <div class="dashboard-grid">
            <!-- Quick Add Task Widget -->
            <div class="dashboard-widget">
                <h2>Quick Add Task</h2>
                <form action="/tasks.php?action=add" method="POST" class="quick-add-form">
                    <input type="text" name="title" placeholder="Task title" required>
                    <select name="category_id">
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category->category_id ?>">
                                <?= htmlspecialchars($category->name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="datetime-local" name="start_time" required>
                    <button type="submit" class="btn btn-primary">Add Task</button>
                </form>
            </div>

            <!-- Today's Tasks Widget -->
            <div class="dashboard-widget">
                <h2>Today's Tasks</h2>
                <div class="task-list">
                    <?php if (empty($todayTasks)): ?>
                        <p class="no-tasks">No tasks scheduled for today</p>
                    <?php else: ?>
                        <?php foreach ($todayTasks as $task): ?>
                            <div class="task-item">
                                <input type="checkbox" 
                                       <?= $task->status === 'completed' ? 'checked' : '' ?>
                                       onchange="updateTaskStatus(<?= $task->task_id ?>)">
                                <span class="task-title"><?= htmlspecialchars($task->title) ?></span>
                                <span class="task-time"><?= date('H:i', strtotime($task->start_time)) ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Categories Overview Widget -->
            <div class="dashboard-widget">
                <h2>Categories Overview</h2>
                <div class="categories-list">
                    <?php foreach ($categories as $category): ?>
                        <div class="category-item" style="border-left-color: <?= htmlspecialchars($category->color) ?>">
                            <span class="category-name"><?= htmlspecialchars($category->name) ?></span>
                            <span class="task-count"><?= $taskService->getTaskCountByCategory($category->category_id) ?> tasks</span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Quick Stats Widget -->
            <div class="dashboard-widget">
                <h2>Quick Stats</h2>
                <div class="stats-grid">
                    <div class="stat-item">
                        <span class="stat-label">Tasks Today</span>
                        <span class="stat-value"><?= count($todayTasks) ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Completed</span>
                        <span class="stat-value"><?= $taskService->getCompletedTasksCount(date('Y-m-d')) ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Categories</span>
                        <span class="stat-value"><?= count($categories) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateTaskStatus(taskId) {
            // Add AJAX call to update task status
            fetch('/tasks.php?action=update_status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    task_id: taskId,
                    status: event.target.checked ? 'completed' : 'pending'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update UI if needed
                }
            });
        }
    </script>
</body>
</html>