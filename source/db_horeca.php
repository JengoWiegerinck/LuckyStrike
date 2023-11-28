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

function checkHoreca($name)
{
    $foodName = db_getData("SELECT * FROM food WHERE name = '$name'");
    if ($foodName->num_rows > 0) {
        return $foodName;
    }
    return "No food found!";
}
