<?php
$host = "localhost";
$username = "root";
$password = "Classy2808";
$dbname = "buku_tamu";
$port = 3306;

// Create connection
$conn = new mysqli($host, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
