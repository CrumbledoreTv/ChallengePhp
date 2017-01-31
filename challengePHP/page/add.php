<?php
include_once("connexion.php");
session_start();

$add = isset($_POST['add'])? $_POST['add'] : "";

$res = mysqli_query($cnx,"UPDATE users SET added='1' WHERE id='$add'");

header('location:admin.php');

 ?>
