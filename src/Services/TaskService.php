<?php
// /src/Services/TaskService.php

require_once __DIR__ . '/../Repositories/TaskRepository.php';
require_once __DIR__ . '/../Models/Task.php';

class TaskService {
    private $taskRepo;

    public function __construct() {
        $this->taskRepo = new TaskRepository();
    }

    // Retrieve all tasks
    public function getAllTasks() {
        return $this->taskRepo->getAll();
    }

    // Retrieve a specific task by ID
    public function getTask($id) {
        return $this->taskRepo->getById($id);
    }

    // Add a new task
    public function addTask($title, $description, $due_date, $status, $priority, $category_id, $is_recurring, $recurring_interval) {
        $task = new Task(null, $title, $description, $due_date, $status, $priority, $category_id, $is_recurring, $recurring_interval);
        $errors = $task->validate();
        if (!empty($errors)) {
            return $errors;
        }
        return $this->taskRepo->create($task);
    }

    // Update an existing task
    public function updateTask($id, $title, $description, $due_date, $status, $priority, $category_id, $is_recurring, $recurring_interval) {
        $task = new Task($id, $title, $description, $due_date, $status, $priority, $category_id, $is_recurring, $recurring_interval);
        $errors = $task->validate();
        if (!empty($errors)) {
            return $errors;
        }
        return $this->taskRepo->update($task);
    }

    // Delete a task by its ID
    public function deleteTask($id) {
        return $this->taskRepo->delete($id);
    }

    // Mark a task as completed
    public function markTaskCompleted($id) {
        $task = $this->getTask($id);
        if (!$task) {
            return ['Task not found.'];
        }
        $task->status = 'completed';
        return $this->taskRepo->update($task);
    }

    // Handle recurring tasks by generating the next instance after completion.
    // This method recalculates the due date based on the recurring interval and resets the status.
    public function handleRecurringTask($id) {
        $task = $this->getTask($id);
        if (!$task) {
            return ['Task not found.'];
        }
        if ($task->is_recurring && $task->status === 'completed') {
            $task->due_date = $this->calculateNextDueDate($task->due_date, $task->recurring_interval);
            $task->status = 'pending';
            return $this->taskRepo->update($task);
        }
        return ['Task is either not recurring or has not been completed yet.'];
    }

    // Calculate the next due date based on the current due date and interval (daily, weekly, monthly)
    private function calculateNextDueDate($currentDueDate, $interval) {
        $date = new DateTime($currentDueDate);
        switch ($interval) {
            case 'daily':
                $date->modify('+1 day');
                break;
            case 'weekly':
                $date->modify('+1 week');
                break;
            case 'monthly':
                $date->modify('+1 month');
                break;
            default:
                // No modification if interval is not recognized
                break;
        }
        return $date->format('Y-m-d');
    }
}
?>