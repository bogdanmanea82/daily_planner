// src/Repositories/TaskRepository.php
<?php
class TaskRepository {
    private $db;
    
    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function findByDate($date) {
        $sql = "SELECT * FROM tasks WHERE DATE(start_time) = ? ORDER BY start_time";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$date]);
        
        $tasks = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tasks[] = new Task($row);
        }
        return $tasks;
    }
    
    public function countByCategory($categoryId) {
        $sql = "SELECT COUNT(*) FROM tasks WHERE category_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$categoryId]);
        return $stmt->fetchColumn();
    }
    
    public function countCompletedByDate($date) {
        $sql = "SELECT COUNT(*) FROM tasks WHERE DATE(start_time) = ? AND status = 'completed'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$date]);
        return $stmt->fetchColumn();
    }
    
    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE task_id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? new Task($result) : null;
    }
    
    public function save(Task $task) {
        if ($task->id) {
            return $this->update($task);
        }
        return $this->insert($task);
    }
    
    private function insert(Task $task) {
        $sql = "INSERT INTO tasks (title, description, category_id, 
                start_time, end_time, is_recurring, recurrence_pattern, priority) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $task->title,
            $task->description,
            $task->category_id,
            $task->start_time,
            $task->end_time,
            $task->is_recurring,
            $task->recurrence_pattern,
            $task->priority
        ]);
        
        return $this->db->lastInsertId();
    }
    
    private function update(Task $task) {
        // Similar to insert but with UPDATE SQL
    }
}
?>