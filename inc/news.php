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

//OBJECT'S INSTANCE

$productManager = new ProductManager($db);
$articleManager = new ArticleManager($db);
$pictureManager = new PictureManager($db);

//VARIABLES

$products = $productManager->getDateList();
$articles = $articleManager->getDateList();
$articleManager->getDateList();


/*=========================================================
=====================NEWS DISPLAY==========================
===========================================================*/

$newsDisplay = 9; //Setting number of displayed news per page.

$y=0; //Products counter
$z=0; //Articles counter

for($i =0; $i<$newsDisplay ; $i++) //Getting and sorting products and dates.
{
    if(($y + $z ) % 3 == 0)
    {
        echo  '<div class="row">';
    }
    if(!empty($products[$y]) && (!empty($articles[$z])))
    {
        if(strtotime($products[$y]->entryDate()) > strtotime($articles[$z]->entryDate()))
        {
            echo '<div class="col-md-3">';
            $idProduct = $products[$y]->idProduct();
            include('product.php');
            $y++;
            echo'</div>';
        }else{
            echo '<div class="col-md-3">';
            $idArticle = $articles[$z]->idArticle();
            include('article.php');
            $z++;
            echo'</div>';
        }
    }elseif(empty($products[$y]) && (!empty($articles[$z])))
    {
        echo '<div class="col-md-3">';
        $idArticle = $articles[$z]->idArticle();
        include('article.php');
        $z++;
        echo'</div>';
    }elseif(!empty($products[$y]) && (empty($articles[$z])))
    {
        echo '<div class="col-md-3">';
        $idProduct = $products[$y]->idProduct();
        include('product.php');
        $y++;
        echo'</div>';
    }
    if(($y + $z ) % 3 == 0)
    {
        echo  '</div>';
    }
}

var_dump($y);
var_dump($z);



?>
