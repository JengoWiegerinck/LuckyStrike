<?php
include 'header.php';
require_once("../source/db_functions.php");
require_once("../source/useful_functions.php");

$id = $_GET["id"];
$reservation = db_getData("SELECT * FROM reservation WHERE id = $id")->fetch_assoc();
$orderlines = db_getData("SELECT * FROM orderlines WHERE reservationId = $id");
?>
<div class="bg-white border rounded-lg shadow-lg px-6 py-8 max-w-md mx-auto mt-8">
    <h1 class="font-bold text-2xl my-4 text-center text-primary">Rekening</h1>
    <hr class="my-2">
    <div class="flex justify-between mb-6">
        <div class="text-gray-700">
            <div><b>Start: </b><?php echo formateDate($reservation["startTime"]) ?></div>
            <div><b>Eind: </b><?php echo formateDate($reservation["endTime"]) ?></div>
        </div>
    </div>
    <table class="w-full mb-8">
        <thead>
            <tr>
                <th class="text-left font-bold text-gray-700">Omschrijving</th>
                <th class="text-right font-bold text-gray-700">Prijs</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            while($orderline = $orderlines->fetch_assoc()) { 
            $foodId = $orderline["foodId"];
            $food = db_getData("SELECT * FROM food WHERE id = $foodId")->fetch_assoc();
            ?>
            <tr>
                <td class="text-left text-gray-700"><b class="mr-2">x<?php echo $orderline["amount"] ?></b><?php echo $food["name"] ?></td>
                <td class="text-right text-gray-700">€<?php echo $orderline["total"] ?></td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot class="border-t mt-2">
            <tr>
                <td class="text-left font-bold text-gray-700">Eetprijs</td>
                <td class="text-right text-gray-700">€<?php echo $reservation["extraPrice"] ?></td>
            </tr>
            <tr>
                <td class="text-left font-bold text-gray-700">Reserveringsprijs</td>
                <td class="text-right text-gray-700">€<?php echo $reservation["price"] ?></td>
            </tr>
            <tr>
                <td class="text-left font-bold text-gray-700">Totaalprijs</td>
                <td class="text-right font-bold text-gray-700">€<?php echo $reservation["extraPrice"] + $reservation["price"] ?></td>
            </tr>
        </tfoot>
    </table>
</div>