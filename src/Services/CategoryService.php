// src/Services/CategoryService.php
<?php
class CategoryService {
    private $categoryRepository;
    
    public function __construct(CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }
    
    public function createCategory(array $data) {
        $category = new Category($data);
        
        $errors = $category->validate();
        if (!empty($errors)) {
            throw new ValidationException($errors);
        }
        
        return $this->categoryRepository->save($category);
    }
    
    public function getAllCategories() {
        return $this->categoryRepository->findAll();
    }
    
    public function updateCategory($id, array $data) {
        $category = $this->categoryRepository->find($id);
        if (!$category) {
            throw new NotFoundException("Category not found");
        }
        
        foreach ($data as $key => $value) {
            $category->$key = $value;
        }
        
        $errors = $category->validate();
        if (!empty($errors)) {
            throw new ValidationException($errors);
        }
        
        return $this->categoryRepository->save($category);
    }
    
    public function deleteCategory($id) {
        return $this->categoryRepository->delete($id);
    }
}