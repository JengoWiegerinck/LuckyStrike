<?php
ob_start(); // Start output buffering
include '../public/header.php';
require_once '../source/db_lane.php';
require_once '../source/useful_functions.php';
require_once '../source/laneClass.php';

if (isset($_COOKIE['CurrUser'])) {
    $user = new user(getUserById($_COOKIE['CurrUser']));
    if (checkAdmin($user->getKlasse())) {
        if (isset($_GET['id'])) {
            $lane = new laneClass(getLaneById($_GET['id']));
        }
        if (isset($_POST['updaten'])) {
            $id = $lane->getId();
            $username = $_POST['username'];
            $gates = (isset($_POST['gates'])) ? true : false;

            $updated = updateLane($username, $lane->fromBoolToInt($gates), $id);

            header('Location: lane.php');
        }

?>

        <head>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        </head>

        <body>
            <div class="flex justify-center w-[100vw] items-center">
                <div class="bg-slate-50 m-24 w-fit px-20 border-solid border-2 border-blackKleur rounded-lg">
                    <h1 class="text-[40px] font-bold text-center pt-6">Updaten</h1>

                    <div class="grid justify-items-center">
                        <form method="POST" action="">
                            <div class="w-full my-4">
                                <p class="font-bold">Naam</p>
                                <input type="text" name="username" class="py-2 px-4 rounded-sm border" value="<?php echo $lane->getUsername() ?>" required />
                            </div>
                            <div class="w-full my-4">
                                <p class="font-bold">hulpmiddel</p>
                                <input type="checkbox" name="gates" class="py-2 px-4 rounded-sm border" <?php
                                                                                                        if (gates($lane->getGates())) {
                                                                                                        ?> checked <?php
                                                                                                                }
                                                                                                                    ?> />
                            </div>
                            <input name="updaten" type="submit" value="updaten" class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur hover:text-whiteKleur hover:border-redKleur" />
                            <div class="flex flex-wrap pt-6">
                                <!-- terug knop -->
                                <input class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" type="button" value="Terug" onclick="window.location.href='lane.php';" />
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