<?php
include '../public/header.php';
require_once("../source/useful_functions.php");
require_once("../source/db_user.php");

if (isset($_COOKIE['CurrUser'])) {
    $user = new user(getUserById($_COOKIE['CurrUser']));
    if (checkAdmin($user->getKlasse()))
    {

        if (isset($_GET['id']) && isset($_GET['type']))
        {
            if ($_GET['type'] == 'user')
            {
                deleteUser($_GET['id']);
            }
        }
    
?>

<link rel="stylesheet" href="../../Css/admin.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<link href="//cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@600;700&family=Open+Sans:wght@500;600;800&family=Rubik:wght@500&display=swap" rel="stylesheet">
<body>
    <div class="px-8 ">
        <h1 class="bold text-center">klanten</h1>
        <table id="customerTable" class="table table-striped">
            <thead>
                <tr>
                    <th>email</th>
                    <th>gebruikersnaam</th>
                    <th>wachtwoord</th>
                    <th>functie</th>
                </tr>
            </thead>
            <tbody>
                <?php $customers = getAllCustomer();
                while ($customer = $customers->fetch_assoc()) {?>
                <tr>
                    <td><?php echo $customer['email']?></td>
                    <td><?php echo $customer['username']?></td>
                    <td><?php echo $customer['password']?></td>
                    <td>
                        <button class="functionBtn btnDelete" title="Verwijderen" id="<?php echo $customer['id'] ?>"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>

        <input class="h-10 px-5 text-blackKleur transition-colors duration-150 border       border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" type="button" value="Terug"  onclick="window.location.href='admin.php';"/>
    </div>
</body>
<script src="../../Js/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(() => {
        //gebruikte deze video (destijds)
        //https://youtu.be/BIurvEtcev4

        $('#customerTable').DataTable({
            "columns": [
                {"data": "email"},
                {"data": "name"},
                {"data": "password"},
                {"data": "function"}
            ]
        });


        $('#customerTable tbody').on('click', '.btnDelete', function() {
            if (confirm("Weet je zeker dat je dit wil verwijderen?"))
            {
                var id = $(this).attr('id');
                window.location.href = `customer.php?id=${id}&type=user`;
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