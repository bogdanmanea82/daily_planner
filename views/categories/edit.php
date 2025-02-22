// views/categories/edit.php
<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Category</h1>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="/categories.php?action=edit&id=<?= $category->category_id ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required
                       value="<?= htmlspecialchars($category->name) ?>">
            </div>
            
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control"><?= htmlspecialchars($category->description) ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="color">Color:</label>
                <input type="color" id="color" name="color" class="form-control"
                       value="<?= htmlspecialchars($category->color) ?>">
            </div>
            
            <button type="submit" class="btn btn-primary">Update Category</button>
            <a href="/categories.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>