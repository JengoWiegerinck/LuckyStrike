<?php
 setcookie('CurrUser', '', time() - 3600, '/');
 unset($_COOKIE['CurrUser']);

 header("Location: ../index.php");
?>