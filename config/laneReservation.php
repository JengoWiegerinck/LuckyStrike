<?php
ob_start(); // Start output buffering
include '../public/header.php';
require_once("../source/useful_functions.php");
require_once("../source/db_user.php");
require_once("../source/db_lane.php");
require_once("../source/db_reservation.php");


if (isset($_COOKIE['CurrUser'])) {
    $user = new user(getUserById($_COOKIE['CurrUser']));
    if (checkAdmin($user->getKlasse()))
    {
        $timestamp = time();
        $datum = gmdate('Y-m-d', $timestamp);
        
    if (isset($_POST['datum'])){
        $datum = $_POST['dateCheck'];

    }
       
    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Week Agenda</title>
</head>
<body class="px-8 bg-gray-100 h-screen flex items-center justify-center">
<div class="flex">
    <div class="flex px-8 m-8 w-full max-w-screen-lg bg-white p-4 rounded-md shadow-md">
        <table class="w-full border-collapse">
           
            <tr class="border-b-2 border-gray-300">
                <th class="text-center font-semibold text-gray-700 p-2"><?php echo formateDatumNl($datum); ?></th>
                <th class="text-center font-semibold text-gray-700 border-l-2 border-r-2 border-gray-300 p-2">Baan 1</th>
                <th class="text-center font-semibold text-gray-700 border-l-2 border-r-2 border-gray-300 p-2">Baan 2</th>
                <th class="text-center font-semibold text-gray-700 border-l-2 border-r-2 border-gray-300 p-2">Baan 3</th>
                <th class="text-center font-semibold text-gray-700 border-l-2 border-r-2 border-gray-300 p-2">Baan 4</th>
                <th class="text-center font-semibold text-gray-700 border-l-2 border-r-2 border-gray-300 p-2">Baan 5</th>
                <th class="text-center font-semibold text-gray-700 border-l-2 border-r-2 border-gray-300 p-2">Baan 6</th>
                <th class="text-center font-semibold text-gray-700 border-l-2 border-r-2 border-gray-300 p-2">Baan 7</th>
                <th class="text-center font-semibold text-gray-700 border-l-2 border-gray-300 p-2">Baan 8</th>
            </tr>

            <!-- Timeslots for each day -->
            <tr class="border-b-2 border-gray-300">
                <!-- Days column -->
                <td class="border-r-2 border-gray-300 p-2">14:00 - 15:00</td>
                <?php 
                for ($i = 1; $i <= 8; $i++) {
                ?>
                <td class="border-r-2 border-gray-300 p-2">
                    
                    <a class="" href="<?php $date = formateDateTime($datum, "14:00"); $bool = laneDateCheck($i, $date); 
                    if ($bool) {
                    echo "#";
                    }else{
                        echo "toevoegen.php";
                    } 
                    ?>">
                    
                    <?php $date = formateDateTime($datum, "14:00"); $bool = laneDateCheck($i, $date); 
                    if ($bool) {
                    echo "bezet";
                    }else{
                        echo "vrij";
                    } 
                    ?>
                
                </a>
                </td>
                <?php } ?>
                
            </tr>
            <tr class="border-b-2 border-gray-300">
                <td class="border-r-2 border-gray-300 p-2">15:00 - 16:00</td>
                <?php 
                for ($i = 1; $i <= 8; $i++) {
                ?>
                <td class="border-r-2 border-gray-300 p-2">
                    
                    <a href="<?php $date = formateDateTime($datum, "15:00"); $bool = laneDateCheck($i, $date); 
                    if ($bool) {
                    echo "#";
                    }else{
                        echo "toevoegen.php";
                    } 
                    ?>">
                    
                    <?php $date = formateDateTime($datum, "15:00"); $bool = laneDateCheck($i, $date); 
                    if ($bool) {
                    echo "bezet";
                    }else{
                        echo "vrij";
                    } 
                    ?>
                
                </a>
                </td>
                <?php } ?>
            </tr>
            <tr class="border-b-2 border-gray-300">
                <td class="border-r-2 border-gray-300 p-2">16:00 - 17:00</td>
                <?php 
                for ($i = 1; $i <= 8; $i++) {
                ?>
                <td class="border-r-2 border-gray-300 p-2">
                    
                    <a href="<?php $date = formateDateTime($datum, "16:00"); $bool = laneDateCheck($i, $date); 
                    if ($bool) {
                    echo "#";
                    }else{
                        echo "toevoegen.php";
                    } 
                    ?>">
                    
                    <?php $date = formateDateTime($datum, "16:00"); $bool = laneDateCheck($i, $date); 
                    if ($bool) {
                    echo "bezet";
                    }else{
                        echo "vrij";
                    } 
                    ?>
                
                </a>
                </td>
                <?php } ?>
            </tr>
            <tr class="border-b-2 border-gray-300">    
                <td class="border-r-2 border-gray-300 p-2">17:00 - 18:00</td>
                <?php 
                for ($i = 1; $i <= 8; $i++) {
                ?>
                <td class="border-r-2 border-gray-300 p-2">
                    
                    <a href="<?php $date = formateDateTime($datum, "17:00"); $bool = laneDateCheck($i, $date); 
                    if ($bool) {
                    echo "#";
                    }else{
                        echo "toevoegen.php";
                    } 
                    ?>">
                    
                    <?php $date = formateDateTime($date, "17:00"); $bool = laneDateCheck($i, $date); 
                    if ($bool) {
                    echo "bezet";
                    }else{
                        echo "vrij";
                    } 
                    ?>
                
                </a>
                </td>
                <?php } ?>
            </tr>
            <tr class="border-b-2 border-gray-300">    
                <td class="border-r-2 border-gray-300 p-2">18:00 - 19:00</td>
                <?php 
                for ($i = 1; $i <= 8; $i++) {
                ?>
                <td class="border-r-2 border-gray-300 p-2">
                    
                    <a href="<?php $date = formateDateTime($datum, "18:00"); $bool = laneDateCheck($i, $date); 
                    if ($bool) {
                    echo "#";
                    }else{
                        echo "toevoegen.php";
                    } 
                    ?>">
                    
                    <?php $date = formateDateTime($date, "18:00"); $bool = laneDateCheck($i, $date); 
                    if ($bool) {
                    echo "bezet";
                    }else{
                        echo "vrij";
                    } 
                    ?>
                
                </a>
                </td>
                <?php } ?>
            </tr>
            <tr class="border-b-2 border-gray-300">    
                <td class="border-r-2 border-gray-300 p-2">19:00 - 20:00</td>
                <?php 
                for ($i = 1; $i <= 8; $i++) {
                ?>
                <td class="border-r-2 border-gray-300 p-2">
                    
                    <a href="<?php $date = formateDateTime($datum, "19:00"); $bool = laneDateCheck($i, $date); 
                    if ($bool) {
                    echo "#";
                    }else{
                        echo "toevoegen.php";
                    } 
                    ?>">
                    
                    <?php $date = formateDateTime($date, "19:00"); $bool = laneDateCheck($i, $date); 
                    if ($bool) {
                    echo "bezet";
                    }else{
                        echo "vrij";
                    } 
                    ?>
                
                </a>
                </td>
                <?php } ?>
            </tr>
            <tr class="border-b-2 border-gray-300">    
                <td class="border-r-2 border-gray-300 p-2">20:00 - 21:00</td>
                <?php 
                for ($i = 1; $i <= 8; $i++) {
                ?>
                <td class="border-r-2 border-gray-300 p-2">
                    
                    <a href="<?php $date = formateDateTime($datum, "20:00"); $bool = laneDateCheck($i, $date); 
                    if ($bool) {
                    echo "#";
                    }else{
                        echo "toevoegen.php";
                    } 
                    ?>">
                    
                    <?php $date = formateDateTime($date, "20:00"); $bool = laneDateCheck($i, $date); 
                    if ($bool) {
                    echo "bezet";
                    }else{
                        echo "vrij";
                    } 
                    ?>
                
                </a>
                </td>
                <?php } ?>
            </tr>
            <tr class="border-b-2 border-gray-300">    
                <td class="border-r-2 border-gray-300 p-2">21:00 - 22:00</td>
                <?php 
                for ($i = 1; $i <= 8; $i++) {
                ?>
                <td class="border-r-2 border-gray-300 p-2">
                    
                    <a href="<?php $date = formateDateTime($datum, "21:00"); $bool = laneDateCheck($i, $date); 
                    if ($bool) {
                    echo "#";
                    }else{
                        echo "toevoegen.php";
                    } 
                    ?>">
                    
                    <?php $date = formateDateTime($date, "21:00"); $bool = laneDateCheck($i, $date); 
                    if ($bool) {
                    echo "bezet";
                    }else{
                        echo "vrij";
                    } 
                    ?>
                
                </a>
                </td>
                <?php } ?>
            </tr>
            <?php 
            if(isweekend($datum))
            {
            ?>
            <tr class="border-b-2 border-gray-300">    
                <td class="border-r-2 border-gray-300 p-2">22:00 - 23:00</td>
                <?php 
                for ($i = 1; $i <= 8; $i++) {
                ?>
                <td class="border-r-2 border-gray-300 p-2">
                    
                    <a href="<?php $date = formateDateTime($datum, "22:00"); $bool = laneDateCheck($i, $date); 
                    if ($bool) {
                    echo "#";
                    }else{
                        echo "toevoegen.php";
                    } 
                    ?>">
                    
                    <?php $date = formateDateTime($date, "22:00"); $bool = laneDateCheck($i, $date); 
                    if ($bool) {
                    echo "bezet";
                    }else{
                        echo "vrij";
                    } 
                    ?>
                
                </a>
                </td>
                <?php } ?>
            </tr>
            <tr class="border-b-2 border-gray-300">    
                <td class="border-r-2 border-gray-300 p-2">23:00 - 00:00</td>
                <?php 
                for ($i = 1; $i <= 8; $i++) {
                ?>
                <td class="border-r-2 border-gray-300 p-2">
                    
                    <a href="<?php $date = formateDateTime($datum, "23:00"); $bool = laneDateCheck($i, $date); 
                    if ($bool) {
                    echo "#";
                    }else{
                        echo "toevoegen.php";
                    } 
                    ?>">
                    
                    <?php $date = formateDateTime($date, "23:00"); $bool = laneDateCheck($i, $date); 
                    if ($bool) {
                    echo "bezet";
                    }else{
                        echo "vrij";
                    } 
                    ?>
                
                </a>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
                <!-- Repeat for each day -->
                <!-- You can customize the content and add more days as needed -->
            
        </table>
        
    </div>
        <div class="m-8 bg-white p-4 rounded-md shadow-md inline-block align-baseline">
            <h2>Dag</h2>
            <form method="POST" action="">
                <div class="w-full my-4">
                    <input type="date" name="dateCheck" />
                </div>
                <input name="datum" type="submit" value="ga naar datum" class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur hover:text-whiteKleur hover:border-redKleur" />
                        <div class="flex flex-wrap pt-6">
                         <!-- terug knop -->
                        <input class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" type="button" value="Terug"  onclick="window.location.href='admin.php';"/> 
                        </div>
            </form>
        </div>
        </div>
</body>
</html>

<?php
    
}else{
    header('location: ../public/index.php');
}
}
include '../public/footer.php';
ob_end_flush(); // Flush the output buffer
?>
