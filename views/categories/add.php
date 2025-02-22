<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Add Category</h1>
    <?php if(isset($errors) && !empty($errors)): ?>
        <ul style="color: red;">
            <?php foreach($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="POST" action="categories.php?action=add">
        <label for="name">Category Name:</label><br>
        <input type="text" name="name" id="name" required><br><br>

        <label for="color">Color (hex code or color name):</label><br>
        <input type="text" name="color" id="color"><br><br>

        <button type="submit">Add Category</button>
    </form>
    <br>
    <a href="categories.php">Back to Category List</a>
</body>
</html>
