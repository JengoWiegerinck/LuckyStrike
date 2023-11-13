<?php
include '../public/header.php';
require_once("../source/useful_functions.php");
require_once("../source/db_user.php");
require_once("../source/db_lane.php");
require_once("../source/laneClass.php");
require_once("../source/db_reservation.php");
require_once("../source/reservationsClass.php");

if (isset($_COOKIE['CurrUser'])) {
    $user = new user(getUserById($_COOKIE['CurrUser']));
    if (checkAdmin($user->getKlasse()) || checkEmployee($user->getKlasse())) {
        if (isset($_GET['id']))
        {
             $reservation = new reservationsClass(getReservationById($_GET['id']));
             $user = new user(getUserById($reservation->getUserId()));
             $laneName = new laneClass(getLaneById($reservation->getLaneName()));
        if (isset($_POST['updaten'])){
            
            $id = $reservation->getId();
            $customerId = $user->getId();
            $laneName = $_POST['baan'];
            $priceBaan = $_POST['priceLane'];
            $priceFood = $_POST['priceFood'];
            $adult = $_POST['adult'];
            $child = $_POST['children'];
            $date = $_POST['date'];
            $startTime = $_POST['starttime'];
            $endTime = $_POST['stoptime'];
            
            $laneId = new laneClass(getLaneByName($laneName));
            
            $start = formateDateTime($date, $startTime);
            $end = formateDateTime($date, $endTime);


            $updated = updateReservation($customerId, $laneId->getId(), $priceBaan, $priceFood, $child, $adult, $start, $end, $id);

            header('Location: reservations.php');
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
                            <p class="font-bold">Klant naam:</p>
                            <input type="text" name="username" class="py-2 px-4 rounded-sm border" value="<?php echo $user->getEmail()?>" readonly />
                        </div>
                        <div class="w-full my-4">
                            <p class="font-bold">Baan:</p>
                            <select name="baan" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                                <?php $lanes = getAllLane();

                                while ($lane = $lanes->fetch_assoc()) {
                                    print_r($lane['username']);
                                    if($lane['username'] == $laneName->getUsername())
                                    {
                                        echo "<option value=". $lane['username'] . " selected>". $lane['username'] . "</option>";
                                    }else {
                                        echo "<option value=". $lane['username'] . ">". $lane['username'] . "</option>";
                                    }
                                    } ?>
                            </select>
                        </div>
                        <div class="w-full my-4">
                            <p class="font-bold">Prijs baan:</p>
                            <input type="number" name="priceLane" id="price" class="py-2 px-4 rounded-sm border" value="<?php echo $reservation->getPriceLane()?>" required />
                        </div>
                        <div class="w-full my-4">
                            <p class="font-bold">Prijs eten:</p>
                            <input type="number" name="priceFood" id="price" class="py-2 px-4 rounded-sm border" value="<?php echo $reservation->getPriceFood()?>" required />
                        </div>
                        <div class="w-full my-4">
                            <p class="font-bold">Volwassene:</p>
                            <input type="number" name="adult" class="py-2 px-4 rounded-sm border" value="<?php echo $reservation->getAdults()?>" required />
                        </div>
                        <div class="w-full my-4">
                            <p class="font-bold">Kinderen:</p>
                            <input type="number" name="children" class="py-2 px-4 rounded-sm border" value="<?php echo $reservation->getChildren()?>" required />
                        </div>
                        <div class="md:col-span-3">
                        <p class="font-bold">Datum:</p>
                        <input type="date" name="date" id="date" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="<?php echo formateDatum($reservation->getStartTime())?>" placeholder="" />
                        </div>
                        <div class="w-full my-4">
                        <p class="font-bold">Starttijd:</p>
                        <input id="appt-time" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" list="times" type="time" name="starttime" value="<?php echo formateTime($reservation->getStartTime())?>" step="3600">
                          <?php 
                          if(date("l") == "Monday" || date("l") == "Tuesday" || date("l") == "Wednesday" || date("l") == "Thursday")
                          {
                          ?>
                          <datalist id="times">
                              <option value="14:00:00">
                              <option value="15:00:00">
                              <option value="16:00:00">
                              <option value="17:00:00">
                              <option value="18:00:00">
                              <option value="19:00:00">
                              <option value="20:00:00">
                              <option value="21:00:00">
                              <option value="22:00:00">
                          </datalist>
                          <?php
                          }
                          if(date("l") == "Friday" || date("l") == "Saturday" || date("l") == "Sunday")
                          {
                            ?>
                            <datalist id="times">
                              <option value="14:00:00">
                              <option value="15:00:00">
                              <option value="16:00:00">
                              <option value="17:00:00">
                              <option value="18:00:00">
                              <option value="19:00:00">
                              <option value="20:00:00">
                              <option value="21:00:00">
                              <option value="22:00:00">
                              <option value="23:00:00">
                              <option value="00:00:00">
                          </datalist>
                            <?php
                          }
                          ?>
                        </div>
                        <div class="w-full my-4">
                        <p class="font-bold">Stoptijd:</p>
                        <input id="appt-time" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" list="times" type="time" name="stoptime" value="<?php echo formateTime($reservation->getEndTime())?>" step="3600">
                          <?php 
                          if(date("l") == "Monday" || date("l") == "Tuesday" || date("l") == "Wednesday" || date("l") == "Thursday")
                          {
                          ?>
                          <datalist id="times">
                              <option value="14:00:00">
                              <option value="15:00:00">
                              <option value="16:00:00">
                              <option value="17:00:00">
                              <option value="18:00:00">
                              <option value="19:00:00">
                              <option value="20:00:00">
                              <option value="21:00:00">
                              <option value="22:00:00">
                          </datalist>
                          <?php
                          }
                          if(date("l") == "Friday" || date("l") == "Saturday" || date("l") == "Sunday")
                          {
                            ?>
                            <datalist id="times">
                              <option value="14:00:00">
                              <option value="15:00:00">
                              <option value="16:00:00">
                              <option value="17:00:00">
                              <option value="18:00:00">
                              <option value="19:00:00">
                              <option value="20:00:00">
                              <option value="21:00:00">
                              <option value="22:00:00">
                              <option value="23:00:00">
                              <option value="00:00:00">
                          </datalist>
                            <?php
                          }
                          ?>
                        </div>
                        <input name="updaten" type="submit" value="updaten" class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur hover:text-whiteKleur hover:border-redKleur" />
                        <div class="flex flex-wrap pt-6">
                         <!-- terug knop -->
                        <input class="h-10 px-5 text-blackKleur transition-colors duration-150 border border-blackKleur rounded-lg focus:shadow-outline hover:bg-redKleur   hover:text-whiteKleur hover:border-redKleur" type="button" value="Terug"  onclick="window.location.href='reservations.php';"/> 
                        </div> 
                    </form>
                    
                    </div>   
                </div>

            </div>
        </body>
<?php
        }  
    } else {
        header('location: ../public/index.php');
    }
    include '../public/footer.php';
}
?>
