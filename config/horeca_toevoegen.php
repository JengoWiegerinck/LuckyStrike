<?php
ob_start(); // Start output buffering
include '../public/header.php';
require_once '../source/db_horeca.php';

if (isset($_COOKIE['CurrUser'])) {
    $user = new user(getUserById($_COOKIE['CurrUser']));
    if (checkAdmin($user->getKlasse())) {
        if (isset($_POST['toevoegen'])) {
            $name = $_POST['name'];
            $prijs = $_POST['price'];
            $image = $_POST['image'];
            $category = isset($_POST['category']) ? $_POST['category'] : '';
            $categori;
            if($category)
            {
                $categori = 'Drinken';
            }else{
                $categori = 'Eten';
            }

            $insertId = insertHoreca($name, $prijs, $image, $categori);

            if ($insertId > 0) {

                echo '<div class="flex items-center justify-center h-screen">';
                echo '<p class="text-green-500 text-4xl font-bold">Nieuw Item succesvol toegevoegt!</p>';
                echo '</div>';

                // add script to redirect to homepage after 3 seconds
                echo "<script>setTimeout(function(){ window.location.href = 'horeca.php'; }, 3000);</script>";
                
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

                        <div class="w-full my-4">
                            <div class="flex items-center">
                                <p class="font-bold mr-2">Eten</p>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="category" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                </label>
                                <p class="font-bold ml-2">Drinken</p>
                            </div>
                    </div>

                        <div class="w-full my-4">
                            <p class="font-bold">Image</p>
                            <input type="text" id="mijnInput" name="image" class="py-2 px-4 rounded-sm border" placeholder="Voer de URL van de afbeelding in..." oninput="updateWeergave()" required>
                            <img src="" id="weergave" alt="Afbeelding kan niet gevonden worden" width="500" height="600" style="display: none;">
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
                function updateWeergave() {
                    // Haal de waarde op van het input-veld met jQuery
                    var invoerWaarde = $('#mijnInput').val();

                    // Update de src van de afbeelding met de ingevoerde waarde met jQuery
                    $('#weergave').attr('src', invoerWaarde);
                    // Selecteer de afbeelding met jQuery
                    var afbeelding = $('#weergave');
                    // Verberg de afbeelding als de ingevoerde waarde leeg is, anders toon de afbeelding en update de src
                    if (invoerWaarde === '') {
                        afbeelding.hide();
                    } else {
                        afbeelding.show();
                        // Update de src van de afbeelding met de ingevoerde waarde met jQuery
                        afbeelding.attr('src', invoerWaarde);
                    }
                }
            </script>
        </body>
<?php
    } else {
        header('location: ../public/index.php');
    }
    include '../public/footer.php';
}
ob_end_flush(); // Flush the output buffer
?>
