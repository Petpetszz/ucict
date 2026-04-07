<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
<title>Attendance</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow p-4">

    <div class="d-flex justify-content-between">
        <h4>Attendance</h4>
        <a href="index.php" class="btn btn-secondary btn-sm">Back to Menu</a>
    </div>

    <!-- INPUT -->
    <form method="POST" class="mt-3 d-flex">
        <input type="text" name="id" class="form-control me-2" placeholder="Input ID #" required>
        <button class="btn btn-primary">Submit</button>
    </form>

    <hr>

<?php
if(isset($_POST['id'])){
    $id = $_POST['id'];

    $res = $conn->query("SELECT * FROM registration WHERE idnum='$id'");

    // ❌ NOT REGISTERED
    if($res->num_rows == 0){
        echo "<div class='alert alert-danger'>ID # is NOT YET REGISTERED</div>";
    } 
    else {
        $row = $res->fetch_assoc();

        // TABLE DISPLAY (like in image)
?>
        <table class="table table-bordered text-center">
            <tr>
                <th>ID #</th>
                <th>Name</th>
                <th>Campus</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>

            <tr>
                <td><?= $row['idnum'] ?></td>
                <td><?= $row['studFName']." ".$row['studLName'] ?></td>
                <td><?= $row['campus'] ?></td>
                <td><?= $row['amountPaid'] ?></td>
                <td>
                    <?php
                    // ✅ ALREADY ATTENDED
                    if($row['attended'] == "Yes"){
                        echo "<span class='badge bg-success'>Attended</span>";
                        echo "<div class='text-warning mt-1'>Record already exists</div>";
                    } 
                    // ✅ NOT YET ATTENDED
                    else {
                    ?>
                        <form method="POST">
                            <input type="hidden" name="mark_id" value="<?= $row['idnum'] ?>">
                            <button class="btn btn-success btn-sm">Attend</button>
                        </form>
                    <?php } ?>
                </td>
            </tr>
        </table>

<?php
    }
}

// ✅ MARK AS ATTENDED
if(isset($_POST['mark_id'])){
    $mark_id = $_POST['mark_id'];

    $conn->query("UPDATE registration SET attended='Yes' WHERE idnum='$mark_id'");

    echo "<div class='alert alert-success mt-3'>Student Attendance is SUCCESSFULLY RECORDED</div>";
}
?>

</div>
</div>

</body>
</html>