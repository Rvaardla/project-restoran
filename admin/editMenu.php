<?php

include("../config/db.php");
$id = $_GET["id"];

$data = mysqli_query($connection, "SELECT * FROM tb_menu WHERE id_menu = $id");
$row = mysqli_fetch_assoc($data);

function updateMenu($data)
{

    global $connection;

    $id = $data["id_menu"];
    $name = $data["name"];
    $price = $data["price"];
    $imageOld = $data["imageOld"];

    if ($_FILES["image"]["error"] === 4) {
        $image_menu = $imageOld;
    } else {
        $image_menu = imageMenu();
    }

    mysqli_query($connection, "UPDATE tb_menu SET
        namabarang = '$name',
        harga = '$price',
        foto = '$image_menu'
        WHERE id_menu = $id
    ");

    return mysqli_affected_rows($connection);
}

function imageMenu()
{

    $nameFile = $_FILES["image"]["name"];
    $tempName = $_FILES["image"]["tmp_name"];
    $error = $_FILES["image"]["error"];

    // check if no images are uploaded
    if ($error === 4) {
        echo "please upload image!";
    }

    // check extension image
    $extension = ["jpg", "png", "jpeg", "jfif"];
    $extensionImage = explode(".", $nameFile);
    $extensionImage = strtolower(end($extensionImage));

    if (!in_array($extensionImage, $extension)) {
        echo "this file not image";
    }

    // change name image from default to random string
    $newName = uniqid();
    $newName .= ".";
    $newName .= $extensionImage;

    move_uploaded_file($tempName, '../assets/img/' . $newName);

    return $newName;
}

if (isset($_POST["submit"])) {
    if (updateMenu($_POST) > 0) {
        header('location: create-indexMenu.php');
        echo "
        <script>
            alert('data berhasil di ubah')
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
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="card mt-5 col-6 mx-auto shadow login">
        <div class="card-header h5 shadow">
            Form Login
        </div>
        <div class="card-body my-2">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_menu" value="<?= $row["id_menu"] ?>">
                <input type="hidden" name="imageOld" value="<?= $row["image_menu"] ?>">
                <div class="form-group mb-1">
                    <img src="../assets/img/<?= $row['image_menu'] ?>" alt="" srcset="" class="img-thumbnail">
                </div>
                <div class="form-group mb-1">
                    <input type="text" class="form-control" name="name" placeholder="Menu" value="<?= $row['name'] ?>">
                </div>
                <div class="form-group mb-1">
                    <input type="file" class="form-control" name="image" placeholder="Menu" value="<?= $row['image_menu'] ?>">
                </div>
                <div class="form-group mb-3">
                    <input type="number" class="form-control" name="price" placeholder="harga" value="<?= $row['price'] ?>">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Edit</button>
                <a href="./create-indexMenu.php" class="btn btn-danger">Back</a>
            </form>
        </div>
    </div>
</body>

</html>