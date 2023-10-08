
<?php
include_once 'controller/ProductController.php';
$productController = new ProductController();
if(isset($_POST['delete']))
      {
        $idArray = [];
        $checkbox = $_POST['checkboxDelete'];
        // $delProducts = sizeof($checkbox);
        foreach ($checkbox as $box) {
          array_push($idArray, $box);
        // //   $sql = "DELETE FROM links WHERE link_id='$del_id'";
        // //   $result = mysqli_query($sql);
        }
        $delProducts = $productController->deleteProducts($idArray);
        // // if successful redirect to delete_multiple.php 
        // if($result){
        //   echo '<meta http-equiv="refresh" content="0;URL=view_links.php">';
        // }
      }
// $productArray = new ProductArray();
// if (isset($_GET['deleteProducts'])) {
//     // $delProducts = $productController->deleteProducts();
//     $delProducts = sizeof($productArray->getProducts());
// }

// if (isset($_GET['toDelete'])) {
//     $id = base64_decode($_GET['toDelete']);
//     // $delProduct = $productController->changeDelete($id);
//     $productArray->addProduct($id);
//     $delProduct = sizeof($productArray->getProducts());
// }
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
    <?php
                    if (isset($delProducts)) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><?=$delProducts?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                    }
                ?>
        <div class="row">
            <div class="col-md-12 pt-4">
                <form method="POST">
                <div class="row mt-4">
                    <div class="col-md-8">
                        <h2>Product List</h2>
                    </div>
                    <div class="col-md-4 float-end">
                        <div class="float-end">
                            <a href="addproduct.php" class="btn btn-primary me-4">ADD</a>
                            <input type="submit" name="delete" value="MASS DELETE" class="btn btn-danger" />
                        </div>
                    </div>
                </div>
                <hr class="border border-2 border-dark">
                <div class="">
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
                                           <input name="checkboxDelete[]" type="checkbox" value="<?php echo $product->getId();?>"/>
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
            <div class="col-md-12 fixed-bottom pb-4">
                <hr class="border border-2 border-dark">
                <h6 class="text-center">Scandiweb Test assignment</h6>
            </div>
        </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        function changeDelete(id) {
            console.log(id);
        }
    </script>
   </body>
</html>