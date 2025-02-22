<?php
// /src/Controllers/TaskController.php

require_once __DIR__ . '/../Services/TaskService.php';

class TaskController {
    private $taskService;

    public function __construct() {
        $this->taskService = new TaskService();
    }

    // Display all tasks
    public function index() {
        $tasks = $this->taskService->getAllTasks();
        include __DIR__ . '/../../views/tasks/index.php';
    }

    // Add a new task
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $due_date = $_POST['due_date'] ?? '';
            $status = $_POST['status'] ?? 'pending';
            $priority = $_POST['priority'] ?? 'medium';
            $category_id = $_POST['category_id'] ?? null;
            $is_recurring = isset($_POST['is_recurring']) ? true : false;
            $recurring_interval = $_POST['recurring_interval'] ?? '';

            $result = $this->taskService->addTask(
                $title, 
                $description, 
                $due_date, 
                $status, 
                $priority, 
                $category_id, 
                $is_recurring, 
                $recurring_interval
            );

            if ($result === true) {
                header('Location: tasks.php');
                exit;
            } else {
                $errors = $result;
            }
        }
        include __DIR__ . '/../../views/tasks/add.php';
    }

    // Edit an existing task
    public function edit() {
        $id = $_GET['id'] ?? null;
        $task = $this->taskService->getTask($id);
        if (!$task) {
            die("Task not found");
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $due_date = $_POST['due_date'] ?? '';
            $status = $_POST['status'] ?? 'pending';
            $priority = $_POST['priority'] ?? 'medium';
            $category_id = $_POST['category_id'] ?? null;
            $is_recurring = isset($_POST['is_recurring']) ? true : false;
            $recurring_interval = $_POST['recurring_interval'] ?? '';

            $result = $this->taskService->updateTask(
                $id,
                $title, 
                $description, 
                $due_date, 
                $status, 
                $priority, 
                $category_id, 
                $is_recurring, 
                $recurring_interval
            );
            if ($result === true) {
                header('Location: tasks.php');
                exit;
            } else {
                $errors = $result;
            }
        }
        include __DIR__ . '/../../views/tasks/edit.php';
    }

    // Delete a task by its ID
    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->taskService->deleteTask($id);
        }
        header('Location: tasks.php');
        exit;
    }

    // Mark a task as completed
    public function complete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->taskService->markTaskCompleted($id);
        }
        header('Location: tasks.php');
        exit;
    }

    // Handle recurring tasks (e.g., recalculate next due date after completion)
    public function handleRecurring() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->taskService->handleRecurringTask($id);
        }
        header('Location: tasks.php');
        exit;
    }
}
?>