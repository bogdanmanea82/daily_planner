<?php
// /src/Models/BaseModel.php
abstract class BaseModel {
    protected $id;

    public function getId() {
        return $this->id;
    }
}
?>