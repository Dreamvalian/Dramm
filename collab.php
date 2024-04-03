<?php
require_once('connection/db_connect.php');

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM store";
$result = mysqli_query($conn, $sql);

if (!$result) {
  die("Error executing query: " . mysqli_error($conn));
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Store Collaboration</title>
  <link rel="stylesheet" href="styles/navbar.css">
  <link rel="stylesheet" href="styles/pages/collab.css">
  <link rel="stylesheet" href="styles/footer.css">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-fsSQIe1nM8ZhmWKuVu0jKAsz1d6xerF2pPn4mVny3A0Thdtmw2lE8x7lTrPSwR8qPCgeEr3iVU4Zh/sA/ltVwg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" type="image/svg+xml" href="public/favicon.svg" media="(prefers-color-scheme: dark)" />

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
        <a href="about.php" class="nav-link">About</a>
      </li>
      <li class="nav-item">
        <a href="product.php" class="nav-link">Product</a>
      </li>
      <li class="nav-item">
        <a href="contact.php" class="nav-link">Contact</a>
      </li>
    </ul>
  </nav>
</header>

<body style="margin-top: 6rem;">
  <div class="container">
    <div class="collab-new">
      <h2>Add New Store</h2>
      <form action="collab-submit.php" method="POST">
        <label for="store_name">Store Name:</label>
        <input type="text" id="store_name" name="store_name" required><br><br>

        <label for="store_location">Store Location:</label>
        <input type="text" id="store_location" name="store_location" required><br><br>

        <label for="contact_information">Contact Information:</label>
        <input type="text" id="contact_information" name="contact_information"><br><br>

        <button type="submit">Add Store</button>
      </form>
    </div>

    <div class="collab-exist">
      <h2>Existing Stores</h2>
      <table class="table">
        <thead>
          <tr>
            <th>Store ID</th>
            <th>Store Name</th>
            <th>Store Location</th>
            <th>Contact Information</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['store_id'] . "</td>";
            echo "<td>" . $row['store_name'] . "</td>";
            echo "<td>" . $row['store_location'] . "</td>";
            echo "<td>" . $row['contact_information'] . "</td>";
            echo "<td><a href='collab-edit.php?id=" . $row['store_id'] . "'><i class='fas fa-edit'></i> Edit</a> | <a href='collab-delete.php?id=" . $row['store_id'] . "'> <i class='fas fa-trash-alt'></i> Delete</a></td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
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

<?php
mysqli_close($conn);
?>