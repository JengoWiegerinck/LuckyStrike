<?php
include '../public/header.php';
if(isset($_POST['toevoegen'])){
    $name = $_POST['name'];
    $prijs = $_POST['price'];
    
}
?>
<div class="py-20 px-[10%] min-w-[100vw] min-h-[100vh] bg-[#fdfde0]">
        <h1 class="text-[40px] font-bold">Toevoegen</h1>
        
        <div class="w-1/2 my-8">
            <form action="POST">
                <div class="w-full my-4">
                    <p class="font-bold">Naam</p>
                    <input type="number" name="name" class="py-2 px-4 rounded-sm border" placeholder="Naam" />
                </div>
                <div class="w-full my-4">
                    <p class="font-bold">Prijs</p>
                    <input type="number" name="price" class="py-2 px-4 rounded-sm border" placeholder="Prijs" />
                </div>
                <input name="toevoegen" type="submit" value="Toevoegen" class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur hover:text-whiteKleur hover:border-redKleur" />
            </form>
        </div>