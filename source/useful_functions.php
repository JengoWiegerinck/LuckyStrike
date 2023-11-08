<?php

function checkAdmin($admin)
{
    $adminBool = false;
    if ($admin = 2) 
    {
        $adminBool = true;
    }
    return $adminBool;
}

//how to use it
/*
    $user = new user(getUserById($_COOKIE['CurrUser']));
    if (checkAmin($user->getKlasse()))
    {

    }
*/
function checkEmployee($employee)
{
    $employeeBool = false;
    if ($employee = 2) 
    {
        $employeeBool = true;
    }
    return $employeeBool;
}

?>