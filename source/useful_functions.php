<?php

function checkAdmin($admin)
{
    $adminBool = false;
    if ($admin == 2) 
    {
        $adminBool = true;
    }
    return $adminBool;
}

//how to use it
/*
if (isset($_COOKIE['CurrUser'])) {
    $user = new user(getUserById($_COOKIE['CurrUser']));
    if (checkAdmin($user->getKlasse()))
    {

    }
}
*/
function checkEmployee($employee)
{
    $employeeBool = false;
    if ($employee == 1) 
    {
        $employeeBool = true;
    }
    return $employeeBool;
}

function checkCustomer($customer)
{
    $customerBool = false;
    if ($customer == 0) 
    {
        $customerBool = true;
    }
    return $customerBool;
}

function gates($gatesBool)
{
    $gates = false;
    if ($gatesBool == 1) 
    {
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
    function isWeekend($date) {
        $date = strtotime($date);
        $dayOfWeek = date("l", $date);
        $dayOfWeek = strtolower($dayOfWeek);
        
        return ($dayOfWeek == "friday" || $dayOfWeek == "saturday" || $dayOfWeek == "sunday");
    }

    function participants($adult, $child){
        return $adult + $child;
    }

    function totalPrice($lanePrice, $foodPrice)
    {
        return $lanePrice + $foodPrice;
    }

    function check24Hours($date)
    {
        $newDate = date('Y-m-d', strtotime('+1 days'));
        if($date >= $newDate)
        {
            return true;
        }else{
            return false;
        }
  
        
    }

?>