<?php
// /src/Models/Task.php

require_once 'BaseModel.php';

class Task extends BaseModel {
    public $title;
    public $description;
    public $due_date;
    public $status;          // e.g., 'pending', 'completed', 'in_progress'
    public $priority;        // e.g., 'low', 'medium', 'high'
    public $category_id;     // Foreign key to Category (if applicable)
    public $is_recurring;    // Boolean flag to indicate recurring tasks
    public $recurring_interval; // e.g., 'daily', 'weekly', 'monthly'

    public function __construct(
        $id = null, 
        $title = '', 
        $description = '', 
        $due_date = null, 
        $status = 'pending', 
        $priority = 'medium', 
        $category_id = null, 
        $is_recurring = false, 
        $recurring_interval = null
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->due_date = $due_date;
        $this->status = $status;
        $this->priority = $priority;
        $this->category_id = $category_id;
        $this->is_recurring = $is_recurring;
        $this->recurring_interval = $recurring_interval;
    }

    public function validate() {
        $errors = [];

        if (empty($this->title)) {
            $errors[] = 'Task title is required.';
        }
        
        if (!empty($this->due_date) && strtotime($this->due_date) === false) {
            $errors[] = 'Invalid due date format.';
        }

        // Validate status against allowed values
        $valid_statuses = ['pending', 'completed', 'in_progress'];
        if (!in_array($this->status, $valid_statuses)) {
            $errors[] = 'Invalid status value. Allowed values: ' . implode(', ', $valid_statuses) . '.';
        }

        // Validate priority against allowed values
        $valid_priorities = ['low', 'medium', 'high'];
        if (!in_array($this->priority, $valid_priorities)) {
            $errors[] = 'Invalid priority value. Allowed values: ' . implode(', ', $valid_priorities) . '.';
        }

        // Optionally, add validation for recurring task settings if needed
        if ($this->is_recurring && empty($this->recurring_interval)) {
            $errors[] = 'Recurring interval must be specified for recurring tasks.';
        }

        return $errors;
    }
}
?>