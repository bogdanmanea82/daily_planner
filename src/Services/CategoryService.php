<?php
// /src/Services/CategoryService.php
require_once __DIR__ . '/../Repositories/CategoryRepository.php';
require_once __DIR__ . '/../Models/Category.php';

class CategoryService {
    private $categoryRepo;

    public function __construct() {
        $this->categoryRepo = new CategoryRepository();
    }

    public function getAllCategories() {
        return $this->categoryRepo->getAll();
    }

    public function getCategory($id) {
        return $this->categoryRepo->getById($id);
    }

    public function addCategory($name, $color) {
        $category = new Category(null, $name, $color);
        $errors = $category->validate();
        if(!empty($errors)) {
            return $errors;
        }
        return $this->categoryRepo->create($category);
    }

    public function updateCategory($id, $name, $color) {
        $category = new Category($id, $name, $color);
        $errors = $category->validate();
        if(!empty($errors)) {
            return $errors;
        }
        return $this->categoryRepo->update($category);
    }

    public function deleteCategory($id) {
        return $this->categoryRepo->delete($id);
    }
}
?>