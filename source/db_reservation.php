<?php

require_once ("db_functions.php");
require_once ("user.php");

function getAllReservation() 
{
    return db_getData("SELECT * FROM reservation");
}

function getReservationById($id)
{
    $result = db_getData("SELECT * FROM reservation WHERE id = '$id'");
    return $result;
}

function insertReservation($userId, $laneId, $priceLane, $priceFood, $children, $adult, $startTime, $endTime)
{
    $result = db_insertData("INSERT INTO reservation (userId, laneId, price, startTime, stopTime, adult, children, extraPrice) VALUES ('$userId', '$laneId', '$priceLane', '$startTime', '$endTime', '$adult', '$children', '$priceFood')");
    return $result;
}

function updateReservation($userId, $laneId, $priceLane, $priceFood, $children, $adult, $startTime, $endTime, $id)
{
    $result = db_doQuery("UPDATE `reservation` SET `userId`='$userId',`laneId`='$laneId',`price`='$priceLane',`extraPrice`='$priceFood',`children`='$children',`adult`='$adult',`startTime`='$startTime',`stopTime`='$endTime' WHERE id = '$id'");
    return $result;
}

function deleteReservation($id)
{
    $result = db_doQuery("DELETE FROM `reservation` WHERE id = '$id'");
    return $result;
}
?>