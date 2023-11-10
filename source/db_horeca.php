<?php

require_once ("db_functions.php");
require_once ("user.php");

function getAllFood() 
{
    return db_getData("SELECT * FROM food");
}

function insertFood($name, $price)
{
    $result = db_insertData("INSERT INTO food (name, price) VALUES ('$name', '$price')");
    return $result;
}

function deleteFood($id)
{
    $result = db_doQuery("DELETE FROM `food` WHERE id = '$id'");
    return $result;
}
?>