<?php
include_once 'header.php';
require_once("../source/useful_functions.php");
require_once("../source/db_user.php");
require_once("../source/db_lane.php");
require_once("../source/db_reservation.php");
?>

<div class="py-20 px-[10%]">
    <div class="container max-w-screen-lg mx-auto">
        <div>
            <div class="bg-whiteKleur rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["selectedLanes"])) {

                    // Retrieve other form data from hidden input fields
                    $username = $_POST["username"];
                    $email = $_POST["email"];
                    $date = $_POST["date"];
                    $startTime = $_POST["startTime"];
                    $volwassen = $_POST["volwassen"];
                    $kinderen = $_POST["kinderen"];
                    $urenBowlen = isset($_POST["urenBowlen"]) ? $_POST["urenBowlen"] : '';

                    // Calculate stoptijd based on the condition
                    $stoptijd = ($urenBowlen != '') ? date('H:i', strtotime($startTime . '+2 hours')) : date('H:i', strtotime($startTime . '+1 hour'));

                    // Reformat starttijd and date to a different display format
                    $formattedStartTime = date('H:i', strtotime($startTime));
                    $formattedDate = date('Y-m-d', strtotime($date));

                    // Retrieve the selected lanes from the form submission
                    $selectedLanesJson = $_POST["selectedLanes"];
                    $selectedLanes = json_decode($selectedLanesJson);

                    // Perform any additional processing or validation as needed
                    // For example, you might want to check if the selected lanes are valid or available

                    // Now you can use the retrieved data in your further processing

                    // For demonstration purposes, let's print the selected lanes and other data

                    echo "<p class='font-bold text-lg mt-4 mb-2'>Formuliergegevens:</p>";
                    echo "<div class='grid grid-cols-2 gap-4'>";
                    // Display selected lanes in the form data
                    echo "<div><span class='font-bold text-gray-700'>Geselecteerde banen:</span> ";
                    foreach ($selectedLanes as $lane) {
                        // if it is the last lane, don't add a comma
                        if ($lane == end($selectedLanes)) {
                            echo htmlspecialchars($lane + 1);
                            break;
                        }

                        echo htmlspecialchars($lane + 1) . ", ";
                    }
                    echo "</div>";
                    echo "<div><span class='font-bold text-gray-700'>Gebruikersnaam:</span> " . htmlspecialchars($username) . "</div>";
                    echo "<div><span class='font-bold text-gray-700'>Email:</span> " . htmlspecialchars($email) . "</div>";
                    echo "<div><span class='font-bold text-gray-700'>Datum:</span> " . htmlspecialchars($formattedDate) . "</div>";
                    echo "<div><span class='font-bold text-gray-700'>Starttijd:</span> " . htmlspecialchars($formattedStartTime) . "</div>";
                    echo "<div><span class='font-bold text-gray-700'>Stoptijd:</span> " . htmlspecialchars($stoptijd) . "</div>";
                    echo "<div><span class='font-bold text-gray-700'>Volwassen:</span> " . htmlspecialchars($volwassen) . "</div>";
                    echo "<div><span class='font-bold text-gray-700'>Kinderen:</span> " . htmlspecialchars($kinderen) . "</div>";
                    echo "</div>";

                    // Add buttons to go back and confirm the reservation
                    echo "<div class='mt-4 flex justify-between'>";
                    echo "<a href='reservation.php' class='bg-yellowKleur hover:bg-blackKleur text-white font-bold py-2 px-4 rounded max-h-10'>Terug</a>";
                    echo "<form method='post' action='processReservation.php' class='inline-block'>";
                    // Include hidden input fields for form data
                    echo "<input type='hidden' name='selectedLanes' value='" . htmlspecialchars($selectedLanesJson) . "'>";
                    echo "<input type='hidden' name='username' value='" . htmlspecialchars($username) . "'>";
                    echo "<input type='hidden' name='email' value='" . htmlspecialchars($email) . "'>";
                    echo "<input type='hidden' name='date' value='" . htmlspecialchars($formattedDate) . "'>";
                    echo "<input type='hidden' name='startTime' value='" . htmlspecialchars($formattedStartTime) . "'>";
                    echo "<input type='hidden' name='stoptijd' value='" . htmlspecialchars($stoptijd) . "'>";
                    echo "<input type='hidden' name='volwassen' value='" . htmlspecialchars($volwassen) . "'>";
                    echo "<input type='hidden' name='kinderen' value='" . htmlspecialchars($kinderen) . "'>";
                    echo "<button type='submit' class='bg-yellowKleur hover:bg-blackKleur text-white font-bold py-2 px-4 rounded'>Bevestigen</button>";
                    echo "</form>";
                    echo "</div>";

                } else {
                    // Redirect the user if the form was not submitted properly
                    header('location: reservation.php');
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
