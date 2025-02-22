// src/Models/Task.php
<?php
class Task extends BaseModel {
    public function __construct(array $data = []) {
        $this->data = [
            'id' => null,
            'title' => '',
            'description' => '',
            'category_id' => null,
            'start_time' => null,
            'end_time' => null,
            'is_recurring' => false,
            'recurrence_pattern' => null,
            'priority' => 'medium'
        ];
        
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $this->data)) {
                $this->data[$key] = $value;
            }
        }
    }

    public function validate() {
        $errors = [];
        if (empty($this->data['title'])) {
            $errors[] = "Title is required";
        }
        if (empty($this->data['start_time'])) {
            $errors[] = "Start time is required";
        }
        // Add more validation as needed
        return $errors;
    }
}
?>