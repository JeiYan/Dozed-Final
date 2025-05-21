<?php include_once('../components/header.php')?>
<head>
<!-- Start Image Carousel -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

</head>
<style>
*{
  font-size: 21px;
  color: #5C3A21;
}
.tab-button {
  font-size: 21px;
  padding: 10px 20px;
  margin: 5px;
  border: none;
  border-radius: 8px;
  background-color: #e6ccb2;
  color: #5C3A21;
  font-weight: bold;
  cursor: pointer;
}
.tab-button:hover {
  background-color: #d6b28a;
}
.tab-content h3 {
  font-size: 42px;
  color: #5C3A21;
  margin-top: 20px;
}

.tab-button:active {
  background-color:rgb(226, 132, 45); /* Change this to any color you like */
  color: #fff; /* Change text color when selected */
}

.tab-button.selected {
  background-color:rgb(226, 132, 45); /* Selected background color */
  color: #fff; /* Change text color when selected */
}

/* Basic styling for the discover section */
.discover-section {
    background-image: url('../image/bg_4.jpg'); /* Replace with your image path */
    background-size: cover; /* Ensures the image covers the entire area */
    background-position: center; /* Centers the image */
    background-repeat: no-repeat; /* Prevents tiling */
    padding: 5rem 0; /* Vertical spacing */
    text-align: center; /* Center align content */
}

.discover-section h1 {
    font-family: 'Copperplate', serif;
    font-size: 48px;
    margin-bottom: 1rem;
}

.discover-section h1 span {
    color: #c49b63; /* Gold accent color for "Discover" */
}

.discover-section p {
    font-size: 18px;
    color: #ccc; /* Light gray for subtext */
    max-width: 800px; /* Limit width for better readability */
    margin: 0 auto; /* Center the paragraph */
}

    /* Basic styling for the carousel */
    #image-carousel {
    max-width: 650px; /* Adjust width as needed */
    margin: 1rem auto;
    }

    .splide__slide img {
        width: 100%;
        height: auto;
        display: block;
        border-radius: 10px;
    }

    .carousel-caption {
        position: absolute;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        width: 100%;
        padding: 10px;
        text-align: left;
        font-size: 1.2rem;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        transition: opacity 0.3s ease;
    }

</style>


<!-- Hero Section with Video Background and Text Overlay -->
<section id="hero" style="position: relative;">
    <video autoplay muted loop playsinline style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
        <source src="../image/coffee.mp4" type="video/mp4">
        <!-- Add additional source elements for 
        other video formats if needed -->
    </video>

    <div class="hero container" style="position: relative; z-index: 1;">
        <div>
            <h1><strong><h1 class="text-center" style="font-family:Copperplate; color:whitesmoke;"> Dozed</h1><span></span></strong></h1>
            <h1><strong style="color:white;"> Great Coffee | Good Coffee<span></span></strong></h1>
            <a href="#projects" type="button" class="cta">MENU</a>
        </div>
    </div>
</section>
<!-- End Hero Section -->


  <!-- Best Seller's Section -->
<!-- Discover Section -->
<section class="discover-section" style="background-color: #e6ccb2; padding: 5rem 0;">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <!-- Heading -->
                <h1 class="mb-3" style="font-family: 'Great Vibes', cursive;, serif; font-size: 48px;">
                <span style="color: #c49b63; font-size: 80px;">Discover</span>
                    <br> Best Coffee Sellers
                </h1>
                <br>
                <!-- Subheading -->
                <p class="lead mb-0" style="font-size: 18px; color: #ccc;">
                Discover the best-selling coffee flavors loved by locals and travelers alike — crafted right here in Ilocos Norte.
                </p>
            </div>
        </div>

        <!-- Image Carousel -->
        <div class="carousel-container">
            <div id="image-carousel" class="splide" aria-label="Menu Image Carousel">
                <div class="splide__track">
                    <ul class="splide__list">
                        <!-- Slide 1 -->
                        <li class="splide__slide">
                            <img src="../image/menu-1.jpg" alt="Drinks">
                            <div class="carousel-caption">Artisanal Latte with Heartfelt Detail</div>
                        </li>
                        <!-- Slide 2 -->
                        <li class="splide__slide">
                            <img src="../image/menu-2.jpg" alt="Drinks">
                            <div class="carousel-caption">Sustainable Sip: Our Eco-Friendly Coffee to Go</div>
                        </li>
                        <!-- Slide 3 -->
                        <li class="splide__slide">
                            <img src="../image/menu-3.jpg" alt="Drinks">
                            <div class="carousel-caption">Cool & Creamy: Perfect Iced Coffee for Summer Days</div>
                        </li>
                        <!-- Slide 4 -->
                        <li class="splide__slide">
                            <img src="../image/menu-4.jpg" alt="Drinks">
                            <div class="carousel-caption">Elegant Cappuccino: Rich Flavor, Perfect Balance</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    new Splide('#image-carousel', {
        type: 'loop', // Enable looping
        perPage: 1,   // Show one slide at a time
        autoplay: true, // Optional: Auto-play the carousel
        interval: 3000, // Change slide every 3 seconds
        arrows: true,   // Show navigation arrows
        pagination: true, // Show pagination dots
    }).mount();
});
</script>
<!-- End Image Carousel -->
  
<!-- Menu Section -->
<section id="projects" style="padding: 60px 20px; background-color: #fef9f5;">
  <div class="projects container" style="max-width: 1200px; margin: auto;">
    <!-- Header -->
    <div class="projects-header" style="text-align: center; margin-bottom: 50px;">
      <h1 class="section-title" style="font-size: 48px; font-weight: bold; color: #5C3A21;">
        Me<span style="color: #B08968; font-size: 48px;">n</span>u
      </h1>
    </div>

    <!-- Category Dropdown -->
    <div style="text-align: center; margin-bottom: 40px;">
      <select id="menu-category" class="menu-category" onchange="switchCategory(this.value)" style="
        padding: 12px 20px;
        font-size: 18px;
        border-radius: 8px;
        border: 1px solid #d6c2a8;
        background-color: #fffaf3;
        color: #5C3A21;">
        <option value="main">MAIN DISHES</option>
        <option value="side">SIDE DISHES</option>
        <option value="drink">DRINKS</option>
      </select>
    </div>

    <!-- Tabs Container -->
    <div id="menu-content">

      <!-- MAIN DISHES -->
      <div class="menu-section" id="main" style="display: block;">
        <?php
        $mainGroups = [];
        foreach ($mainDishes as $item) {
          $mainGroups[$item['item_type']][] = $item;
        }
        ?>
        <div class="tabs">
          <?php foreach ($mainGroups as $type => $items): ?>
            <button class="tab-button" onclick="showItems('main-<?php echo md5($type); ?>')"><?php echo $type; ?></button>
          <?php endforeach; ?>
        </div>
        <?php foreach ($mainGroups as $type => $items): ?>
          <div class="tab-content" id="main-<?php echo md5($type); ?>" style="display: none;">
            <h3><?php echo $type; ?></h3>
            <?php foreach ($items as $item): ?>
              <p>
                <strong><?php echo $item['item_name']; ?></strong> -
                ₱<?php echo $item['item_price']; ?>
              </p>
              <hr>
            <?php endforeach; ?>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- SIDE DISHES -->
      <div class="menu-section" id="side" style="display: none;">
        <?php
        $sideGroups = [];
        foreach ($sides as $item) {
          $sideGroups[$item['item_type']][] = $item;
        }
        ?>
        <div class="tabs">
          <?php foreach ($sideGroups as $type => $items): ?>
            <button class="tab-button" onclick="showItems('side-<?php echo md5($type); ?>')"><?php echo $type; ?></button>
          <?php endforeach; ?>
        </div>
        <?php foreach ($sideGroups as $type => $items): ?>
          <div class="tab-content" id="side-<?php echo md5($type); ?>" style="display: none;">
            <h3><?php echo $type; ?></h3>
            <?php foreach ($items as $item): ?>
              <p>
                <strong><?php echo $item['item_name']; ?></strong> -
                ₱<?php echo $item['item_price']; ?>
              </p>
              <hr>
            <?php endforeach; ?>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- DRINKS -->
      <div class="menu-section" id="drink" style="display: none;">
        <?php
        $drinkGroups = [];
        foreach ($drinks as $item) {
          $drinkGroups[$item['item_type']][] = $item;
        }
        ?>
        <div class="tabs">
          <?php foreach ($drinkGroups as $type => $items): ?>
            <button class="tab-button" onclick="showItems('drink-<?php echo md5($type); ?>')"><?php echo $type; ?></button>
          <?php endforeach; ?>
        </div>
        <?php foreach ($drinkGroups as $type => $items): ?>
          <div class="tab-content" id="drink-<?php echo md5($type); ?>" style="display: none;">
            <h3><?php echo $type; ?></h3>
            <?php foreach ($items as $item): ?>
              <p>
                <strong><?php echo $item['item_name']; ?></strong> -
                ₱<?php echo $item['item_price']; ?>
              </p>
              <hr>
            <?php endforeach; ?>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>


  
  <!-- About Section -->
<section id="about">
  <div class="about container">
    <div class="col-right">
        <h1 class="section-title" >About <span>Us</span></h1>
        <h2>Welcome to Dozed – The Most Instagrammable Coffee Shop in Ilocos!</h2>
 <p> 
 At Dozed, we believe that a great coffee experience is about more than just a cup of coffee; it's about creating moments that leave a lasting impression. Nestled in the heart of Ilocos, Dozed is a cozy and inviting coffee shop that has quickly become a favorite spot for coffee lovers and Instagram enthusiasts alike. Our beautifully designed space offers a blend of modern aesthetics and a warm, welcoming atmosphere, making it the perfect place to unwind, catch up with friends, or get some work done while enjoying your favorite coffee.
 </p>
 <p>
 But we’re more than just a coffee shop – we are a haven for those who appreciate good food and great company. Alongside our expertly crafted espresso-based drinks, we offer a diverse menu that includes delicious meals for every taste. From freshly baked pastries and hearty sandwiches to savory pasta dishes and flavorful rice meals, there's something for everyone at Dozed. We carefully select the finest ingredients to ensure that every bite is as satisfying as the last.
 </p>
 <p>
 At Dozed, we aim to be a space where you can connect with yourself, your loved ones, or your colleagues. Whether you're looking for a place to focus on personal growth, team development, or simply relax, we’ve created an environment that encourages meaningful experiences. Our space is also designed to cater to students, corporate groups, and families, offering a variety of programs and activities that foster creativity, collaboration, and relaxation. Whether you’re meeting with a client, working on a group project, or spending quality time with family, Dozed is the perfect backdrop for all your moments.
</p>
 <p>
 Our mission is to provide more than just a café experience – we want to be a part of your journey. Whether you're fueling your day with our signature drinks or enjoying a meal with friends, Dozed is here to inspire, rejuvenate, and bring people together. Visit us today and experience a coffee shop like no other.
 </p>
    
      </div>
    </div>
  </section>
  <!-- End About Section -->
  
  
 <!-- Contact Section -->
<section id="contact">
  <div class="contact container">
    <div>
      <h1 class="section-title">Contact <span>info</span></h1>
    </div>
    <div class="contact-items">
      <div class="contact-item contact-item-bg">
        <div class="contact-info">
          <div class='icon'><img src="../image/icons8-phone-100.png" alt=""/></div>
          <h1>Phone</h1>
          <h2>+63919216763</h2>
        </div>
      </div>
      
      <div class="contact-item contact-item-bg"> 
        <div class="contact-info">
          <div class='icon'><img src="../image/icons8-email-100.png" alt=""/></div>
          <h1>Email</h1>
          <h2>dozedcoffeshop@gmail.com</h2> 
        </div>
      </div>
      
      <div class="contact-item contact-item-bg">
        <div class="contact-info">
          <div class='icon'> <img src="../image/icons8-home-address-100.png" alt=""/></div>
          <h1>Address</h1>
          <h2>16-S Quilling Sur, Batac, Ilocos Norte, Philippines, 2906</h2>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Contact Section -->


<!-- Scripts -->
<script>
function switchCategory(categoryId) {
  const sections = document.querySelectorAll('.menu-section');
  sections.forEach(section => {
    section.style.display = 'none';
  });
  document.getElementById(categoryId).style.display = 'block';

  // Automatically click the first tab in the selected section
  const firstTab = document.querySelector(`#${categoryId} .tab-button`);
  if (firstTab) {
    firstTab.click();
  }
}

function showItems(id) {
  const allTabs = document.querySelectorAll('.tab-content');
  allTabs.forEach(tab => {
    tab.style.display = 'none';
  });
  const target = document.getElementById(id);
  if (target) {
    target.style.display = 'block';
  }
}

document.querySelectorAll('.tab-button').forEach(button => {
  button.addEventListener('click', () => {
    // Remove 'selected' class from all buttons
    document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('selected'));
    
    // Add 'selected' class to the clicked button
    button.classList.add('selected');
  });
});

</script>

<!-- Styles -->


<?php 
include_once('../components/footer.php');
?>