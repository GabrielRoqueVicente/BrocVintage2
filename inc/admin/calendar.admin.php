<?php
//Redirect
if(!isAdmin())
{
    header('location:' . URL . '/index.php');
}
//Objects instance

$reservationManager = new ReservationManager($db);

//VARIABLES
$week = $_GET['week'];

//Today Date
$tomorrow = new DateTime("tomorrow");

// Format days
$formatDay = new IntlDateFormatter('fr_FR',IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Europe/Paris', IntlDateFormatter::GREGORIAN,'EEEE');
$formatDay->setPattern('EEEE');
$formatDayTh = new IntlDateFormatter('fr_FR',IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Europe/Paris', IntlDateFormatter::GREGORIAN,'EEEE d MMMM  yyyy');
$formatDayTh->setPattern('EEEE d MMMM  yyyy');

$formatMonth = new IntlDateFormatter('fr_FR',IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Europe/Paris', IntlDateFormatter::GREGORIAN, 'MMMM  yyyy');
$formatMonth->setPattern('MMMM  yyyy');
$dayI = clone $tomorrow;
$dayI =$dayI->modify('+' . ($week * 7) . 'days');

// Format Hours

$hour = new DateTime('08:00');
$formatHour = new IntlDateFormatter('fr_FR',IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Europe/Paris', IntlDateFormatter::GREGORIAN, 'HH:mm');
$formatHour->setPattern('HH:mm');

// Format DateTime
$formatDateTime =  new IntlDateFormatter('fr_FR',IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Europe/Paris', IntlDateFormatter::GREGORIAN,'yyyy-MM-dd ');
$formatDateTime->setPattern('yyyy-MM-dd ');
$formatHourDateTime =  new IntlDateFormatter('fr_FR',IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Europe/Paris', IntlDateFormatter::GREGORIAN,'HH-mm-ss');
$formatHourDateTime->setPattern('HH:mm:ss');


// DATA PROCESSING

if(!empty($_GET['reservation'])){
    $error='';

    if($_SESSION['status'] !== 'admin')
    {
        $error += 'Seul un aministrateur peut modifier ce tableau.';
    }


    if(empty($error) && !empty($reservationManager->getDate($_GET['reservation'])))
    {
        $reservationManager->delete($_GET['reservation']);
        unset($_GET['reservation']);
        header('location:' . URL .'?page=calendarAdmin&week=' . $_GET['week'] . '&reservation=');

    }elseif(empty($error) && $_GET['reservation'] !== $reservationManager->getDate($_GET['reservation']))
    {
        $reservation['meeting_date'] = $_GET['reservation'];
        $reservation['id_user'] = $_SESSION['idUser'];
        $reservation = new Reservation($reservation);
        $reservationManager->add($reservation);
        header('location:' . URL .'?page=calendarAdmin&week=' . $_GET['week'] . '&reservation=');
    }
}



?>

<h3><?php //echo $formatMonth->format($today); ?></h3><br />

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <?php
            if($_GET['week'] <= 0)
            {
                $_GET['week'] = 0;
                ?>
                <th><span class="glyphicon glyphicon-chevron-left"></span></th>
            <?php
            }else{
                ?>
                <th><a href="?page=calendarAdmin&week=<?php echo $_GET['week']-1; ?>"><span class="glyphicon glyphicon-chevron-left"></span></a></th>
            <?php
            }

            for($i = 0; $i < 7; $i++)
            {
                if ($formatDay->format($dayI) === 'samedi' && $i !== 0)
                {
                    echo '<th style="width:1px" class="active"></th>';
                }

                ///////////////////Day Cells//////////////////////////
                echo '<th>' . $formatDayTh->format($dayI) . '</th>';
                ///////////////////////////////////////////////////////

                if ($formatDay->format($dayI) === 'dimanche' && $i !==6)
                {
                    echo '<th style="width:1px" class="active"></th>';
                }elseif($formatDay->format($dayI) === 'dimanche' && $i == 0)
                {
                    echo '<th style="width:1px" class="active"></th>';
                }

                $dayI = $dayI->modify('+1 days');
            } 
            ?>
        <th><a href="?page=calendarAdmin&week=<?php echo $_GET['week']+1; ?>"><span class="glyphicon glyphicon-chevron-right"></span></a></th>
    </tr>
    </thead>
    <tbody>
    <?php
    for($y = 0; $y < 9; $y++)
    {
        $DayI = $dayI->modify('-7 days');
        ?><tr><?php
            echo '<td></td>';

            for($i = 0; $i < 7; $i++)
            {
                if ($formatDay->format($dayI) === 'samedi' && $i !== 0)
                {
                    echo '<td style="width:1px" class="active"></td>';
                }

                //////////////////// TABLE HOURS//////////////////////
                if ($formatDay->format($dayI) === 'samedi')
                {
                    $btn = 'btn-primary';
                    $dateTime = $formatDateTime->format($dayI) . $formatHourDateTime->format($hour);

                   if(!empty($reservationManager->getDate($dateTime)))
                    {
                        $btn = 'btn-danger';
                    }

                    echo '<td> <a href=?page=calendarAdmin&week=' . $_GET['week'] . '&reservation=' . $dateTime .'" class="btn ' . $btn . '" role="button">' . $formatHour->format($hour) . ' - ';
                    $hour = $hour->modify('+1 hour');
                    echo   $formatHour->format($hour) . '</a></td>';
                    $hour = $hour->modify('-1 hour');
                }elseif($formatDay->format($dayI) === 'dimanche')
                {
                    $btn = 'btn-primary';
                    $dateTime = $formatDateTime->format($dayI) . $formatHourDateTime->format($hour);

                    if(!empty($reservationManager->getDate($dateTime)))
                    {
                        $btn = 'btn-danger';
                    }

                    echo '<td><a href="?page=calendarAdmin&week=' . $_GET['week'] . '&reservation=' . $dateTime .'" class="btn ' . $btn . '" role="button">' . $formatHour->format($hour) . ' - ';
                    $hour = $hour->modify('+1 hour');
                    echo   $formatHour->format($hour) . '</a></td>';
                    $hour = $hour->modify('-1 hour');
                }elseif($y <3) {
                    $hour = $hour->modify('+9 hour');

                    $btn = 'btn-primary';
                    $dateTime = $formatDateTime->format($dayI) . $formatHourDateTime->format($hour);

                    if(!empty($reservationManager->getDate($dateTime)))
                    {
                        $btn = 'btn-danger';
                    }

                    echo '<td><a href="?page=calendarAdmin&week=' . $_GET['week'] . '&reservation=' . $dateTime .'" class="btn ' . $btn . '" role="button">' . $formatHour->format($hour) . ' - ';
                    $hour = $hour->modify('+1 hour');
                    echo $formatHour->format($hour) . '</a></td>';
                    $hour = $hour->modify('-10 hour');
                }else{
                    echo '<td class="active"></td>';
                }
                ///////////////////////////////////////////////////////

                if ($formatDay->format($dayI) === 'dimanche' && $i !==6)
                {
                    echo '<td style="width:1px" class="active"></td>';
                }elseif($formatDay->format($dayI) === 'dimanche' && $i == 0)
                {
                    echo '<td style="width:1px" class="active"></td>';
                }

                $dayI = $dayI->modify('+1 days');
            }
            ?>
            <td></td>
        </tr><?php


        $hour = $hour->modify('+1 hour');
    }
        ?></tbody>
    </table>
</div>