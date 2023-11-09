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
?>