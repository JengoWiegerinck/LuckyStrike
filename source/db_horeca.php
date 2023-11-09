<?php

require_once ("db_functions.php");
require_once ("user.php");

function getAllFood() 
{
    return db_getData("SELECT * FROM food");
}

function insertFood($name, $price)
{
    $result = db_insertData("INSERT INTO user (name, price) VALUES ('$name', '$price')");
    return $result;
}
?>