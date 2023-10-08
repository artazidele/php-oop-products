<?php
include_once 'Product.php';
class Furniture extends Product 
{
    private $dimensions;

    public function setSpecial($weight, $width, $height, $length, $size) 
    {
        $this->dimensions = "{$height}x{$width}x{$length}";
    }

    public function getSpecial() 
    {
        return "Dimension: {$this->dimensions}";
    }

    public function setSpecialForDB($special) 
    {
        $this->dimensions = $special;
    }

    public function getSpecialForDB() 
    {
        return $this->dimensions;
    }
}
?>