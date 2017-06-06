<?php

//OBJECT'S INSTANCE

$productManager = new ProductManager($db);
$articleManager = new ArticleManager($db);
$pictureManager = new PictureManager($db);

//VARIABLES

$products = $productManager->getDateList();
$articles = $articleManager->getDateList();

/*=========================================================
=====================NEWS DISPLAY==========================
===========================================================*/

$newsDisplay = 9; //Setting number of displayed news per page.

$y=0; //Products counter
$z=0; //Articles counter

echo '
<div class="container">
    <div class="col-md-12">
        <hr>
        <h2>NEWS</h2>';

for($i =0; $i<$newsDisplay ; $i++){//Getting and sorting products and dates.
    if(($y + $z ) % 3 == 0)
    {
        echo  '<div class="row">';
    }
    if(!empty($products[$y]) && (!empty($articles[$z]))){
        if(strtotime($products[$y]->entryDate()) > strtotime($articles[$z]->entryDate())){
            echo '<div class="col-sm-4 col-lg-4 col-md-4">';
            $idProduct = $products[$y]->idProduct();
            include('product.php');
            $y++;
            echo'</div>';
        }else{
            echo '<div class="col-sm-4 col-lg-4 col-md-4">';
            $idArticle = $articles[$z]->idArticle();
            include('article.php');
            $z++;
            echo'</div>';
        }
    }elseif(empty($products[$y]) && (!empty($articles[$z])))
    {
        echo '<div class="col-sm-4 col-lg-4 col-md-4">';
        $idArticle = $articles[$z]->idArticle();
        include('article.php');
        $z++;
        echo'</div>';
    }elseif(!empty($products[$y]) && (empty($articles[$z])))
    {
        echo '<div class="col-sm-4 col-lg-4 col-md-4">';
        $idProduct = $products[$y]->idProduct();
        include('product.php');
        $y++;
        echo'</div>';
    }
    if(($y + $z ) % 3 == 0 && $i !== 0)
    {
        echo  '</div>';
    }
}

echo '
    </div>
</div>';