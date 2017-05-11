<?php

?>

<?php include('Nav.php');?>

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
           }

        }else{
            include('news.php');
        }




        ?>


    </div>

</div>