<!-- Author: Luuk -->
<?php
include_once 'header.php';
require_once "../source/useful_functions.php";
require_once "../source/db_user.php";
require_once "../source/db_lane.php";
require_once "../source/db_reservation.php";

if (isset($_COOKIE['CurrUser'])) {
    $user = new user(getUserById($_COOKIE['CurrUser']));

    if (isset($_POST["reservation"])) {
        $username   = $_POST["username"];
        $email      = $_POST["email"];
        $date       = $_POST["date"];
        $startTime  = $_POST["startTime"];
        $volwassen  = $_POST["volwassen"];
        $kinderen   = $_POST["kinderen"];

        if (isset($_POST["urenBowlen"])) {
            $urenBowlen = $_POST["urenBowlen"];
        }
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <title>Lucky Strike</title>
        </head>

        <body>
            <div class="py-20 px-[10%]">
                <div class="container max-w-screen-lg mx-auto">
                    <div>
                        <div class="bg-whiteKleur rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                                <div class="text-blackKleur">
                                    <p class="font-medium text-blackKleur">Reservering Bevestigen</p>
                                    <p>Selecteer een baan voor de reservering.</p>
                                    <p class="mt-20 text-red-600 font-bold">! Alleen de volgende banen hebben beschikbare hulpmiddelen: </p>
                                    <p>
                                        <?php
                                        $lanes = getAllLane();
                                        while ($lane = $lanes->fetch_assoc()) {
                                            if ($lane['gates'] == 1) {
                                                echo "Baan " . $lane['id'] . "<br>";
                                            }
                                        }
                                        ?>
                                    </p>
                                </div>

                                <div class="lg:col-span-2">
                                    <p><strong>Naam:</strong> <?php echo $username; ?></p>
                                    <p><strong>Email:</strong> <?php echo $email; ?></p>
                                    <p><strong>Datum:</strong> <?php echo formatedatumNl($date); ?></p>
                                    <p><strong>Starttijd:</strong> <?php echo $startTime . (isset($urenBowlen) ? " (2 uur lang)" : ""); ?></p>
                                    <p><strong>Volwassenen:</strong> <?php echo $volwassen; ?></p>
                                    <?php if ($kinderen > 0) { ?>
                                        <p><strong>Kinderen:</strong> <?php echo $kinderen; ?></p>
                                    <?php } ?>

                                    <br>
                                    <hr><br>

                                    <!-- Lane selection form goes here -->
                                    <form method="post" action="processReservation.php">
                                        <label for="lane">Selecteer maximaal twee banen:</label>
                                        <table class="w-full border-collapse">

                                            <tr class="border-b-2 border-gray-300">
                                                <th class="text-center font-semibold text-gray-700 p-2 cursor-pointer"><?php echo formatedatumNl($date); ?></th>
                                                <th class="text-center font-semibold text-gray-700 border-l-2 border-r-2 border-gray-300 p-2 lane-header cursor-pointer" id="lane1">Baan 1</th>
                                                <th class="text-center font-semibold text-gray-700 border-l-2 border-r-2 border-gray-300 p-2 lane-header cursor-pointer" id="lane2">Baan 2</th>
                                                <th class="text-center font-semibold text-gray-700 border-l-2 border-r-2 border-gray-300 p-2 lane-header cursor-pointer" id="lane3">Baan 3</th>
                                                <th class="text-center font-semibold text-gray-700 border-l-2 border-r-2 border-gray-300 p-2 lane-header cursor-pointer" id="lane4">Baan 4</th>
                                                <th class="text-center font-semibold text-gray-700 border-l-2 border-r-2 border-gray-300 p-2 lane-header cursor-pointer" id="lane5">Baan 5</th>
                                                <th class="text-center font-semibold text-gray-700 border-l-2 border-r-2 border-gray-300 p-2 lane-header cursor-pointer" id="lane6">Baan 6</th>
                                                <th class="text-center font-semibold text-gray-700 border-l-2 border-r-2 border-gray-300 p-2 lane-header cursor-pointer" id="lane7">Baan 7</th>
                                                <th class="text-center font-semibold text-gray-700 border-l-2 border-gray-300 p-2 lane-header cursor-pointer" id="lane8">Baan 8</th>
                                            </tr>

                                            <tr class="border-b-2 border-gray-300">
                                                <td class="border-r-2 border-gray-300 p-2"><?php echo date('H:i', strtotime($startTime)); ?></td>
                                                <?php
                                                $selectedStartTime = $startTime;

                                                for ($i = 1; $i <= 8; $i++) {
                                                ?>
                                                    <td class="border-r-2 border-gray-300 p-2 lane-cell">
                                                        <?php
                                                        $date = formateDateTime($date, $selectedStartTime);
                                                        $bool = laneDateCheck($i, $date);
                                                        ?>
                                                        <a href="javascript:void(0)" class="lane-link cursor-default" data-lane="<?php echo $i; ?>">
                                                            <?php
                                                            echo $bool ? "bezet" : "vrij";
                                                            ?>
                                                            <?php if ($bool) { ?>
                                                                <script>
                                                                    $("#lane<?php echo $i; ?>").removeClass("lane-header");
                                                                    $(".lane-cell:nth-child(<?php echo $i + 1; ?>)").css("opacity", "0.5");
                                                                </script>
                                                            <?php } ?>
                                                        </a>
                                                    </td>
                                                <?php } ?>
                                            </tr>

                                            <!-- Extra row to check the hour after the start time -->
                                            <?php if (isset($urenBowlen)) { ?>
                                                <tr class="border-b-2 border-gray-300">
                                                    <td class="border-r-2 border-gray-300 p-2"><?php echo date('H:i', strtotime($startTime . '+1 hour')); ?></td>
                                                    <?php
                                                    $selectedStartTime = date('H:i', strtotime($startTime . '+1 hour'));

                                                    for ($i = 1; $i <= getNumberOfLanes(); $i++) {
                                                    ?>
                                                        <td class="border-r-2 border-gray-300 p-2 lane-cell">
                                                            <?php
                                                            $date = formateDateTime($date, $selectedStartTime);
                                                            $bool = laneDateCheck($i, $date);
                                                            ?>
                                                            <a href="javascript:void(0)" class="lane-link cursor-default" data-lane="<?php echo $i; ?>">
                                                                <?php
                                                                echo $bool ? "bezet" : "vrij";

                                                                ?>
                                                                <?php if ($bool) { ?>
                                                                    <script>
                                                                        $("#lane<?php echo $i; ?>").removeClass("lane-header");
                                                                        $(".lane-cell:nth-child(<?php echo $i + 1; ?>)").css("opacity", "0.5");
                                                                    </script>
                                                                <?php } ?>
                                                            </a>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>

                                        </table>
                                        <!-- Add hidden input fields for other form data -->
                                        <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">
                                        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                                        <input type="hidden" name="date" value="<?php echo htmlspecialchars($date); ?>">
                                        <input type="hidden" name="startTime" value="<?php echo htmlspecialchars($startTime); ?>">
                                        <input type="hidden" name="volwassen" value="<?php echo htmlspecialchars($volwassen); ?>">
                                        <input type="hidden" name="kinderen" value="<?php echo htmlspecialchars($kinderen); ?>">
                                        <input type="hidden" name="urenBowlen" value="<?php echo isset($urenBowlen) ? htmlspecialchars($urenBowlen) : ''; ?>">
                                        <input type="hidden" name="selectedLanes" id="selectedLanes" value="">

                                        <a href="reservation.php" class="bg-yellowKleur hover:bg-blackKleur text-white font-bold my-6 py-2 px-4 rounded">Terug</a>
                                        <button type="submit" id="confirmationButton" class="bg-yellowKleur hover:bg-blackKleur text-white font-bold my-6 py-2 px-4 rounded">Bevestigen</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                var lanes = [];

                $(document).ready(function() {
                    $(".lane-header").on("click", function() {
                        var laneIndex = $(this).index() - 1; // Subtract 1 to account for the date column

                        if (lanes.includes(laneIndex)) {
                            $(".lane-cell:nth-child(" + (laneIndex + 2) + ")").css("background-color", "");
                            lanes.splice(lanes.indexOf(laneIndex), 1);
                            return;
                        }

                        if (lanes.length == 2) {
                            $(".lane-cell:nth-child(" + (lanes[0] + 2) + ")").css("background-color", "");
                            lanes.shift();
                        }

                        lanes.push(laneIndex);
                        $(".lane-cell:nth-child(" + (laneIndex + 2) + ")").css("background-color", "#909090");
                    });

                    // Update the hidden input field with selected lanes and other form data
                    $("#confirmationButton").on("click", function() {
                        $("#selectedLanes").val(JSON.stringify(lanes));

                        var username = "<?php echo htmlspecialchars($username); ?>";
                        var email = "<?php echo htmlspecialchars($email); ?>";
                        var date = "<?php echo htmlspecialchars($date); ?>";
                        var startTime = "<?php echo htmlspecialchars($startTime); ?>";
                        var volwassen = "<?php echo htmlspecialchars($volwassen); ?>";
                        var kinderen = "<?php echo htmlspecialchars($kinderen); ?>";
                        var urenBowlen = "<?php echo isset($urenBowlen) ? htmlspecialchars($urenBowlen) : ''; ?>";

                        $("#username").val(username);
                        $("#email").val(email);
                        $("#date").val(date);
                        $("#startTime").val(startTime);
                        $("#volwassen").val(volwassen);
                        $("#kinderen").val(kinderen);
                        $("#urenBowlen").val(urenBowlen);
                    });
                });
            </script>
        </body>

        </html>
<?php
    } else {
        header('location: reservation.php');
    }

    include_once 'footer.php';
} else {
    header('location: login.php');
}
?>