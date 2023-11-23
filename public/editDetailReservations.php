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
        if (isset($_GET['id']))
        {
             $reservation = new reservationsClass(getReservationById($_GET['id']));
             $laneName = new laneClass(getLaneById($reservation->getLaneName()));
             $adult = $reservation->getAdults();
             $childs = $reservation->getChildren();
             $fullStartTime = $reservation->getStartTime();
             $date = formateDatumNl($fullStartTime);
             $time = formateTime($fullStartTime);


             if($childs == null)
             {
              $childs = '0';
             }
    
              if (isset($_POST["datum"])) 
              {
                $date = $_POST['date'];
                $time = $_POST['time'];
                $dateFormatted = formateDateTime($date, $time);
                $adult = $_POST['volwassen'];
                $childs= $_POST['kinderen'];
                // echo $date;
                
                if (isset($_POST["urenBowlen"])) {
                  $urenBowlen = $_POST["urenBowlen"];
                }
                $dateStart = $dateFormatted;
              }
              if (isset($_POST["update"])) {
                $selectedLanes;
                $dateStart = $_POST["dateStart"];
                $adult = $_POST['adult'];
                $childs= $_POST['childs'];
                if (isset($_POST["selectedLanes"])){
                  $selectedLanes = $_POST["selectedLanes"];
                }
                
                $urenBowlen = isset($_POST["urenBowlen"]) ? $_POST["urenBowlen"] : '';
                

                $urenBowlenCheck = 1;
               if ($urenBowlen == "on") {
                   $urenBowlenCheck = 2;
               }
             
               // Calculate end time
               $stoptijd = strtotime("+" . $urenBowlenCheck . " hours", strtotime($time));
               // Format the stop time
               $stoptijdLong = date('Y-m-d H:i', $stoptijd);
               $price = kosten($dateStart, formateTime($stoptijdLong));
                $update = updateReservationCustomer($user->getId(), laneID1($selectedLanes), $price, '0', $childs, $adult, $dateStart, $stoptijdLong, $reservation->getId(), laneID2($selectedLanes));
                if ($update) {
                  header('Location: detail.php');
                }else{
                  echo 'niet gelukt';
                }

                
              }



?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Baan Agenda</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
  $(document).ready(function() {
    // Event handler for adult input change
    $('#volwassen').on('change', function() {
      updateTotalParticipants();
    });

    // Event handler for child input change
    $('#kinderen').on('change', function() {
      updateTotalParticipants();
    });

    function updateTotalParticipants() {
      // Get the values of adult and child inputs
      var adults = parseInt($('#volwassen').val()) || 0;
      var children = parseInt($('#kinderen').val()) || 0;

      // Enforce the rule: if there is at least 1 child, you need at least 2 adults
      if (children > 0 && adults < 2) {
        adults = 2;
        $('#volwassen').val(adults);
      }

      // Enforce the rule: maximum of 8 adults
      if (adults > 8) {
        adults = 8;
        $('#volwassen').val(adults);
      }

      // Enforce the rule: maximum total of 10 people
      var totalParticipants = adults + children;
      if (totalParticipants > 10) {
        // If the total exceeds 10, adjust the number of children
        children = 10 - adults;
        $('#kinderen').val(children);
      }

      // Update the total number of participants
      totalParticipants = adults + children;

      // Display the updated total
      console.log('Total Participants: ' + totalParticipants);
    }

    // Initialize minDate as tomorrow
    var tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1); // Adding 1 to get tomorrow
    var minDate = tomorrow.toISOString().split('T')[0];

    // Set the min attribute of the date input
    $('#date').attr('min', minDate);

    $('#date').on('change', function() {
      // Clear the selected time when the date changes
      $('#appt-time').val('');

      var selectedDate = new Date($(this).val());

      // Check if the selected date is Saturday (6) or Sunday (0)
      if (selectedDate.getDay() === 6 || selectedDate.getDay() === 0) {
        // If Saturday or Sunday, enable options "22:00" and "23:00"
        $('#appt-time option[value="22:00:00"]').prop('disabled', false);
        $('#appt-time option[value="23:00:00"]').prop('disabled', false);
      } else {
        // If not Saturday or Sunday, disable options "22:00" and "23:00"
        $('#appt-time option[value="22:00:00"]').prop('disabled', true);
        $('#appt-time option[value="23:00:00"]').prop('disabled', true);
      }

      // Check if it's Monday (1), Tuesday (2), Wednesday (3), Thursday (4), or Friday (5)
      if (selectedDate.getDay() >= 1 && selectedDate.getDay() <= 5) {
        // If it's a weekday, clear the "urenBowlen" checkbox
        $('#urenBowlen').prop('checked', false);
        $('#urenBowlen').prop('disabled', true);
      } else {
        // If not a weekday, enable the "urenBowlen" checkbox
        $('#urenBowlen').prop('disabled', false);
      }
    });

    $('#appt-time').on('change', function() {
      var selectedTime = $(this).val();
      var lastOption = $('#appt-time option:last-child').val();

      // Check if the selected time is the last option
      if (selectedTime === lastOption) {
        // Clear the "urenBowlen" checkbox
        $('#urenBowlen').prop('checked', false);
        $('#urenBowlen').prop('disabled', true);
      } else {
        // If not the last option, enable the "urenBowlen" checkbox
        $('#urenBowlen').prop('disabled', false);
      }

      // Check if it's 21:00, disable the "urenBowlen" checkbox
      if (selectedTime === "21:00:00") {
        $('#urenBowlen').prop('checked', false);
        $('#urenBowlen').prop('disabled', true);
      }
    });

   
  });
</script>

</head>
<body class="px-8 bg-gray-100 h-screen flex items-center justify-center">
<div class="flex">
    <div class="flex items-center justify-center px-8 m-8 w-full max-w-screen-lg bg-white p-4 rounded-md shadow-md">
    <form method="POST" action="">
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
              <td class="border-r-2 border-gray-300 p-2"><?php echo date('H:i', strtotime($time)); ?></td>
              <?php
              $selectedStartTime = $time;

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
                  <td class="border-r-2 border-gray-300 p-2"><?php echo date('H:i', strtotime($date . '+1 hour')); ?></td>
                  <?php
                  $selectedStartTime = date('H:i', strtotime($date . '+1 hour'));

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
     <!-- Add hidden input field for selected lanes -->
     <input type="hidden" name="selectedLanes" id="selectedLanes" value="">  
     <input type="hidden" name="adult" id="adult" value="<?php echo $adult;?>">     
     <input type="hidden" name="childs" id="childs" value="<?php echo $childs;?>">     
     <input type="hidden" name="dateStart" id="dateStart" value="<?php echo $dateStart;?>">                                  
     <button type="submit" id="confirmationButton" name="update" class="bg-yellowKleur hover:bg-blackKleur text-white font-bold my-6 py-2 px-4 rounded">Update</button>
                                    </form>
        
    </div>
    <div class="m-8 bg-white p-4 rounded-md shadow-md inline-block align-baseline">
    <h2>Dag</h2>
    <form method="POST" action="">
        <div class="my-4">
            <input type="date" name="date" id="date" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="<?php echo formateDatum($date); ?>" />
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="startTime">Starttijd</label>
                <select id="appt-time" name="time" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                    <?php for($i = 14; $i <= 23; $i++) { ?>
                        <option <?php echo (formateTime($date) == formateBackToHoureMinute($i)) ? 'selected' : ''; ?> value="<?php echo $i; ?>:00:00"><?php echo $i; ?>:00</option>
                    <?php } ?>
                </select>
            </div>

            <div>
                <div class="inline-flex items-center">
                    <input type="checkbox" name="urenBowlen" id="urenBowlen" class="form-checkbox" />
                    <label for="urenBowlen" class="ml-2">Ik wil graag 2 uur bowlen</label>
                </div>
            </div>
        </div>

        <div class="flex py-2">
            <div class="pr-8">
                <label for="volwassen">Hoeveel volwassenen?</label>
                <div class="h-10 w-28 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                    <input required type="number" name="volwassen" id="volwassen" value="<?php echo $adult; ?>" class="px-2 text-center appearance-none outline-none text-gray-800 w-full bg-transparent" min="0" max="8" />
                </div>
            </div>

            <div>
                <label for="kinderen">Hoeveel kinderen?</label>
                <div class="h-10 w-28 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                    <input type="number" name="kinderen" id="kinderen" value="<?php echo $childs; ?>" class="px-2 text-center appearance-none outline-none text-gray-800 w-full bg-transparent" min="0" max="8" />
                </div>
            </div>
        </div>

        <div class="flex flex-wrap pt-6">
            <!-- terug knop -->
            <input class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur hover:text-whiteKleur hover:border-redKleur" type="button" value="Terug" onclick="window.location.href='detail.php';"/>
            <!-- ga naar datum knop -->
            <input name="datum" type="submit" value="Ga naar datum" class="h-10 px-5 ml-4 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur hover:text-whiteKleur hover:border-redKleur" />
        </div>
    </form>
</div>

        </div>
        <script>
    var lanes = [];

    $(document).ready(function () {
        // Add click event to each lane link in th elements
        $(".lane-header").on("click", function () {
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
        $("#confirmationButton").on("click", function () {
            $("#selectedLanes").val(JSON.stringify(lanes));
        });


$("#update").on("click", function () {
  $("#selectedLanesInput").val(JSON.stringify(lanes));
});   
    });
</script>
</body>
</html>

<?php
             
        }
      }
      ob_end_flush(); // Flush the output buffer
      include 'footer.php';
?>