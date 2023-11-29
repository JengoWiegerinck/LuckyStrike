<?php
ob_start(); // Start output buffering
include '../public/header.php';
require_once("../source/useful_functions.php");
require_once("../source/db_user.php");
require_once("../source/db_lane.php");
require_once("../source/laneClass.php");
require_once("../source/db_reservation.php");
require_once("../source/reservationsClass.php");

if (isset($_COOKIE['CurrUser'])) {
    $user = new user(getUserById($_COOKIE['CurrUser']));
    if (checkAdmin($user->getKlasse()) || checkEmployee($user->getKlasse())) {
        if (isset($_GET['id'])) {
            $reservation = new reservationsClass(getReservationById($_GET['id']));
            $user = new user(getUserById($reservation->getUserId()));
            $laneName = new laneClass(getLaneById($reservation->getLaneName()));
            $extraLane = " ";
            $lanes = getAllLane();
            $firstLane = array();
            while ($lane = $lanes->fetch_assoc()) {
                $newLane = new laneClass(getLaneById($lane['id']));
                $firstLane[] = $newLane;
            }

            $lanesExtra = getAllLane();


            if(!empty($reservation->getExtraLane()))
            {
                $extraLane = new laneClass(getLaneById($reservation->getExtraLane()));
                $extraLane = $extraLane->getUsername();
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    unset($firstLane);

                    $geselecteerdeDatum = $_POST['date'];
                    $geselecteerdeDatum = str_replace(' ', '-', $geselecteerdeDatum);           
                    $geselecteerdeStarttijd = $_POST['selectStart'];
                    $geselecteerdeEindtijd = $_POST['selectEnd'];

                    $startTimeData = formateDateTime($geselecteerdeDatum, $geselecteerdeStarttijd);
                    $endTimeData = formateDateTime($geselecteerdeDatum, $geselecteerdeEindtijd);
                    $lanesId = getLaneIdOption($reservation->getId(), $startTimeData, $endTimeData);

                    while ($lane = $lanesId->fetch_assoc()) {
                        // Assuming 'id' is the unique identifier for a lane, modify it accordingly
                        $newLane = new laneClass($lane['id']); // Pass the lane ID to the constructor
                        $firstLane[] = $newLane;
                    }  
                
            }

            if (isset($_POST['updaten'])) {

                $id = $reservation->getId();
                $customerId = $user->getId();
                $laneName = $_POST['baan'];
                $priceBaan = $_POST['priceLane'];
                $priceFood = $_POST['priceFood'];
                $adult = $_POST['adult'];
                $child = $_POST['children'];
                $date = $_POST['date'];
                $startTime = $_POST['starttime'];
                $endTime = $_POST['endTime'];

                if (formateTime($startTime) > formateTime($endTime)) {
                    echo '<script>alert("Start tijd is na de eind tijd.")</script>';
                    header('Location: reservations.php');
                } else {



                    $laneId = new laneClass(getLaneByName($laneName));

                    $start = formateDateTime($date, $startTime);
                    $end = formateDateTime($date, $endTime);


                    $updated = updateReservation($customerId, $laneId->getId(), $priceBaan, $priceFood, $child, $adult, $start, $end, $id, null);

                    header('Location: reservations.php');
                }
            }

?>

<head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/vader/jquery-ui.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <div class="flex justify-center w-[100vw] items-center">
        <div class="bg-slate-50 m-24 w-fit px-20 border-solid border-2 border-blackKleur rounded-lg">
            <h1 class="text-[40px] font-bold text-center pt-6">Update</h1>
            <div class="md:col-span-3">
                <form id="myForm" action="" method="post">
                <label for="date">Datum</label>
                <input required autocomplete="off" name="date" id="date" class="h-10 border mt-1 rounded px-4 w-full bg-white" value="<?php echo formateDatumNl($reservation->getStartTime()) ?>" placeholder="" onchange="submitForm()" />
            </div>                                
            <div class="w-full my-4">
                <p class="font-bold">Starttijd:</p>
                <select required name="selectStart" id="selectStart" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"  onchange="submitForm()">
                        <?php for($i = 14; $i <= 23; $i++) { ?>
                        <option <?php echo (formateTime($reservation->getStartTime()) == formateBackToHoureMinute($i)) ? 'selected' : ''; ?> value="<?php echo $i; ?>:00"><?php echo $i; ?>:00</option>
                    <?php } ?>
                </select>   
            </div>
            <div class="w-full my-4">
                <p class="font-bold">Stoptijd:</p>
                <select required id="selectEnd" name="selectEnd" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" onchange="submitForm()">
                        <?php for($i = 15; $i <= 24; $i++) { 
                            $hour = $i;
                            if($hour == 24)
                            {
                                $hour = '00';
                            }
                            ?>
                        <option <?php echo (formateTime($reservation->getEndTime()) == formateBackToHoureMinute($hour)) ? 'selected' : ''; ?> value="<?php echo $hour; ?>:00"><?php echo $hour; ?>:00</option>
                    <?php } ?>
                </select>   
            </div>
            </form>
    <div class="grid justify-items-center">
        <form method="POST" action="">
            <div class="w-full my-4">
                <p class="font-bold">Klant email:</p>
                <input type="text" name="username" class="py-2 px-4 rounded-sm border" value="<?php echo $user->getEmail() ?>" readonly />
            </div>
            <div class="w-full my-4">
                <p class="font-bold">Baan:</p>
                <select name="baan" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                    <?php 
                    foreach ($firstLane as $value) {
                        if ($value->getUsername() == $laneName->getUsername()) {
                            echo "<option value=" . $value->getUsername() . " selected>" . $value->getUsername() . "</option>";
                        } else {
                            echo "<option value=" . $value->getUsername() . ">" . $value->getUsername() . "</option>";
                        }
                    } ?>
                </select>
            </div>
            <div class="w-full my-4">
                <p class="font-bold">Extra baan:</p>
                <select name="extraBaan" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                    <option value="geen">geen</option>
                    <?php

                    while ($lane = $lanesExtra->fetch_assoc()) {
                        
                        if ($lane['username'] == $extraLane) {
                            echo "<option value=" . $lane['username'] . " selected>" . $lane['username'] . "</option>";
                        } else {
                            echo "<option value=" . $lane['username'] . ">" . $lane['username'] . "</option>";
                        }
                    } ?>
                </select>
            </div>
            <div class="w-full my-4">
                <p class="font-bold">Prijs baan:</p>
                <input type="number" name="priceLane" id="price" class="py-2 px-4 rounded-sm border" value="<?php echo $reservation->getPriceLane() ?>" required />
            </div>
            <div class="w-full my-4">
                <p class="font-bold">Prijs eten:</p>
                <input type="number" name="priceFood" id="price" class="py-2 px-4 rounded-sm border" value="<?php echo $reservation->getPriceFood() ?>" required />
            </div>
            <div class="w-full my-4">
                <p class="font-bold">Volwassene:</p>
                <input type="number" name="adult" class="py-2 px-4 rounded-sm border" value="<?php echo $reservation->getAdults() ?>" required />
            </div>
            <div class="w-full my-4">
                <p class="font-bold">Kinderen:</p>
                <input type="number" name="children" class="py-2 px-4 rounded-sm border" value="<?php echo $reservation->getChildren() ?>" required />
            </div>

            <input name="updaten" type="submit" value="updaten" class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur hover:text-whiteKleur hover:border-redKleur" />
            <div class="flex flex-wrap pt-6">
                <!-- terug knop -->
                <input class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" type="button" value="Terug" onclick="window.location.href='reservations.php';" />
            </div>
        </form>

    </div>
        </div>

    </div>
    <script>
$(document).ready(function() {

    $('#date').change(function() {
            submitForm();
        });

        // Eindtijdveld
        $('#selectEnd').change(function() {
            submitForm();
        });
        $('#selectStart').change(function() {
            submitForm();
        });

        // Functie om het formulier in te dienen
        function submitForm() {
            $("#myForm").submit();
        }
    <?php
    $reservations = getAllReservationFromUser($user->getId());
    $reservationArr = [];
    $str = "";

    while ($reservation = $reservations->fetch_assoc()) {
    $addReservation = $reservation['startTime'];
    $addReservation = date("d-m-Y", strtotime($addReservation));
    array_push($reservationArr, $addReservation);
    }
    $str = substr($str, 0, -2);
    ?>

    var unavailableDates = [<?php echo $str; ?>];

    function unavailable(date) {
    var today = new Date();
    today.setHours(0, 0, 0, 0);

    if (date <= today) {
        return [false, "", "Unavailable"];
    }

    // Format the selected date to match the array format
    dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();

    if ($.inArray(dmy, unavailableDates) == -1) {
        return [true, ""];
    } else {
        return [false, "", "Unavailable"];
    }
    }

    $("#date").datepicker({
    dateFormat: 'dd-mm-yy',
    beforeShowDay: unavailable
    });
});
</script>
    <style>
  .readonly-input {
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    opacity: 0.7;
    cursor: not-allowed;
  }

  /* Styling for the datepicker */
  .ui-datepicker {
    background-color: #fff;
  }

  .ui-datepicker-header {
    background-color: #333;
    color: #fdfde0;
  }

  .ui-widget-content {
    background: #fff;
  }

  .ui-datepicker-title {
    margin: 0;
    color: #fff;
  }

  .ui-datepicker-prev,
  .ui-datepicker-next {
    color: #fff;
  }

  .ui-datepicker-calendar {
    border: 1px solid #fff;
  }

  .ui-state-default {
    background-color: #d2ae39;
    border: 1px solid #fff;
    color: #333;
  }

  .ui-state-default:hover {
    background-color: #e0e0e0;
    color: #333;
  }

  .ui-state-active,
  .ui-state-active:hover {
    background-color: #333;
    color: #fff;
    border: 1px solid #333;
  }

  .ui-datepicker th {
    background-color: #fff;
  }
</style>
            </body>
<?php
        }
    } else {
        header('location: ../public/index.php');
    }
    include '../public/footer.php';
}
ob_end_flush(); // Flush the output buffer
?>