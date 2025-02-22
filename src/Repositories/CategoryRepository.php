// src/Repositories/CategoryRepository.php
<?php
class CategoryRepository {
    private $db;
    
    public function __construct(PDO $db) {
        $this->db = $db;
    }
    
    public function findAll() {
        $stmt = $this->db->query("SELECT * FROM categories ORDER BY name");
        $categories = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = new Category($row);
        }
        return $categories;
    }
    
    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE category_id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? new Category($result) : null;
    }
    
    public function save(Category $category) {
        if ($category->category_id) {
            return $this->update($category);
        }
        return $this->insert($category);
    }
    
    private function insert(Category $category) {
        $sql = "INSERT INTO categories (name, description, color) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $category->name,
            $category->description,
            $category->color
        ]);
        return $this->db->lastInsertId();
    }
    
    private function update(Category $category) {
        $sql = "UPDATE categories SET name = ?, description = ?, color = ? WHERE category_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $category->name,
            $category->description,
            $category->color,
            $category->category_id
        ]);
    }
    
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE category_id = ?");
        return $stmt->execute([$id]);
    }
}