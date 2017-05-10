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
           }

        }else{
            include('news.php');
        }




        ?>


    </div>

</div>