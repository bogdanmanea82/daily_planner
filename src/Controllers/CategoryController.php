<?php
// /src/Controllers/CategoryController.php
require_once __DIR__ . '/../Services/CategoryService.php';

class CategoryController {
    private $categoryService;

    public function __construct() {
        $this->categoryService = new CategoryService();
    }

    public function index() {
        $categories = $this->categoryService->getAllCategories();
        include __DIR__ . '/../../views/categories/index.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $color = $_POST['color'] ?? '';
            $result = $this->categoryService->addCategory($name, $color);
            if ($result === true) {
                header('Location: categories.php');
                exit;
            } else {
                $errors = $result;
            }
        }
        include __DIR__ . '/../../views/categories/add.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        $category = $this->categoryService->getCategory($id);
        if (!$category) {
            die("Category not found");
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $color = $_POST['color'] ?? '';
            $result = $this->categoryService->updateCategory($id, $name, $color);
            if ($result === true) {
                header('Location: categories.php');
                exit;
            } else {
                $errors = $result;
            }
        }
        include __DIR__ . '/../../views/categories/edit.php';
    }

    // Renamed "delete" method to "remove"
    public function remove() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->categoryService->deleteCategory($id);
        }
        header('Location: categories.php');
        exit;
    }
}
?>