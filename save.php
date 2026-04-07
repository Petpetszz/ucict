<?php
include 'config.php';

$conn->query("INSERT INTO registration VALUES(
    '$_POST[idnum]',
    '$_POST[campus]',
    '$_POST[studFName]',
    '$_POST[studLName]',
    '$_POST[amountPaid]',
    'No'
)");

header("Location: register.php");