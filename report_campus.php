<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
<title>Report by Campus</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">
<div class="card p-4 shadow">

<div class="d-flex justify-content-between">
    <h4>Report (By Campus)</h4>
    <a href="index.php" class="btn btn-secondary btn-sm">Back to Menu</a>
</div>

<form method="POST" class="mt-3">
<label>Set filters here:</label><br>

<input type="checkbox" name="campus[]" value="Main"> Main
<input type="checkbox" name="campus[]" value="Banilad"> Banilad
<input type="checkbox" name="campus[]" value="LM"> LM
<input type="checkbox" name="campus[]" value="PT"> PT

<br><br>
<button class="btn btn-primary">Generate Report</button>
</form>

<hr>

<?php
if(isset($_POST['campus'])){
    $campuses = $_POST['campus'];
    $filter = "'" . implode("','", $campuses) . "'";

    $res = $conn->query("SELECT * FROM registration WHERE campus IN ($filter)");

    $total = 0;
    $attendees = 0;
    $count = 0;
?>

<table class="table table-bordered text-center">
<tr>
<th>ID #</th>
<th>Name</th>
<th>Campus</th>
<th>Amount</th>
<th>Attended</th>
</tr>

<?php while($row = $res->fetch_assoc()){ 
    $total += $row['amountPaid'];
    $count++;
    if($row['attended']=="Yes") $attendees++;
?>
<tr>
<td><?= $row['idnum'] ?></td>
<td><?= $row['studFName']." ".$row['studLName'] ?></td>
<td><?= $row['campus'] ?></td>
<td><?= $row['amountPaid'] ?></td>
<td><?= $row['attended'] ?></td>
</tr>
<?php } ?>

</table>

<p><b># of Registrants:</b> <?= $count ?></p>
<p><b># of Attendees:</b> <?= $attendees ?></p>
<p><b>Total Collection:</b> <?= $total ?></p>
<p><b>Date Generated:</b> <?= date("m/d/Y") ?></p>

<?php } ?>

</div>
</div>
</body>
</html>