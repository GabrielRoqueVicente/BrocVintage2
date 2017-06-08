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
echo'
<!-- scripts -->
<script
        src="https://code.jquery.com/jquery-3.2.1.js"
        integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<script src="inc/js/pinterestGrid.js"></script>
<!-- <script src="inc/js/brocVintage.js"></script> -->
<!-- <script src="inc/js/showMore.js"></script> -->';