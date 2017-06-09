<?php
// Require list
require('inc/init.inc.php');
require(DOCUMENT_ROOT . 'inc/class/ProductClass.php');
require(DOCUMENT_ROOT . 'inc/class/ProductManager.php');
require(DOCUMENT_ROOT . 'inc/class/ProductTypeClass.php');
require(DOCUMENT_ROOT . 'inc/class/ProductTypeManager.php');
require(DOCUMENT_ROOT . 'inc/class/SubTypeClass.php');
require(DOCUMENT_ROOT . 'inc/class/SubTypeManager.php');
require(DOCUMENT_ROOT . 'inc/class/ArticleClass.php');
require(DOCUMENT_ROOT . 'inc/class/ArticleManager.php');
require(DOCUMENT_ROOT . 'inc/class/PictureClass.php');
require(DOCUMENT_ROOT . 'inc/class/PictureManager.php');
require(DOCUMENT_ROOT . 'inc/class/UserClass.php');
require(DOCUMENT_ROOT . 'inc/class/UserManager.php');
require(DOCUMENT_ROOT . 'inc/class/DispoClass.php');
require(DOCUMENT_ROOT . 'inc/class/DispoManager.php');
require(DOCUMENT_ROOT . 'inc/class/ReservationClass.php');
require(DOCUMENT_ROOT . 'inc/class/ReservationManager.php');

$title ='Broc\'Vintage: ';

// Dynamic title
if(isset($_GET['page'])){
    if ($_GET['page'] == 'registration'){
        $title .= 'rejoignez-nous !';
    } elseif ($_GET['page'] == 'connection'){
        $title .= 'connexion';
    } elseif ($_GET['page'] == 'product'){
        $productManager = new ProductManager($db);
        $product = $productManager->get($_GET['idProduct']);
        $title .= $product->name();
    } elseif ($_GET['page'] == 'article'){
        $articleManager = new articleManager($db);
        $article = $productManager->get($_GET['idArticle']);
        $title .= $article->title();
    } elseif ($_GET['page'] == 'produits'){
        $subTypeManager = new SubTypeManager($db);
        $subType = $subTypeManager->getProductSubTYpe($_GET['subType']);
        $title .= $subType->subTypeName();
    } elseif ($_GET['page'] == 'aboutUs'){
        $title .= 'Qui sommes-nous ?';
    } elseif ($_GET['page'] == 'conditions'){
        $title .= 'Conditions de vente';
    }

    if (isConnected()) {
        if ($_GET['page'] == 'reservation'){
            $title .= 'Planifiez votre visite !';
        } else if ($_GET['page'] == 'profile'){
            $title .= 'Vos informations';
        }
    }
}else{
    $title .='Vente de meubles, lampes et décorations design';
}

//Include pages parts

include('inc/head.inc.php');

include('inc/body.inc.php');

include('inc/foot.inc.php');
