<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lab_project";


$conn = mysqli_connect("localhost", "root", "", "lab_project");


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
