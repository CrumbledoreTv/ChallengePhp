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
$mess = isset($_POST['mess'])? $_POST['mess'] : "";


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

          $res = mysqli_query($cnx, "INSERT INTO users (pseudo, prenom, email, jeux, dateBirth, messages, added, img) VALUES ('$pseudo','$prenom','$email','$jeux','$dateBirth', '$mess','' ,'$filelist')");

          $sMessage = 'Message envoyé le '.date('d/m/Y').' à '.date('H:i')."\r\n";
          $sMessage .= 'Pseudo : '.$pseudo.''.$prenom."\r\n";
          $sMessage .= 'E-mail : '.$email."\r\n";
          $sMessage .= 'Message : '."\r\n\r\n--\r\n\r\n";
          $sMessage .= $mess."\r\n\r\n--\r\n\r\n";

          $sObjet = 'Challenge PhP';

          $sEmail = 'ellart.simon@gmail.com';

          mail($sEmail, $sObjet, $sMessage);

          echo "Votre message a bien été envoyé.<br>Redirection automatique dans 3sec.";

          header('Refresh: 3; contact.php');
        } else {
          echo "Erreur.<br>Redirection automatique dans 3sec";
          
          header('Refresh: 3; contact.php');
        }
?>
