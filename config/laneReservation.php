<?php
ob_start(); // Start output buffering
include '../public/header.php';
require_once("../source/useful_functions.php");
require_once("../source/db_user.php");
require_once("../source/db_lane.php");
require_once("../source/db_reservation.php");


if (isset($_COOKIE['CurrUser'])) {
    $user = new user(getUserById($_COOKIE['CurrUser']));
    if (checkAdmin($user->getKlasse()) || checkEmployee($user->getKlasse())) {
        $timestamp = time();
        $datum = gmdate('Y-m-d', $timestamp);

        if (isset($_POST['datum'])) {
            $datum = $_POST['dateCheck'];
        }


?>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
            <title>Baan Agenda</title>
        </head>

        <body class="px-8 bg-gray-100 h-screen flex items-center justify-center">
            <div class="flex">
                <div class="flex px-8 m-8 w-full max-w-screen-lg bg-white p-4 rounded-md shadow-md">
                    <table class="w-full border-collapse">

                        <tr class="border-b-2 border-gray-300">
                            <th class="text-center font-semibold text-gray-700 p-2"><?php echo formateDatumNl($datum); ?></th>

                            <?php $lanes = getAllLane();
                            while ($lane = $lanes->fetch_assoc()) {
                            ?>
                                <th class="text-center font-semibold text-gray-700 border-l-2 border-r-2 border-gray-300 p-2"><?php echo $lane['username'] ?> <?php if (gates($lane['gates'])) {
                                                                                                                                                                    echo "*";
                                                                                                                                                                } ?></th>
                            <?php } ?>
                        </tr>

                        <!-- Timeslots for each day -->
                        <tr class="border-b-2 border-gray-300">
                            <!-- Days column -->
                            <td class="border-r-2 border-gray-300 p-2">14:00 - 15:00</td>
                            <?php
                            for ($i = 1; $i <= 8; $i++) {
                                $tijd = "14:00";
                            ?>
                                <td class="border-r-2 border-gray-300 p-2">

                                    <a class="" href="<?php $date = formateDateTime($datum, $tijd);
                                                        $bool = laneDateCheck($i, $date);
                                                        if ($bool) {
                                                            echo "#";
                                                        } else {
                                                            echo "toevoegen.php?variabele=" . $date . "&id=" . $i;
                                                        }
                                                        ?>">

                                        <?php $date = formateDateTime($datum, $tijd);
                                        $bool = laneDateCheck($i, $date);
                                        if ($bool) {
                                            echo "bezet";
                                        } else {
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
                                $tijd = "15:00";
                            ?>
                                <td class="border-r-2 border-gray-300 p-2">

                                    <a href="<?php $date = formateDateTime($datum, $tijd);
                                                $bool = laneDateCheck($i, $date);
                                                if ($bool) {
                                                    echo "#";
                                                } else {
                                                    echo "toevoegen.php?variabele=" . $date . "&id=" . $i;
                                                }
                                                ?>">

                                        <?php $date = formateDateTime($datum, $tijd);
                                        $bool = laneDateCheck($i, $date);
                                        if ($bool) {
                                            echo "bezet";
                                        } else {
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
                                $tijd = "16:00";
                            ?>
                                <td class="border-r-2 border-gray-300 p-2">

                                    <a href="<?php $date = formateDateTime($datum, $tijd);
                                                $bool = laneDateCheck($i, $date);
                                                if ($bool) {
                                                    echo "#";
                                                } else {
                                                    echo "toevoegen.php?variabele=" . $date . "&id=" . $i;
                                                }
                                                ?>">

                                        <?php $date = formateDateTime($datum, $tijd);
                                        $bool = laneDateCheck($i, $date);
                                        if ($bool) {
                                            echo "bezet";
                                        } else {
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
                                $tijd = "17:00";
                            ?>
                                <td class="border-r-2 border-gray-300 p-2">

                                    <a href="<?php $date = formateDateTime($datum, $tijd);
                                                $bool = laneDateCheck($i, $date);
                                                if ($bool) {
                                                    echo "#";
                                                } else {
                                                    echo "toevoegen.php?variabele=" . $date . "&id=" . $i;
                                                }
                                                ?>">

                                        <?php $date = formateDateTime($date, $tijd);
                                        $bool = laneDateCheck($i, $date);
                                        if ($bool) {
                                            echo "bezet";
                                        } else {
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
                                $tijd = "18:00";
                            ?>
                                <td class="border-r-2 border-gray-300 p-2">

                                    <a href="<?php $date = formateDateTime($datum, $tijd);
                                                $bool = laneDateCheck($i, $date);
                                                if ($bool) {
                                                    echo "#";
                                                } else {
                                                    echo "toevoegen.php?variabele=" . $date . "&id=" . $i;
                                                }
                                                ?>">

                                        <?php $date = formateDateTime($date, $tijd);
                                        $bool = laneDateCheck($i, $date);
                                        if ($bool) {
                                            echo "bezet";
                                        } else {
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
                                $tijd = "19:00";
                            ?>
                                <td class="border-r-2 border-gray-300 p-2">

                                    <a href="<?php $date = formateDateTime($datum, $tijd);
                                                $bool = laneDateCheck($i, $date);
                                                if ($bool) {
                                                    echo "#";
                                                } else {
                                                    echo "toevoegen.php?variabele=" . $date . "&id=" . $i;
                                                }
                                                ?>">

                                        <?php $date = formateDateTime($date, $tijd);
                                        $bool = laneDateCheck($i, $date);
                                        if ($bool) {
                                            echo "bezet";
                                        } else {
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
                                $tijd = "20:00";
                            ?>
                                <td class="border-r-2 border-gray-300 p-2">

                                    <a href="<?php $date = formateDateTime($datum, $tijd);
                                                $bool = laneDateCheck($i, $date);
                                                if ($bool) {
                                                    echo "#";
                                                } else {
                                                    echo "toevoegen.php?variabele=" . $date . "&id=" . $i;
                                                }
                                                ?>">

                                        <?php $date = formateDateTime($date, $tijd);
                                        $bool = laneDateCheck($i, $date);
                                        if ($bool) {
                                            echo "bezet";
                                        } else {
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
                                $tijd = "21:00";
                            ?>
                                <td class="border-r-2 border-gray-300 p-2">

                                    <a href="<?php $date = formateDateTime($datum, $tijd);
                                                $bool = laneDateCheck($i, $date);
                                                if ($bool) {
                                                    echo "#";
                                                } else {
                                                    echo "toevoegen.php?variabele=" . $date . "&id=" . $i;
                                                }
                                                ?>">

                                        <?php $date = formateDateTime($date, $tijd);
                                        $bool = laneDateCheck($i, $date);
                                        if ($bool) {
                                            echo "bezet";
                                        } else {
                                            echo "vrij";
                                        }
                                        ?>

                                    </a>
                                </td>
                            <?php } ?>
                        </tr>
                        <?php
                        if (isweekend($datum)) {
                        ?>
                            <tr class="border-b-2 border-gray-300">
                                <td class="border-r-2 border-gray-300 p-2">22:00 - 23:00</td>
                                <?php
                                for ($i = 1; $i <= 8; $i++) {
                                    $tijd = "22:00";
                                ?>
                                    <td class="border-r-2 border-gray-300 p-2">

                                        <a href="<?php $date = formateDateTime($datum, $tijd);
                                                    $bool = laneDateCheck($i, $date);
                                                    if ($bool) {
                                                        echo "#";
                                                    } else {
                                                        echo "toevoegen.php?variabele=" . $date . "&id=" . $i;
                                                    }
                                                    ?>">

                                            <?php $date = formateDateTime($date, $tijd);
                                            $bool = laneDateCheck($i, $date);
                                            if ($bool) {
                                                echo "bezet";
                                            } else {
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
                                    $tijd = "23:00";
                                ?>
                                    <td class="border-r-2 border-gray-300 p-2">

                                        <a href="<?php $date = formateDateTime($datum, $tijd);
                                                    $bool = laneDateCheck($i, $date);
                                                    if ($bool) {
                                                        echo "#";
                                                    } else {
                                                        echo "toevoegen.php?variabele=" . $date . "&id=" . $i;
                                                    }
                                                    ?>">

                                            <?php $date = formateDateTime($date, $tijd);
                                            $bool = laneDateCheck($i, $date);
                                            if ($bool) {
                                                echo "bezet";
                                            } else {
                                                echo "vrij";
                                            }
                                            ?>

                                        </a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>

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
                            <input class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" type="button" value="Terug" onclick="window.location.href='admin.php';" />
                        </div>
                    </form>
                </div>
            </div>
        </body>

        </html>

<?php

    } else {
        header('location: ../public/index.php');
    }
}
include '../public/footer.php';
ob_end_flush(); // Flush the output buffer
?>