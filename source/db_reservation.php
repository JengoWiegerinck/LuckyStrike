<?php
require_once("db_functions.php");
require_once("user.php");

function getAllReservation()
{
    return db_getData("SELECT * FROM reservation");
}

function getReservationByUserID($userId)
{
    $result = db_getData("SELECT * FROM reservation WHERE userId = '$userId'");
    if($result->num_rows > 0){
        return $result;
    }
    return true;
}

function laneDateCheck($laneId, $startTime)
{
    // Execute the query
    $result = db_getData("SELECT * FROM reservation WHERE laneId = '$laneId'  AND ('$startTime' >= startTime AND '$startTime' < endTime)");

    // Check if there are rows in the result
    if ($result->num_rows > 0) {
        return true;
    }
    return false;
}


function timeDay($lane, $datumWithoutTime, $beginTijd)
{
    $date = $datumWithoutTime . " " . $beginTijd;
    $dateEnd = $datumWithoutTime . " 23:00";
    $result = db_getData("SELECT * FROM reservation 
    WHERE laneId = '$lane' AND
       startTime >= '$date' AND
       startTime <= '$dateEnd' ORDER BY startTime LIMIT 1");

    if ($result->num_rows > 0) {
        return $result;
    }
    return false;
}

function timeDayUpdate($lane, $datumWithoutTime, $beginTijd, $userId)
{
    $date = $datumWithoutTime . " " . $beginTijd;
    $dateEnd = $datumWithoutTime . " 23:00";
    $result = db_getData("SELECT * FROM reservation 
    WHERE laneId = '$lane' AND
       startTime >= '$date' AND
       startTime <= '$dateEnd'AND
       userId != '$userId'
        ORDER BY startTime LIMIT 1");

    if ($result->num_rows > 0) {
        return $result;
    }
    return false;
}

function getReservationById($id)
{
    $result = db_getData("SELECT * FROM reservation WHERE id = '$id'");
    return $result;
}

function getAllReservationFromUser($id)
{
    $result = db_getData("SELECT * FROM reservation WHERE userId = '$id' ORDER BY startTime DESC");
    return $result;
}

function insertReservation($userId, $laneId, $priceLane, $priceFood, $children, $adult, $startTime, $endTime, $extraLane)
{

        $result = db_insertData("INSERT INTO reservation (userId, laneId, price, startTime, endTime, adult, children, extraPrice, extraBaan) VALUES ('$userId', '$laneId', '$priceLane', '$startTime', '$endTime', '$adult', '$children', '$priceFood', '$extraLane')");
        return $result;
}



function updateReservation($userId, $laneId, $priceLane, $priceFood, $children, $adult, $startTime, $endTime, $id, $extraLane)
{
   
        $result = db_doQuery("UPDATE `reservation` SET `userId`='$userId',`laneId`='$laneId', `extraBaan`='$extraLane', `price`='$priceLane',`extraPrice`='$priceFood',`children`='$children',`adult`='$adult', `startTime`='$startTime',`endTime`='$endTime' WHERE id = '$id'");
        return $result;
}

function updateReservationCustomer($userId, $laneId, $priceLane, $priceFood, $children, $adult, $startTime, $endTime, $id, $extraLane)
{

        $result = db_doQuery("UPDATE `reservation` SET `userId`='$userId',`laneId`='$laneId', `extraBaan`='$extraLane', `price`='$priceLane',`extraPrice`='$priceFood',`children`='$children',`adult`='$adult', `startTime`='$startTime',`endTime`='$endTime' WHERE id = '$id'");
        return $result;
}

function deleteReservation($id)
{
    $result = db_doQuery("DELETE FROM `reservation` WHERE id = '$id'");
    return $result;
}


