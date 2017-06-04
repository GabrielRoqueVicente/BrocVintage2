<?php
if(isAdmin())
{ ?>
    <br />
    <br />
    <br />
    <nav class="navbar navbar-inverse navbar-fixed-bottom">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#adminNav">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Menu Administrateur</a>
            </div>
            <div class="collapse navbar-collapse" id="adminNav">
                <ul class="nav navbar-nav">
                    <li><a href="?page=products">Produits</a></li>
                    <li><a href="?page=articles">Articles</a></li>
                    <li><a href="?page=users">Utilisateurs</a></li>
                    <li><a href="?page=calendarAdmin&week=0">Calendrier</a></li>
                </ul>
            </div>
        </div>
    </nav>
<?php } ?>
</html>




<!-- <script language="javascript" src="inc/js/brocVintage.js"></script> -->