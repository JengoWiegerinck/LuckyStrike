<?php

require_once ("db_functions.php");
require_once ("user.php");

function getAllReservation() 
{
    return db_getData("SELECT * FROM reservation");
}

function getAllReservationAsClass() 
{
    //should give back an array with all activities as classes  edit: doesn't work
    $reservationSql = getAllReservation();
    $reservationArr = [];
    while ($reservation = $reservationSql->fetch_assoc()) {
        $emtyReservations = new reservationsClass();

        $addReservation = $emtyReservations->setReservation(
            $reservation['id'], 
            $reservation['userId'],
            $reservation['laneId'],
            $reservation['priceLane'],
            $reservation['priceFood'],
            $reservation['adult'],
            $reservation['children'],
            $reservation['startTime'],
            $reservation['endTime'],
            $reservation['extraLane']);
        array_push($reservationArr, $addReservation);
    }
    return $reservationArr;
}

function laneDateCheck($laneId, $startTime)
{
    $result = db_getData("SELECT * FROM reservation WHERE laneId = '$laneId' AND startTime = '$startTime' OR '2024-07-06 19:00:00.00' BETWEEN startTime AND endTime");
    if ($result->num_rows > 0){
        return false;
    }
    return true;
    
}

function getReservationById($id)
{
    $result = db_getData("SELECT * FROM reservation WHERE id = '$id'");
    return $result;
}

function getAllReservationFromUser($id)
{
    $result = db_getData("SELECT * FROM reservation WHERE userId = '$id'");
    return $result;
}

function insertReservation($userId, $laneId, $priceLane, $priceFood, $children, $adult, $startTime, $endTime)
{
    if(checkAvailability($startTime, $laneId, $endTime))
    {
        $result = db_insertData("INSERT INTO reservation (userId, laneId, price, startTime, endTime, adult, children, extraPrice) VALUES ('$userId', '$laneId', '$priceLane', '$startTime', '$endTime', '$adult', '$children', '$priceFood')");
        return $result;
    }else{
        return false;
    }  
}

function updateReservation($userId, $laneId, $priceLane, $priceFood, $children, $adult, $startTime, $endTime, $id)
{
    if(checkAvailability($startTime, $laneId, $endTime))
    {
        $result = db_doQuery("UPDATE `reservation` SET `userId`='$userId',`laneId`='$laneId',   `price`='$priceLane',`extraPrice`='$priceFood',`children`='$children',`adult`='$adult',    `startTime`='$startTime',`endTime`='$endTime' WHERE id = '$id'");
        return $result;
    }else{
        return false;
    }
}

function deleteReservation($id)
{
    $result = db_doQuery("DELETE FROM `reservation` WHERE id = '$id'");
    return $result;
}

function checkAvailability($start, $lane, $end)
{
    $result = db_getData("SELECT * FROM reservation WHERE laneId = '$lane' AND '$end' BETWEEN startTime AND endTime");
    print_r("SELECT * FROM reservation WHERE laneId = '$lane' AND '$end' BETWEEN startTime AND endTime");
    if ($result->num_rows > 0){
        return false;
    }

    $result = db_getData("SELECT * FROM reservation WHERE laneId = '7' AND startTime = ''$start");
    print_r("SELECT * FROM reservation WHERE laneId = '$lane' AND '$end' BETWEEN startTime AND endTime");
    if ($result->num_rows > 0){
        return false;
    }

    $result = db_getData("SELECT * FROM reservation WHERE laneId = '$lane' AND '$start' BETWEEN startTime AND endTime");
    print_r("SELECT * FROM reservation WHERE laneId = '$lane' AND '$start' BETWEEN startTime AND endTime");
    if ($result->num_rows > 0){
        return false;
    }
    return true;
}


?>