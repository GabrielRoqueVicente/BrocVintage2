<?php

//OBJECT'S INSTANCE

$productManager = new ProductManager($db);
$articleManager = new ArticleManager($db);
$pictureManager = new PictureManager($db);

//VARIABLES

$articles = $articleManager->getDateList();
$articlesNbr = count($articles);
$products = $productManager->getDateList2();

/*=========================================================
=====================NEWS DISPLAY==========================
===========================================================*/

echo '
<div class="container">
    <div class="col-md-12">
        <hr>
        <h2 class="homeH2">Actualités</h2>
        <div class="row">
            <div class="slideshow-container">';

                for ($i = 0; $i < $articlesNbr; $i++) {
                    $numbertext = $i + 1;
                    $primary = $pictureManager->getPrimaryPicture($articles[$i]->idArticle());
                    $primary = $pictureManager->getPicture($primary);
                    echo '<div class="mySlides fade">
                        <div class="numbertext">' . $numbertext . '/ '. $articlesNbr .'</div>
                        <a href="' . URL . '?page=article&idArticle=' . $articles[$i]->idArticle() . '"><img src="' . URL .'/inc/' . $primary['pic_final_name'] . '" alt="' . $primary['pic_alt'] . '" class="slideImg"></a>
                        <div class="text"><h3>' .  $articles[$i]->title() . '</h3></div>
                    </div>';
                }

                echo '<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
            <br>

            <div style="text-align:center">';
                for ($i = 0; $i <$articlesNbr; $i++){
                    $currentSlide = $i + 1;
                    echo '<span class="dot" onclick="currentSlide(' . $currentSlide . ')"></span>';
                }

            echo '</div>
        </div>
    </div>
</div>';

/*=========================================================
=====================LAST PRODUCTS=========================
===========================================================*/
echo '
<div class="container">
    <div class="col-md-12">
        <hr>
        <h2 class="homeH2">Nouveautés</h2>
        
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
        
            <section id="pinBoot">';

            foreach($products as $product) {
                $i++;
                $idProduct = $product->idProduct();
                include('product.php');
            }

echo '
            </section>    
        </div>
    </div>
</div>
<script src="' . URL . '/inc/js/newsSlideshow.js"></script>';
