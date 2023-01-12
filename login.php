<?php

include './config/db.php';
session_start();
if(isset($_POST["submit"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  //cek username
  $user = mysqli_query($connection, "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password' ");
  $data = mysqli_fetch_assoc($user);
  $data_id = $data ['id_user'];
  if (mysqli_num_rows($user) === 1){
    //cek level
    if($data['level'] == "admin") {
      $_SESSION["admin"] = $username;
      $_SESSION["id_admin"] = $data_id;
      header('location: ./admin/index.php');
      
      
    }else if($data["level"] == "user"){
      $_SESSION["user"] = $username;
      $_SESSION["id_user"] = $data_id;
      header('location: ./user/index.php');

    }
    else if($data["level"] == "kasir"){
      $_SESSION["kasir"] = $userrname;
      $_SESSION["id_kasir"] = $data_id;
      echo "
      <script>
          document.location.herf = '../kasir-index.php'
      </script>
    ";

    }
  }

}

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
  <title>Aplikasi resto</title>
</head>
<style>
  body {
    background-color: #29a185;
  }
</style>
<body>


    <div class="card mt-5 col-sm-3 mx-auto shadow">
      <div class="card-header h5 shadow">
      Form Login
    </div>
    <div class="card-body my-2">
      <form action="" method="post">
        <div class="form-group mb-1">
          <input type="text" class="form-control" name="username" placeholder="username">
        </div>
        <div class="form-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="password">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>