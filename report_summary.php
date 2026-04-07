<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
<title>Summary Report</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">
<div class="card p-4 shadow">

<div class="d-flex justify-content-between">
    <h4>Summary Report (All Campuses)</h4>
    <a href="index.php" class="btn btn-secondary btn-sm">Back to Menu</a>
</div>

<hr>

<table class="table table-bordered text-center">
<tr>
<th>Campus</th>
<th>Registered</th>
<th>Attended</th>
<th>Total Collection</th>
</tr>

<?php
$res = $conn->query("
SELECT campus,
COUNT(*) as registered,
SUM(attended='Yes') as attended,
SUM(amountPaid) as total
FROM registration
GROUP BY campus
");

$grandTotal = 0;

while($row = $res->fetch_assoc()){
    $grandTotal += $row['total'];
?>
<tr>
<td><?= $row['campus'] ?></td>
<td><?= $row['registered'] ?></td>
<td><?= $row['attended'] ?></td>
<td><?= $row['total'] ?></td>
</tr>
<?php } ?>

<tr>
<th colspan="3">TOTALS</th>
<th><?= $grandTotal ?></th>
</tr>

</table>

<p><b>Date Generated:</b> <?= date("m/d/Y") ?></p>

</div>
</div>
</body>
</html>