<?php

session_start();
include '../config/db.php';
if ($_SESSION['admin'] == "") {
    header('location: ../login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .gradientColor {
            background-image: linear-gradient(to left, #ff9797, #ffb648);
        }

        .reverseColor {
            background-image: linear-gradient(to right, #ff9797, #ffb648);
        }
    </style>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>

<body class="">
    <div class="container my-2">

        <nav class="navbar navbar-expand-lg navbar-dark reverseColor rounded">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Resto</a>
                <a class="btn btn-danger" href="../auth/logout.php">Log out</a>
            </div>
        </nav>
        <div class="jumbotron text-center py-3 border mt-3 gradientColor text-white rounded">
            <h1 class="" style="text-transform: capitalize;">Hello, <?= $_SESSION["admin"] ?></h1>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <a href="./create-indexUser.php" class="btn btn-primary mt-3">User</a>
                <a href="./create-indexMenu.php" class="btn btn-primary mt-3">Menu</a>
                <a href="./transaction.php" class="btn btn-primary mt-3">Transaksi</a>
            </div>
        </div>
    </div>
</body>

</html>