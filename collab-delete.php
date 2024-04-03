<?php
session_start();
require_once('connection/db_connect.php');

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
if (isset($_GET['id'])) {
  $product_id = $_GET['id'];

  $sql = "DELETE FROM store WHERE store_id = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "i", $product_id);
  mysqli_stmt_execute($stmt);

  if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo '<script>alert("Delete successfully!");';
  }
  echo 'window.location.href = "collab.php";</script>';
  exit();
}

mysqli_close($conn);
