<?php

require_once ("db_functions.php");
require_once ("user.php");
function getUser($email, $password){
    $user = db_getData("SELECT * FROM user WHERE email = '$email' AND password = '$password'");
    if ($user->num_rows > 0){
        return $user;
    }
    return "No user found!";
}
?>