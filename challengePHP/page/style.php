<?php
error_reporting(E_ALL);
ini_set("display_errors", true);

include_once("connexion.php");
session_start();


// COULEUR --------------------------

// TITRE
 $hval1 = isset($_POST['hval1'])? $_POST['hval1'] : "";
 $hval2 = isset($_POST['hval2'])? $_POST['hval2'] : "";
 $hval3 = isset($_POST['hval3'])? $_POST['hval3'] : "";
 $hval4 = isset($_POST['hval4'])? $_POST['hval4'] : "";

 $hrgba = "rgba(".$hval1.",".$hval2.",".$hval3.",".$hval4.")";

 // NAVBAR
  $nval1 = isset($_POST['nval1'])? $_POST['nval1'] : "";
  $nval2 = isset($_POST['nval2'])? $_POST['nval2'] : "";
  $nval3 = isset($_POST['nval3'])? $_POST['nval3'] : "";
  $nval4 = isset($_POST['nval4'])? $_POST['nval4'] : "";

  $nrgba = "rgba(".$nval1.",".$nval2.",".$nval3.",".$nval4.")";

  // URL
   $uval1 = isset($_POST['uval1'])? $_POST['uval1'] : "";
   $uval2 = isset($_POST['uval2'])? $_POST['uval2'] : "";
   $uval3 = isset($_POST['uval3'])? $_POST['uval3'] : "";
   $uval4 = isset($_POST['uval4'])? $_POST['uval4'] : "";

   $urgba = "rgba(".$uval1.",".$uval2.",".$uval3.",".$uval4.")";

   // BOUTON
    $bval1 = isset($_POST['bval1'])? $_POST['bval1'] : "";
    $bval2 = isset($_POST['bval2'])? $_POST['bval2'] : "";
    $bval3 = isset($_POST['bval3'])? $_POST['bval3'] : "";
    $bval4 = isset($_POST['bval4'])? $_POST['bval4'] : "";

    $brgba = "rgba(".$bval1.",".$bval2.",".$bval3.",".$bval4.")";

// CAROUSEL --------------------------
 $fleche = isset($_POST['fleche'])? $_POST['fleche'] : "off";

// NEIGE ----------------------------
$neige = isset($_POST['neige'])? $_POST['neige'] : "off";

// POLICE ---------------------------
$police = isset($_POST['police'])? $_POST['police'] : "";


$res = mysqli_query($cnx,"UPDATE style SET titre='".$hrgba."', navbar='".$nrgba."', url='".$urgba."', bouton='".$brgba."', police='$police', fleche='$fleche', neige='$neige' WHERE id='1'");
###########################################################################

$dir = "/var/www/html/Challenge/challengePHP/imgCarousel";
$img = move_uploaded_file($_FILES['imgCar']['tmp_name'], "/$dir/".$_FILES['imgCar']['name']);

$filelist = $_FILES['imgCar']['name'];

$title = isset($_POST['title']) ? $_POST['title'] : "";
$subtitle = isset($_POST['subtitle']) ? $_POST['subtitle'] : "";

$res2 = mysqli_query($cnx, "INSERT INTO carou (image, title, subtitle) VALUES ('$filelist','$title','$subtitle')");

header('location:admin.php');

 ?>
