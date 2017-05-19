<?php

//OBJECT'S INSTANCE

$productManager = new ProductManager($db);
$pictureManager = new PictureManager($db);

//VARIABLES

$products = $productManager->getSubList($_GET['idSubType']);

var_dump($products);
