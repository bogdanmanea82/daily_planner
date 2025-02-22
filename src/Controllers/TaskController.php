// src/Controllers/TaskController.php
<?php
class TaskController {
    private $taskService;
    
    public function __construct(TaskService $taskService) {
        $this->taskService = $taskService;
    }
    
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $taskId = $this->taskService->createTask($_POST);
                header("Location: /tasks.php?id=$taskId&success=1");
                exit;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
                include 'views/tasks/add.php';
            }
        } else {
            include 'views/tasks/add.php';
        }
    }
}
?>