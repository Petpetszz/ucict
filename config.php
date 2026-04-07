<?php
$conn = new mysqli("localhost", "root", "", "ucict");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>