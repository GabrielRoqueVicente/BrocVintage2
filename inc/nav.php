<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top"  role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#primaryNavbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo URL; ?>">Broc'Vintage</a>
        </div>
        <!-- Collect the nav links and other content for toggling -->
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li>
                    <a href="?page=aboutUs">Qui sommes nous ?</a>
                </li>
                <li>
                    <a href="?page=conditions">Conditions</a>
                </li>
                <li>
                    <a href="?page=contact">Contact</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (!isConnected()){
                  echo '<li><a href="?page=connection"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>';
                  echo '<li><a href="?page=registration"><span class="glyphicon glyphicon-user"></span> S\'inscrire</a></li>';
                }else{
                    $reservationManager = new ReservationManager($db);
                    $reservations = $reservationManager->getCartList($_SESSION['idUser']);
                    $reservations = count($reservations);

                    echo '<li><a href="?page=reservation&week=0&product=0&dispo=0">' . $reservations . ' <span class="glyphicon glyphicon-shopping-cart"></span></a></li>';
                    echo '<li><a href="?page=profile"><span class="glyphicon glyphicon-user"></span></a></li>';
                    echo '<li><a href="?page=connection&action=out"><span class="glyphicon glyphicon-log-out"></span> Deconnexion</a></li>';
                }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>