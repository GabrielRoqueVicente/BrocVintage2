<?php

//OBJECT'S INSTANCE

$productManager = new ProductManager($db);
$subTypeManager = new SubTypeManager($db);

//VARIABLES

$products = $productManager->getSubList($_GET['subType']);
$subType = $subTypeManager->getProductSubTYpe($_GET['subType']);

// DIPLAY PRODUCTS
echo '
<div class="col-md-12">
    <h1>'. $subType->subTypeName() .'</h1>
    <hr>
    <section id="pinBoot">';
foreach($products as $product)
{
    $idProduct = $product->idProduct();
    include('product.php');
}
echo '
    </section>
</div>';
