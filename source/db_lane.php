<?php

require_once ("db_functions.php");
require_once ("laneClass.php");

function getAllLane() 
{
    return db_getData("SELECT * FROM lane");
}

function getLaneById($laneId)
{
    $query = "SELECT *
    FROM lane
    WHERE id = '$laneId'";   
    $lane = db_getData($query);
    if ($lane->num_rows > 0) {
        return $lane;
    } else {
        return "Geen activiteit gevonden";
    }
}
function getLaneByName($laneName)
{
    $query = "SELECT *
    FROM lane
    WHERE username = '$laneName'";   
    $lane = db_getData($query);
    if ($lane->num_rows > 0) {
        return $lane;
    } else {
        return "Geen baan gevonden";
    }
}
function insertLane($name, $gates)
{
    $result = db_insertData("INSERT INTO food (username, gates) VALUES ('$name', '$gates')");
    return $result;
}

function deleteLane($id)
{
    $result = db_doQuery("DELETE FROM `lane` WHERE id = '$id'");
    return $result;
}

function updateLane($name, $gates, $id)
{
    $result = db_doQuery("UPDATE `lane` SET `username`='$name',`gates`='$gates' WHERE id = '$id'");
    return $result;
}

function getNumberOfLanes()
{
    $query = "SELECT COUNT(*) AS total FROM lane";
    $result = db_getData($query);
    $data=mysqli_fetch_assoc($result);
    return $data['total'];
}

?>