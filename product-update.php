<?php
session_start();
require_once('connection/db_connect.php');

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$productTypes = array("Single Malt", "Blended");

if (isset($_GET['id'])) {
  $product_id = $_GET['id'];

  $sql = "SELECT * FROM product WHERE product_id = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "i", $product_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $product = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $product_name = $_POST['product_name'];
  $product_type = $_POST['product_type'];
  $product_age = $_POST['product_age'];
  $product_description = $_POST['product_description'];
  $product_image = $_POST['product_image'];

  $sql = "UPDATE product SET product_name=?, product_type=?, product_age=?, product_description=?, product_image=? WHERE product_id=?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "sssisi", $product_name, $product_type, $product_age, $product_description, $product_image, $product_id);
  mysqli_stmt_execute($stmt);

  if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo '<script>alert("Product updated successfully!");</script>';
  }
  echo '<script>window.location.href = "product.php";</script>';
  exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Product</title>
  <link rel="stylesheet" href="styles/navbar.css">
  <link rel="stylesheet" href="styles/pages/product-update.css">
  <link rel="stylesheet" href="styles/footer.css">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-fsSQIe1nM8ZhmWKuVu0jKAsz1d6xerF2pPn4mVny3A0Thdtmw2lE8x7lTrPSwR8qPCgeEr3iVU4Zh/sA/ltVwg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" type="image/svg+xml" href="public/favicon.svg" media="(prefers-color-scheme: dark)" />

</head>

<body>
  <div class="container">
    <h2>Update Product</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $product_id); ?>" method="post">
      <div class="form-group">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" value="<?php echo $product['product_name']; ?>" required>
      </div>
      <div class="form-group">
        <label for="product_type">Product Type:</label>
        <select id="product_type" name="product_type" required>
          <option value="">Select Product Type</option>
          <?php
          foreach ($productTypes as $type) {
            echo "<option value='" . $type . "' ";
            if ($product['product_type'] == $type) {
              echo "selected";
            }
            echo ">" . $type . "</option>";
          }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="product_age">Product Age:</label>
        <input type="number" id="product_age" name="product_age" value="<?php echo $product['product_age']; ?>" required>
      </div>
      <div class="form-group">
        <label for="product_description">Product Description:</label>
        <textarea id="product_description" name="product_description"><?php echo $product['product_description']; ?></textarea>
      </div>
      <div class="form-group">
        <label for="product_image">Product Image URL:</label>
        <input type="text" id="product_image" name="product_image" value="<?php echo $product['product_image']; ?>">
      </div>
      <button type="submit">Update Product</button>
    </form>
  </div>
</body>

</html>