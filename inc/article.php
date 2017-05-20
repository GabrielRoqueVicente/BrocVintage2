<?php
//REDIRECT

if(empty($_GET['idArticle']) && empty($idArticle))
{
    header('Location: ..\index.php');
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


?>

<!-- DISPLAY ARTICLE -->
<div class="<?php echo $colPage; ?>">
    <div class="panel-group">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2><a href="<?php echo URL . '?page=article&idArticle=' . $article->idArticle() ?>"><strong><?php echo $article->title(); ?></strong></a></h2>
            </div>
            <div class="panel-body">
                <p>
                    <img src="<?php echo URL .'\inc\\' . $primary['pic_final_name']; ?>" alt="<?php echo $primary['pic_alt'];?>" class="<?php echo $imgPage; ?>">
                    <?php echo $article->text() ; ?>
                </p>

                <?php

                if(!empty($_GET['idArticle']))
                {
                    foreach($pictures as $picture)
                    {
                        ?>
                        <img src="<?php echo URL .'\inc\\'. $picture->picFinalName(); ?>" alt="<?php echo $picture->picAlt(); ?> ">
                        <?php
                    }
                }

                ?>
            </div>
        </div>
    </div>
</div>
