<?php
include_once 'Product.php';
class Book extends Product 
{
    private $weight;

    public function setSpecial($weight, $width, $height, $length, $size) 
    {
        $this->weight = $weight;
    }

    public function getSpecial() 
    {
        return "Weight: {$this->weight}KG";
    }

    public function setSpecialForDB($special) 
    {
        $this->weight = $special;
    }

    public function getSpecialForDB() 
    {
        return $this->weight;
    }
}
?>