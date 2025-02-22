<?php
// /src/Repositories/TaskRepository.php

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../Models/Task.php';

class TaskRepository {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    // Retrieve all tasks
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM tasks");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Task');
        return $stmt->fetchAll();
    }

    // Retrieve a single task by its ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE id = ?");
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Task');
        return $stmt->fetch();
    }

    // Create a new task entry
    public function create(Task $task) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO tasks (title, description, due_date, status, priority, category_id, is_recurring, recurring_interval) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([
            $task->title,
            $task->description,
            $task->due_date,
            $task->status,
            $task->priority,
            $task->category_id,
            $task->is_recurring ? 1 : 0,
            $task->recurring_interval
        ]);
    }

    // Update an existing task
    public function update(Task $task) {
        $stmt = $this->pdo->prepare(
            "UPDATE tasks SET title = ?, description = ?, due_date = ?, status = ?, priority = ?, category_id = ?, is_recurring = ?, recurring_interval = ? WHERE id = ?"
        );
        return $stmt->execute([
            $task->title,
            $task->description,
            $task->due_date,
            $task->status,
            $task->priority,
            $task->category_id,
            $task->is_recurring ? 1 : 0,
            $task->recurring_interval,
            $task->getId()
        ]);
    }

    // Delete a task by its ID
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>