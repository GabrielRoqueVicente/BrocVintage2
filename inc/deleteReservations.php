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

$formatMeeting = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Europe/Paris', IntlDateFormatter::GREGORIAN, 'EEEE d MMMM yyyy HH:mm');
$formatMeeting->setPattern('EEEE d MMMM yyyy à HH:mm');


if($_GET['del']== '0')
{
    $reservation = $reservationManager->get($_GET['idReservation']);
    $reservationManager->delete($reservation);
    header('Location:' . URL . '?page=reservation&week=0&product=0&dispo=0');
}elseif($_GET['del']== '1') {
    $reservations = $reservationManager->getUserList($_SESSION['idUser']);
    $dispo = $dispoManager->get($reservations[0]->idDispo());
    $dispo2 = clone $dispo; //Cloning $Dispo for the MAILING
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
    //==========MAILING==========================================================
    $meeting = $dispo2->meetingDate();
    $meeting = strtotime($meeting);
    $meeting = $formatMeeting->format($meeting);
    $mail = EMAIL; // Destination.
    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) //Preventing bugs.
    {
        $return = "\r\n";
    }else{
        $return = "\n";
    }

    //=====TXT message.
    $message_txt .= 'Le rendez-vous de ' . $meeting .' à été annulé.' . $return . $return . '
                        Voici la liste des articles qui étaient concernés : '. $return;
    foreach($reservations as $reservation)
    {
        if($reservation->idDispo() !== null)
        {
            $product = $productManager->get($reservation->idProduct());
            $message_txt .= $product->name() . $return;
        }
    }

    //=====HTML message.
    $message_html = '
            <html>
                <head>
                </head>
                <body>
                    <p>';
    $message_html .= 'Le rendez-vous de ' . $meeting .' à été annulé.<br /><br />
                        Voici la liste des articles qui étaient concernés : <br />
                        <ul>';
    foreach($reservations as $reservation)
    {
        if($reservation->idDispo() !== null)
        {
            $product = $productManager->get($reservation->idProduct());
            $message_html .= '<li>' . $product->name() . '</li>';
        }

    }
    $message_html .= '
                    </p>
                </body>
            </html>';
    //==========

    //=====Boundary
    $boundary = "-----=".md5(rand());
    //==========

    //=====Défine subject.
    $sujet = "[Broc'Vintage]Annulation du rendez-vous de ". $meeting .".";
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
    //==========
    header('Location:' . URL . '?page=reservation&week=0&product=0&dispo=0');
}