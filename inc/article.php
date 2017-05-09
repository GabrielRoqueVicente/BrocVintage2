<?php
//REDIRECT

if(empty($_GET['idArticle']) && empty($idArticle))
{
    header('Location: ..\index.php');
}

//Objects instance

$articleManager = new ArticleManager($db);
$pictureManager = new PictureManager($db);

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

<h2><strong><?php echo $article->title(); ?></strong></h2>
<p>
    <img src="<?php echo URL .'\inc\\' . $primary['pic_final_name']; ?>" alt="<?php echo $primary['pic_alt']; ?>">
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
