<?php
ob_start(); // Start output buffering
include '../public/header.php';
require_once("../source/useful_functions.php");
require_once("../source/reservationsClass.php");
require_once("../source/db_user.php");
require_once("../source/db_lane.php");
require_once("../source/db_reservation.php");

if (isset($_COOKIE['CurrUser'])) {
    $user = new user(getUserById($_COOKIE['CurrUser']));
    if (checkAdmin($user->getKlasse()) || checkEmployee($user->getKlasse())) {
        $lane;

        if (isset($_GET['variabele'])) {
            $tijd = $_GET['variabele'];
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $lane = new laneClass(getLaneById($id));
            }
            if (!timeDay($lane->getId(), formateDatum($tijd), formateTime($tijd))) {
            }

        $reservationCheck = new reservationsClass(timeDay($lane->getId(), formateDatum($tijd), formateTime($tijd)));
        $prijsTotaal;
        $customerEmail = array();
        $customers = getAllCustomer();
            while ($customer = $customers->fetch_assoc()) 
            {
                $customerEmail[] = $customer['email'];
            }

            // $customers->close(); // Close the result set
        if(isset($_POST['prijs']))
        {
            $selectedValue = $_POST['endTime'];
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $volwassen = $_POST['volwassen'];
            $kinderen = $_POST['kinderen'];

            $prijsTotaal = kosten($tijd, $selectedValue);     
        }
        if(isset($_POST['reserveren']))
        {
            $dateEnd = formateDatum($tijd);
            $endTime = $_POST['endTime'];
            $newEndTime = formateDateTime($dateEnd, $endTime);
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $volwassen = $_POST['volwassen'];
            $kinderen = $_POST['kinderen'];
            $prijsTotaal = kosten($tijd, $endTime);
            $baan = $_POST['laneName'];
            $user = new user(checkEmail($email));
            $lane = new laneClass(getLaneByName($baan));

            $result = insertReservation($user->getId(), $lane->getId(), $prijsTotaal, 0, $kinderen, $volwassen, $tijd, $newEndTime);

            if ($result > 0) {
                echo '<div class="flex items-center justify-center h-screen">';
                echo '<p class="text-green-500 text-4xl font-bold">Reserveren succesvol toegevoegt!</p>';
                echo '</div>';

                // add script to redirect to homepage after 3 seconds
                echo "<script>setTimeout(function(){ window.location.href = 'laneReservation.php'; }, 3000);</script>";
                exit();
            }
            if (isset($_POST['reserveren'])) {
                $dateEnd = formateDatum($tijd);
                $endTime = $_POST['endTime'];
                $newEndTime = formateDateTime($dateEnd, $endTime);
                $email = $_POST['username'];
                $volwassen = $_POST['volwassen'];
                $kinderen = $_POST['kinderen'];
                $prijsTotaal = kosten($tijd, $endTime);
                $baan = $_POST['laneName'];
                $user = new user(checkEmail($email));
                $lane = new laneClass(getLaneByName($baan));

                $result = insertReservation($user->getId(), $lane->getId(), $prijsTotaal, 0, $kinderen, $volwassen, $tijd, $newEndTime);

                if ($result > 0) {
                    header('location: laneReservation.php');
                    exit();
                }
            }
?>


<head>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
</head>
        <body>
            <div class="flex justify-center w-[100vw] items-center">
                <div class="bg-slate-50 m-24 w-fit px-20 border-solid border-2 border-blackKleur rounded-lg">
                <h1 class="text-[40px] font-bold text-center pt-6">Toevoegen</h1>
    
                <div class="grid justify-items-center">
                    <form method="POST" action="">
                        <div class="w-full my-4">
                            <p class="font-bold">Klant email:</p>
                            <select class="js-example-basic-single w-full py-2 px-4 rounded-sm border bg-white focus:outline-none focus:border-gray-500" name="email">
                                <?php foreach($customerEmail as $email2) {
                                    if($email == $email2)
                                    {
                                        echo '<option selected="selected">'.$email2.'</option>'; 
                                    }else{
                                        echo '<option>'.$email2.'</option>'; 
                                    }
                                } ?>
                            </select>
                        </div>
                       
                        <div class="w-full my-4">
                            <p class="font-bold">Baan:</p>
                            <input type="text" name="laneName" class="py-2 px-4 rounded-sm border" value="<?php echo $lane->getUsername(); ?>" readonly />
                        </div>
                        <div class="w-full my-4">
                            <p class="font-bold">Starttijd:</p>
                            <input type="datetime-local" name="startTime" class="py-2 px-4 rounded-sm border" value="<?php echo $tijd;?>" readonly />
                        </div>

            <body>
                <div class="flex justify-center w-[100vw] items-center">
                    <div class="bg-slate-50 m-24 w-fit px-20 border-solid border-2 border-blackKleur rounded-lg">
                        <h1 class="text-[40px] font-bold text-center pt-6">Toevoegen</h1>

                        <div class="grid justify-items-center">
                            <form method="POST" action="">
                                <div class="w-full my-4">
                                    <p class="font-bold">Klant email:</p>
                                    <input type="text" name="username" <?php if (isset($_POST['prijs'])) {
                                                                            $username = $_POST['username'];
                                                                            echo 'value="' . $username . '"';
                                                                        } ?> class="py-2 px-4 rounded-sm border" placeholder="klant@email.com" require />
                                </div>

                                <div class="w-full my-4">
                                    <p class="font-bold">Baan:</p>
                                    <input type="text" name="laneName" class="py-2 px-4 rounded-sm border" value="<?php echo $lane->getUsername(); ?>" readonly />
                                </div>
                                <div class="w-full my-4">
                                    <p class="font-bold">Starttijd:</p>
                                    <input type="datetime-local" name="startTime" class="py-2 px-4 rounded-sm border" value="<?php echo $tijd; ?>" readonly />
                                </div>

                                <div class="w-full my-4">
                                    <p class="font-bold">Eindtijd:</p>
                                    <select id="appt-time" name="endTime" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                                        <?php
                                        $time = '22';
                                        $hour = '0';
                                        if (isWeekend($tijd)) {
                                            $time = '24';
                                        }

                                        for ($i = formateOnlyHours($tijd) + 1; $i <= $time; $i++) {
                                            $hour = $i;
                                            if ($hour == 24) {
                                                $hour = '00';
                                            }
                                            if (isset($_POST['prijs'])) {
                                                $selectedValue = $_POST['endTime'];
                                                $selected = $hour . ":00";
                                                if ($selected == $selectedValue) {
                                                    echo '<option selected="selected">' . $hour . ':00</option>';
                                                } else {
                                                    echo '<option>' . $hour . ':00</option>';
                                                }
                                                if (formateDateOutDatabase($reservationCheck->getStartTime()) == formateDateTime(formateDatum($tijd), formateBackToHoureMinute($i))) {
                                                    break;
                                                }
                                            } else {
                                                echo '<option>' . $hour . ':00</option>';
                                                if (formateDateOutDatabase($reservationCheck->getStartTime()) == formateDateTime(formateDatum($tijd), formateBackToHoureMinute($i))) {
                                                    break;
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>


                                <div class="w-full my-4">
                                    <p class="font-bold">Volwassene:</p>
                                    <input type="number" name="volwassen" id="volwassen" <?php if (isset($_POST['prijs'])) {
                                                                                                $volwassen = $_POST['volwassen'];
                                                                                                echo 'value="' . $volwassen . '"';
                                                                                            } ?> placeholder="0" class="py-2 px-4 rounded-sm border" required />
                                </div>
                                <div class="w-full my-4">
                                    <p class="font-bold">Kinderen:</p>
                                    <input type="number" name="kinderen" <?php if (isset($_POST['prijs'])) {
                                                                                $kinderen = $_POST['kinderen'];
                                                                                echo 'value="' . $kinderen . '"';
                                                                            } ?> id="kinderen" placeholder="0" class="py-2 px-4 rounded-sm border" />
                                </div>
                                <div class="w-full my-4">
                                    <?php if (!empty($prijsTotaal)) : ?>
                                        <p class="font-bold">prijs:</p>
                                        <input type="text" name="prijs" value="&euro; <?php echo $prijsTotaal; ?>" class="py-2 px-4 rounded-sm border" readonly />
                                    <?php endif; ?>
                                </div>
                                <input name="prijs" type="submit" value="Prijs berekenen" class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur hover:text-whiteKleur hover:border-redKleur" />
                                <input name="reserveren" type="submit" value="Reserveren" class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur hover:text-whiteKleur hover:border-redKleur" />
                                <div class="flex flex-wrap pt-6">
                                    <!-- terug knop -->
                                    <input class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" type="button" value="Terug" onclick="window.location.href='laneReservation.php';" />
                                </div>
                            </form>

                        </div>
                    </div>

                </div>

            </body>
<?php
        }
    } else {
        header('location: ../public/index.php');
    }
}
include '../public/footer.php';
ob_end_flush(); // Flush the output buffer
?>