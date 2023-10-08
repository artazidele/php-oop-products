<?php

include_once 'database/Database.php';
include_once 'model/Book.php';
include_once 'model/Disk.php';
include_once 'model/Furniture.php';
include_once 'model/Product.php';

class ProductController {

    public $db;
    public function __construct() {
        $this->db = new Database();
    }

    public function addProduct($data) {
        
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
                $msg = "Please fill all fields.";
                return $msg;
            } else {
                $newProduct = new Book();
            }
        } elseif ($type == "disk") {
            if (empty($sku) || empty($name) || empty($price) || empty($size)) {
                $msg = "Please fill all fields.";
                return $msg;
            } else {
                $newProduct = new Disk();
            }
        } else {
            if (empty($sku) || empty($name) || empty($price) || empty($width) || empty($height) || empty($length)) {
                $msg = "Please fill all fields.";
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

        $specialDB = $newProduct->getSpecialForDB();

        $query = "INSERT INTO `products`(`sku`, `name`, `price`, `type`, `special`) 
        VALUES ('$sku', '$name', '$price', '$type', '$specialDB')";
        $result = $this->db->addProduct($query);
        if ($result) {
            $msg = "Product added successfully.";
            return $msg;
        } else {
            $msg = "Product is not added successfully.";
            return $msg;
        }
    }


    public function getAllProducts() {
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


    // public $productArray = [];
    // public function changeDelete($product) {
    //     if (in_array($product, $this->productArray)) {
    //         $key = array_search($product, $this->productArray);
    //         unset($this->productArray[$key]);
    //     } else {
    //         array_push($this->productArray, $product);
    //     }
    //     return sizeof($this->productArray);
    // }

    public function deleteProduct($id) {
        $query = "DELETE FROM products WHERE id = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteProducts($idArray) {
        // return sizeof($idArray);
        foreach ($idArray as $id) {
            $result = $this->deleteProduct($id);
            if ($result == false) {
                return "Sorry, we could not delete all products";
            }
        }
    }

    
}
?>