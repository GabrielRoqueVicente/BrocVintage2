<?php

//OBJECT'S INSTANCE

$productManager = new ProductManager($db);
$subTypeManager = new SubTypeManager($db);

//VARIABLES

$products = $productManager->getSubList($_GET['subType']);
$subType = $subTypeManager->getProductSubTYpe($_GET['subType']);

// DIPLAY PRODUCTS
echo '<strong><h1>'. $subType->subTypeName() .'</h1></strong>
      <hr>';
foreach($products as $product)
{
    echo '<div class="col-md-4">';
    $idProduct = $product->idProduct();
    include('product.php');
    echo'</div>';
}
