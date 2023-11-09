<?php
require_once "header.php";
require_once "../source/db_user.php";

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];


        if(checkEmail($email) == "No user found!")
        {
            $insertedId = insertUser($username, $email, $password);
        }else{
            echo '<script>alert("Er is al een account voor dit email")</script>';
        }
        

    if ($insertedId > 0) {
        setcookie("CurrUser", $insertedId, time() + 3600, "/", "");
        header('location: ../public/index.php');
        exit();
    }
}

?>

<html>
<head>
</head>
<body>  
<div class="flex items-center justify-between min-w-[100vw] px-[10%] py-20">
        <div class="w-1/2">
            <h1 class="text-[40px] font-bold text-blackKleur">Welkom bij Lucky Strike, <br>maak hier een account aan.</h1>
            <p class="text-[20px] font-medium text-blackKleur mt-4">Heb je al een account? <a href="login.php" class="text-yellowKleur">Log hier in</a>.</p>
    
            <form class="mt-8" method="post">
                <div class="relative z-0 w-full mb-6 group my-4">
                    <input type="text" name="username" class="block py-2.5 px-0 w-full text-md text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-yellowKleur focus:outline-none focus:ring-0 focus:border-yellowKleur peer" placeholder=" " required />
                    <label class="peer-focus:font-medium absolute text-md text-black dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-yellowKleur peer-focus:dark:text-yellowKleur peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Gebruikersnaam</label>
                </div>
                <div class="relative z-0 w-full mb-6 group my-4">
                    <input type="email" name="email" class="block py-2.5 px-0 w-full text-md text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-yellowKleur focus:outline-none focus:ring-0 focus:border-yellowKleur peer" placeholder=" " required />
                    <label class="peer-focus:font-medium absolute text-md text-black dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-yellowKleur peer-focus:dark:text-yellowKleur peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                </div>
                <div class="relative z-0 w-full mb-6 group my-4">
                    <input type="password" name="password" class="block py-2.5 px-0 w-full text-md text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-yellowKleur focus:outline-none focus:ring-0 focus:border-yellowKleur peer" placeholder=" " required />
                    <label class="peer-focus:font-medium absolute text-md text-black dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-yellowKleur peer-focus:dark:text-yellowKleur peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Wachtwoord</label>
                </div>
    
                <input type="submit" value="Login" name="submit"  class="px-6 py-4 bg-redKleur text-whiteKleur font-semibold hover:cursor-pointer"/>
            </form>
        </div>

        <img src="../assets/img/luckystrike.png" alt="image" class="rounded-md w-[40%]" />
    </div>
</html>

<?php
require_once "footer.php";
?>