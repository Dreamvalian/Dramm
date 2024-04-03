<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <link rel="stylesheet" href="styles/navbar.css">
  <link rel="stylesheet" href="styles/pages/contact.css">
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
          <a href="index.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="about.php" class="nav-link">About</a>
        </li>
        <li class="nav-item">
          <a href="product.php" class="nav-link">Product</a>
        </li>
        <li class="nav-item">
          <a href="collab.php" class="nav-link">Collab</a>
        </li>
      </ul>
    </nav>
  </header>
  <main>
    <section class="contact-form">
      <h2>Send us a message</h2>
      <form action="contact-submit.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="contact_name" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="contact_email" required>
        <label for="message">Message:</label>
        <textarea id="message" name="contact_message" rows="4" required></textarea>
        <button type="submit">Send</button>
      </form>
    </section>
    <section class="contact-info">
      <h2>Contact Information</h2>
      <p>Email: info@dramm.com</p>
      <p>Phone: +1 (800) DR (1-800-662-5337)</p>
      <p>Address: 182 Heritage Lane, Oakwood, Kentucky, USA</p>
    </section>
  </main>
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
</body>

</html>