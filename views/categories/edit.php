<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Edit Category</h1>
    <?php if(isset($errors) && !empty($errors)): ?>
        <ul style="color: red;">
            <?php foreach($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="POST" action="categories.php?action=edit&id=<?php echo $category->getId(); ?>">
        <label for="name">Category Name:</label><br>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($category->name); ?>" required><br><br>

        <label for="color">Color (hex code or color name):</label><br>
        <input type="text" name="color" id="color" value="<?php echo htmlspecialchars($category->color); ?>"><br><br>

        <button type="submit">Update Category</button>
    </form>
    <br>
    <a href="categories.php">Back to Category List</a>
</body>
</html>
