<?php

//OBJECT'S INSTANCE

$articleManager = new ArticleManager($db);
$pictureManager = new PictureManager($db);

//VARIABLES

$articles = $articleManager->getDateList();

$i = 0;

/*=========================================================
=====================NEWS DISPLAY==========================
===========================================================*/

echo '
<div class="container">
    <div class="col-md-12">
        <hr>
        <h2 class="homeH2">Actualités</h2>
            <div class="row">';

                foreach($articles as $article) {
                    $i++;
                    echo '<div class="col-md-3 col-sm-6 home-article">';
                    $idArticle = $article->idArticle();
                    include('article.php');
                    echo'</div>';

                    /*if($i % 3 == 0 && $i !== 0){
                        echo '</div>
                        <div class="row">';
                    }*/
                }

echo '
        </div>
    </div>
</div>';