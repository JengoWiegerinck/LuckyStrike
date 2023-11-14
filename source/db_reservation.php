<?php

require_once ("db_functions.php");
require_once ("user.php");

function getAllReservation() 
{
    return db_getData("SELECT * FROM reservation");
}

function getReservationById($id)
{
    $result = db_getData("SELECT * FROM reservation WHERE userId = '$id'");
    return $result;
}

function getAllReservationFromUser($id)
{
    $result = db_getData("SELECT * FROM reservation WHERE userId = '$id'");
    return $result;
}

function insertReservation($userId, $laneId, $priceLane, $priceFood, $children, $adult, $startTime, $endTime)
{
    $result = db_insertData("INSERT INTO reservation (userId, laneId, price, startTime, endTime, adult, children, extraPrice) VALUES ('$userId', '$laneId', '$priceLane', '$startTime', '$endTime', '$adult', '$children', '$priceFood')");
    return $result;
}

function updateReservation($userId, $laneId, $priceLane, $priceFood, $children, $adult, $startTime, $endTime, $id)
{
    $result = db_doQuery("UPDATE `reservation` SET `userId`='$userId',`laneId`='$laneId',`price`='$priceLane',`extraPrice`='$priceFood',`children`='$children',`adult`='$adult',`startTime`='$startTime',`endTime`='$endTime' WHERE id = '$id'");
    return $result;
}

function deleteReservation($id)
{
    $result = db_doQuery("DELETE FROM `reservation` WHERE id = '$id'");
    return $result;
}

function check($start, $lane)
{
    $user = db_getData("SELECT * FROM reservation WHERE laneId = '$lane' AND startTime = '$start'");
    if ($user->num_rows > 0){
        return false;
    }
    return true;
}

function checkAvailability($laneId, $endTime, $startTime)
{
    while($startTime > $endTime){
        check($laneId, $startTime);
        $startTime = $startTime->modify('+1 hour');
    }





    $user = db_getData("SELECT * FROM reservation WHERE laneId = '$laneId' AND startTime = '$startTime' AND endTime = '$endTime'");
    if ($user->num_rows > 0){
        return false;
    }
    return true;
}
?>