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


?>

<!-- DISPLAY ARTICLE -->
<div class="<?php echo $colPage; ?>">
    <div class="panel-group">
        <div class="panel panel-info">
            <div class="panel-heading"><?php
                if($_GET['page'] == 'article')
                {
                    echo '<h1><a href="' . URL . '?page=article&idArticle=' . $article->idArticle() . '">' . $article->title() . '</a></h1>';
                }else{
                    echo '<h3><a href="' . URL . '?page=article&idArticle=' . $article->idArticle() . '">' . $article->title() . '</a></h3>';
                }?>
            </div>
            <div class="panel-body">
                <p>
                    <a target="_blank" href="<?php echo URL .'/inc/' . $primary['pic_final_name']; ?>"><img src="<?php echo URL .'/inc/' . $primary['pic_final_name']; ?>" alt="<?php echo $primary['pic_alt'];?>" class="<?php echo $imgPage; ?>"></a>
                    <?php echo $article->text() ; ?>
                </p>

                <?php

                if(!empty($_GET['idArticle']))
                {
                    foreach($pictures as $picture)
                    {
                        ?>
                        <div class="col-md-1">
                            <a target="_blank" href="<?php echo URL .'/inc/'. $picture->picFinalName(); ?>"><img src="<?php echo URL .'/inc/'. $picture->picFinalName(); ?>" alt="<?php echo $picture->picAlt(); ?> " class="imgProduct"></a>
                        </div>
                        <?php
                    }
                }

                ?>
            </div>
        </div>
    </div>
</div>