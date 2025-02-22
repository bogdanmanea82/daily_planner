// views/categories/add.php
<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Add New Category</h1>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="/categories.php?action=add">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required
                       value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>">
            </div>
            
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control"><?= isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '' ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="color">Color:</label>
                <input type="color" id="color" name="color" class="form-control"
                       value="<?= isset($_POST['color']) ? htmlspecialchars($_POST['color']) : '#000000' ?>">
            </div>
            
            <button type="submit" class="btn btn-primary">Create Category</button>
            <a href="/categories.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>