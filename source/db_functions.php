<?php

// require_once ("../config/databse.php");


function db_connect(){
    $servername = "gc-webhosting.nl";
    $username   = "jwiegerinck_luckystrike";
    $password   = "luckystrike001";
    $dbname     = "jwiegerinck_luckystrike";

    $mysqli = new mysqli($servername, $username, $password, $dbname);

    return $mysqli;
}

function db_getData($query){
    $mysqli = db_connect();
    $result = $mysqli->query($query);
    $mysqli->close();
    return $result;
}


function db_insertData($query){
    $mysqli = db_connect();
    $result = "";
    if ($mysqli->query($query) === TRUE){
        $result = $mysqli->insert_id;
    }else{
        $result = "Error: " . $query . "<br>" . $mysqli->error;
    }
    $mysqli->close();
    return $result;
}

function db_doQuery($query)
{
    $mysqli= db_connect();
    if ($mysqli->query($query) === true) {
        return true;
    }
    $mysqli->close();
    return false;
}

?>