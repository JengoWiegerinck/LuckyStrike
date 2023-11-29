<?php
function checkAdmin($admin)
{
    $adminBool = false;
    if ($admin == 2) {
        $adminBool = true;
    }
    return $adminBool;
}

function checkEmployee($employee)
{
    $employeeBool = false;
    if ($employee == 1) {
        $employeeBool = true;
    }
    return $employeeBool;
}

function checkCustomer($customer)
{
    $customerBool = false;
    if ($customer == 0) {
        $customerBool = true;
    }
    return $customerBool;
}

function gates($gatesBool)
{
    $gates = false;
    if ($gatesBool == 1) {
        $gates = true;
    }
    return $gates;
}

function formateDate($date)
{
    return date("d-m-Y H:i", strtotime($date));
}

function formateDatumNl($date)
{
    return date("d-m-Y", strtotime($date));
}

function formateDateOutDatabase($date)
{
    return date("Y-m-d H:i", strtotime($date));
}

function formateOnlyHours($date)
{
    return date("H", strtotime($date));
}

function formateBackToHoureMinute($hours)
{
    return $hours . ":00";
}

function formateDatum($date)
{
    return date("Y-m-d", strtotime($date));
}

function formateTime($date)
{
    return date("H:i", strtotime($date));
}

function formateDateTime($date, $time)
{
    $newDate = date("Y-m-d", strtotime($date));
    $newTime = date("H:i", strtotime($time));
    $dateTime = $newDate . ' ' . $newTime;
    return $dateTime;
}

function isWeekend($date)
{
    $date = strtotime($date);
    $dayOfWeek = date("l", $date);
    $dayOfWeek = strtolower($dayOfWeek);

    return ($dayOfWeek == "friday" || $dayOfWeek == "saturday" || $dayOfWeek == "sunday");
}

function participants($adult, $child)
{
    return $adult + $child;
}

function totalPrice($lanePrice, $foodPrice)
{
    return $lanePrice + $foodPrice;
}

function check24Hours($date)
{
    $newDate = date('Y-m-d', strtotime('+1 days'));
    if ($date >= $newDate) {
        return true;
    } else {
        return false;
    }
}

function isTimeInRange($startTime, $endTime)
{
    $start = DateTime::createFromFormat('H:i', $startTime);
    $end = DateTime::createFromFormat('H:i', $endTime);

    // Check if DateTime::createFromFormat was successful
    if (!$start || !$end) {
        return ['isInRange' => false, 'duration' => 'Invalid time format'];
    }

    $rangeStart = DateTime::createFromFormat('H:i', '18:00');
    $rangeEnd = DateTime::createFromFormat('H:i', '24:00');

    $isInRange = ($start >= $rangeStart && $start <= $rangeEnd) || ($end >= $rangeStart && $end <= $rangeEnd);

    // Calculate the duration in hours and minutes
    $duration = '';
    if ($isInRange) {
        $interval = $start->diff($end);
        $hours = $interval->format('%h');
        $minutes = $interval->format('%i');
        $duration = $hours . ':' . $minutes;
    }

    return ['isInRange' => $isInRange, 'duration' => $duration];
}

function getHourDifference($startTime, $endTime)
{
    $startTime = formateTime($startTime);
    $start = DateTime::createFromFormat('H:i', $startTime);
    $end = DateTime::createFromFormat('H:i', $endTime);

    if ($start === false || $end === false) {
        // Geef een foutmelding terug of behandel de fout op een geschikte manier
        return 'Ongeldige datum/tijd formaat';
    }
    // Verschil berekenen in uren
    $interval = $start->diff($end);
    $hours = $interval->format('%h');

    return $hours;
}

function kosten($startTime, $endTime)
{
    $prijsNormaal = 24.0;
    $prijsWeekend = 28.0;
    $prijsAvond = 33.50;

    $uren = (float) getHourDifference($startTime, $endTime);

    if (isWeekend($startTime)) {
        $result = isTimeInRange(formateTime($startTime), $endTime);
        if ($result['isInRange']) {
            $urenPrijs = (float) $result['duration'];
            $uren = $uren - $urenPrijs;
            return ($prijsAvond * $urenPrijs) + ($uren * $prijsWeekend);
        } else {
            return $prijsWeekend * $uren;
        }
    } else {
        return $prijsNormaal * $uren;
    }
}

function laneID1($selectedLanes)
{
    $laneId = (int)$selectedLanes[1];

    $laneId = $laneId + 1;
    return $laneId;
}

function laneID2($selectedLanes)
{

    $laneId = (int)$selectedLanes[1];
    $laneId = $laneId + 1;
    $laneId2 = isset($selectedLanes[3]) ? $selectedLanes[3] + 1 : null;

    return $laneId2;
}
