<?php
abstract class Product 
{
    private $id;
    private $sku;
    private $name;
    private $price;
    private $type;

    public function setId($id) 
    {
        $this->id = $id;
    }

    public function setSKU($sku) 
    {
        $this->sku = $sku;
    }

    public function setName($name) 
    {
        $this->name = $name;
    }

    public function setPrice($price) 
    {
        $this->price = $price;
    }

    public function setType($type) 
    {
        $this->type = $type;
    }

    abstract public function setSpecial($weight, $width, $height, $length, $size);

    abstract public function setSpecialForDB($special);

    public function getSKU() 
    {
        return $this->sku;
    }

    public function getId() 
    {
        return $this->id;
    }

    public function getName() 
    {
        return $this->name;
    }

    public function getPrice() 
    {
        return $this->price;
    }

    public function getType() 
    {
        return $this->type;
    }

    abstract public function getSpecial();

    abstract public function getSpecialForDB();

}
?>