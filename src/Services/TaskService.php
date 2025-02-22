// src/Services/TaskService.php
<?php
class TaskService {
    private $taskRepository;
    
    public function __construct(TaskRepository $taskRepository) {
        $this->taskRepository = $taskRepository;
    }

    public function getTasksForDay($date) {
        return $this->taskRepository->findByDate($date);
    }
    
    public function getTaskCountByCategory($categoryId) {
        return $this->taskRepository->countByCategory($categoryId);
    }
    
    public function getCompletedTasksCount($date) {
        return $this->taskRepository->countCompletedByDate($date);
    }
    
    public function createTask(array $data) {
        $this->db->beginTransaction();
        try {
            $task = new Task($data);
            $errors = $task->validate();
            if (!empty($errors)) {
                throw new ValidationException($errors);
            }
            
            $taskId = $this->taskRepository->save($task);
            
            if ($task->is_recurring) {
                $this->createRecurringInstances($task);
            }
            
            $this->db->commit();
            return $taskId;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
    
    private function createRecurringInstances(Task $task) {
        // Implementation for creating recurring instances
    }
}
?>