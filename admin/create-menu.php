<?php

session_start();
include '../config/db.php';
if ($_SESSION["admin"] == "") {
    header('location: ../login.php');
}

?>