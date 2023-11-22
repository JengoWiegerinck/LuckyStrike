<?php
include 'header.php';
require_once("../source/useful_functions.php");
require_once("../source/db_user.php");
require_once("../source/db_lane.php");
require_once("../source/db_reservation.php");

// Check if the user is logged in
if (isset($_COOKIE['CurrUser'])) {
    $user = new user(getUserById($_COOKIE['CurrUser']));





    // Check if the reservation form was submitted
    if (isset($_POST["reservation"])) {
        // Retrieve reservation details from the form
        $username = $_POST["username"];
        $email = $_POST["email"];
        $date = $_POST["date"];
        $startTime = $_POST["startTime"];
        $volwassen = $_POST["volwassen"];
        $kinderen = $_POST["kinderen"];

        if (isset($_POST["urenBowlen"])) {
            $urenBowlen = $_POST["urenBowlen"];
        }




        // Perform any additional processing or validation as needed
        // ...

        // Display the reservation confirmation and lane selection form
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <!-- Include any necessary scripts or stylesheets -->
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <!-- Additional scripts or stylesheets can be added here -->
            <title>Reservation Confirmation</title>
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
                                        // get all lanes where gates is 1
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
                                    <!-- Display information received from the form -->
                                    <p><strong>Naam:</strong> <?php echo $username; ?></p>
                                    <p><strong>Email:</strong> <?php echo $email; ?></p>
                                    <p><strong>Datum:</strong> <?php echo formatedatumNl($date); ?></p>
                                    <p><strong>Starttijd:</strong> <?php echo $startTime . (isset($urenBowlen) ? " (2 uur lang)" : ""); ?></p>
                                    <p><strong>Volwassenen:</strong> <?php echo $volwassen; ?></p>
                                    <p><strong>Kinderen:</strong> <?php echo $kinderen; ?></p>

                                    <br>
                                    <hr><br>

                                    <!-- Lane selection form goes here -->
                                    <!-- You can use a dropdown, radio buttons, or any other input method for lane selection -->
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

                                            <!-- Existing code for the timeslots row -->
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
                                                                    // make the lane$i unclickable
                                                                    $("#lane<?php echo $i; ?>").removeClass("lane-header");

                                                                    // add a visual indicator that the lane is unavailable by changing the opacity
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
                                                                        // make the lane$i unclickable
                                                                        $("#lane<?php echo $i; ?>").removeClass("lane-header");

                                                                        // add a visual indicator that the lane is unavailable by changing the opacity
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
                                        <!-- Add hidden input field for selected lanes -->
                                        <input type="hidden" name="selectedLanes" id="selectedLanes" value="">
                                        <!-- back button -->
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
                    // Add click event to each lane link in th elements
                    $(".lane-header").on("click", function() {
                        var laneIndex = $(this).index() - 1; // Subtract 1 to account for the date column
                        // if a lane is already selected and the user clicks on it again, remove the background color
                        if (lanes.includes(laneIndex)) {
                            $(".lane-cell:nth-child(" + (laneIndex + 2) + ")").css("background-color", "");
                            // Remove the lane from the array
                            lanes.splice(lanes.indexOf(laneIndex), 1);
                            return;
                        }

                        if (lanes.length == 2) {
                            // If two lanes are already selected, remove the background color from the cells in the first lane
                            $(".lane-cell:nth-child(" + (lanes[0] + 2) + ")").css("background-color", "");
                            // Remove the first lane from the array
                            lanes.shift();
                        }
                        // Remove background color from all lanes
                        // $(".lane-cell").css("background-color", "");

                        // Get the index of the clicked lane header
                        lanes.push(laneIndex);
                        // Set background color for the corresponding cells in the clicked lane
                        $(".lane-cell:nth-child(" + (laneIndex + 2) + ")").css("background-color", "#f0f0f0");
                    });

                    // Update the hidden input field with selected lanes and other form data
                    $("#confirmationButton").on("click", function() {
                        // Convert the lanes array to JSON and set the value of the selectedLanes hidden field
                        $("#selectedLanes").val(JSON.stringify(lanes));

                        // Get other form data and set the values of the corresponding hidden fields
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
        // Redirect the user to the reservation page if the form was not submitted
        header('location: reservation.php');
    }

    include 'footer.php';
} else {
    // Redirect the user to the login page if not logged in
    header('location: login.php');
}
?>