<?php
//Redirect
if(!isConnected())
{
    header('location:' . URL . '/index.php');
}


//OBJECT'S INSTANCE

$reservationManager = new ReservationManager($db);
$dispoManager = new DispoManager($db);
$productManager = new ProductManager($db);
$pictureManager = new PictureManager($db);


//VARIABLES

$reservations = $ReservationManager-getUserList($_SESSION['idUser']);
$products = $productManager->getList();
$dispos = $dispoManager->getList();


//CHECKS
$error = '';

// Product Allready in a cart

if(empty($reservationManager->getProduct($_GET['product'])))
{
    //Is still available
    $product = $productManager->get($_GET['idProduct']);
    if($product->disponibility() !== 'dis')
    {
        $error += 'L\'article n\'est plus disponible';
    }

    if(empty($error))
    {
        //add $dispo;
    }

}








