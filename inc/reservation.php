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

if(!empty($_GET['dispo']))
{
    if(!empty($dispoManager->getDate($_GET['dispo'])))
    {
        $error += 'Cette date de rendez-vous n\'est plus disponible';
        $_GET['dispo'] = NULL;
    }

    foreach($reservations as $reservation)
    {
        $product = $productManager->get($reservation->idProduct());
        if ($product->disponibility() !== 'dis') {
            $error += 'Un article de votre panier n\'est plus disponible';
            //supression de la reservation concernant le produit.
        }
    }

    if(empty($error))
    {
        $dispo['meeting_date'] = $_GET['dispo'];
        $dispo['id_user'] = $_SESSION['idUser'];
        $dispo = new Dispo($dispo);
        $dispoManager->add($dispo);
        $dispo = $dispoManager->getDate($_GET['dispo']);
        var_dump($dispo);

        foreach($reservations as $reservation)
        {
            $reservation->setid_dispo($dispo->idDispo());
            $reservationManager->update($reservation);
        }
    }



}

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

echo '<div class="col-md-3">';
echo $error;

foreach($reservations as $reservation)
{
    if($reservation->idDispo() == Null)
    {
        var_dump($reservation);
    }else{
        echo 'Vous avez reserver les articles suivants :';
        var_dump($reservation);
    }

}
echo '</div>';

echo '<div class="col-md-9">';
if($reservations[0]->idDispo() == Null)
{
    include('calendar.php');
}elseif($reservations[0]->idDispo() !== Null)
{
    echo 'Votre rendez-vous à été à bien été enregistré pour la date du #DATE# à #HEUR#.';
}

echo '</div>';







