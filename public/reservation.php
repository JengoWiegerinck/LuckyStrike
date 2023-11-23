<?php include 'header.php';
include '../source/db_reservation.php';

if (isset($_COOKIE['CurrUser'])) {
  $user = new user(getUserById($_COOKIE['CurrUser']));
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/vader/jquery-ui.css" rel="stylesheet" />
    <script>
      $(document).ready(function() {

        <?php

        // get all reservations from the user and put them in an array with the correct format
        $reservations = getAllReservationFromUser($user->getId());
        $reservationArr = [];
        $str = "";
        while ($reservation = $reservations->fetch_assoc()) {
          $addReservation = $reservation['startTime'];
          //format the date to date only dd-mm-yyyy
          $addReservation = date("d-m-Y", strtotime($addReservation));
          $str = $str . '"' . $addReservation . '", ';
          array_push($reservationArr, $addReservation);
        }

        // remove last comma and space
        $str = substr($str, 0, -2);
        ?>

        var unavailableDates = [<?php echo $str; ?>];

        function unavailable(date) {
          // Get the current date
          var today = new Date();
          today.setHours(0, 0, 0, 0); // Set the time to midnight for accurate comparison

          // Check if the selected date is before today
          if (date < today) {
            return [false, "", "Unavailable"];
          }

          // Format the selected date to match the array format
          dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();

          // Check if the selected date is in the array of unavailable dates
          if ($.inArray(dmy, unavailableDates) == -1) {
            return [true, ""];
          } else {
            return [false, "", "Unavailable"];
          }
        }

        $("#date").datepicker({
          dateFormat: 'dd MM yy',
          beforeShowDay: unavailable
        });

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

  <body>
    <div class="py-20 px-[10%]">

      <!-- component -->

      <div class="container max-w-screen-lg mx-auto">
        <div>
          <div class="bg-whiteKleur rounded shadow-lg p-4 px-4 md:p-8 mb-6">
            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
              <div class="text-blackKleur">
                <p class="font-medium text-blackKleur">Reserveren</p>
                <p>Vul hier de details in van de reservering.</p>
              </div>

              <form method="post" action="reservationConfirm.php" class="lg:col-span-2">
                <div class="lg:col-span-2">
                  <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                    <div class="md:col-span-5">
                      <label for="username">Gebruikersnaam</label>
                      <input type="text" name="username" id="username" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 readonly-input" value="<?php echo $user->getUsername(); ?>" readonly />
                    </div>

                    <div class="md:col-span-5">
                      <label for="email">Emailadres</label>
                      <input type="text" name="email" id="email" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 readonly-input" value="<?php echo $user->getEmail(); ?>" readonly />
                    </div>

                    <div class="md:col-span-3">
                      <label for="date">Datum</label>
                      <input required autocomplete="off" name="date" id="date" class="h-10 border mt-1 rounded px-4 w-full bg-white" value="" placeholder="" />
                    </div>

                    <div class="md:col-span-1">
                      <label for="startTime">Starttijd</label>
                      <select required name="startTime" id="appt-time" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                        <option default value="">Selecteer</option>
                        <option value="14:00:00">14:00</option>
                        <option value="15:00:00">15:00</option>
                        <option value="16:00:00">16:00</option>
                        <option value="17:00:00">17:00</option>
                        <option value="18:00:00">18:00</option>
                        <option value="19:00:00">19:00</option>
                        <option value="20:00:00">20:00</option>
                        <option value="21:00:00">21:00</option>
                        <option value="22:00:00">22:00</option>
                        <option value="23:00:00">23:00</option>
                      </select>
                    </div>

                  </div>
                  <div class="md:col-span-5 py-2">
                    <div class="inline-flex items-center">
                      <input type="checkbox" name="urenBowlen" id="urenBowlen" class="form-checkbox" />
                      <label for="urenBowlen" class="ml-2">Ik wil graag 2 uur bowlen</label>
                    </div>
                  </div>


                  <div class="flex py-2">
                    <div class="md:col-span-2 pr-20">
                      <label for="volwassen">Hoeveel volwassenen?</label>
                      <div class="h-10 w-28 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">

                        <input required type="number" name="volwassen" id="volwassen" placeholder="0" class="px-2 text-center appearance-none outline-none text-gray-800 w-full bg-transparent" min="0" max="8" />

                      </div>
                    </div>

                    <div class="md:col-span-2">
                      <label for="kinderen">Hoeveel kinderen?</label>
                      <div class="h-10 w-28 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">

                        <input type="number" name="kinderen" id="kinderen" placeholder="0" class="px-2 text-center appearance-none outline-none text-gray-800 w-full bg-transparent" min="0" max="8" />

                      </div>
                    </div>
                  </div>





                  <div class="md:col-span-5 text-right">
                    <div class="inline-flex items-end">
                      <!-- Wrap the button in a form and set the action attribute to reservationConfirm.php -->

                      <button type="submit" name="reservation" class="bg-yellowKleur hover:bg-blackKleur text-white font-bold py-2 px-4 rounded">Verder</button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
    </div>
    </div>
    </div>
    </div>
  </body>


<?php
} else {
  header('location: login.php');
}
include 'footer.php';
?>

<style>
  /* Add this to your CSS file or style section */
  .readonly-input {
    background-color: #f0f0f0;
    /* Light gray background */
    border: 1px solid #ccc;
    /* Light border */
    opacity: 0.7;
    /* Reduced opacity */
    cursor: not-allowed;
    /* Change cursor to indicate not editable */
  }

  /* Styling for the datepicker */
.ui-datepicker {
  background-color: #fff; /* White background for the datepicker */
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
  background-color: #d2ae39; /* Background color for the date cells */
  border: 1px solid #fff;
  color: #333; /* Text color for normal state */
}

.ui-state-default:hover {
  background-color: #e0e0e0;
  color: #333; /* Text color on hover */
}

.ui-state-active,
.ui-state-active:hover {
  background-color: #333;
  color: #fff;
  border: 1px solid #333;
}

/* make the background of the th white */
.ui-datepicker th {
  background-color: #fff;
}



</style>
</body>

  </html>