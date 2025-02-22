<?php
// /public/tasks.php
require_once __DIR__ . '/../src/Controllers/TaskController.php';

$controller = new TaskController();
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
    case 'complete':
        $controller->complete();
        break;
    case 'handleRecurring':
        $controller->handleRecurring();
        break;
    default:
        $controller->index();
        break;
}
?>