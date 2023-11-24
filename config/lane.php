<?php
ob_start(); // Start output buffering
include '../public/header.php';
require_once("../source/useful_functions.php");
require_once("../source/db_user.php");
require_once("../source/db_lane.php");

if (isset($_COOKIE['CurrUser'])) {
    $user = new user(getUserById($_COOKIE['CurrUser']));
    if (checkAdmin($user->getKlasse())) {

        if (isset($_GET['id']) && isset($_GET['type'])) {
            if ($_GET['type'] == 'lane') {
                deleteLane($_GET['id']);
            }
        }

?>

        <link rel="stylesheet" href="../../Css/admin.css">
        <link href="//cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@600;700&family=Open+Sans:wght@500;600;800&family=Rubik:wght@500&display=swap" rel="stylesheet">

        <body>
            <div class="px-8 py-10 md:py-20">
                <h1 class="bold text-center text-4xl text-blackKleur mb-8">Banen</h1>
                <div class="mb-4 overflow-x-auto">
                    <table id="laneTable" class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th>Naam</th>
                                <th>hulpmiddelen</th>
                                <th>Functie</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $lanes = getAllLane();
                            while ($lane = $lanes->fetch_assoc()) { ?>
                                <tr class="odd:bg-blackKleur/20">
                                    <td class="border border-blackKleur/30"><?php echo $lane['username'] ?></td>
                                    <td class="border border-blackKleur/30">
                                        <?php if (gates($lane['gates'])) {
                                            echo "&#10003;";
                                        } else {
                                            echo "&#10005;";
                                        } ?></td>


                                    <td class="border border-blackKleur/30">
                                        <button class="functionBtn btnEdit" title="Aanpassen" id="<?php echo $lane['id'] ?>"><i class="bi bi-pencil-square"></i></button>
                                        <button class="functionBtn btnDelete" title="Verwijderen" id="<?php echo $lane['id'] ?>"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <input class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" type="button" value="Terug" onclick="window.location.href='admin.php';" />
            </div>
        </body>
        <script src="../../Js/jquery.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
        <script src="//cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(() => {
                //gebruikte deze video (destijds)
                //https://youtu.be/BIurvEtcev4

                $('#laneTable').DataTable({
                    "columns": [{
                            "data": "name"
                        },
                        {
                            "data": "gates"
                        },
                        {
                            "data": "function"
                        }
                    ]
                });

                $('#laneTable tbody').on('click', '.btnEdit', function() {
                    var id = $(this).attr('id');
                    window.location.href = `editLane.php?id=${id}`;
                })
                $('#laneTable tbody').on('click', '.btnDelete', function() {
                    if (confirm("Weet je zeker dat je dit wil verwijderen?")) {
                        var id = $(this).attr('id');
                        window.location.href = `lane.php?id=${id}&type=lane`;
                    }
                })
            })
        </script>
<?php
    } else {
        header('location: ../public/index.php');
    }
}
include '../public/footer.php';
ob_end_flush(); // Flush the output buffer
?>