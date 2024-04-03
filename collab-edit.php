<?php
session_start();
require_once('connection/db_connect.php');

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

if (isset($_GET['id'])) {
  $store_id = $_GET['id'];

  $sql = "SELECT * FROM store WHERE store_id = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "i", $store_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $store = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $store_name = $_POST['store_name'];
  $store_location = $_POST['store_location'];
  $contact_information = $_POST['contact_information'];

  $sql = "UPDATE store SET store_name=?, store_location=?, contact_information=? WHERE store_id=?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "sssi", $store_name, $store_location, $contact_information, $store_id);
  mysqli_stmt_execute($stmt);

  if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo '<script>alert("Store updated successfully!");</script>';
  }
  echo '<script>window.location.href = "collab.php";</script>';
  exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Store</title>
  <link rel="stylesheet" href="styles/navbar.css">
  <link rel="stylesheet" href="styles/pages/collab-update.css">
  <link rel="stylesheet" href="styles/footer.css">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-fsSQIe1nM8ZhmWKuVu0jKAsz1d6xerF2pPn4mVny3A0Thdtmw2lE8x7lTrPSwR8qPCgeEr3iVU4Zh/sA/ltVwg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" type="image/svg+xml" href="public/favicon.svg" media="(prefers-color-scheme: dark)" />

</head>

<body>
  <div class="container">
    <h2>Update Store</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $store_id); ?>" method="post">
      <div class="form-group">
        <label for="store_name">Store Name:</label>
        <input type="text" id="store_name" name="store_name" value="<?php echo $store['store_name']; ?>" required>
      </div>
      <div class="form-group">
        <label for="store_location">Store Location:</label>
        <input type="text" id="store_location" name="store_location" value="<?php echo $store['store_location']; ?>" required>
      </div>
      <div class="form-group">
        <label for="contact_information">Contact Information:</label>
        <input type="text" id="contact_information" name="contact_information" value="<?php echo $store['contact_information']; ?>">
      </div>
      <button type="submit">Update Store</button>
    </form>
  </div>
</body>

</html>