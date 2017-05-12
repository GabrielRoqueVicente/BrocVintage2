<?php

require('..\init.inc.php');
require(DOCUMENT_ROOT . 'inc\class\UserClass.php');
require(DOCUMENT_ROOT . 'inc\class\UserManager.php');

//Redirect
if(!isAdmin())
{
    header('location:' . URL . '/index.php');
}

//Objects instance

$userManager = new UserManager($db);

if(isset($_GET['idUser']))
{
    $user = $userManager->get($_GET['idUser']);
    $userManager->delete($user);
    header('Location:' . URL . ' ?page=users');
}else{
    header('Location:' . URL);
}