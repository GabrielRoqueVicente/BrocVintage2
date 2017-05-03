<?php
// Require list
require('..\init.inc.php');

//Objects instance


//$products = $Product->getList();
?>

<form action="cible_envoi.php" method="post" enctype="multipart/form-data">
    <p>Formulaire d'envoi de fichier</p>
    <input type="file" name="picture" /><br />
    <input type="submit" value="Envoyer" />
</form>