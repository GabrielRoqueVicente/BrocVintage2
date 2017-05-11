<?php

session_start();

$db = new PDO('mysql:host=localhost;dbname=brocVintage', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

define('DOCUMENT_ROOT',
    substr(__FILE__,
        0,
        strpos(__FILE__, 'inc\init.inc.php')
    )
);

// Define URL
define('URL', 'http://localhost/brocvintage2');

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