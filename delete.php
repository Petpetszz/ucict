<?php
include 'config.php';

$conn->query("DELETE FROM registration WHERE idnum='$_GET[id]'");

header("Location: register.php");