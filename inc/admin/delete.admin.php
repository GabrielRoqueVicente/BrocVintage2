<?php
// Require list
require('../init.inc.php');
require(DOCUMENT_ROOT . 'inc/class/ProductClass.php');
require(DOCUMENT_ROOT . 'inc/class/ProductManager.php');
require(DOCUMENT_ROOT . 'inc/class/ProductTypeClass.php');
require(DOCUMENT_ROOT . 'inc/class/ProductTypeManager.php');
require(DOCUMENT_ROOT . 'inc/class/SubTypeClass.php');
require(DOCUMENT_ROOT . 'inc/class/SubTypeManager.php');
require(DOCUMENT_ROOT . 'inc/class/PictureClass.php');
require(DOCUMENT_ROOT . 'inc/class/PictureManager.php');

//Redirect
if(!isAdmin())
{
    header('location:' . URL . '/index.php');
}


//Objects instance

$productManager = new ProductManager($db);
$pictureManager = new PictureManager($db);

$product = $productManager->get($_GET['idProduct']);
$pictures = $pictureManager->getProductPicture($_GET['idProduct']);

if(isset($_GET['idProduct']))
{
    $productManager->delete($product);

    foreach ($pictures as $picture)
    {
       unlink (DOCUMENT_ROOT . 'inc/' . $picture->picFinalName());
    }

    $pictureManager->deleteProductPicture($_GET['idProduct']);
    header('location:' . URL . '?page=products');


}else{
    header('location:' . URL . '?page=products');
}