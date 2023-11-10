<?php include 'header.php'; ?>
<!-- Link Swiper's CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<div class="font-sans top-0 w-full h-screen flex">

    <!-- Main Section on the Left -->
    <section class="w-full min-h-full  ">

        
<!-- Swiper -->
<div class="swiper mySwiper h-2/4 my-12 w-[90%]">
    <div class="swiper-wrapper">
      <div class="swiper-slide h-full w-full">
        <img class="object-cover w-full h-full" src="../assets/img/slider_01.jpg" alt="Slide 1">
      </div>
      <div class="swiper-slide h-full w-full">
        <img class="object-cover w-full h-full" src="../assets/img/slider_02.jpg" alt="Slide 2">
      </div>
      <div class="swiper-slide h-full w-full">
        <img class="object-cover w-full h-full" src="../assets/img/slider_03.jpg" alt="Slide 3">
      </div>
      <div class="swiper-slide h-full w-full">
        <img class="object-cover w-full h-full" src="../assets/img/slider_04.jpg" alt="Slide 4">
      </div>
      <div class="swiper-slide h-full w-full">
        <img class="object-cover w-full h-full" src="../assets/img/slider_05.jpg" alt="Slide 5">
      </div>
    </div>
  </div>

    
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-semibold text-gray-800">Welkom bij Lucky Strike Bowling!</h2>
            <p class="text-gray-600 mt-4">Ervaar de opwinding van het omverwerpen van kegels en geniet van een geweldige tijd met vrienden en familie.</p>
            <a href="#" class="inline-block mt-8 px-6 py-3 bg-yellowKleur text-whiteKleur font-bold rounded">Maak een reservering</a>
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
    autoplay: {
        delay: 1500,
        disableOnInteraction: false,
      },
  });
</script>