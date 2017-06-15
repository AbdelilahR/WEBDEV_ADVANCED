<?php
class Boek {
    public $productID;
    public $name;
    public $description;
    public $price;
    

    public function __construct($productID, $name, $description, $price) {
        $this->productID = $productID;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        
    }

    //Extra functionaliteit kan je hier schrijven
}
