<?php
echo'
<div class="container">

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Broc\'Vintage 2017</p>
            </div>
        </div>
    </footer>
    <!-- /.container -->
</div>';

if(isAdmin()){
    echo'
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
    </nav>';
}