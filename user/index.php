<?php

include '../config/db.php';
session_start();
$id = $_SESSION['id_user'];

$menu = mysqli_query($connection,'SELECT * FROM tb_menu');

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
            </div>
        </nav>
        <!-- hero content -->
        <div class="jumbotron text-center py-3 border mt-3 gradientColor text-white rounded">
            <h1 class="" style="text-transform: capitalize;">Hello, <?= $_SESSION["user"] ?></h1>
        </div>
        <div class="row mt-2">
            <?php while($row = mysqli_fetch_assoc($menu)) : ?>
            <div class="col-4">
                <div class="card shadow">
                    <div class="card-body">
                        <span>Menu : <?= $row['namabarang'] ?></span><br>
                        <span>Harga : Rp <?= $row['harga'] ?></span>
                    </div>
                </div>
            </div>
            <?php endwhile?>
        </div>
    </div>
</body>

</html>