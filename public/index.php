<?php include 'header.php'; ?>
<!-- Link Swiper's CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<div class="font-sans top-0 w-full h-screen">

<!-- Main Section on the Left -->
<section class="grid grid-cols-1 md:grid-cols-2 gap-8 p-4 ">

<div class="w-3/4 ml-20 text-center my-16 pb-8 border border-gray-300 rounded-lg shadow-lg">
    <div class="swiper mySwiper h-3/5 w-full">
        <div class="swiper-wrapper">
            <div class="swiper-slide h-full w-full">
                <img class="object-cover w-full h-full rounded-lg" src="../assets/img/slider_01.jpg" alt="Slide 1">
            </div>
            <div class="swiper-slide h-full w-full">
                <img class="object-cover w-full h-full rounded-lg" src="../assets/img/slider_02.jpg" alt="Slide 2">
            </div>
            <div class="swiper-slide h-full w-full">
                <img class="object-cover w-full h-full rounded-lg" src="../assets/img/slider_03.jpg" alt="Slide 3">
            </div>
            <div class="swiper-slide h-full w-full">
                <img class="object-cover w-full h-full rounded-lg" src="../assets/img/slider_04.jpg" alt="Slide 4">
            </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <h1 class="text-4xl font-bold my-8">Prijzen</h1>
    <p>Maandag t/m donderdag: € 24,00 per baan per uur</p>
    <p>Vrijdag t/m zondag tot 18:00: € 28,00 per baan per uur</p>
    <p>Vrijdag t/m zondag vanaf 18:00: € 33,50 per baan per uur</p>
</div>

<div class="container w-3/4 mx-auto text-center flex flex-col items-center justify-center">
    <div>
        <h2 class="text-4xl font-semibold text-gray-800">Welkom bij Lucky Strike Bowling!</h2>
        <p class="text-lg text-gray-600 mt-4">Ervaar de opwinding van het omverwerpen van kegels en geniet van een geweldige tijd met vrienden en familie.</p>
        <a href="reservation.php" class="inline-block mt-8 px-6 py-3 bg-yellowKleur text-whiteKleur font-bold rounded">Maak een reservering</a>
    </div>
</div>
</section>

    
</div>
<?php include 'footer.php'; ?>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    loop: true,
    speed: 1000,
    pagination: {
        el: ".swiper-pagination",
      },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
  });

</script>