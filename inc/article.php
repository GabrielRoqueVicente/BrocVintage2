<?php
//REDIRECT

if(empty($_GET['idArticle']) && empty($idArticle))
{
    header('Location: ../index.php');
}

//Objects instance

$articleManager = new ArticleManager($db);
$pictureManager = new PictureManager($db);

//Variables
if($_GET['page'] == 'article')
{
    $colPage = "col-md-12";
    $imgPage='imgPage';
}

if(!empty($_GET['idArticle']))
{
    $article = $articleManager->get($_GET['idArticle']);
    $primary = $pictureManager->getPrimaryPicture($_GET['idArticle']);
    $primary = $pictureManager->getPicture($primary);
    $pictures = $pictureManager->getNewsPicture($_GET['idArticle'], $primary['id_picture']);
}

if(!empty($idArticle))
{
    $article = $articleManager->get($idArticle);
    $primary = $pictureManager->getPrimaryPicture($idArticle);
    $primary = $pictureManager->getPicture($primary);
    $pictures = $pictureManager->getNewsPicture($idArticle, $primary['id_picture']);
}

if($_GET['page'] == 'article')
{
    $colPage = "col-md-12";
    $imgPage='imgPage';
}


//DISPLAY ARTICLE

if($_GET['page'] !== 'article')
{
    echo '
    <div class="thumbnail">
        <a target="_blank" href="' .URL .'/inc/' . $primary['pic_final_name'] . '"><img src="' . URL .'/inc/' . $primary['pic_final_name'] . '" alt="' . $primary['pic_alt'] . '" class="' .  $imgPage . '"></a>
        <div class="caption">
            <h3>' .  $article->title() . '</h3>
            <p hidden>' . $article->text() . '</p>
            <a class="btn btn-default" href="' . URL . '?page=article&idArticle=' . $article->idArticle() . '">Voir plus</a>
        </div>
    </div>
    ';
}else{
echo '
<div class="' . $colPage .'">
    <div class="panel-group">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h1><a href="' . URL . '?page=article&idArticle=' . $article->idArticle() . '">' . $article->title() . '</a></h1>
            </div>
            <div class="panel-body">
                <p>
                    <a target="_blank" href="' . URL .'/inc/' . $primary['pic_final_name'] . '"><img src="' . URL .'/inc/' . $primary['pic_final_name'] . '" alt="' . $primary['pic_alt'] . '" class="' . $imgPage . '"></a>
                    ' . $article->text() . '
                </p>';
                    if(!empty($_GET['idArticle'])){
                        foreach($pictures as $picture){
                        echo '
                        <div class="col-md-1">
                            <a target="_blank" href="' . URL .'/inc/'. $picture->picFinalName() . '"><img src="' . URL .'/inc/'. $picture->picFinalName() . '" alt="' . $picture->picAlt() . '" class="imgProduct"></a>
                        </div>';
                        }
                    }
            echo'
            </div>
        </div>
    </div>
</div>';
}