<?php
include_once 'Product.php';
class Disk extends Product 
{
    private $size;

    public function setSpecial($weight, $width, $height, $length, $size) 
    {
        $this->size = $size;
    }

    public function getSpecial() 
    {
        return "Size: {$this->size}MB";
    }

    public function setSpecialForDB($special) 
    {
        $this->size = $special;
    }

    public function getSpecialForDB() 
    {
        return $this->size;
    }
}
?>