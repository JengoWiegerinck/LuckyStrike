<?php
require_once("../source/db_user.php");
require_once("../source/useful_functions.php");

    //check if account is admin
if (isset($_COOKIE['CurrUser'])) {
    $user = new user(getUserById($_COOKIE['CurrUser']));
    if (checkAdmin($user->getKlasse()))
    {
        
    }else{
        header('../public/index.php');
    }
}
    
?>