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

$reservations = $reservationManager->getUserList($_SESSION['idUser']);
$products = $productManager->getList();
$dispos = $dispoManager->getList();


//CHECKS
$error = '';

var_dump($_GET['product']);
var_dump($reservationManager->getProduct($_GET['product']));

// Product Allready in a cart

if($_GET['product'] !== '0' && empty($reservationManager->getProduct($_GET['product'])))
{
    //Is still available
    $product = $productManager->get($_GET['product']);

    if($product->disponibility() !== 'dis')
    {
        $error += 'L\'article n\'est plus disponible';
    }

    if(empty($error))
    {
        $reservation['id_user'] = $_SESSION['idUser'];
        $reservation['id_product'] = $_GET['product'] ;
        $reservation = new Reservation($reservation);
        $reservationManager->add($reservation);
        header('location:' . URL .'?page=reservation&product=0');
    }
}

//DISPLAY USER RESERVATIONS

echo $error;

foreach($reservations as $reservation)
{
    var_dump($reservation);
}








