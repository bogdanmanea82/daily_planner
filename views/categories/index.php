// views/categories/index.php
<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Categories</h1>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">
                <?php
                    switch ($_GET['success']) {
                        case 'created': echo 'Category created successfully'; break;
                        case 'updated': echo 'Category updated successfully'; break;
                        case 'deleted': echo 'Category deleted successfully'; break;
                    }
                ?>
            </div>
        <?php endif; ?>
        
        <a href="/categories.php?action=add" class="btn btn-primary">Add New Category</a>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Color</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= htmlspecialchars($category->name) ?></td>
                    <td><?= htmlspecialchars($category->description) ?></td>
                    <td>
                        <div class="color-preview" style="background-color: <?= htmlspecialchars($category->color) ?>"></div>
                    </td>
                    <td>
                        <a href="/categories.php?action=edit&id=<?= $category->category_id ?>" class="btn btn-sm btn-info">Edit</a>
                        <a href="/categories.php?action=delete&id=<?= $category->category_id ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>