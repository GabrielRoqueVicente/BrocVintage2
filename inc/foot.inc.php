<?php
if(isAdmin())
{ ?>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Menu Administrateur</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="?page=products">Produits</a></li>
                    <li><a href="?page=articles">Articles</a></li>
                    <li><a href="?page=users">Utilisateurs</a></li>
                    <li><a href="?page=calendar">Calendrier</a></li>
                </ul>
            </div>
        </div>
    </nav>
<?php } ?>




<!--<script language="javascript" src="inc/js/brocVintage.js"></script>-->