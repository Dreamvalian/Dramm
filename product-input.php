<?php
session_start();
require_once('connection/db_connect.php');

$productName = $productType = $productAge = $productDescription = $productImage = "";
$productName_err = $productType_err = $productAge_err = "";

$productTypes = array("Single Malt", "Blended");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty(trim($_POST["product_name"]))) {
    $productName_err = "Please enter product name.";
  } else {
    $productName = trim($_POST["product_name"]);
  }

  if (empty(trim($_POST["product_type"]))) {
    $productType_err = "Please select product type.";
  } else {
    $productType = trim($_POST["product_type"]);
  }

  if (empty(trim($_POST["product_age"]))) {
    $productAge_err = "Please enter product age.";
  } else {
    $productAge = trim($_POST["product_age"]);
  }

  if (empty($productName_err) && empty($productType_err) && empty($productAge_err)) {
    $sql = "INSERT INTO product (product_name, product_type, product_age, product_description, product_image) VALUES (?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_bind_param($stmt, "ssiss", $paramProductName, $paramProductType, $paramProductAge, $paramProductDescription, $paramProductImage);

      $paramProductName = $productName;
      $paramProductType = $productType;
      $paramProductAge = $productAge;
      $paramProductDescription = $_POST["product_description"];
      $paramProductImage = $_POST["product_image"];

      if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Product added successfully!");</script>';
        mysqli_stmt_close($stmt);
        echo '<script>window.location.href = "product.php";</script>';
        exit();
      } else {
        echo '<script>alert("Something went wrong. Please try again later.");</script>';
      }
    }
  }

  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Whiskey Product</title>
  <link rel="stylesheet" href="styles/navbar.css">
  <link rel="stylesheet" href="styles/pages/product-input.css">
  <link rel="stylesheet" href="styles/footer.css">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-fsSQIe1nM8ZhmWKuVu0jKAsz1d6xerF2pPn4mVny3A0Thdtmw2lE8x7lTrPSwR8qPCgeEr3iVU4Zh/sA/ltVwg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" type="image/svg+xml" href="public/favicon.svg" media="(prefers-color-scheme: dark)" />

</head>

<body>
  <div class="container">
    <h2>Add Whiskey Product</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="form-group">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required>
        <span class="error"><?php echo $productName_err; ?></span>
      </div>
      <div class="form-group">
        <label for="product_type">Product Type:</label>
        <select id="product_type" name="product_type" required>
          <option value="">Select Product Type</option>
          <?php
          foreach ($productTypes as $type) {
            echo "<option value='" . $type . "'>" . $type . "</option>";
          }
          ?>
        </select>
        <span class="error"><?php echo $productType_err; ?></span>
      </div>
      <div class="form-group">
        <label for="product_age">Product Age:</label>
        <input type="number" id="product_age" name="product_age" required>
        <span class="error"><?php echo $productAge_err; ?></span>
      </div>
      <div class="form-group">
        <label for="product_description">Product Description:</label>
        <textarea id="product_description" name="product_description"></textarea>
      </div>
      <div class="form-group">
        <label for="product_image">Product Image URL:</label>
        <input type="text" id="product_image" name="product_image">
      </div>
      <button type="submit">Add Product</button>
    </form>
  </div>
</body>

</html>