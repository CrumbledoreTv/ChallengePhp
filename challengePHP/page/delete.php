<?php
include_once("connexion.php");

$del = isset($_POST['del'])? $_POST['del'] : "";

$res = mysqli_query($cnx, "DELETE FROM users WHERE id='$del'");

// REMETTRE LES ID DANS L'ORDRE
$res2 = mysqli_query($cnx, "SET @num := 0");
$res3 = mysqli_query($cnx, "UPDATE users SET id = @num := (@num+1)");
$res4 = mysqli_query($cnx, "ALTER TABLE users AUTO_INCREMENT = 1");

header('location:admin.php');

 ?>
