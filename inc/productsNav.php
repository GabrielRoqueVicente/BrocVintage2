<?php

//OBJECT'S INSTANCE

$productManager = new ProductManager($db);
$subTypeManager = new SubTypeManager($db);

//VARIABLES

$products = $productManager->getSubList($_GET['subType']);
$subType = $subTypeManager->getProductSubTYpe($_GET['subType']);

$i = 0;

// DIPLAY PRODUCTS
echo '
<div class="col-md-12">
    <h1>'. $subType->subTypeName() .'</h1>
    <hr>
    <div class="row">';
foreach($products as $product)
{
    $i++;
    echo '<div class="col-sm-4 col-lg-4 col-md-4">';
    $idProduct = $product->idProduct();
    include('product.php');
    echo'</div>';
    if($i % 3 == 0 && $i !== 0) {
        echo  '</div>
        <div class="row">';
    }
}
echo '
    </div>
</div>';
