<?php
include_once 'controller/ProductController.php';
$productController = new ProductController();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productController->addProduct($_POST);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Add</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body onload="onPageLoad()">
    <div class="container">
        <div class="row">
        <form id="#product_form" method="POST">
            <div class="col-md-12 pt-4">
                <div class="row mt-4">
                    <div class="col-md-8">
                        <h2>Product Add</h2>
                    </div>
                    <div class="col-md-4 float-end">
                        <div class="float-end">
                            <input type="submit" class="btn btn-primary me-4" value="Save"/>
                            <a href="index.php" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </div>
                <hr class="border border-2 border-dark">
                <div class="row">
                        <div class="row mb-4">
                            <label for="" class="col-md-1">SKU</label>
                            <input id="#sku" type="text" name="sku" class="col-md-4" placeholder="Please type product's SKU"/>
                        </div>
                        <div class="row mb-4">
                            <label for="" class="col-md-1">Name</label>
                            <input id="#name" type="text" name="name" class="col-md-4" placeholder="Please type product's name"/>
                        </div>
                        <div class="row mb-4">
                            <label for="" class="col-md-1">Price ($)</label>
                            <input id="#price" type="text" name="price" class="col-md-4" placeholder="Please type product's price"/>
                        </div>
                        <div class="row mb-4">
                            <label for="" class="col-md-2">Type Switcher</label>
                            <select onchange="onSelectedElementChange()" id="#productType" name="type" class="col-md-3">
                                <option value="book">Book</option>
                                <option value="disk">DVD</option>
                                <option value="furniture">Furniture</option>
                            </select>
                        </div>
                        <div class="row mb-4">
                            <div id="disk">
                                <p>Please provide DVD's size in MB</p>
                                <label for="" class="col-md-1">Size (MB)</label>
                                <input id="#size" type="text" name="size" class="col-md-4" placeholder="DVD's size"/>
                            </div>
                            <div id="furniture">
                                <p>Please provide furniture's dimensions in HxWxL format</p>
                                <div class="row mb-4">
                                    <label for="" class="col-md-2">Height (CM)</label>
                                    <input id="#height" type="text" name="height" class="col-md-3" placeholder="Furniture's height"/>
                                </div>
                                <div class="row mb-4">
                                    <label for="" class="col-md-2">Width (CM)</label>
                                    <input id="#width" type="text" name="width" class="col-md-3" placeholder="Furniture's width"/>
                                </div>
                                <div class="row mb-4">
                                    <label for="" class="col-md-2">Length (CM)</label>
                                    <input id="#lenght" type="text" name="length" class="col-md-3" placeholder="Furniture's length"/>
                                </div>
                            </div>
                            <div id="book">
                                <p>Please provide book's weight in KG</p>
                                <label for="" class="col-md-1">Weight (KG)</label>
                                <input id="#weight" type="text" name="weight" class="col-md-4" placeholder="Book's weight"/>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-md-12 fixed-bottom pb-4">
                <hr class="border border-2 border-dark">
                <h6 class="text-center">Scandiweb Test assignment</h6>
            </div>
        </form>
        </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        function onPageLoad() {
            document.getElementById("disk").style.display = 'none';
            document.getElementById("furniture").style.display = 'none';
        }
        function onSelectedElementChange() {
            let value = document.getElementById("#productType").value;
            let bookField = document.getElementById("book");
            let diskField = document.getElementById("disk");
            let furnitureField = document.getElementById("furniture");
            if (value == "book") {
                diskField.style.display = 'none';
                furnitureField.style.display = 'none';
                bookField.style.display = 'block';
            } else if (value == "disk") {
                bookField.style.display = 'none';
                furnitureField.style.display = 'none';
                diskField.style.display = 'block';
            } else {
                bookField.style.display = 'none';
                diskField.style.display = 'none';
                furnitureField.style.display = 'block';
            }
        }
    </script>
  </body>
</html>