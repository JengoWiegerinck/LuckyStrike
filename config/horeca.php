<?php
include '../public/header.php';
require_once("../source/useful_functions.php");
require_once("../source/db_user.php");
require_once("../source/db_horeca.php");

if (isset($_COOKIE['CurrUser'])) {
    $user = new user(getUserById($_COOKIE['CurrUser']));
    if (checkAdmin($user->getKlasse()))
    {

        if (isset($_GET['id']) && isset($_GET['type']))
        {
            if ($_GET['type'] == 'food')
            {
                deleteHoreca($_GET['id']);
            }
        }
    
?>

<link rel="stylesheet" href="../../Css/admin.css">
<link href="//cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@600;700&family=Open+Sans:wght@500;600;800&family=Rubik:wght@500&display=swap" rel="stylesheet">
<body>
    <div class="px-8 ">
        <h1 class="bold text-center">horeca</h1>
        <table id="foodTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Prijs</th>
                    <th>Functie</th>
                </tr>
            </thead>
            <tbody>
                <?php $foods = getAllHoreca();
                while ($food = $foods->fetch_assoc()) {?>
                <tr class="odd:bg-blackKleur/20">
                    <td class="border border-blackKleur/30"><?php echo $food['name']?></td>
                    <td class="border border-blackKleur/30"><?php echo "€" . number_format((float)$food['price'], 2, '.', '')?></td>

                    <td class="border border-blackKleur/30">
                        <!-- <button class="functionBtn btnEdit" title="Aanpassen" id="<?php echo $food['id'] ?>"><i class="bi bi-pencil-square"></i></button> -->
                        <button class="functionBtn btnDelete" title="Verwijderen" id="<?php echo $food['id'] ?>"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <input class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur hover:text-whiteKleur hover:border-redKleur" type="button" value="Toevoegen"  onclick="window.location.href='horeca_toevoegen.php';"/>

        <input class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" type="button" value="Terug"  onclick="window.location.href='admin.php';"/>
    </div>
</body>
<script src="../../Js/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(() => {
        //gebruikte deze video (destijds)
        //https://youtu.be/BIurvEtcev4

        $('#foodTable').DataTable({
            "columns": [
                {"data": "name"},
                {"data": "price"},
                {"data": "function"}
            ]
        });

        //foods
        $('#btnAddFood').on('click', function() {
            window.location.href = `addFood.php`;
        })
        // $('#foodTable tbody').on('click', '.btnEdit', function() {
        //     var id = $(this).attr('id');
        //     window.location.href = `editFood.php?id=${id}`;
        // })
        $('#foodTable tbody').on('click', '.btnDelete', function() {
            if (confirm("Weet je zeker dat je dit wil verwijderen?"))
            {
                var id = $(this).attr('id');
                window.location.href = `horeca.php?id=${id}&type=food`;
            }
        })
    })
</script>
<?php
}else{
    header('location: ../public/index.php');
}
}
include '../public/footer.php';
?>