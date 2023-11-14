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
<div class="flex items-center md:space-x-8 ml-0">
    <a href="../public/index.php" class="text-whiteKleur hidden md:inline">Home</a>
    <a href="#" class="text-whiteKleur hidden md:inline" onclick="scrollToFooter()">Contact</a>
    
        <a class="text-whiteKleur inline" href="
        <?php
        if (isset($_COOKIE['CurrUser'])) {
             echo '../public/reservation.php';
            
        } else {
        echo '../public/login.php';
            
            
            } ?>
         ">Reservering</a>
</div>

    </div>


         <!-- Center Section with Logo -->
         <div class="flex items-center"><a href="../public/index.php">
         <img src="../assets/img/luckystrike.png" alt="Logo" class="w-8 h-8 md:w-12 md:h-12 z-[2] relative top-[-40px]"
         style="scale: 4.5; 
         filter: 
         drop-shadow(1px 0 0 rgba(27, 27, 25, 1)) 
         drop-shadow(0 1px 0 rgba(27, 27, 25, 1))
         drop-shadow(-1px 0 0 rgba(27, 27, 25, 1)) 
         drop-shadow(0 -1px 0 rgba(27, 27, 25, 1));">
        </a></div>
        
    
    <div class="container justify-center  flex max-w-screen-xl w-1/2">

        <!-- Right Section with Over Ons and Inloggen -->
        
        <button id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation" class="text-whiteKleur bg-blackKleur focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center" type="button">
    Account
    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
    </svg>
</button>

<!-- Dropdown menu -->
<div id="dropdownInformation" class="z-10 hidden absolute top-44 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600 mt-2">
<?php
if (isset($_COOKIE['CurrUser'])) {

    echo '    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                <div>';
                $user = new user(getUserById($_COOKIE['CurrUser']));
                echo $user->getUsername();
                echo '</div>';
                echo '<div class="font-medium truncate">';
                echo $user->getEmail();
                echo '</div></div>';
} else {
    echo '<div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                <div>Welkom</div>
                <div class="font-medium truncate">Log hieronder in</div>
            </div>';
}
            

?>
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownInformationButton">
        
    <?php
    if (isset($_COOKIE['CurrUser'])) {
        $user = new user(getUserById($_COOKIE['CurrUser']));

                if (!checkCustomer($user->getKlasse())) {
                    echo '<li>
                            <a href="../config/admin.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Beheer</a>
                        </li>';
                }
    }
    ?>
    <?php
if (isset($_COOKIE['CurrUser'])) {
                    echo '<a href="detail.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profiel</a>';
                }
    ?>
    
    
        <!-- <li>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
        </li>
        <li>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
        </li> -->
    </ul>

<?php
if (isset($_COOKIE['CurrUser'])) {
    echo '<div class="py-2">
        <a href="../public/logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Uitloggen</a>
    </div>';
 } else {
    echo '<div class="py-2">
        <a href="login.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Inloggen</a>
    </div>';
    //reserveren
    echo '<div class="py-2">
        <a href="signUp.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Registreren</a>
    </div>';
}
?>

    
</div>
    </div>
</div>

<div class="h-screen absolute top-0 z-[-1]">
        <img src="../assets/img/bodyBackground.jpg" alt="Gradient Image" class="w-full h-full object-cover object-center opacity-20">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-whiteKleur opacity-100"></div>
    </div>

    <!-- JavaScript to handle scrolling -->
<script>
    function scrollToFooter() {
        // Scroll to the footer
        document.getElementById('website-footer').scrollIntoView({
            behavior: 'smooth'
        });
    }

    // JavaScript to handle dropdown toggle
    document.getElementById('dropdownInformationButton').addEventListener('click', function () {
        var dropdown = document.getElementById('dropdownInformation');
        dropdown.classList.toggle('hidden');
    });
</script>



