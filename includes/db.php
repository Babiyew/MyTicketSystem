<?php
// includes/db.php

$host = "127.0.0.1";
$user = "root";
$pass = "";          // XAMPP default usually empty
$db   = "ticketsystem";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("DB connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
