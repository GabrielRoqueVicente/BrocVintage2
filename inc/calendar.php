<?php

//VARIABLES

//Today Date
$today = new DateTime("today");

// Format days
$formatDay = new IntlDateFormatter('fr_FR',IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Europe/Paris', IntlDateFormatter::GREGORIAN,'EEEE');
$formatDay->setPattern('EEEE');
$formatDayTh = new IntlDateFormatter('fr_FR',IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Europe/Paris', IntlDateFormatter::GREGORIAN,'EEEE d MMMM  yyyy');
$formatDayTh->setPattern('EEEE d MMMM  yyyy');

$formatMonth = new IntlDateFormatter('fr_FR',IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Europe/Paris', IntlDateFormatter::GREGORIAN, 'MMMM  yyyy');
$formatMonth->setPattern('MMMM  yyyy');
$dayI  = clone $today;

// Format Hours

$hour = new DateTime('08:00');
$formatHour = new IntlDateFormatter('fr_FR',IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Europe/Paris', IntlDateFormatter::GREGORIAN, 'HH:mm');
$formatHour->setPattern('HH:mm');

?>

<h3><?php //echo $formatMonth->format($today); ?></h3><br />

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th><span class="glyphicon glyphicon-chevron-left"></th>
            <?php
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
        <th><span class="glyphicon glyphicon-chevron-right"></th>
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

                //////////////////// Week-End Hours//////////////////////
                if ($formatDay->format($dayI) === 'samedi')
                {
                    echo '<td>' . $formatHour->format($hour) . ' - ';
                    $hour = $hour->modify('+1 hour');
                    echo   $formatHour->format($hour) . '</td>';
                    $hour = $hour->modify('-1 hour');
                }elseif($formatDay->format($dayI) === 'dimanche')
                {
                    echo '<td>' . $formatHour->format($hour) . ' - ';
                    $hour = $hour->modify('+1 hour');
                    echo   $formatHour->format($hour) . '</td>';
                    $hour = $hour->modify('-1 hour');
                }elseif($y <3) {
                    $hour = $hour->modify('+9 hour');
                    echo '<td>' . $formatHour->format($hour) . ' - ';
                    $hour = $hour->modify('+1 hour');
                    echo $formatHour->format($hour) . '</td>';
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