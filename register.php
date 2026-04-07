<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
<title>Registration</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow p-4">

    <div class="d-flex justify-content-between">
        <h4>Registration</h4>
        <a href="index.php" class="btn btn-secondary btn-sm">Back to Menu</a>
    </div>

    <!-- FORM -->
    <form action="save.php" method="POST" class="mt-3 row g-2">

        <div class="col-md-2">
            <input name="idnum" class="form-control" placeholder="ID #" required>
        </div>

        <div class="col-md-2">
            <input name="studFName" class="form-control" placeholder="First Name" required>
        </div>

        <div class="col-md-2">
            <input name="studLName" class="form-control" placeholder="Last Name" required>
        </div>

        <div class="col-md-2">
            <select name="campus" class="form-control">
                <option>Main</option>
                <option>Banilad</option>
                <option>LM</option>
                <option>PT</option>
            </select>
        </div>

        <div class="col-md-2">
            <input name="amountPaid" class="form-control" placeholder="Amount" required>
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100">Add</button>
        </div>

    </form>

    <hr>

    <!-- TABLE -->
    <table class="table table-bordered table-hover text-center">

        <tr class="table-dark">
            <th>ID #</th>
            <th>Name</th>
            <th>Campus</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>

        <?php
        $res = $conn->query("SELECT * FROM registration");

        while($row = $res->fetch_assoc()){
        ?>
        <tr>
            <td><?= $row['idnum'] ?></td>
            <td><?= $row['studFName']." ".$row['studLName'] ?></td>
            <td><?= $row['campus'] ?></td>
            <td><?= $row['amountPaid'] ?></td>

            <!-- ✅ ACTION BUTTONS HERE -->
            <td class="d-flex justify-content-center gap-2">

                <a href="edit.php?id=<?= $row['idnum'] ?>" 
                   class="btn btn-warning btn-sm">
                   Edit
                </a>

                <a href="delete.php?id=<?= $row['idnum'] ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Are you sure you want to delete this record?')">
                   Delete
                </a>

            </td>
        </tr>
        <?php } ?>

    </table>

</div>
</div>

</body>
</html>