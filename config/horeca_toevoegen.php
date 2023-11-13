<?php
include '../public/header.php';
require_once '../source/db_horeca.php';

if (isset($_COOKIE['CurrUser'])) {
    $user = new user(getUserById($_COOKIE['CurrUser']));
    if (checkAdmin($user->getKlasse())) {
        if (isset($_POST['toevoegen'])) {
            $name = $_POST['name'];
            $prijs = $_POST['price'];

            $insertId = insertHoreca($name, $prijs);

            if ($insertId > 0) {
                header('location: horeca.php');
                // moet nog een melding geven dat het is gelukt
                exit();
            }
        }
?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
        <body>
            <div class="flex justify-center w-[100vw] items-center">
                <div class="bg-slate-50 m-24 w-fit px-20 border-solid border-2 border-blackKleur rounded-lg">
                <h1 class="text-[40px] font-bold text-center pt-6">Toevoegen</h1>
    
                <div class="grid justify-items-center">
                    <form method="POST" action="">
                        <div class="w-full my-4">
                            <p class="font-bold">Naam</p>
                            <input type="text" name="name" class="py-2 px-4 rounded-sm border" placeholder="Naam" required />
                        </div>
                        <div class="w-full my-4">
                            <p class="font-bold">Prijs</p>
                            <input type="text" name="price" id="price" class="py-2 px-4 rounded-sm border" placeholder="Prijs" required />
                        </div>
                        <input name="toevoegen" type="submit" value="Toevoegen" class="h-10 px-5 text-blackKleur transition-colors duration-150 border       border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" />
                        <div class="flex flex-wrap pt-6">
                         <!-- terug knop -->
                        <input class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" type="button" value="Terug"  onclick="window.location.href='horeca.php';"/> 
                        </div> 
                    </form>
                    
                    </div>   
                </div>

            </div>

            <script>
                $(document).ready(function() 
                {
                    $('#price').on('input', function() 
                    {
                        var inputValue = $(this).val();
                        var pattern = /^[0-9]+(\.[0-9]{0,2})?$/;
                        
                        if (!pattern.test(inputValue)) 
                        {
                            $(this).val('');
                        }
                    });
                });
            </script>
        </body>
<?php
    } else {
        header('location: ../public/index.php');
    }
    include '../public/footer.php';
}
?>
