<?php

include '../config/db.php';
session_start();
if ($_SESSION["admin"] == "") {
    header('location: ../login.php');
}

$menus = mysqli_query($connection,'SELECT * FROM tb_menu');

function imageMenu(){

    $nameFile = $_FILES["image_name"]["name"];
    $tempName = $_FILES["image_name"]["tmp_name"];
    $error = $_FILES["image_name"]["error"];

    // check if no images are uploaded
    if( $error === 4 ){
        echo "
        <script>
            alert('please upload image!!')
        </script>
        ";
    }

    // check extension image
    $extension = ["jpg","png","jpeg","jfif"];
    $extensionImage = explode(".",$nameFile);
    $extensionImage = strtolower(end($extensionImage));
    
    if( !in_array($extensionImage,$extension) ){
        echo "this file not image";
    }
    
    // change name image from default to random string
    $newName = uniqid();
    $newName .= ".";
    $newName .= $extensionImage;

    move_uploaded_file($tempName, '../assets/img/' . $newName);

    return $newName;

}

function create($data)
{
    global $connection;

    $name = $data["name"];
    $price = $data["price"];
    $image_name = imageMenu();

    if(!$image_name){
        return false;
    }

    // var_dump($image_name);
    // die;
    mysqli_query($connection, "INSERT INTO tb_menu VALUES(
        '',
        '$name',
        '$price',
        '$image_name'
    )");

    return mysqli_affected_rows($connection);
}

if(isset($_POST["submit"])){
    if(create($_POST) > 1)
    {
        echo "
        <script>
            document.location.href = 'create-indexMenu.php'
            location.reload()
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
                <a href="./create-indexUser.php" class="btn btn-primary mt-3">User</a>
                <a href="./index.php" class="btn btn-danger mt-3">Back</a>
            </div>
            <div class="row mt-2">
            <div class="col-12">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group mb-2">
                        <input type="text" placeholder="Nama Menu" class="form-control shadow" name="name" required>
                    </div>
                    <div class="form-group mb-2">
                        <input type="file" class="form-control" name="image_name" required>
                    </div>
                    <div class="form-group mb-2">
                        <input type="number" placeholder="Harga" name="price" class="form-control shadow" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Store data</button>
                </form>
            </div>
            <?php while ($row = mysqli_fetch_assoc($menus)) : ?>
                <div class="col-4 my-4">
                    <div class="card shadow">
                    <img src="../assets/img/<?= $row['image_menu'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <span>Menu : <?= $row['name'] ?></span><br>
                            <span>Harga : Rp <?= $row['price'] ?></span><br>
                            <div class="mt-2">
                                <a href="./delete-menu.php?id=<?= $row['id_menu'] ?>" class="btn btn-danger">Delete</a>
                                <a href="./editMenu.php?id=<?= $row['id_menu'] ?>" class="btn btn-success">Edit</a>
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