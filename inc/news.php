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

$y=0;
$idLastArticle=0;

for($i =0; $i<9 ; $i++) //Getting and sorting products and dates.
{

    if($i == 0) //Checking if their is a product added after the last article.
    {
        if(strtotime($products[0]->entryDate()) > strtotime($articles[0]->entryDate()))
        {
            var_dump($products[0]);
            $y++;
            $i++;
            var_dump($y);
        }
    }

    if($i !== 0) //Sorting the articles by 9
    {
        if(isset($products[$y+1])) //Checking if there is articles to insert between products
        {
            $productDateA = $products[$y]->entryDate();
            $productDateB = $products[$y+1]->entryDate();
            $articles2 = $articleManager->getDateList($productDateA, $productDateB);

            if(!empty($articles2)) //Inserting articles between products
            {
                foreach ($articles2 as $article)
                {
                    if ($i !== 9 && $article->idArticle() > $idLastArticle)
                    {
                        var_dump($article);
                        $idLastArticle = $article->idArticle();
                        $i++;
                    }
                }
            }
        }

        if(isset($products[$y]))
        {
            var_dump($products[$y]);
            $y++;
            var_dump($y);
        }
    }
}
