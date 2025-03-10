<?php
// /public/categories.php
require_once __DIR__ . '/../src/Controllers/CategoryController.php';

$controller = new CategoryController();
$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'add':
        $controller->add();
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        $controller->index();
        break;
}
?>