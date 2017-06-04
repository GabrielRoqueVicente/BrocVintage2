<?php

?>

<?php include('nav.php');?>

<div class="container">

    <div class="row">

        <?php
        if(isset($_GET['page']))
        {
           if($_GET['page'] == 'registration')
           {
               include('registration.php');
           }elseif($_GET['page'] == 'connection')
           {
               include('connection.php');
           }elseif($_GET['page'] == 'product')
           {
               include('product.php');
           }elseif($_GET['page'] == 'article')
           {
               include('article.php');
           }elseif($_GET['page'] == 'produits')
           {
               include('productsNav.php');
           }elseif($_GET['page'] == 'news')
           {
               include('news.php');
           }elseif($_GET['page'] == 'aboutUs')
           {
               include('aboutUs.php');
           }elseif($_GET['page'] == 'conditions')
           {
               include('conditions.php');
           }

           if(isConnected())
           {
               if($_GET['page'] == 'reservation')
               {
                   include('reservation.php');
               }else if($_GET['page'] == 'profile')
               {
                   include('profile.php');
               }
           }

           // ADMIN PAGES

            if(isAdmin())
            {
                if ($_GET['page'] == 'products')
                {
                    include('admin/website.admin.php');
                } elseif ($_GET['page'] == 'articles')
                {
                    include('admin/articles.admin.php');
                } elseif ($_GET['page'] == 'users')
                {
                    include('admin/users.admin.php');
                } elseif ($_GET['page'] == 'calendarAdmin')
                {
                    echo '<div class="col-md-offset-3 col-md-9">';
                    include('admin/calendar.admin.php');
                }
            }

        }else{
            include('home.php');
        }




        ?>


    </div>
</div>