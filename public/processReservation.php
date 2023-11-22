<?php
include_once 'header.php';
require_once("../source/useful_functions.php");
require_once("../source/db_user.php");
require_once("../source/db_lane.php");
require_once("../source/db_reservation.php");

function insertReservationData($user, $selectedLanes, $formattedDate, $formattedStartTime, $volwassen, $kinderen, $urenBowlen)
{
    // Connect to the database
    $conn = db_connect();

    // Get user ID
    $userId = $user->getId();

    // Get lane IDs and cast to int

    $laneId = (int)$selectedLanes[1];

    $laneId = $laneId + 1;


    $laneId2 = isset($selectedLanes[3]) ? $selectedLanes[3] + 1 : null;

    // Format start time and end time
    $formattedStartTimeLong = formateDateTime($formattedDate, $formattedStartTime) . ":00.000000";

    $urenBowlenCheck = 1;
    if ($urenBowlen == "on") {
        $urenBowlenCheck = 2;
    }

    // Calculate end time
    $stoptijd = strtotime("+" . $urenBowlenCheck . " hours", strtotime($formattedStartTime));
    // Format the stop time
    $stoptijdLong = date('Y-m-d H:i:s.000000', $stoptijd);
    // Reformat the stop time to HH:MM
    $stoptijd = date('H:i', $stoptijd);

    // Store the constant value 0 in a variable
    $extraPrice = 0;

    // Get the price
    $price = kosten($formattedStartTimeLong, $stoptijd);

    // Prepare the query
    $query = "INSERT INTO reservation (userId, laneId, price, startTime, endTime, adult, extraPrice, children, extraBaan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bind_param("iidssidii", $userId, $laneId, $price, $formattedStartTimeLong, $stoptijdLong, $volwassen, $extraPrice, $kinderen, $laneId2);

    // Execute the query
    $stmt->execute();

    // Get the ID of the inserted row
    $insertedId = $stmt->insert_id;

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();

    // Return the inserted ID
    return $insertedId;
}

?>

<div class="py-20 px-[10%]">
    <!-- Your HTML code here -->
    <!-- ... -->


    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["selectedLanes"])) {
        // Retrieve other form data from hidden input fields
        $selectedLanes = $_POST["selectedLanes"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $date = $_POST["date"];
        $startTime = $_POST["startTime"];
        $volwassen = $_POST["volwassen"];
        $kinderen = $_POST["kinderen"];
        $urenBowlen = isset($_POST["urenBowlen"]) ? $_POST["urenBowlen"] : '';

        // Call the function to insert data
        $insertedId = insertReservationData($user, $selectedLanes, $date, $startTime, $volwassen, $kinderen, $urenBowlen);

        // Display success message or handle the result accordingly
        if ($insertedId) {
            echo '<div class="flex items-center justify-center h-screen">';
            echo '<p class="text-green-500 text-4xl font-bold">Reservering succesvol opgeslagen!</p>';
            echo '</div>';

            // add script to redirect to homepage after 3 seconds
            echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 3000);</script>";
        } else {
            echo "<p class='text-red-500'>Fout bij het opslaan van de reservering.</p>";
        }
    } else {
        // Redirect the user if the form was not submitted properly
        header('location: reservation.php');
    }
    ?>
    <!-- ... -->
</div>

<?php include 'footer.php'; ?>