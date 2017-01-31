<?php
include_once('connexion.php');
session_start();

$username = isset($_POST['username'])? $_POST['username'] : "";
$password = isset($_POST['password'])? $_POST['password'] : "";

$username = mysqli_real_escape_string($cnx, $username);
$password = mysqli_real_escape_string($cnx, $password);

$res = mysqli_query($cnx,"SELECT * FROM challenge WHERE username='$username' AND password='$password'");
$data = mysqli_fetch_assoc($res);

if(isset($data)){
  $_SESSION['connected']= true;
  $_SESSION['id'] = $data['id'];
  header('location:../index.php');
}else{
  $_SESSION['connected']= false;
  header('location:../index.php');
}
 ?>
