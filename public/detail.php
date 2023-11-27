<?php
include_once 'header.php';
require_once "../source/user.php";
require_once "../source/db_user.php";
require_once "../source/db_reservation.php";
require_once "../source/useful_functions.php";

if (isset($_COOKIE['CurrUser'])) {
    $user = new user(getUserById($_COOKIE['CurrUser']));

    if (isset($_POST['updaten'])) {
        $currentlyP = $_POST['password'];
        $newP = $_POST['newPassword'];

        if ($currentlyP == $user->getPassword()) {
            updatePassword($newP, $user->getId());
        }
    }
    if (isset($_GET['type']) && $_GET['type'] == 'reservation')
            {
                deleteReservation($_GET['id']);
            }
?>

    <head>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    </head>

    <body>
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="my-8 bg-slate-50 m-24 w-fit px-20 border-solid border-2 border-blackKleur rounded-lg">
                <h2 class="text-4xl font-semibold text-gray-800 ">Persoonlijke gegevens</h2>
                <form method="POST" action="">
                    <div class="w-full my-4">
                        <p class="font-bold">Email</p>
                        <input type="email" name="email" class="py-2 px-4 rounded-sm border" value="<?php echo $user->getEmail(); ?>" readonly />
                    </div>
                    <div class="w-full my-4">
                        <p class="font-bold">Naam</p>
                        <input type="text" name="username" class="py-2 px-4 rounded-sm border" value="<?php echo $user->getUsername(); ?>" readonly />
                    </div>
                    <div class="w-full my-4">
                        <p class="font-bold">Wachtwoord</p>
                        <input type="password" name="password" class="py-2 px-4 rounded-sm border" placeholder="Wachtwoord" required />
                    </div>
                    <div class="w-full my-4">
                        <p class="font-bold">Nieuw wachtwoord</p>
                        <input type="password" name="newPassword" class="py-2 px-4 rounded-sm border" placeholder="Wachtwoord" required />
                    </div>
                    <input name="updaten" type="submit" value="updaten" class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur hover:text-whiteKleur hover:border-redKleur" />

            </form>        
        </div>
        <div class="my-8 bg-slate-50 m-24 w-fit px-20 border-solid border-2 border-blackKleur rounded-lg">
            <h2 class="text-4xl font-semibold text-gray-800">Reserveringen</h2>
            <table class="table-fixed w-full border-collapse">
              <thead>
                <tr>
                  <th class="p-4">Datum</th>
                  <th class="p-4">Prijs</th>
                  <th class="p-4">Aantal personen</th>
                  <th class="p-4">Edit</th>
                </tr>
              </thead>
              <tbody>
              <?php $reservations = getAllReservationFromUser($user->getId());

                while ($reservation = $reservations->fetch_assoc()) { ?>
                <tr>
                  <td class="p-4 text-center"><?php echo formateDate($reservation['startTime'])?></td>
                  <td class="p-4 text-center">&#8364;<?php echo totalPrice($reservation['price'], $reservation['extraPrice']);?></td>
                  <td class="p-4 text-center"><?php echo participants($reservation['adult'], $reservation['children'])?></td>
                  <td class="p-4 text-center" id="edit">
                    <?php
                    if(check24Hours($reservation['startTime']))
                    { ?>
                    <a class="btnEdit" id="<?php echo $reservation['id'] ?>"><i class='fas fa-edit'></i></a>
                    <a class="btnDelete" id="<?php echo $reservation['id'] ?>"><i class='far fa-trash-alt'></i> </a>
<?php
                    }else{ ?>
                    <p>bellen voor verandering</p>
                    <?php
                    }
                    ?>
                </td>
                </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <script>
       $(document).on('click', '.btnEdit', function() {
        var id = $(this).attr('id');
        console.log(id);
        window.location.href = `editDetailReservations.php?id=${id}`;
        });

        $(document).on('click', '.btnDelete', function() {
            if (confirm("Weet je zeker dat je dit wil verwijderen? Dit kan niet ongedaan worden gemaakt."))
            {
                var id = $(this).attr('id');
                window.location.href = `detail.php?id=${id}&type=reservation`;
            }
        })
    </script>
</body>


<?php
}

include 'footer.php';
?>