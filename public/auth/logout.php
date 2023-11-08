<?php
 setcookie('CurrUser', '', time() - 3600, '/');
 unset($_COOKIE['CurrUser']);

 header("Location: ../Activities/overview.php");
?>