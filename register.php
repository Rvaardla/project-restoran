<?php

include('./config/db.php');
function register($data){
    global $connection;

    $username = $data["username"];
    $password = $data["password"];
    
    // check username
    $name = mysqli_query($connection,"SELECT * FROM tb_user WHERE username = '$username'");
    if(mysqli_fetch_assoc($name)){
        echo "
        <script>
            alert('username sudah terpakai')
        </script>
        ";
        return false;
    }

    // add data to database
    mysqli_query($connection,"INSERT INTO tb_user VALUES (
        '',
        '$username',
        '$password',
        'user'
        )
    ");

    return mysqli_affected_rows($connection);
}

if(isset($_POST["submit"])){
    if(register($_POST) > 0){
        echo"
        <script>
            alert('data berhasil di tambahkan')
            document.location.href = './login.php'
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
</head>
<link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
<style>
  body {
    background-color: #e2e8f0;
  }

  .login {
    background-color: #ffb648;
  }
</style>
<body>
    <div class="card mt-5 col-sm-3 mx-auto shadow login">
      <div class="card-header h5 shadow text-white">
      Form Register
    </div>
    <div class="card-body my-2">
      <form action="" method="post">
        <div class="form-group mb-1">
          <input type="text" class="form-control" name="username" placeholder="username" required>
        </div>
        <div class="form-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="password" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        <a href="./login.php" class="text-primary fw-bold">Login</a>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>