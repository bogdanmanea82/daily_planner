<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Categories</h1>
    <a href="categories.php?action=add">Add Category</a>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Color</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($categories)): ?>
                <?php foreach($categories as $category): ?>
                    <tr style="color: <?php echo htmlspecialchars($category->color); ?>">
                        <td><?php echo $category->getId(); ?></td>
                        <td><?php echo htmlspecialchars($category->name); ?></td>
                        <td><?php echo htmlspecialchars($category->color); ?></td>
                        <td>
                            <a href="categories.php?action=edit&id=<?php echo $category->getId(); ?>">Edit</a> |
                            <a href="categories.php?action=delete&id=<?php echo $category->getId(); ?>" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No categories found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <br>
    <a href="tasks.php">Manage Tasks</a>
</body>
</html>
