// src/Controllers/CategoryController.php
<?php
class CategoryController {
    private $categoryService;
    
    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }
    
    public function index() {
        $categories = $this->categoryService->getAllCategories();
        include ROOT_PATH . '/views/categories/index.php';
    }
    
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $categoryId = $this->categoryService->createCategory($_POST);
                header("Location: /categories.php?success=created");
                exit;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
                include ROOT_PATH . '/views/categories/add.php';
            }
        } else {
            include ROOT_PATH . '/views/categories/add.php';
        }
    }
    
    public function edit($id) {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->categoryService->updateCategory($id, $_POST);
                header("Location: /categories.php?success=updated");
                exit;
            } else {
                $category = $this->categoryService->getCategory($id);
                include ROOT_PATH . '/views/categories/edit.php';
            }
        } catch (NotFoundException $e) {
            header("Location: /categories.php?error=not_found");
            exit;
        }
    }
    
    public function delete($id) {
        try {
            $this->categoryService->deleteCategory($id);
            header("Location: /categories.php?success=deleted");
        } catch (Exception $e) {
            header("Location: /categories.php?error=delete_failed");
        }
        exit;
    }
}