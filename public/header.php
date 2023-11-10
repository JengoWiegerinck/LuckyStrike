<?php 
    require_once __DIR__ . '\layouts\default.php';
    require_once "../source/db_user.php";
    require_once "../source/useful_functions.php";
    $pageTitle = 'Lucky Strike';
?>

<body class="bg-whiteKleur">

<div class="h-1/5 w-full relative">
    <img class="w-full h-full object-cover" src="../assets/img/bowling+alleys+in+okc.jpg" alt="">
    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-blackKleur"></div>
</div>
<div class="bg-blackKleur h-14 w-full flex">
<div class="container flex justify-center max-w-screen-xl w-1/2">
        
        <!-- Left Section with Home and Contact -->
        <div class="flex items-center space-x-8">
            <a href="#" class="text-whiteKleur">Home</a>
            <a href="#" class="text-whiteKleur">Contact</a>
        </div>

    </div>


         <!-- Center Section with Logo -->
         <div class="flex items-center">
         <img src="../assets/img/luckystrike.png" alt="Logo" class="w-14 h-14 z-[2] relative top-[-40px]"
         style="scale: 4.5; 
         filter: 
         drop-shadow(1px 0 0 rgba(27, 27, 25, 1)) 
         drop-shadow(0 1px 0 rgba(27, 27, 25, 1))
         drop-shadow(-1px 0 0 rgba(27, 27, 25, 1)) 
         drop-shadow(0 -1px 0 rgba(27, 27, 25, 1));">
        </div>
        
    
    <div class="container justify-center  flex max-w-screen-xl w-1/2">

        <!-- Right Section with Over Ons and Inloggen -->
        <div class="flex items-center space-x-8">
            <a href="#" class="text-whiteKleur">Over ons</a>
            <?php
                if (isset($_COOKIE['CurrUser'])) {
                    echo '<a class="text-whiteKleur" href="#">';
                    $user = new user(getUserById($_COOKIE['CurrUser']));
                    echo $user->getUsername();
                    echo '</a>';

                    if (!checkCustomer($user->getKlasse())) {
                        echo '<a class="text-whiteKleur" href="../config/admin.php">Beheer</a>';
                    }
                } else {
                    echo '<a href="login.php" class="text-whiteKleur">Inloggen</a>';
                }

                if (isset($_COOKIE['CurrUser'])) {
                    echo '<a href="logout.php" class="text-whiteKleur">uitloggen</a>';
                }
            ?>
        </div>
    </div>
</div>

<div class="h-screen absolute top-0 z-[-1]">
        <img src="../assets/img/bodyBackground.jpg" alt="Gradient Image" class="w-full h-full object-cover object-center opacity-20">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-whiteKleur opacity-100"></div>
    </div>
