<!-- Author: Luuk -->
<?php
include_once 'header.php';
require_once "../source/useful_functions.php";
require_once "../source/db_user.php";
require_once "../source/db_lane.php";
require_once "../source/db_reservation.php";

function insertReservationData($user, $selectedLanes, $formattedDate, $formattedStartTime, $volwassen, $kinderen, $urenBowlen)
{
    // Connect to the database
    $conn = db_connect();
    $userId = $user->getId();

    $laneId = (int)$selectedLanes[1];
    $laneId = $laneId + 1;
    $laneId2 = isset($selectedLanes[3]) ? $selectedLanes[3] + 1 : null;

    $formattedStartTimeLong = formateDateTime($formattedDate, $formattedStartTime) . ":00.000000";

    $urenBowlenCheck = 1;
    if ($urenBowlen == "on") {
        $urenBowlenCheck = 2;
    }

    // Calculate end time
    $stoptijd = strtotime("+" . $urenBowlenCheck . " hours", strtotime($formattedStartTime));
    $stoptijdLong = date('Y-m-d H:i:s.000000', $stoptijd);
    $stoptijdLong = substr_replace($stoptijdLong, substr($formattedStartTimeLong, 0, 10), 0, 10);
    $stoptijd = date('H:i', $stoptijd);

    // Store the constant value 0 in a variable
    $extraPrice = 0;
    $price = kosten($formattedStartTimeLong, $stoptijd);

    // Prepare the query
    $query = "INSERT INTO reservation (userId, laneId, price, startTime, endTime, adult, extraPrice, children, extraBaan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iidssidii", $userId, $laneId, $price, $formattedStartTimeLong, $stoptijdLong, $volwassen, $extraPrice, $kinderen, $laneId2);
    $stmt->execute();

    $insertedId = $stmt->insert_id;

    $stmt->close();
    $conn->close();

    return $insertedId;
}

?>

<div class="py-20 px-[10%]">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["selectedLanes"])) {
        // Retrieve other form data from hidden input fields
        $selectedLanes  = $_POST["selectedLanes"];
        $username       = $_POST["username"];
        $email          = $_POST["email"];
        $date           = $_POST["date"];
        $startTime      = $_POST["startTime"];
        $volwassen      = $_POST["volwassen"];
        $kinderen       = $_POST["kinderen"];
        $urenBowlen     = isset($_POST["urenBowlen"]) ? $_POST["urenBowlen"] : '';

        $insertedId = insertReservationData($user, $selectedLanes, $date, $startTime, $volwassen, $kinderen, $urenBowlen);

        // Display success message or handle the result accordingly
        if ($insertedId) {
            echo '<div class="flex items-center justify-center h-screen">';
            echo '<p class="text-green-500 text-4xl font-bold">Reservering succesvol opgeslagen!</p>';
            echo '</div>';

            echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 3000);</script>";
        } else {
            echo "<p class='text-red-500'>Fout bij het opslaan van de reservering.</p>";
        }
    } else {
        header('location: reservation.php');
    }
    ?>
</div>

<?php include_once 'footer.php'; ?>