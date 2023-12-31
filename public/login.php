<?php
ob_start(); // Start output buffering

require_once "header.php";
require_once "../source/db_user.php";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = getUser($email, $password);
    if ($user !== "No user found!") $fetchUser = new user($user);
    
    if ($user == "No user found!") {
        echo '<script>alert("Dit is niet de goede combinatie")</script>';
    } else if($fetchUser->getVerified() < 1) {
        echo '<script>alert("Verifieer eerst je email!")</script>';
    }else {
        setcookie("CurrUser", $fetchUser->getId(), time() + (3600 * 8), "/", "");
        header('location: index.php');
        exit(); // Make sure to exit after calling header
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@600;700&family=Open+Sans:wght@500;600;800&family=Rubik:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <div class="flex flex-col md:flex-row items-center justify-between px-[10%] py-20">
        <div class="w-full md:w-1/2">
            <h1 class="text-2xl md:text-4xl font-bold text-blackKleur">Welkom bij Lucky Strike, <br>log in met je gegevens.</h1>
            <p class="text-md md:text-lg font-medium text-blackKleur mt-4">Nog geen account? <a href="signUp.php" class="text-yellowKleur">Registreer hier</a>.</p>

            <form class="mt-8" method="post">
                <div class="relative z-0 w-full mb-6 group my-4">
                    <input type="email" name="email" class="block py-2.5 px-0 w-full text-md text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-yellowKleur focus:outline-none focus:ring-0 focus:border-yellowKleur peer" placeholder=" " required />
                    <label class="peer-focus:font-medium absolute text-md text-black dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-yellowKleur peer-focus:dark:text-yellowKleur peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                </div>
                <div class="relative z-0 w-full mb-6 group my-4">
                    <input type="password" name="password" class="block py-2.5 px-0 w-full text-md text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-yellowKleur focus:outline-none focus:ring-0 focus:border-yellowKleur peer" placeholder=" " required />
                    <label class="peer-focus:font-medium absolute text-md text-black dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-yellowKleur peer-focus:dark:text-yellowKleur peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Wachtwoord</label>
                </div>
                <input type="submit" value="Login" name="submit" class="px-6 py-4 bg-redKleur text-whiteKleur font-semibold hover:cursor-pointer" />
            </form>
        </div>

        <img src="../assets/img/luckystrike.png" alt="image" class="rounded-md w-0 md:w-[40%] mt-8 md:mt-0 md:ml-8">
    </div>
</body>

</html>

<script>
    function alert() {
        <?php
        if (!empty($login_err)) {
        ?>
            alert($login_err);
        <?php
        }
        ?>
    }
</script>

<?php
ob_end_flush(); // Flush the output buffer
require_once "footer.php";
?>