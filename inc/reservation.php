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
$userManager = new UserManager($db);


//VARIABLES
$reservations = $reservationManager->getUserList($_SESSION['idUser']);
$products = $productManager->getList();
$dispos = $dispoManager->getList();
$user = $userManager->get($_SESSION['idUser']);

//CHECKS
$error = '';

if(!empty($_GET['dispo']))
{
    if(!empty($dispoManager->getDate($_GET['dispo'])))
    {
        $error += 'Cette date de rendez-vous n\'est plus disponible';
    }

    foreach($reservations as $reservation)
    {
        $product = $productManager->get($reservation->idProduct());
        if ($product->disponibility() !== 'dis') {
            $error += 'Un article de votre panier n\'est plus disponible';
            $productManager->delete($reservation);
        }
    }

// DATA PROCESSING

    if(empty($error))
    {
        $dispo['meeting_date'] = $_GET['dispo'];
        $dispo['id_user'] = $_SESSION['idUser'];
        $dispo = new Dispo($dispo);
        $dispoManager->add($dispo);
        $dispo = $dispoManager->getByDate($_GET['dispo']);

        foreach($reservations as $reservation)
        {
            $reservation->setid_dispo($dispo->idDispo());
            $reservationManager->update($reservation);
            $product = $productManager->get($reservation->idProduct());
            $product->setDisponibility('res');
            $productManager->update($product);
        }

        //==========MAILING==========================================================
        $dispo = $dispoManager->get($reservations[0]->idDispo());
        $meeting = $dispo->meetingDate();
        $meeting = strtotime($meeting);
        $formatMeeting = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Europe/Paris', IntlDateFormatter::GREGORIAN, 'EEEE d MMMM yyyy HH:mm');
        $formatMeeting->setPattern('EEEE d MMMM yyyy à HH:mm');
        $meeting = $formatMeeting->format($meeting);
        $mail = $_SESSION['user']; // Destination.
        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) //Preventing bugs.
        {
            $return = "\r\n";
        }else{
            $return = "\n";
        }

        //=====TXT message.
        if($user->title() == "H")
        {
            $message_txt = 'Monsieur ' . $user->surname() .' bonjour,' . $return;
        }else{
            $message_txt = 'Madame ' . $user->surname() .' bonjour,' . $return;
        }

        $message_txt .= "Notre rendez-vous du " . $meeting ." à bien été fixé." . $return . "
                        Vous avez reservé les articles suivants : ". $return;
        foreach($reservations as $reservation)
        {
            if($reservation->idDispo() !== null)
            {
                $product = $productManager->get($reservation->idProduct());
                $message_txt .= $product->name() . $return;
            }
        }

        //=====HTML message.
        $message_html = "
            <html>
                <head>
                </head>
                <body>
                    <p>";

                    if($user->title() == "H")
                    {
                        $message_html .= 'Monsieur ' . $user->surname() .' bonjour,<br />';
                    }else{
                        $message_html .= 'Madame ' . $user->surname() .' bonjour,<br />';
                    }

        $message_html .= "Notre rendez-vous du " . $meeting ." à bien été fixé.<br /> 
                        Vous avez reservé les articles suivants : <br />
                        <ul>";
                    foreach($reservations as $reservation)
                    {
                        if($reservation->idDispo() !== null)
                        {
                            $product = $productManager->get($reservation->idProduct());
                            $message_html .= '<li>' . $product->name() . '</li>';
                        }

                    }
        $message_html .= " 
                        </ul>
                    </p>
                </body>
            </html>";
        //==========

        //=====Boundary
        $boundary = "-----=".md5(rand());
        //==========

        //=====Défine subject.
        $sujet = "[Broc'Vintage]Confirmation de notre rendez-vous du ". $meeting .".";
        //=========

        //=====Mail Header.
        $header = "From: \"Broc'Vintage\"<" . EMAIL . ">".$return;
        $header.= "Reply-to: \"Broc'Vintage\"<" . EMAIL . ">".$return;
        $header.= "MIME-Version: 1.0".$return;
        $header.= "Content-Type: multipart/alternative;".$return." boundary=\"$boundary\"".$return;
        //==========

        //=====Message.
        $message = $return."--".$boundary.$return;
        //=====Add TXT message.
        $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$return;
        $message.= "Content-Transfer-Encoding: 8bit".$return;
        $message.= $return.$message_txt.$return;
        //==========
        $message.= $return."--".$boundary.$return;

        //=====Add HTML message.
        $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$return;
        $message.= "Content-Transfer-Encoding: 8bit".$return;
        $message.= $return.$message_html.$return;
        //==========
        $message.= $return."--".$boundary."--".$return;
        $message.= $return."--".$boundary."--".$return;
        //==========

        //=====Sending Mail.
        mail($mail,$sujet,$message,$header);
        //====Sending à Copy to the Administrator
        $mail = EMAIL;
        mail($mail,$sujet,$message,$header);
        //==========
        header('location:' . URL . '/index.php');
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
        <span class="glyphicon glyphicon-shopping-cart"></span> ';
        echo '<a href="' . URL . '/inc/deleteReservations.php?del=0&idReservation=' . $reservation->idReservation() . '"><img src="' . URL . '/inc/img/delete.png" alt="Supprimer" height="13" width="13" /></a><br / ><br / >';
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
if(isset($reservations[0]))
{
    if($reservations[0]->idDispo() == Null)
    {
        include('calendar.php');
    }elseif($reservations[0]->idDispo() !== Null)
    {
        $dispo = $dispoManager->get($reservations[0]->idDispo());
        $meeting = $dispo->meetingDate();
        $meeting = strtotime($meeting);
        $formatMeeting = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Europe/Paris', IntlDateFormatter::GREGORIAN, 'EEEE d MMMM yyyy HH:mm');
        $formatMeeting->setPattern('EEEE d MMMM yyyy à HH:mm');
        $meeting = $formatMeeting->format($meeting);

        echo '<h2>Votre rendez-vous à bien été enregistré pour la date du ' . $meeting  . '.</h2>
    <h4>Pour reserver tout article nouvellement ajouté à votre panier, veuillez me contacter au #TEL#.<br /></h4>'; ?>

        <!-- Trigger-button -->
        <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#delMeeting">Annuler ce rendez-vous</button>

        <!-- Modal -->
        <div id="delMeeting" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Voulez-vous réellement annuler ce rendez-vous ?</h4>
                    </div>
                    <div class="modal-body">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Non</button>
                        <a href="<?php echo URL ;?>/inc/deleteReservations.php?del=1" class="btn btn-danger" role="button">Oui</a>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>

            </div>
        </div>
        <?php
    }
}else{
    echo'<h2>Votre panier est vide. </h2>';
}


echo '</div>';
?>