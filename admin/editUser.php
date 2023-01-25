<?php 

include '../config/db.php';
$id = $_GET['id'];
$user = mysqli_query($connection,"SELECT * FROM tb_user WHERE id_user = $id");
$row = mysqli_fetch_array($user);

function edit($data)
{
    global $connection,$id;
    $username = $data['username'];
    $password = $data['password'];
    $level = $data['level'];

    mysqli_query($connection,"UPDATE tb_user SET username = '$username',password = '$password',level = '$level' WHERE id_user = $id ");
    return mysqli_affected_rows($connection);
}

if(isset($_POST['submit'])){
    if(edit($_POST) > 0){
        echo "
        <script>
            document.location.href = './create-indexUser.php'
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
            <form action="" method="post">
                <div class="form-group mb-1">
                    <input type="text" class="form-control" name="username" placeholder="Username" value="<?= $row['username'] ?>">
                </div>
                <div class="form-group mb-1">
                    <select name="level" class="form-control">
                        <option value="">--</option>
                        <option value="admin">admin</option>
                        <option value="kasir">kasir</option>
                        <option value="user">user</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="password" placeholder="Password" value="<?= $row['password'] ?>">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Edit</button>
                <a href="./create-indexMenu.php" class="btn btn-danger">Back</a>
            </form>
        </div>
    </div>
</body>

</html>