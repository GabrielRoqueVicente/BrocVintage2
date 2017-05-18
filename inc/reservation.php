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
            $productManager->delete($reservation);
        }
    }

    if(empty($error))
    {
        $dispo['meeting_date'] = $_GET['dispo'];
        $dispo['id_user'] = $_SESSION['idUser'];
        $dispo = new Dispo($dispo);
        $dispoManager->add($dispo);
        var_dump($_GET['dispo']);
        $dispo = $dispoManager->getByDate($_GET['dispo']);

        foreach($reservations as $reservation)
        {
            $reservation->setid_dispo($dispo->idDispo());
            $reservationManager->update($reservation);
            $product = $productManager->get($reservation->idProduct());
            $product->setDisponibility('res');
            $productManager->update($product);
        }
        // envoie mail Utilisateur + Admin
    }



}

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




// DISPLAY RESERVATIONS
foreach($reservations as $reservation)
{
    if($reservation->idDispo() == Null)
    {
        $primary = $pictureManager->getPrimaryPicture2($reservation->idProduct());
        $primary = $pictureManager->getPicture($primary);
        $product = $productManager->get($reservation->idProduct());
        ?><img src="<?php echo URL .'\inc\\' .$primary['pic_final_name']; ?>" alt="<?php echo $primary['pic_alt']; ?>" width="20%">
        <a href="<?php echo URL . '?page=product&idProduct=' . $product->idProduct() ?>"><strong><?php echo $product->name(); ?></strong></a><br / ><?php
        echo $product->price() . ' Frs<br / >
        <span class="glyphicon glyphicon-shopping-cart"></span><br / ><br / >';
    }else{
        $primary = $pictureManager->getPrimaryPicture2($reservation->idProduct());
        $primary = $pictureManager->getPicture($primary);
        $product = $productManager->get($reservation->idProduct());
        ?><img src="<?php echo URL .'\inc\\' .$primary['pic_final_name']; ?>" alt="<?php echo $primary['pic_alt']; ?>" width="20%">
        <a href="<?php echo URL . '?page=product&idProduct=' . $product->idProduct() ?>"><strong><?php echo $product->name(); ?></strong></a><br / ><?php
        echo $product->price() . ' Frs<br / >
        Reservé <span class="glyphicon glyphicon-ok"></span><br / ><br / >';
    }


}
echo '</div>';

//DISPLAY CALENDAR

echo '<div class="col-md-9">';
if($reservations[0]->idDispo() == Null)
{
    include('calendar.php');
}elseif($reservations[0]->idDispo() !== Null)
{
    echo '<h2>Votre rendez-vous à été à bien été enregistré pour la date du #DATE# à #HEUR#.</h2> 
    <h4>Pour reserver tout article nouvellement ajouté à votre panier, veuillez me contacter au #TEL#.<br /></h4>';
}

echo '</div>';







