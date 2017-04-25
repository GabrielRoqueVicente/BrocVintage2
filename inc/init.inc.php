<?php

session_start();

/*try
{
    $db = new PDO('mysql:host=localhost;dbname=brocvintage;charset=utf8', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}*/

$db = new PDO('mysql:host=localhost;dbname=brocVintage', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.

// Constante contenant l'adresse absolu de la racine de mon site (sur le disque dur)
// Strpos renvoie la position de 'inc' dans __FILE__
// Substr COUPE la chaine de caractère à l'entroit où 'inc' a été trouvé
define('DOCUMENT_ROOT',
    substr(__FILE__,
        0,
        strpos(__FILE__, 'inc\init.inc.php')
    )
);

// Constante contenant l'URL de mon site
define('URL', 'http://localhost/brocvintage2');