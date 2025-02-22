// src/Models/BaseModel.php

<?php
abstract class BaseModel {
    protected $data = [];
    
    public function __get($name) {
        return $this->data[$name] ?? null;
    }
    
    public function __set($name, $value) {
        $this->data[$name] = $value;
    }
    
    public function toArray() {
        return $this->data;
    }
}
?>