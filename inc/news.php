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

echo '<div class="col-md-12">
      <h1 class="h1">NEWS</h1>
      </div>
      </div>
      <div class="row"><br />';
for($i =0; $i<$newsDisplay ; $i++) //Getting and sorting products and dates.
{
    $offset = '';
    if(($y + $z ) % 3 == 0 && $i !== 0)
    {
       // $offset = ' col-md-offset-3';
        echo  '<div class="row">';
    }
    if(!empty($products[$y]) && (!empty($articles[$z])))
    {
        if(strtotime($products[$y]->entryDate()) > strtotime($articles[$z]->entryDate()))
        {
            echo '<div class="col-md-4'. $offset .'">';
            $idProduct = $products[$y]->idProduct();
            include('product.php');
            $y++;
            echo'</div>';
        }else{
            echo '<div class="col-md-4'. $offset .'">';
            $idArticle = $articles[$z]->idArticle();
            include('article.php');
            $z++;
            echo'</div>';
        }
    }elseif(empty($products[$y]) && (!empty($articles[$z])))
    {
        echo '<div class="col-md-4'. $offset .'">';
        $idArticle = $articles[$z]->idArticle();
        include('article.php');
        $z++;
        echo'</div>';
    }elseif(!empty($products[$y]) && (empty($articles[$z])))
    {
        echo '<div class="col-md-4'. $offset .'">';
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

//var_dump($y);
//var_dump($z);



?>
