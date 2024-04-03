<?php
require_once('connection/db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $store_name = $_POST['store_name'];
  $store_location = $_POST['store_location'];
  $contact_information = $_POST['contact_information'];

  $sql = "INSERT INTO store (store_name, store_location, contact_information) VALUES (?, ?, ?)";

  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: collab.php?error=sqlerror");
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, "sss", $store_name, $store_location, $contact_information);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    mysqli_close($conn);

    echo '<script>alert("Store added successfully!");</script>';
    echo '<script>window.location.href = "collab.php";</script>';
    exit();
  }
}
