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


function insertUser($username, $email, $password){

    $result = db_insertData("INSERT INTO user (username, email, password, role) VALUES ('$username', '$email', '$password', 0)");
    return $result;
}

function getUserById($id)
{
    $result = db_getData("SELECT * FROM user WHERE id = '$id'");
    return $result;
}


function checkEmail($email)
{
    $user = db_getData("SELECT * FROM user WHERE email = '$email'");
    if ($user->num_rows > 0){
        return $user;
    }
    return "No user found!";
}

?>