<?php
$typeManager = new TypeManager($db);
$subTypeManager = new SubTypeManager($db);
$reservationManager = new ReservationManager($db);

$types = $typeManager->getListProductType();
$subTypes = $subTypeManager->getListProductSubType();
$nTypes = count($types);

echo '<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="' . URL . '">Broc\'Vintage</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="?page=news">News</a></li>
                <li><a href="?page=aboutUs">Qui sommes nous ?</a></li>';
                foreach($types as $type)
                {
                    echo '<li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">' . $type->typeName() . '<span class="caret"></span></a>
                        <ul class="dropdown-menu">';
                            foreach ($subTypes as $subType)
                            {
                                if ($type->idProductType() == $subType->idProductType())
                                {
                                    echo '<li><a href="?page=produits&subType=' . $subType->idSubType() . '">' . $subType->subTypeName() . '</a></li>';
                                }
                            }
                        echo '</ul>
                    </li>';
                }
                echo '<li><a href="?page=conditions">Conditions</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">';
                if (!isConnected())
                {
                    echo '<li><a href="?page=connection"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>';
                    echo '<li><a href="?page=registration"><span class="glyphicon glyphicon-user"></span> S\'inscrire</a></li>';
                }else{
                    $reservations = $reservationManager->getCartList($_SESSION['idUser']);
                    $reservations = count($reservations);

                    echo '<li><a href="?page=reservation&week=0&product=0&dispo=0">' . $reservations . ' <span class="glyphicon glyphicon-shopping-cart"></span></a></li>';
                    echo '<li><a href="?page=profile"><span class="glyphicon glyphicon-user"></span></a></li>';
                    echo '<li><a href="?page=connection&action=out"><span class="glyphicon glyphicon-log-out"></span> Deconnexion</a></li>';
                }
            echo '</ul>
        </div>
    </div>
</nav>
<br />
<br />
<br />';