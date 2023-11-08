<?php include 'header.php'; ?>
    <div class="py-20 px-[10%] min-w-[100vw] min-h-[100vh] bg-[#fdfde0]">
        <h1 class="text-[40px] font-bold">Reserveer een baan</h1>
        
        <div class="w-1/2 my-8">
            <form action="POST">
                <div class="w-full my-4">
                    <p class="font-bold">Starttijd</p>
                    <input type="date" class="py-2 px-4 rounded-sm border" placeholder="Starttijd" />
                </div>
                <div class="w-full my-4">
                    <p class="font-bold">Stoptijd</p>
                    <input type="date" class="py-2 px-4 rounded-sm border" placeholder="Stoptijd" />
                </div>
                <div class="w-full my-4">
                    <p class="font-bold">Deelnemers</p>
                    <input type="number" class="py-2 px-4 rounded-sm border" placeholder="Deelnemers" />
                </div>
                <div class="w-full my-4">
                    <p class="font-bold">Hulpmiddelen</p>
                    <input type="number" class="py-2 px-4 rounded-sm border" placeholder="Deelnemers" />
                </div>
                <input name="reservation" type="submit" value="Reserveren" class="font-semibold py-2 px-4 bg-red-700" />
            </form>
        </div>

        <?php 
            if(isset($_POST["reservation"])) {
                $participants = $_POST["participants"];
                $startTime = $_POST["participants"];
                $stopTime = $_POST["participants"];

                // $lanes = db_getData(" ");

                // db_insertData("
                //     INSERT INTO `reservation`(`id`, `userId`, `baanId`, `orderingId`, `price`, `startTime`, `stopTime`, `participants`) VALUES ('','$','','','','','','')
                // ")
            }
        ?>
    </div> 

<?php include 'footer.php'; ?>