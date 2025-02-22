// src/Models/Category.php
<?php
class Category extends BaseModel {
    public function __construct(array $data = []) {
        $this->data = [
            'category_id' => null,
            'name' => '',
            'description' => '',
            'color' => '#000000'
        ];
        
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $this->data)) {
                $this->data[$key] = $value;
            }
        }
    }

    public function validate() {
        $errors = [];
        if (empty($this->data['name'])) {
            $errors[] = "Category name is required";
        }
        if (!empty($this->data['color']) && !preg_match('/^#[a-fA-F0-9]{6}$/', $this->data['color'])) {
            $errors[] = "Invalid color format. Use hex format (e.g., #FF0000)";
        }
        return $errors;
    }
}