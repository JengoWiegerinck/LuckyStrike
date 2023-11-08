<?php
include "../config/Database.php";


function db_connect() {
    try {
        $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;

        $db = new PDO($dsn, DB_USER, DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $db;
      } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
      }
}


function db_getData($query) {
    $db = db_connect();
    $result = $db->prepare($query);
    $result->execute();
    $db = null;
    return $result;
}


function db_insertData($query) {
    $db = db_connect();
    $result = $db->prepare($query);
    $result->execute();
    if ($result)
    {
        // Return row id for success
        return $db->lastInsertId();
    }
    else
    {
        $result = null;
        $result = "Query insert Error: " . $query . "<br>" . implode(" | ",$db->errorInfo());
    }
    $db = null;
    return $result;
}

function db_getUser($userName, $password) {
    $user = db_getData("SELECT * FROM admin WHERE userNaam = '$userName' AND userPassword = '$password'");
    //PDO: rowCount MYSQLI: num_rows
    if ($user->rowCount() > 0 )
    {
        // User found, return user data
        return $user;
    }
    else
    {
        return null;
    }
}
?>