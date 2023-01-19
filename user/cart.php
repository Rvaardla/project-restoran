<?php

include("../config/db.php");
session_start();
if ($_SESSION["user"] == "") {
    header("location: ./index.php");
}

$id = (int)$_SESSION["id_user"];

$carts = mysqli_query($connection, "SELECT * FROM tb_cart
        INNER JOIN tb_menu ON tb_menu.id_menu = tb_cart.id_menu
        INNER JOIN tb_user ON tb_user.id_user = tb_cart.id_user
        ORDER BY id_cart DESC
    ");

if (isset($_POST["export_id_cart"]) and isset($_POST['total']) and isset($_POST["menu"])) {
    $array_id = $_POST["export_id_cart"];
    $array_menu = $_POST["menu"];
    $array_total = $_POST["total"];
    for ($i = 0; $i < count($array_id); $i++) {
        $date = date('Y-m-d');
        $id_cart_loop = (int)$array_id[$i];
        $menu_loop = $array_menu[$i];
        $total_loop = (int)$array_total[$i];

        // var_dump($id,$menu_loop,$total_loop,$date);

        mysqli_query($connection, "INSERT INTO tb_transaksi VALUES('','$id','$menu_loop','$total_loop','0','$date')");
        mysqli_query($connection, "DELETE FROM tb_cart WHERE id_user = $id");
    }
    echo "
    <script>
        alert('pesanan sedang di buat silahkan bayar di kasir')
        document.location.href = 'cart.php'
    </script>
    ";
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

<body>
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
                <a href="./index.php" class="btn btn-primary">Back</a>
            </div>
            <div class="col-12">
                <table class="table table-striped text-center">
                    <tr>
                        <th>Menu</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                    <form method="post">
                        <?php while ($row = mysqli_fetch_assoc($carts)) : ?>
                            <?php if ($row['id_user'] == $id) { ?>
                                <input type="checkbox" name="export_id_cart[]" value="<?= $row["id_cart"] ?>" checked hidden>
                                <input type="checkbox" name="total[]" value="<?= $row["total"] ?>" checked hidden>
                                <input type="checkbox" name="menu[]" value="<?= $row["name"] ?>" checked hidden>
                                <tr>
                                    <td>
                                        <?= $row['name'] ?>
                                    </td>
                                    <td>
                                        <?= $row['price'] ?>
                                    </td>
                                    <td>
                                        <?= $row['quantity'] ?>
                                    </td>
                                    <td>
                                        <?= $row['total'] ?>
                                    </td>
                                    <td>
                                        <a href="./deleteCart.php?id=<?= $row["id_cart"] ?>" class="text-danger fw-bold">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php endwhile ?>
                    </table>
                    <button class="btn btn-success" type="submit">Pesan</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>