<?php
// Require list
/*require '/class/ProductTypeClass.php';
require '/class/ProductTypeManager.php';
require '/class/ProductSubTypeClass.php';
require '/class/ProductSubTypeManager.php';*/

$db = new PDO('mysql:host=localhost;dbname=brocvintage', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

/*$typeManager = new TypesManager($db);
$subTypeManager = new SubTypesManager($db);*/
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://localhost/BrocVintage2/inc/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="http://localhost/BrocVintage2/inc/js/bootstrap.js"></script>
</head>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Broc'Vintage</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Acceuil <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Qui sommes-nous ?</a></li>


                <?php

                /*
                 * Dynamic Nav
                 */

                $result = $db->query("SELECT name, id_product_type FROM products_types");

                while ($types = $result ->fetch())
                {
                    ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo htmlspecialchars($types['name']); ?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <?php

                    $tId = $types['id_product_type'];
                    $sResult = $db->query("SELECT name, id_product_type FROM sub_types");
                    while ($sTypes = $sResult ->fetch())
                    {
                        $sId = $sTypes['id_product_type'];

                        if($tId == $sId ) {

                            ?>
                            <li><h6><a href="#"><?php echo htmlspecialchars($sTypes['name']); ?></a></h6></li>
                            <?php
                        }
                    }
                    ?>
                    </ul>
                </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>




