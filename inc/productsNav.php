<?php

//OBJECT'S INSTANCE

$productManager = new ProductManager($db);
$pictureManager = new PictureManager($db);

//VARIABLES

$products = $productManager->getSubList($_GET['subType']);

foreach($products as $product)
{
    echo '<div class="col-md-4">';
    $idProduct = $product->idProduct();
    include('product.php');
    echo'</div>';
}
