<?php
require_once("db_functions.php");
require_once("user.php");

function getUser($email, $password)
{
    $user = db_getData("SELECT * FROM user WHERE email = '$email' AND password = '$password'");
    if ($user->num_rows > 0) {
        return $user;
    }
    return "No user found!";
}

function getUserById($id)
{
    $result = db_getData("SELECT * FROM user WHERE id = '$id'");
    return $result;
}

function getAllUser()
{
    return db_getData("SELECT * FROM user");
}

function getAllEmployee()
{
    return db_getData("SELECT * FROM user WHERE role = 1");
}

function getAllCustomer()
{
    return db_getData("SELECT * FROM user WHERE role = 0");
}

function insertCustomer($username, $email, $password)
{
    $result = db_insertData("INSERT INTO user (username, email, password, role) VALUES ('$username', '$email', '$password', 0)");
    return $result;
}

function insertEmployee($username, $email, $password)
{
    $result = db_insertData("INSERT INTO user (username, email, password, role) VALUES ('$username', '$email', '$password', 1)");
    return $result;
}

function deleteUser($id)
{
    $result = db_doQuery("DELETE FROM `user` WHERE id = '$id'");
    return $result;
}

function checkEmail($email)
{
    $user = db_getData("SELECT * FROM user WHERE email = '$email'");

    $resultArray = array();
    if  ($user) {
            while ($row = $user->fetch_assoc()) {
                $resultArray[] = $row;
            }
            
            return $resultArray;
        }
    return "Geen gebruiker gevonden!";
}

function updatePassword($password, $id)
{
    $result = db_doQuery("UPDATE user SET user.password = '$password' WHERE user.id = '$id'");
    return $result;
}
