<?php
// Connection details
$host = "localhost";
$user = "fabrice";
$pass = "222011120";
$database = "video_conferencingp";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>