<?php

include("../config/db.php");
session_start();
if ($_SESSION["admin"] == "") {
    header('location: ../user/index.php');
}
$id = $_GET["id"];

function deleteData($id){
    global $connection;
    mysqli_query($connection,"DELETE FROM tb_user WHERE id_user = $id");
    return mysqli_affected_rows($connection);
}

if(deleteData($id) > 0){
    echo'
    <script>
        alert("data delete has succesfully")
        document.location.href = "create-indexUser.php"
    </script>';
}

?>