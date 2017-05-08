<?php
// Require list
require('init.inc.php');
//require('functions.inc.php');
require(DOCUMENT_ROOT . 'inc\class\ProductClass.php');
require(DOCUMENT_ROOT . 'inc\class\ProductManager.php');
require(DOCUMENT_ROOT . 'inc\class\ArticleClass.php');
require(DOCUMENT_ROOT . 'inc\class\ArticleManager.php');
require(DOCUMENT_ROOT . 'inc\class\PictureClass.php');
require(DOCUMENT_ROOT . 'inc\class\PictureManager.php');

//OBJETCS INSTANCE

$productManager = new ProductManager($db);
$articleManager = new ArticleManager($db);
$pictureManager = new PictureManager($db);

//VARIABLES

$products = $productManager->getDateList();
$articles = $articleManager->getDateList();
//echo strtotime($entryDate);
var_dump($products);
var_dump($articles);

//foreach