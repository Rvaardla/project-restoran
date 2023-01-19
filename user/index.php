<?php

include '../config/db.php';
session_start();
if($_SESSION['user'] == ""){
    header('location : ../login.php');
}
$id = $_SESSION['id_user'];

$menu = mysqli_query($connection,'SELECT * FROM tb_menu');
function createCart($data){
    global $connection;
    $id_user = $data["id_user"];
    $id_menu = $data["id_menu"];
    $quantity = $data["quantity"];
    $total = $quantity * $data["price"];

    mysqli_query($connection,"INSERT INTO tb_cart VALUES(
        '',
        '$id_menu',
        '$id_user',
        '$quantity',
        '$total'
    )");

    return mysqli_affected_rows($connection);
}

if(isset($_POST["add-to-cart"])){
    if(createCart($_POST) > 0 ){
        echo "
        <script>
            alert('keranjang di tambahkan')
            document.location.href = 'index.php'
        </script>
        ";
    }
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
                <a href="../auth/logout.php" class="me-2 btn btn-danger">Logout</a>
            </div>
        </nav>
        <!-- hero content -->
        <div class="jumbotron text-center py-3 border mt-3 gradientColor text-white rounded">
            <h1 class="" style="text-transform: capitalize;">Hello, <?= $_SESSION["user"] ?></h1>
        </div>
        <div class="row mt-2">
            <div class="col-12 mb-3 text-center">
                <a href="./cart.php" class="btn btn-primary">Keranjang</a>
            </div>
            <?php while($row = mysqli_fetch_assoc($menu)) : ?>
            <div class="col-4">
                <div class="card shadow reverseColor">
                    <div class="card-body">
                        <form method="post">
                            <input type="hidden" name="id_user" value="<?= $_SESSION["id_user"] ?>">
                            <input type="hidden" name="id_menu" value="<?= $row["id_menu"] ?>">
                            <input type="hidden" name="price" value="<?= $row["price"] ?>">
                            <img src="../assets/img/<?= $row['image_menu'] ?>" alt="" class="img-thumbnail shadow mb-3">
                            <span class="fw-bold h5">Menu : <?= $row['name'] ?></span><br>
                            <span class="fw-bold h5 block">Harga : Rp <?= $row['price'] ?></span><br>
                            <input type="number" name="quantity" id="" value="1" class="form-control">
                            <button type="submit" name="add-to-cart" class="btn btn-success mt-2">Add Cart</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endwhile?>
        </div>
    </div>
</body>

</html>