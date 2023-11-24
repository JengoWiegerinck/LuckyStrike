<?php
require_once("db_functions.php");
require_once("user.php");

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
            $reservation['extraLane']
        );
        array_push($reservationArr, $addReservation);
    }
    return $reservationArr;
}

function laneDateCheck($laneId, $startTime)
{
    $conn = db_connect();

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM reservation 
                            WHERE laneId = ? 
                               AND (? >= startTime AND ? < endTime)");

    // Bind parameters
    $stmt->bind_param("iss", $laneId, $startTime, $startTime);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if there are rows in the result
    if ($result->num_rows > 0) {
        $stmt->close();
        $conn->close();
        return true;
    }

    $stmt->close();
    $conn->close();
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
    $result = db_getData("SELECT * FROM reservation WHERE userId = '$id'");
    return $result;
}

function insertReservation($userId, $laneId, $priceLane, $priceFood, $children, $adult, $startTime, $endTime)
{

        $result = db_insertData("INSERT INTO reservation (userId, laneId, price, startTime, endTime, adult, children, extraPrice) VALUES ('$userId', '$laneId', '$priceLane', '$startTime', '$endTime', '$adult', '$children', '$priceFood')");
        return $result;
}



function updateReservation($userId, $laneId, $priceLane, $priceFood, $children, $adult, $startTime, $endTime, $id, $extraLane)
{
    if (checkAvailability($startTime, $laneId, $endTime)) {
        $result = db_doQuery("UPDATE `reservation` SET `userId`='$userId',`laneId`='$laneId', `extraLane`='$extraLane', `price`='$priceLane',`extraPrice`='$priceFood',`children`='$children',`adult`='$adult', `startTime`='$startTime',`endTime`='$endTime' WHERE id = '$id'");
        print_r("UPDATE `reservation` SET `userId`='$userId',`laneId`='$laneId', `extraLane`='$extraLane', `price`='$priceLane',`extraPrice`='$priceFood',`children`='$children',`adult`='$adult', `startTime`='$startTime',`endTime`='$endTime' WHERE id = '$id'");
        return $result;
    } else {
        return false;
    }
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

function checkAvailability($start, $lane, $end)
{
    $result = db_getData("SELECT * FROM reservation WHERE laneId = '$lane' AND '$end' BETWEEN startTime AND endTime");
    print_r("SELECT * FROM reservation WHERE laneId = '$lane' AND '$end' BETWEEN startTime AND endTime");
    if ($result->num_rows > 0) {
        return false;
    }

    $result = db_getData("SELECT * FROM reservation WHERE laneId = '7' AND startTime = ''$start");
    print_r("SELECT * FROM reservation WHERE laneId = '$lane' AND '$end' BETWEEN startTime AND endTime");
    if ($result->num_rows > 0) {
        return false;
    }

    $result = db_getData("SELECT * FROM reservation WHERE laneId = '$lane' AND '$start' BETWEEN startTime AND endTime");
    print_r("SELECT * FROM reservation WHERE laneId = '$lane' AND '$start' BETWEEN startTime AND endTime");
    if ($result->num_rows > 0) {
        return false;
    }
    return true;
}
