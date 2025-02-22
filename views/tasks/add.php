<!-- views/tasks/add.php -->
<?php include 'views/header.php'; ?>

<div class="container">
    <h1>Add New Task</h1>
    
    <?php if (isset($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '' ?>">
        </div>
        
        <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" id="category_id" name="category_id">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category->id ?>" <?= (isset($_POST['category_id']) && $_POST['category_id'] == $category->id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category->name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="date" class="form-control" id="due_date" name="due_date" value="<?= isset($_POST['due_date']) ? htmlspecialchars($_POST['due_date']) : '' ?>">
        </div>

        <button type="submit" class="btn btn-primary">Create Task</button>
        <a href="/tasks.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include 'views/footer.php'; ?>