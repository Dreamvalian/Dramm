<?php
session_start();
require_once('connection/db_connect.php');

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$sql = "SELECT * FROM product";
$result = mysqli_query($conn, $sql);

?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Dramm, Heirloom Quality, Every Sip.</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="center;tion" content="Dramm, Heirloom Quality, Every Sip." />
  <meta name="keywords" content="Whiskey, Whisky, Heirloom, Malt, Alcohol">
  <meta name="author" content="company">
  <meta name="Version" content="v0.1">
  <link rel="stylesheet" href="styles/navbar.css">
  <link rel="stylesheet" href="styles/home/hero.css">
  <link rel="stylesheet" href="styles/home/product.css">
  <link rel="stylesheet" href="styles/home/feature.css">
  <link rel="stylesheet" href="styles/home/carousel.css">
  <link rel="stylesheet" href="styles/home/faq.css">
  <link rel="stylesheet" href="styles/footer.css">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-fsSQIe1nM8ZhmWKuVu0jKAsz1d6xerF2pPn4mVny3A0Thdtmw2lE8x7lTrPSwR8qPCgeEr3iVU4Zh/sA/ltVwg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" type="image/svg+xml" href="public/favicon.svg" media="(prefers-color-scheme: dark)" />
</head>

<body>
  <header class="header">
    <nav class="navbar container">
      <a class="brand-logo" href="index.php">
        <img src="assets/logo-text.svg" height="100%" alt="Logo of Company" />
      </a>
      <ul class="nav-list">
        <li class="nav-item">
          <a href="about.php" class="nav-link">About</a>
        </li>
        <li class="nav-item">
          <a href="product.php" class="nav-link">Product</a>
        </li>
        <li class="nav-item">
          <a href="contact.php" class="nav-link">Contact</a>
        </li>
        <li class="nav-item">
          <a href="collab.php" class="nav-link">Collab</a>
        </li>
        <?php
        if (isset($_SESSION['user_id'])) {
          echo '<li class="nav-item">';
          echo '<a href="logout.php" class="nav-link">Logout</a>';
          echo '</li>';
        } else {
          echo '<li class="nav-item">';
          echo '<a href="login.php" class="nav-link">Login</a>';
          echo '</li>';
        }
        ?>
      </ul>
    </nav>
  </header>
  <section class="hero container">
    <div class="hero-content">
      <h1 class="hero-title">The rich heritage and craftsmanship
        behind <strong style="color: e69500;">
          Whiskey production.
        </strong></h1>
      <p class="hero-subtitle">A smooth and well-balanced blend of whiskeys, perfect for sipping neat or on the rocks.
      </p>
      <a class="hero-cta" href="about.php" class="btn-primary">Learn More</a>
    </div>
    <div class="hero-wrapper">
      <video autoplay loop muted playsinline class="image-hero" width="100%">
        <source src="assets/trailer.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    </div>
  </section>
  <section class="container">
    <div class="product-section">
      <h2 class="product-section-title">Our Products
      </h2>
      <div class="product-list">
        <?php
        $count = 0;
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            if ($count >= 3) {
              break;
            }
            echo '<figure class="product-card">';
            echo '<img class="product-image" src="' . $row['product_image'] . '" width="50%" />';
            echo '<figcaption class="product-desc">';
            echo '<h3 class="product-name">' . $row['product_name'] . '</h3>';
            echo '<p class="product-desc">Type: ' . $row['product_type'] . '</p>';
            echo '<p class="product-desc">' . $row['product_description'] . '</p>';
            echo '</figcaption>';
            echo '</figure>';
            $count++;
          }
        } else {
          echo 'No products found.';
        }
        ?>
      </div>
    </div>
    <div class="product-feature">
      <div class="product-feature--image">
        <img class="" src="assets/hero-image3.webp" width="100%" alt="Header of Company" class="image-hero" />
      </div>
      <div class="feature-row">
        <ul class="feature-list feature-list--icon">
          <li class="wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
            <div class="feature-container">
              <i class="fas fa-usd"></i>
              <div class="text">
                <h3>Whisky deals</h3>
                <p>Over 20,000 daily updated prices and 800 whisky deals.</p>
              </div>
            </div>
          </li>
          <li class="wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
            <div class="feature-container">
              <i class="fas fa-database"></i>
              <div class="text">
                <h3>Curated database</h3>
                <p>Every whisky is manually checked.</p>
              </div>
            </div>
          </li>
          <li class="wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
            <div class="feature-container">
              <i class="fas fa-newspaper"></i>
              <div class="text">
                <h3>Whisky News</h3>
                <p>Read the latest whisky news in one overview.</p>
              </div>
            </div>
          </li>
          <li class="wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
            <div class="feature-container">
              <i class="fas fa-map-marker"></i>
              <div class="text">
                <h3>Distillery Location</h3>
                <p>See the location of a distillery on the map.</p>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <div class="product-carousel">
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="assets/product-1.webp" class="d-block w-100" alt="Carousel image 1">
            <div class="carousel-caption d-none d-md-block">
              <h5>Slide 1</h5>
              <p>Vintage crystal glass of bourbon whiskey by an outdoor campfire.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="assets/product-2.webp" class="d-block w-100" alt="Carousel image 2">
            <div class="carousel-caption d-none d-md-block">
              <h5>Slide 2</h5>
              <p>Woodford Reserve Distiller’s Select Rye + Avo Uvezian Fogato.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="assets/product-3.webp" class="d-block w-100" alt="Carousel image 3">
            <div class="carousel-caption d-none d-md-block">
              <h5>Slide 3</h5>
              <p>
                After getting off the metro north, I was walking out to Lexington when I saw this store empty with the lights on.</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    <div class="faq-section">
      <h2>Frequently Asked Questions</h2>
      <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
              Have question about product or service?
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <p>What's the different between whiskey and whisky?</p>
              <p>The main difference between "whiskey" and "whisky" lies in their geographical origins. "Whiskey" with an "e" is typically used to refer to spirits produced in Ireland and the United States. On the other hand, "whisky" without an "e" is commonly used for spirits produced in Scotland, Canada, Japan, and other countries. However, there are exceptions to this rule, and some producers may choose to use one spelling over the other for stylistic or branding reasons.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://kit.fontawesome.com/f65a22530d.js" crossorigin="anonymous"></script>
  <script src="javascripts/bootstrap.min.js" crossorigin="anonymous"></script>
</body>


<footer class="footer">
  <div class="container footer-content">
    <div class="copyright">
      DRAMM © 2024
    </div>
    <div>
      Designed & Developed by Hanif Nahriya Nugraha
    </div>
  </div>
</footer>

</html>