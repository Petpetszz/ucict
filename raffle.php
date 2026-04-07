<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
<title>Raffle</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">
<div class="card p-4 shadow">

<div class="d-flex justify-content-between">
    <h4>Raffle</h4>
    <a href="index.php" class="btn btn-secondary btn-sm">Back to Menu</a>
</div>

<form method="POST" class="mt-3">
    <label>Set filters here:</label><br>

    <input type="checkbox" name="campus[]" value="Main"> Main
    <input type="checkbox" name="campus[]" value="Banilad"> Banilad
    <input type="checkbox" name="campus[]" value="LM"> LM
    <input type="checkbox" name="campus[]" value="PT"> PT

    <br><br>
    <button class="btn btn-primary">Reveal Winner</button>
</form>

<hr>

<?php
if(isset($_POST['campus'])){
    $campuses = $_POST['campus'];

    $filter = "'" . implode("','", $campuses) . "'";

    $res = $conn->query("SELECT * FROM registration WHERE campus IN ($filter)");
    $rows = $res->fetch_all(MYSQLI_ASSOC);

    if(count($rows) > 0){
        $winner = $rows[array_rand($rows)];
?>

<h5 class="text-center">Reveal the Lucky Winner!</h5>

<table class="table table-bordered text-center mt-3">
<tr>
<th>ID #</th>
<th>Name</th>
<th>Campus</th>
</tr>

<tr>
<td><?= $winner['idnum'] ?></td>
<td><?= $winner['studFName']." ".$winner['studLName'] ?></td>
<td><?= $winner['campus'] ?></td>
</tr>
</table>

<h3 class="text-center text-success">CONGRATULATIONS!!!</h3>

<?php
    } else {
        echo "<div class='alert alert-danger'>No participants found</div>";
    }
}
?>

</div>
</div>
</body>
</html>