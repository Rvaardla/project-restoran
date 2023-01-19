<?php

include "../config/db.php";
session_start();

$transactions = mysqli_query($connection,
    "SELECT * FROM tb_transaksi
    INNER JOIN tb_user ON tb_transaksi.id_user = tb_user.id_user"
);

function changeStatus($data)
{
    global $connection;

    $id_transaksi = $data["id_transaksi"];
    mysqli_query($connection,"UPDATE tb_transaksi SET status = '1' WHERE id_transaksi = '$id_transaksi'");
    return mysqli_affected_rows($connection);
}

if(isset($_POST["submit"]))
{
    if(changeStatus($_POST) > 0)
    {
        header("location:index.php");
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
<body>
    
</body>
</html>