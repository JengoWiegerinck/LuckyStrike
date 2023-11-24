<?php
ob_start(); // Start output buffering
include '../public/header.php';
require_once '../source/db_horeca.php';

if (isset($_COOKIE['CurrUser'])) {
    $user = new user(getUserById($_COOKIE['CurrUser']));
    if (checkAdmin($user->getKlasse())) {
        if (isset($_POST['toevoegen'])) {
            $email = $_POST['email'];
            $name = $_POST['username'];
            $password = $_POST['password'];

            $insertId = insertEmployee($email, $name, $password);

            if ($insertId > 0) {
                header('location: employee.php');
                exit();
            }
        }
?>

        <head>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        </head>

        <body>
            <div class="flex justify-center w-[100vw] items-center">
                <div class="bg-slate-50 m-24 w-fit px-20 border-solid border-2 border-blackKleur rounded-lg">
                    <h1 class="text-[40px] font-bold text-center">Toevoegen</h1>

                    <div class="grid justify-items-center">
                        <form method="POST" action="">
                            <div class="w-full my-4">
                                <p class="font-bold">Email</p>
                                <input type="email" name="email" class="py-2 px-4 rounded-sm border" placeholder="Email" required />
                            </div>
                            <div class="w-full my-4">
                                <p class="font-bold">Naam</p>
                                <input type="text" name="username" class="py-2 px-4 rounded-sm border" placeholder="Naam" required />
                            </div>
                            <div class="w-full my-4">
                                <p class="font-bold">Wachtwoord</p>
                                <input type="password" name="password" class="py-2 px-4 rounded-sm border" placeholder="Wachtwoord" required />
                            </div>

                            <input name="toevoegen" type="submit" value="Toevoegen" class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur hover:text-whiteKleur hover:border-redKleur" />
                            <div class="flex flex-wrap pt-6">
                                <!-- terug knop -->
                                <input class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" type="button" value="Terug" onclick="window.location.href='employee.php';" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </body>
<?php
    } else {
        header('location: ../public/index.php');
    }
    include '../public/footer.php';
}
ob_end_flush(); // Flush the output buffer
?>