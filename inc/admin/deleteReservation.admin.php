<?php

require('..\init.inc.php');
require(DOCUMENT_ROOT . 'inc\class\ReservationClass.php');
require(DOCUMENT_ROOT . 'inc\class\ReservationManager.php');
require(DOCUMENT_ROOT . 'inc\class\ProductClass.php');
require(DOCUMENT_ROOT . 'inc\class\ProductManager.php');
require(DOCUMENT_ROOT . 'inc\class\DispoClass.php');
require(DOCUMENT_ROOT . 'inc\class\DispoManager.php');

//Redirect
if(!isAdmin())
{
    header('location:' . URL . '/index.php');
}

// VARIABLES
$productManager = new ProductManager($db);
$reservationManager = new ReservationManager($db);
$dispoManager = new DispoManager($db);
$reservations = $reservationManager->getUserList($_GET['idUser']);
$count = $reservations;
$reservation = $reservationManager->get($_GET['idReservation']);

// DELETE
if($count == 1) //If it is the last reservation of the client unset de disponibility too
{
    $dispo = $dispoManager->get($reservation->idDispo());
    $dispoManager->delete2($dispo);
    $product = $productManager->get($reservation->idProduct());
    $product->setDisponibility('dis');
    $productManager->update($product);
    $reservationManager->delete($reservation);
    header('Location:' . URL . '?page=calendarAdmin&week=0');

}else{
    $product = $productManager->get($reservation->idProduct());
    $product->setDisponibility('dis');
    $productManager->update($product);
    $reservationManager->delete($reservation);
    header('Location:' . URL . '?page=calendarAdmin&week=0');
}
