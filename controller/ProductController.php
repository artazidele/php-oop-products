<?php
include_once 'database/Database.php';
include_once 'model/Book.php';
include_once 'model/Disk.php';
include_once 'model/Furniture.php';
include_once 'model/Product.php';

class ProductController 
{
    public $db;

    public function __construct() 
    {
        $this->db = new Database();
    }

    public function addProduct($data) 
    {
        $sku = $data['sku'];
        $name = $data['name'];
        $price = $data['price'];
        $type = $data['type'];
        $weight = $data['weight'];
        $height = $data['height'];
        $width = $data['width'];
        $length = $data['length'];
        $size = $data['size'];

        if ($type == "book") {
            if (empty($sku) || empty($name) || empty($price) || empty($weight)) {
                $msg = "Please, submit required data";
                return $msg;
            } else {
                $newProduct = new Book();
            }
        } elseif ($type == "disk") {
            if (empty($sku) || empty($name) || empty($price) || empty($size)) {
                $msg = "Please, submit required data";
                return $msg;
            } else {
                $newProduct = new Disk();
            }
        } else {
            if (empty($sku) || empty($name) || empty($price) || empty($width) || empty($height) || empty($length)) {
                $msg = "Please, submit required data";
                return $msg;
            } else {
                $newProduct = new Furniture();
            }
        }

        $newProduct->setSKU($sku);
        $newProduct->setName($name);
        $newProduct->setPrice($price);
        $newProduct->setType($type);
        $newProduct->setSpecial($weight, $width, $height, $length, $size);

        if ($this->validateData($newProduct) == true) {
            if ($this->uniqueSKU($newProduct) == true) {
                $specialDB = $newProduct->getSpecialForDB();
                $query = "INSERT INTO `products`(`sku`, `name`, `price`, `type`, `special`) 
                VALUES ('$sku', '$name', '$price', '$type', '$specialDB')";
                $result = $this->db->addProduct($query);
                if ($result) {
                    return true;
                } else {
                    $msg = "Product is not added successfully";
                    return $msg;
                }
            } else {
                $msg = "Please, provide unique SKU";
                return $msg;
            }
        } else {
            $msg = "Please, provide the data of indicated type";
            return $msg;
        }
    }

    private function validateData($product) 
    {
        $price_pattern = "/^((([1-9][0-9]{0,7})|0)|((([1-9][0-9]{0,7})|0)\.[0-9]{1,2}))$/";
        $weight_pattern = "/^((([1-9][0-9]{0,7})|0)|((([1-9][0-9]{0,7})|0)\.[0-9]{1,3}))$/";
        if (strlen($product->getSKU()) > 10 || preg_match("/^([A-Z0-9]+)$/", $product->getSKU()) == false) {
            return false;
        } elseif (strlen($product->getName()) > 255) {
            return false;
        } elseif (preg_match($price_pattern, $product->getPrice()) == false){
            return false;
        } elseif (preg_match($price_pattern, $product->getPrice()) == true) {
            $price = $product->getPrice();
            if (preg_match("/^(([1-9][0-9]{0,7})|0)$/", $price)) {
                $newPrice = $price . ".00";
                $product -> setPrice($newPrice);
            } elseif (preg_match("/^((([1-9][0-9]{0,7})|0)\.[0-9])$/", $price)) {
                $newPrice = $price . "0";
                $product -> setPrice($newPrice);
            }
        } else {
            if ($product->getType() == "book") {
                if (preg_match($weight_pattern, $product->getSpecialForDB()) == false) {
                    return false;
                }
            } elseif ($product->getType() == "disk") {
                if (preg_match("/^([1-9][0-9]*)$/", $product->getSpecialForDB()) == false) {
                    return false;
                }
            } else {
                if (preg_match("/^([1-9][0-9]*[x][1-9][0-9]*[x][1-9][0-9]*)^/", $product->getSpecialForDB()) == false) {
                    return false;
                }
            }
        }
        return true;
    }

    private function uniqueSKU($product) 
    {
        $allProducts = $this->getAllProducts();
        foreach ($allProducts as $oneProduct) {
            if ($oneProduct->getSKU() == $product->getSKU()) {
                return false;
            }
        }
        return true;
    }


    public function getAllProducts() 
    {
        $query = "SELECT * FROM products ORDER BY id ASC";
        $result = $this->db->getProducts($query);
        if ($result) {
            $allProducts = [];
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['type'] == "book") {
                    $product = new Book();
                } elseif ($row['type'] == "disk") {
                    $product = new Disk();
                } else {
                    $product = new Furniture();
                }
                $product->setId($row['id']);
                $product->setSKU($row['sku']);
                $product->setName($row['name']);
                $product->setPrice($row['price']);
                $product->setType($row['type']);
                $product->setSpecialForDB($row['special']);
                array_push($allProducts, $product);
            };
            return $allProducts;
        } else {
            return $result;
        }
    }

    public function deleteProduct($id) 
    {
        $query = "DELETE FROM products WHERE id = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteProducts($idArray) 
    {
        foreach ($idArray as $id) {
            $result = $this->deleteProduct($id);
            if ($result == false) {
                return false;
            }
        }
    }
}
?>