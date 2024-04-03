<?php
session_start();

if (isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit();
}

require_once('connection/db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['user_name'];
  $password = $_POST['user_password'];

  $sql = "SELECT * FROM user WHERE user_name=? AND user_password=?";

  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: login.php?error=sqlerror");
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
      $_SESSION['user_id'] = $row['user_id'];
      header("Location: index.php");
      exit();
    } else {
      $error = "Invalid username or password";
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/navbar.css">
  <link rel="stylesheet" href="styles/pages/login.css">
  <link rel="stylesheet" href="styles/footer.css">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-fsSQIe1nM8ZhmWKuVu0jKAsz1d6xerF2pPn4mVny3A0Thdtmw2lE8x7lTrPSwR8qPCgeEr3iVU4Zh/sA/ltVwg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" type="image/svg+xml" href="public/favicon.svg" media="(prefers-color-scheme: dark)" />


  <title>Login</title>
</head>

<body>
  <div class="container">
    <h2>Login</h2>
    <form action="login.php" method="post">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="user_name" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="user_password" required>
      </div>
      <button type="submit">Login</button>
    </form>
    <?php
    if (isset($_GET['error'])) {
      echo '<p class="error-message">' . $_GET['error'] . '</p>';
    }
    ?>
  </div>
</body>

</html>