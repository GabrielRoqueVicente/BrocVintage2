<?php

require('init.inc.php');
require(DOCUMENT_ROOT . 'inc\class\ReservationClass.php');
require(DOCUMENT_ROOT . 'inc\class\ReservationManager.php');
require(DOCUMENT_ROOT . 'inc\class\ProductClass.php');
require(DOCUMENT_ROOT . 'inc\class\ProductManager.php');
require(DOCUMENT_ROOT . 'inc\class\DispoClass.php');
require(DOCUMENT_ROOT . 'inc\class\DispoManager.php');

//Redirect
if(!isset($_GET['del']))
{
    header('location:' . URL);
}

//Objects instance

$reservationManager = new ReservationManager($db);
$productManager = new ProductManager($db);
$dispoManager = new DispoManager($db);


if($_GET['del']== '0')
{
    $reservation = $reservationManager->get($_GET['idReservation']);
    $reservationManager->delete($reservation);
    header('Location:' . URL . '?page=reservation&week=0&product=0&dispo=0');
}elseif($_GET['del']== '1') {
    $reservations = $reservationManager->getUserList($_SESSION['idUser']);
    $dispo = $dispoManager->get($reservations[0]->idDispo());
    $dispo = $dispo->idDispo();
    $dispoManager->delete2($dispo);
    foreach($reservations as $reservation)
    {
        if(!is_null($reservation->idDispo()))
        {
            $product = $productManager->get($reservation->idProduct());
            $product->setDisponibility('dis');
            $productManager->update($product);
            $reservationManager->delete($reservation);
        }
    }
    header('Location:' . URL . '?page=reservation&week=0&product=0&dispo=0');
}