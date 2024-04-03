<?php
require_once('connection/db_connect.php');

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO contact (contact_name, contact_email, contact_message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $contact_name, $contact_email, $contact_message);

$contact_name = $_POST['contact_name'];
$contact_email = $_POST['contact_email'];
$contact_message = $_POST['contact_message'];
$stmt->execute();

echo '<script>alert("Message submitted successfully.");</script>';
echo '<script>window.location.href = "contact.php";</script>';

$stmt->close();
$conn->close();
