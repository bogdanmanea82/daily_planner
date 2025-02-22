// public/categories.php
<?php
define('ROOT_PATH', dirname(__DIR__));
require_once ROOT_PATH . '/config/Database.php';
require_once ROOT_PATH . '/src/Models/BaseModel.php';
require_once ROOT_PATH . '/src/Models/Category.php';
require_once ROOT_PATH . '/src/Repositories/CategoryRepository.php';
require_once ROOT_PATH . '/src/Services/CategoryService.php';
require_once ROOT_PATH . '/src/Controllers/CategoryController.php';

$db = Database::getInstance();
$categoryRepository = new CategoryRepository($db);
$categoryService = new CategoryService($categoryRepository);
$categoryController = new CategoryController($categoryService);

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'add':
        $categoryController->add();
        break;
    case 'edit':
        $categoryController->edit($id);
        break;
    case 'delete':
        $categoryController->delete($id);
        break;
    default:
        $categoryController->index();
}