<?php

?>

<?php include('Nav.php');?>
<br />
<br />
<br />

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
           }

           if(isConnected())
           {
               if(isset($_GET['reservation']))
               {
                   include('reservation.php');
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
                    include('admin/calendar.admin.php');
                }
            }

        }else{
            include('news.php');
        }




        ?>


    </div>
</div>