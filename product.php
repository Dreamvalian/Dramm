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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/navbar.css">
  <link rel="stylesheet" href="styles/pages/product.css">
  <link rel="stylesheet" href="styles/footer.css">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-fsSQIe1nM8ZhmWKuVu0jKAsz1d6xerF2pPn4mVny3A0Thdtmw2lE8x7lTrPSwR8qPCgeEr3iVU4Zh/sA/ltVwg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" type="image/svg+xml" href="public/favicon.svg" media="(prefers-color-scheme: dark)" />
  <title>Our Products</title>
</head>

<header class="header">
  <nav class="navbar container">
    <a class="brand-logo" href="index.php">
      <img src="assets/logo-text.svg" height="100%" alt="Logo of Company" />
    </a>
    <ul class="nav-list">
      <li class="nav-item">
        <a href="index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item">
        <a href="product-input.php" class="nav-link">Product Input</a>
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

<body>
  <div class="product-section">
    <h2 class="product-section-title">Our Products</h2>
    <div class="product-list">
      <?php

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<figure class="product-card">';
          echo '<img class="product-image" src="' . $row['product_image'] . '" width="50%" />';
          echo '<figcaption class="product-desc">';
          echo '<h3 class="product-name">' . $row['product_name'] . '</h3>';
          echo '<p class="product-desc">Type: ' . $row['product_type'] . '</p>';
          echo '<p class="product-desc">Age: ' . $row['product_age'] . '</p>';
          echo '<p class="product-desc">' . $row['product_description'] . '</p>';
          echo '<div class="product-buttons">';
          echo '<a class="product-cta" href="product-update.php?id=' . $row['product_id'] . '" class="btn-update">Update</a>';
          echo '<a class="product-cta" href="product-delete.php?id=' . $row['product_id'] . '" class="btn-delete">Delete</a>';
          echo '</div>';
          echo '</figcaption>';
          echo '</figure>';
        }
      } else {
        echo 'No products found.';
      }

      mysqli_close($conn);
      ?>
    </div>
  </div>
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