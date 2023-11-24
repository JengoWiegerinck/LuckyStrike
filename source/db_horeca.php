<?php
require_once("db_functions.php");
require_once("user.php");

function getAllHoreca()
{
    return db_getData("SELECT * FROM food");
}

function insertHoreca($name, $price, $image, $category)
{
    $result = db_insertData("INSERT INTO food (name, price, image, category) VALUES ('$name', '$price', '$image', '$category')");
    return $result;
}

function deleteHoreca($id)
{
    $result = db_doQuery("DELETE FROM `food` WHERE id = '$id'");
    return $result;
}
