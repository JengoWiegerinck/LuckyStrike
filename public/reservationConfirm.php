<?php
include 'header.php';

// Check if the user is logged in
if (isset($_COOKIE['CurrUser'])) {
    $user = new user(getUserById($_COOKIE['CurrUser']));

    // Check if the reservation form was submitted
    if (isset($_POST["reservation"])) {
        // Retrieve reservation details from the form
        $participants = $_POST["participants"];
        $startTime = $_POST["startTime"];
        $endTime = $_POST["endTime"];

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
                                </div>

                                <div class="lg:col-span-2">
                                    <!-- Lane selection form goes here -->
                                    <!-- You can use a dropdown, radio buttons, or any other input method for lane selection -->
                                    <form method="post" action="processReservation.php">
                                        <label for="lane">Selecteer een baan:</label>
                                        <select id="lane" name="lane" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" required>
                                            <!-- Add options for available lanes dynamically or manually -->
                                            <option value="lane1">Baan 1</option>
                                            <option value="lane2">Baan 2</option>
                                            <!-- Add more options as needed -->
                                        </select>

                                        <!-- Include hidden fields to pass reservation details to the next page -->
                                        <input type="hidden" name="participants" value="<?php echo $participants; ?>">
                                        <input type="hidden" name="startTime" value="<?php echo $startTime; ?>">
                                        <input type="hidden" name="endTime" value="<?php echo $endTime; ?>">

                                        <button type="submit" class="bg-yellowKleur hover:bg-blackKleur text-white font-bold py-2 px-4 rounded">Bevestigen</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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