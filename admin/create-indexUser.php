<?php

include '../config/db.php';
session_start();

$datas = mysqli_query($connection,'SELECT * FROM tb_user');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu | Create</title>
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

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark reverseColor rounded">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Resto</a>
            </div>
        </nav>
        <div class="jumbotron text-center py-3 border mt-3 gradientColor text-white rounded">
            <h1 class="" style="text-transform: capitalize;">Hello, <?= $_SESSION["admin"] ?></h1>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <a href="./create-indexMenu.php" class="btn btn-primary mt-3">Menu</a>
                <a href="./index.php" class="btn btn-danger mt-3">Back</a>
            </div>
            <div class="row mt-2">
            <?php while ($row = mysqli_fetch_assoc($datas)) : ?>
                <div class="col-4 my-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <span>Username : <?= $row['username'] ?></span><br>
                            <span>Level : <?= $row['level'] ?></span><br>
                            <div class="mt-2">
                                <a href="./delete-user.php?id=<?= $row['id_user'] ?>" class="btn btn-danger">Delete</a>
                                <a href="./editMenu.php?id=<?= $row['id_user'] ?>" class="btn btn-success">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile ?>

        </div>
        </div>
    </div>
</body>

</html>