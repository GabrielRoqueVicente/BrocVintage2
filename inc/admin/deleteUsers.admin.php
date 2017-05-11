<?php

//Redirect
if(!isAdmin())
{
    header('location:' . URL . '/index.php');
}