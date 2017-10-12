<?php
// Require list
require('../init.inc.php');
require(DOCUMENT_ROOT . 'inc/class/ArticleClass.php');
require(DOCUMENT_ROOT . 'inc/class/ArticleManager.php');
require(DOCUMENT_ROOT . 'inc/class/PictureClass.php');
require(DOCUMENT_ROOT . 'inc/class/PictureManager.php');

//Redirect
if(!isAdmin())
{
    header('location:' . URL . '/index.php');
}

//Objects instance

$articleManager = new ArticleManager($db);
$pictureManager = new PictureManager($db);

$article = $articleManager->get($_GET['idArticle']);
$pictures = $pictureManager->getArticlePicture($_GET['idArticle']);

if(isset($_GET['idArticle']))
{
    $articleManager->delete($article);

    foreach ($pictures as $picture)
    {
       unlink (DOCUMENT_ROOT . 'inc/' . $picture->picFinalName());
    }

    $pictureManager->deleteArticlePicture($_GET['idArticle']);
    header('Location:' . URL . '?page=articles');
}else{
    header('Location:' . URL . '?page=articles');

}