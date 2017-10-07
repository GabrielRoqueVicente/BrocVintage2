<body>
    <?php
    include('nav.php');

    echo '
    <div class="container">
        <div class="col-md-12">
            <div class="alert alert-warning">
                <strong>ATTENTION!</strong> SITE EN CONSTRUCTION, les inscriptions sont actuellement fermées.
            </div>
        </div>
    </div>';

    echo '
    <div class="container">
        <div class="row">';

                if(isset($_GET['page'])){
                    if($_GET['page'] == 'registration'){
                        include('registration.php');
                    }elseif($_GET['page'] == 'connection'){
                        include('connection.php');
                    }elseif($_GET['page'] == 'product'){
                        include('content.php');
                        echo '
                        <div class="col-md-9">';
                            include('product.php');
                        echo '
                        </div>
                        <!-- /.col-md-9 -->';
                    }elseif($_GET['page'] == 'article'){
                        include('content.php');
                        echo '
                        <div class="col-md-9">';
                            include('article.php');
                        echo '
                        </div>
                        <!-- /.col-md-9 -->';
                    }elseif($_GET['page'] == 'produits'){
                        include('content.php');
                        echo '
                        <div class="col-md-9">';
                            include('productsNav.php');
                        echo '
                        </div>
                        <!-- /.col-md-9 -->';
                    }elseif($_GET['page'] == 'aboutUs'){
                        include('aboutUs.php');
                    }elseif($_GET['page'] == 'conditions'){
                        include('conditions.php');
                    }elseif($_GET['page'] == 'contact'){
                        include('contact.php');
                    }

                    if(isConnected()){
                        if($_GET['page'] == 'reservation'){
                            include('reservation.php');
                        }else if($_GET['page'] == 'profile'){
                            include('profile.php');
                        }
                    }

                    // ADMIN PAGES

                    if(isAdmin()){
                        if ($_GET['page'] == 'products'){
                            include('admin/website.admin.php');
                        }elseif ($_GET['page'] == 'articles'){
                            include('admin/articles.admin.php');
                        }elseif ($_GET['page'] == 'users'){
                            include('admin/users.admin.php');
                        }elseif ($_GET['page'] == 'calendarAdmin'){
                            include('admin/calendar.admin.php');
                        }
                    }

                }else{
                    include('content.php');
                    echo '
                    <div class="col-md-9">';
                        include('home.php');
                    echo '
                    </div>
                    <!-- /.col-md-9 -->';
                }
echo '
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
 
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
<!-- <script src="inc/js/showMore.js"></script> -->
</body>
';
