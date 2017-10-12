<?php
require "../private.php";

session_start();

$db = new PDO( $host, $dbname, $pswd);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

define('DOCUMENT_ROOT',
    substr(__FILE__,
        0,
        strpos(__FILE__, 'inc/init.inc.php')
    )
);

// CONSTANT
// Define URL
define('URL', 'http://stephservices.fr/brocvintage');
//Define ADMIN MAIL
define('EMAIL', 'gabriel.vicente.59@gmail.com');
//Define ADMIN ID
define('IDA', 1);

//Functions

function isConnected()
{
    return isset($_SESSION['user']);
}

function isAdmin()
{
    if(isConnected() && $_SESSION['status'] == 'admin' )
    {
        return TRUE;
    }
}