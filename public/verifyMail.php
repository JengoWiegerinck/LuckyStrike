<?php
require_once "../source/db_functions.php";

if($_GET["userId"]) {
    $id = $_GET["userId"];
    db_doQuery("UPDATE `user` SET `verified`='1' WHERE id = $id");
    header('location: ./login.php');
    exit();
}
?>