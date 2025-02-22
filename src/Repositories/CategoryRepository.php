<?php
// /src/Repositories/CategoryRepository.php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../Models/Category.php';

class CategoryRepository {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM categories");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Category');
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Category');
        return $stmt->fetch();
    }

    public function create(Category $category) {
        $stmt = $this->pdo->prepare("INSERT INTO categories (name, color) VALUES (?, ?)");
        return $stmt->execute([$category->name, $category->color]);
    }

    public function update(Category $category) {
        $stmt = $this->pdo->prepare("UPDATE categories SET name = ?, color = ? WHERE id = ?");
        return $stmt->execute([$category->name, $category->color, $category->getId()]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM categories WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>