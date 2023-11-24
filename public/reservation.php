<!-- Author: Luuk -->
<?php
include_once 'header.php';
include_once '../source/db_reservation.php';

if (isset($_COOKIE['CurrUser'])) {
  $user = new user(getUserById($_COOKIE['CurrUser']));
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <title>Lucky Strike</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/vader/jquery-ui.css" rel="stylesheet" />
  </head>

  <body>
    <div class="py-20 px-[10%]">
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
include_once 'footer.php';
?>

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

    // Update and check the total number of participants
    function updateTotalParticipants() {
      var adults = parseInt($('#volwassen').val()) || 0;
      var children = parseInt($('#kinderen').val()) || 0;

      if (children > 0 && adults < 2) {
        adults = 2;
        $('#volwassen').val(adults);
      }

      if (adults > 8) {
        adults = 8;
        $('#volwassen').val(adults);
      }

      var totalParticipants = adults + children;
      if (totalParticipants > 10) {
        children = 10 - adults;
        $('#kinderen').val(children);
      }

      totalParticipants = adults + children;
    }

    // Update the datepicker
    <?php
    $reservations = getAllReservationFromUser($user->getId());
    $reservationArr = [];
    $str = "";

    while ($reservation = $reservations->fetch_assoc()) {
      $addReservation = $reservation['startTime'];
      $addReservation = date("d-m-Y", strtotime($addReservation));
      $str = $str . '"' . $addReservation . '", ';
      array_push($reservationArr, $addReservation);
    }
    $str = substr($str, 0, -2);
    ?>

    var unavailableDates = [<?php echo $str; ?>];

    function unavailable(date) {
      var today = new Date();
      today.setHours(0, 0, 0, 0);

      if (date < today) {
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
      dateFormat: 'dd MM yy',
      beforeShowDay: unavailable
    });

    // Event handler for date change
    $('#date').on('change', function() {
      $('#appt-time').val('');
      var selectedDate = new Date($(this).val());

      // Check if the selected date is Saturday (6) or Sunday (0)
      if (selectedDate.getDay() === 6 || selectedDate.getDay() === 0) {
        $('#appt-time option[value="22:00:00"]').prop('disabled', false);
        $('#appt-time option[value="23:00:00"]').prop('disabled', false);
      } else {
        $('#appt-time option[value="22:00:00"]').prop('disabled', true);
        $('#appt-time option[value="23:00:00"]').prop('disabled', true);
      }

      if (selectedDate.getDay() >= 1 && selectedDate.getDay() <= 5) {
        $('#urenBowlen').prop('checked', false);
        $('#urenBowlen').prop('disabled', true);
      } else {
        $('#urenBowlen').prop('disabled', false);
      }
    });

    // Event handler for time change
    $('#appt-time').on('change', function() {
      var selectedTime = $(this).val();
      var lastOption = $('#appt-time option:last-child').val();

      // Check if the selected time is the last option
      if (selectedTime === lastOption) {
        $('#urenBowlen').prop('checked', false);
        $('#urenBowlen').prop('disabled', true);
      } else {
        $('#urenBowlen').prop('disabled', false);
      }

      if (selectedTime === "21:00:00") {
        $('#urenBowlen').prop('checked', false);
        $('#urenBowlen').prop('disabled', true);
      }
    });
  });
</script>
</body>

  </html>