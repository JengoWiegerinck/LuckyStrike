<?php 
    require_once __DIR__ . '\layouts\default.php';
    require_once "../source/db_user.php";
    require_once "../source/useful_functions.php";
    $pageTitle = 'Lucky Strike';
?>

<body class="bg-whiteKleur">

<div class="bg-blackKleur drop-shadow-[0_5px_3px_rgb(0,0,0)] h-14 sticky top-0">
  <div class="container mx-auto flex justify-between items-center max-w-screen-xl">
    <div class="flex items-center space-x-4">
      <img src="../assets/img/Lucky_Strike_logo.svg.png" alt="Logo" class="w-14 h-14">
      
    </div>
    <div>
        <nav class="space-x-8">
        <a href="#" class="text-whiteKleur">Contact</a>
        <a href="#" class="text-whiteKleur">Over ons</a>
                        <?php
                        if (isset($_COOKIE['CurrUser'])) {
                        ?> 
                            <a class="text-whiteKleur" href="#"><?php 
                            $user = new user(getUserById($_COOKIE['CurrUser']));
                            echo $user->getUsername();
                        ?></a>
                        <?php
                          if(!checkCustomer($user->getKlasse())) {
                            ?>
                            <a class="text-whiteKleur" href="../config/admin.php">Beheer</a>
                            <?php
                          }
                        } else { ?>
                            <a href="login.php" class="text-whiteKleur">Inloggen</a>
                        <?php } 
                            if (isset($_COOKIE['CurrUser'])) {
                            ?> 
                                <a href="logout.php" class="text-whiteKleur">uitloggen</a>
                            <?php
                            }?>
                        
      </nav>
    </div>
  </div>
</div>

<img src="../assets/img/bodyBackground.jpg" alt="Image" class="w-full h-screen object-cover object-center absolute top-0 z-[-1] opacity-20">