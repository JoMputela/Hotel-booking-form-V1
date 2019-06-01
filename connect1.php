

<?php
$servername = "localhost";
$username = "joseph";
$password = "joseph";

// Create connection
$conn = new mysqli($servername, $username, $password, 'hotelBF');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";
?>
