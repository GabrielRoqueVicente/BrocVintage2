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

// DATA PROCESSING

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

        //==========MAILING==========================================================
        //Getting reservation info
        $formatMeeting = new IntlDateFormatter('fr_FR',IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Europe/Paris', IntlDateFormatter::GREGORIAN,'EEEE d MMMM  yyyy à HH:mm');
        $formatMeeting->setPattern('EEEE d MMMM  yyyy à HH:mm');
        $meeting = $formatMeeting->format($_GET['dispo']);
        $reservations = $reservationManager->getUserList($_SESSION['idUser']);

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

        $message_txt .= "Notre rendez-vous du" . $meeting ." à bien été fixé." . $return . "
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
                        $message_txt .= 'Monsieur ' . $user->surname() .' bonjour,<br />';
                    }else{
                        $message_txt .= 'Madame ' . $user->surname() .' bonjour,<br />';
                    }

        $message_html .= "Notre rendez-vous du" . $meeting ." à bien été fixé.<br /> 
                        Vous avez reservé les articles suivants : <br />
                        <ul>";
                    foreach($reservations as $reservation)
                    {
                        if($reservation->idDispo() !== null)
                        {
                            $product = $productManager->get($reservation->idProduct());
                            $message_txt .= '<li>' . $product->name() . '</li>';
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







