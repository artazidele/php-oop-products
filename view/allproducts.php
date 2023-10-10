
<?php
include_once 'controller/ProductController.php';
$productController = new ProductController();
if(isset($_POST['delete']))
{
    $idArray = [];
    $checkbox = $_POST['checkboxDelete'];
    foreach ($checkbox as $box) {
        array_push($idArray, $box);
    }
    $productController->deleteProducts($idArray);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 pt-4  mb-5 pb-5">
                <form method="POST">
                    <div class="row mt-4">
                        <div class="col-md-8">
                            <h2>Product List</h2>
                        </div>
                        <div class="col-md-4 float-end">
                            <div class="float-end">
                                <a href="http://localhost/07-10-2023/add-product" class="btn btn-primary me-4" id="add_btn">ADD</a>
                                <input type="submit" class="btn btn-danger" name="delete" value="MASS DELETE" id="delete_btn"/>
                            </div>
                        </div>
                    </div>
                    <hr class="border border-2 border-dark">
                    <div>
                        <?php 
                        $products = $productController->getAllProducts();
                        if ($products) {
                            ?>
                            <div class="row">
                            <?php
                            $count = 0;
                            foreach ($products as $product) {
                                $count += 1;
                                ?>
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <input class="delete-checkbox form-check-input" name="checkboxDelete[]" type="checkbox" value="<?php echo $product->getId();?>"/>
                                            <h6 class="text-center"><?=$product->getSKU()?></h6>
                                            <h6 class="text-center"><?=$product->getName()?></h6>
                                            <h6 class="text-center"><?=$product->getPrice()?>$</h6>
                                            <h6 class="text-center"><?=$product->getSpecial()?></h6>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if ($count == 4) {
                                    ?>
                                    <div class="w-100 mt-3"></div>
                                    <?php
                                    $count = 0;
                                }
                            }
                            ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </form>
            </div>
            <div class="col-md-12 fixed-bottom pb-4 bg-white">
                <hr class="mt-0 border border-2 border-dark">
                <h6 class="text-center">Scandiweb Test assignment</h6>
            </div>
        </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
    </script>
   </body>
</html>