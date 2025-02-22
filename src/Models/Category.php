<?php
// /src/Models/Category.php
require_once 'BaseModel.php';

class Category extends BaseModel {
    public $name;
    public $color;

    public function __construct($id = null, $name = '', $color = '') {
        $this->id = $id;
        $this->name = $name;
        $this->color = $color;
    }

    public function validate() {
        $errors = [];
        if(empty($this->name)) {
            $errors[] = 'Category name is required.';
        }
        return $errors;
    }
}
?>