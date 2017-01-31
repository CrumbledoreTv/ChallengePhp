<?php
error_reporting(E_ALL);
ini_set("display_errors", true);

include_once("connexion.php");
session_start();

$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : "";
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$jeux = isset($_POST['jeux']) ? $_POST['jeux'] : "";
$dateBirth = isset($_POST['dateBirth']) ? $_POST['dateBirth'] : "";

$id = isset($_POST['id'])? $_POST['id'] : "";

if (preg_match("#^[^0-9][a-zA-Z0-9]+$#", $pseudo)) {
    $verifPs = true;
} elseif($pseudo=="") {
    $verifPs=false;
}else{
  $verifPs=false;
}

if (preg_match("#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i", $email)) {
    $verifM = true;
}elseif($email==""){
  $verifM=false;
} else {
    $verifM=false;
}

if (preg_match("#[a-zA-Z]+$#", $prenom)) {
    $verifPr = true;
}elseif($prenom==""){
  $verifPr=false;
} else {
    $verifPr=false;
}

if (preg_match("#^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$#", $dateBirth)) {
    $verifD = true;
}elseif($dateBirth){
  $verifD=false;
} else {
    $verifD=false;
}

$dir = "/var/www/html/Challenge/challengePHP/imgProfil";
$img = move_uploaded_file($_FILES['img']['tmp_name'], "/$dir/".$_FILES['img']['name']);

$filelist = $_FILES['img']['name'];

      if ($verifD==true && $verifPs==true && $verifM==true && $verifPr==true) {

          $res = mysqli_query($cnx, "UPDATE users SET pseudo='".$pseudo."', prenom='".$prenom."', email='".$email."', jeux='".$jeux."', dateBirth='".$dateBirth."', img='".$filelist."' WHERE id='$id'");

          echo "Modifications effectuées.<br>Redirection automatique dans 3sec.";
          header('Refresh: 3; admin.php');

      } else {
        echo "Erreur dans le formulaire.<br>Redirection automatique dans 3sec";
          header('Refresh: 3; admin.php');
      }

 ?>
