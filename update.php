<?php
include 'config.php';

// Get form data
$id = $_POST['idnum'];
$fname = $_POST['studFName'];
$lname = $_POST['studLName'];
$campus = $_POST['campus'];
$amount = $_POST['amountPaid'];

// Update query
$conn->query("UPDATE registration SET 
    studFName = '$fname',
    studLName = '$lname',
    campus = '$campus',
    amountPaid = '$amount'
WHERE idnum = '$id'");

// Redirect back to registration page
header("Location: register.php");
exit();
?>