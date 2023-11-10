<?php
include '../public/header.php';
require_once("../source/db_user.php");
require_once("../source/useful_functions.php");

    //check if account is admin
if (isset($_COOKIE['CurrUser'])) {
    $user = new user(getUserById($_COOKIE['CurrUser']));
    if (!checkCustomer($user->getKlasse()))
    {
        
?>
<?php  

if (checkAdmin($user->getKlasse()))
{
    ?>
        
        <div class="h-56 grid gap-4 grid-cols-3 content-center">

            <input class="h-10 px-5 text-blackKleur transition-colors duration-150 border       border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" type="button" value="horeca"onclick="window.location.href='horeca.php';"/>
            <input class="h-10 px-5 text-blackKleur transition-colors duration-150 border       border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" type="button" value="medewerker account"  onclick="window.location.href='employee.php';"/>

            <input class="h-10 px-5 text-blackKleur transition-colors duration-150 border       border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" type="button" value="klanten account" onclick="window.location.href='customer.php';"/>
            
            <input class="h-10 px-5 text-blackKleur transition-colors duration-150 border       border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" type="button" value="reserveringen" onclick="window.location.href='horeca.php';"/>

            <input class="h-10 px-5 text-blackKleur transition-colors duration-150 border       border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" type="button" value="banen" onclick="window.location.href='lane.php';"/>
                    
        </div>
        <?php
}

?>
<?php  
if (checkEmployee($user->getKlasse()))
{
    ?>
        <div class="flex items-center justify-center min-h-[100vh]">
            <input class="h-10 px-5 text-blackKleur transition-colors duration-150 border           border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur    hover:border-redKleur" type="button" value="reserveringen" onclick="window.location.href='horeca.php';"/>
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
?>