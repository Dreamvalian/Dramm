<?php
session_start();

require_once('connection/db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user_name = $_POST['user_name'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];

  $stmt = $conn->prepare("INSERT INTO user (user_name, user_email, user_password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $user_name, $user_email, $user_password);

  if ($stmt->execute()) {
    $_SESSION['user_name'] = $user_name;
    $_SESSION['user_email'] = $user_email;

    header("Location: index.php");
    exit();
  } else {
    echo "Error: " . $stmt->error;
  }
  $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="styles/pages/register.css">
  <link rel="stylesheet" href="styles/footer.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <title>Register</title>
  <link rel="icon" type="image/svg+xml" href="public/favicon.svg" media="(prefers-color-scheme: dark)" />
</head>

<body>
  <div class="container mt-3">
    <div class="card w-50 m-0 m-auto">
      <div class="card-body">
        <h1 class="mb-2">Register</h1>
        <form id="form" method="post" action="">
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input name="user_name" id="user_name" type="text" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email address</label>
            <input name="user_email" id="user_email" type="email" class="form-control" aria-describedby="emailHelp" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input name="user_password" id="user_password" type="password" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>