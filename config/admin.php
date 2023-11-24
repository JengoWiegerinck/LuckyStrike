<?php
ob_start(); // Start output buffering
include '../public/header.php';
require_once("../source/db_user.php");
require_once("../source/useful_functions.php");

// Check if account is admin
if (isset($_COOKIE['CurrUser'])) {
    $user = new user(getUserById($_COOKIE['CurrUser']));
    if (!checkCustomer($user->getKlasse()))
    {
        
?>
<?php  

if (checkAdmin($user->getKlasse()))
{
    ?>
        
        <div class="h-[60%] md:h-[50%] grid gap-4 grid-cols-1 py-20 md:grid-cols-2 content-center justify-items-center">

            <input class="h-10 w-3/4 px-5 text-blackKleur transition-colors duration-150 border       border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" type="button" value="horeca"onclick="window.location.href='horeca.php';"/>
            <input class="h-10 w-3/4 px-5 text-blackKleur transition-colors duration-150 border       border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" type="button" value="medewerker account"  onclick="window.location.href='employee.php';"/>

            <input class="h-10 w-3/4 px-5 text-blackKleur transition-colors duration-150 border       border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" type="button" value="klanten account" onclick="window.location.href='customer.php';"/>
            
            <input class="h-10 w-3/4 px-5 text-blackKleur transition-colors duration-150 border       border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" type="button" value="reserveringen" onclick="window.location.href='reservations.php';"/>

            <input class="h-10 w-3/4 px-5 text-blackKleur transition-colors duration-150 border       border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" type="button" value="banen" onclick="window.location.href='lane.php';"/>
                    
            <input class="h-10 w-3/4 px-5 text-blackKleur transition-colors duration-150 border       border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" type="button" value="banen reserveren" onclick="window.location.href='laneReservation.php';"/>
        </div>
        <?php
}

?>
<?php  
if (checkEmployee($user->getKlasse()))
{
    ?>
        <div class="flex items-center justify-center min-h-[100vh]">
        <input class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur hover:text-whiteKleur hover:border-redKleur mr-4" type="button" value="banen reserveren" onclick="window.location.href='laneReservation.php';" />
        <input class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur hover:text-whiteKleur hover:border-redKleur" type="button" value="reserveringen" onclick="window.location.href='reservations.php';" />
</div>

        <?php
}
}

?>



<?php
    }else{
        header('../public/index.php');
    }
     include '../public/footer.php'; 
     ob_end_flush(); // Flush the output buffer
?>