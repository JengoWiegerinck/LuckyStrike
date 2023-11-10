<?php include 'header.php'; ?>
    <div class="py-20 px-[10%] ">

        <!-- component -->

  <div class="container max-w-screen-lg mx-auto">
    <div>
    

      <div class="bg-whiteKleur rounded shadow-lg p-4 px-4 md:p-8 mb-6">
        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
          <div class="text-blackKleur">
            <p class="font-medium text-blackKleur">Reserveren</p>
            <p>Vul hier de details in van de reservering.</p>
          </div>

          <div class="lg:col-span-2">
            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
              <div class="md:col-span-5">
                <label for="username">Gebruikersnaam</label>
                <input type="text" name="username" id="username" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="Gebruikersnaam"/>
              </div>

              <div class="md:col-span-5">
                <label for="email">Emailadres</label>
                <input type="text" name="email" id="email" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="John@email.com" />
              </div>

              <div class="md:col-span-3">
                <label for="date">Datum</label>
                <input type="date" name="date" id="date" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
              </div>

              <div class="md:col-span-1">
                <label for="startTime">Starttijd</label>
                <input type="time" name="startTime" id="startTime" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
              </div>

              <div class="md:col-span-1">
                <label for="stopTime">Stoptijd</label>
                <input type="time" name="stopTime" id="stopTime" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
              </div>

              <div class="md:col-span-2">
                <label for="volwassen">Hoeveel volwassenen?</label>
                <div class="h-10 w-28 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                  <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-r border-gray-200 transition-all text-gray-500 hover:text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                  </button>
                  <input name="volwassen" id="volwassen" placeholder="0" class="px-2 text-center appearance-none outline-none text-gray-800 w-full bg-transparent" value="0" />
                  <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-l border-gray-200 transition-all text-gray-500 hover:text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 fill-current" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </div>
              </div>

              <div class="md:col-span-2">
                <label for="kinderen">Hoeveel kinderen?</label>
                <div class="h-10 w-28 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                  <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-r border-gray-200 transition-all text-gray-500 hover:text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                  </button>
                  <input name="kinderen" id="kinderen" placeholder="0" class="px-2 text-center appearance-none outline-none text-gray-800 w-full bg-transparent" value="0" />
                  <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-l border-gray-200 transition-all text-gray-500 hover:text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 fill-current" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </div>
              </div>
      
              <div class="md:col-span-5">
                <div class="inline-flex items-center">
                  <input type="checkbox" name="hulpmiddelen" id="hulpmiddelen" class="form-checkbox" />
                  <label for="hulpmiddelen" class="ml-2">Ik wil graag een baan met hulpmiddelen</label>
                </div>
              </div>

              <div class="md:col-span-5 text-right">
                <div class="inline-flex items-end">
                  <button class="bg-yellowKleur hover:bg-blackKleur text-white font-bold py-2 px-4 rounded">Submit</button>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



        
        <!-- <div class="w-1/2 my-8">
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
        </div> -->

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