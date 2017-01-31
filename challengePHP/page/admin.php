<?php
error_reporting(E_ALL);
ini_set("display_errors", true);

include_once("connexion.php");
session_start();

if ($_SESSION['connected']==false) {
    header('location:../index.php');
}

$resStyle = mysqli_query($cnx, "SELECT * FROM style");
$dataStyle = mysqli_fetch_assoc($resStyle);

 ?>
<!DOCTYPE php>
<php lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Challenge PHP de </title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/main.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Overpass+Mono" rel="stylesheet">

    <!-- php5 Shim and Respond.js IE8 support of php5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/php5shiv/3.7.0/php5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- NEIGE ----------------------->

       <?php
       if ($dataStyle['neige'] == "off") {
           $_SESSION['checkN']= false;
       } elseif ($dataStyle['neige'] == "") {
           $_SESSION['checkN']= true;
           echo '<script type="text/javascript" src="../js/script.js"></script>
         <script type="text/javascript">
             window.onload = function() {
                 snow.init(20);
             };
         </script>';
       }
        ?>

</head>

<style media="screen">
h1,h2,h3,h4{
  color : <?php echo $dataStyle['titre'] ?>;
  font-family: <?php echo $dataStyle['police']; ?>, sans-serif;
  font-family: <?php echo $dataStyle['police']; ?>, sans-serif;
  font-family: <?php echo $dataStyle['police']; ?>, monospace;
}
#navColor{
  background-color: <?php echo $dataStyle['navbar'] ?>;
}
a{
  color: <?php echo $dataStyle['a'] ?>;
}
.btn{
  background-color: <?php echo $dataStyle['bouton'] ?>;
}
h2,h1{
  text-align: center;
}
h2,h1,h4{
  color: white;
}
  .champ{
    width: 30px;
  }
  #mid{
    margin-top: 50px;
  }
  table{
    border-collapse: collapse;
    margin: auto;
    background-color: grey;
    color: white;
  }
  tr,td,th{
    border: 1px solid black;
    padding: 10px;
  }
  #couleur{
    width: 400px;
    height: 420px;
    border: 1px solid white;
    border-radius: 14px;
    padding: 10px;
    background-color: grey;
  }
  #style{
    width: 350px;
    height: 210px;
    border: 1px solid white;
    border-radius: 14px;
    padding: 10px;
    background-color: grey;
  }
  #top{
    display:flex;
    justify-content: space-around;
  }
  #carousel{
    float: right;
    width: 350px;
    height: 270px;
    border: 1px solid white;
    border-radius: 14px;
    padding: 10px;
    background-color: grey;
  }
  h1,h2{
    background-color: grey;
  }
</style>

<body>

    <!-- Navigation -->
    <nav id="navColor" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Left -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Start Bootstrap</a>
            </div>
            <!-- Right -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="../index.php">Home</a>
                    </li>
                    <li>
                        <a href="repertory.php">Repertory</a>
                    </li>
                    <li>
                        <a href="about.php">About</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                    <?php
                    if ($_SESSION['connected']==false) {
                        echo '<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
			<ul id="login-dp" class="dropdown-menu">
				<li>
					 <div class="row">
							<div class="col-md-12">
              <p id="login">LOGIN</p>
								 <form class="form" role="form" method="post" action="loginCheck.php" accept-charset="UTF-8" id="login-nav">
										<div class="form-group">
											 <input type="text" class="form-control" name="username" placeholder="USERNAME" required>
										</div>
										<div class="form-group">
											 <input type="text" class="form-control" name ="password" placeholder="PASSWORD" required>
										</div>
										<div class="form-group">
											 <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
										</div>
								 </form>
							</div>
					 </div>
				</li>
			</ul>
        </li>';
                    } elseif ($_SESSION['connected']==true) {
                        echo '<li>
                          <a href="admin.php">Administration</a>
                          </li>';
                    }

                     ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
      <h1>PANNEAU D'ADMINISTRATION</h1>

      <div id="top">

        <div id="couleur">
          <h2>Couleurs</h2>
          <form action="style.php" enctype="multipart/form-data" method="post">
            <h4>Titres:</h4>
            Code rgba (<input class="champ" type="text" name="hval1">,<input class="champ" type="text" name="hval2">,<input class="champ" type="text" name="hval3">,<input class="champ" type="text" name="hval4">)

            <h4>Navbar:</h4>
            Code rgba (<input class="champ" type="text" name="nval1">,<input class="champ" type="text" name="nval2">,<input class="champ" type="text" name="nval3">,<input class="champ" type="text" name="nval4">)

            <h4>Urls:</h4>
            Code rgba (<input class="champ" type="text" name="uval1">,<input class="champ" type="text" name="uval2">,<input class="champ" type="text" name="uval3">,<input class="champ" type="text" name="uval4">)

            <h4>Boutons:</h4>
            Code rgba (<input class="champ" type="text" name="bval1">,<input class="champ" type="text" name="bval2">,<input class="champ" type="text" name="bval3">,<input class="champ" type="text" name="bval4">)
          </div>

        <div id="style">
            <h2>Styles</h2>
            <input type="checkbox" name="fleche" <?php if ($_SESSION['checkF']==true) {
                         echo "checked";
                     } else {
                         echo "";
                     } ?> value="">Afficher les flêches de navigation du carousel<br><br>
                     <input type="checkbox" name="neige" <?php if ($_SESSION['checkN']==true) {
                         echo "checked";
                     } else {
                         echo "";
                     } ?> value="">Ajouter la neige<br><br>
                     <select  name="police">
                       <option value="Oswald">Oswald</option>
                       <option value="Montserrat">Montserrat</option>
                       <option value="Overpass Mono">Overpass Mono</option>
                     </select>
                     Police des titres
                   </div>

                   <div id="carousel">
                     <h2>Carousel</h2>
                     <h4>Ajouter une image:</h4>
                       <input type="file" name="imgCar">
                       <h4>Title:</h4>
                       <input type="text" name="title" placeholder="25 caractères max">
                       <h4>Subtitle:</h4>
                       <input type="text" name="subtitle" placeholder="10 caractère max">
                   </div>

                 </div>




      <br><br><input class="col-md-offset-5" type="submit" name="submit" value="Sauvegarder Changement"></form><br><br>

      <div id="mid">
        <h2>Messages</h2>

        <table>
        <?php

        $textMess = mysqli_query($cnx, "SELECT prenom, pseudo, jeux, messages FROM users");
        $dataMess = mysqli_fetch_assoc($textMess);

          foreach ($dataMess as $key => $value) {
              echo "<th>$key</th>";
          }
          echo "<tr></tr>";

          mysqli_data_seek($textMess, 0);

          while ($dataMess = mysqli_fetch_assoc($textMess)) {
              foreach ($dataMess as $key => $value) {
                  echo "<td>$value</td>";
              }
              echo "<tr></tr>";
          }

         ?>
       </table>

      </div>



      <!-- ##################################################################### -->
      <div id=mid>
      <h2>Ajouts amis</h2>
      <?php

      $ajout = mysqli_query($cnx, "SELECT id,prenom,pseudo,jeux,email,dateBirth,added,img FROM users");
      $data = mysqli_fetch_assoc($ajout);

      ?>
      <table>
      <?php

      foreach ($data as $key => $value) {
          echo "<th>$key</th>";
      }
      echo "<th>Add</th>";
      echo "<th>Delete</th>";
      echo "<th>Modif</th>";
      echo "<tr></tr>";

      mysqli_data_seek($ajout, 0);

      while ($data = mysqli_fetch_assoc($ajout)) {
          foreach ($data as $key => $value) {
              echo "<td>$value</td>";
          }
          if ($data['added']==1) {
              echo "<td>Added</td>";
          } else {
              echo '<td><form  action="add.php" method="post">
                 <input type="hidden" name="add" value="'.$data["id"].'"/>
                 <input style="color:black;" type="submit" name="submit" value="Ajouter">
             </form></td>';
          }
          echo '<td><form  action="delete.php" method="post">
                    <input type="hidden" name="del" value="'.$data["id"].'"/>
                    <input style="color:black;" type="submit" name="submit" value="Supprimer">
                </form></td>';
          echo '<td><form  action="modif.php" method="post">
                       <input type="hidden" name="mod" value="'.$data["id"].'"/>
                       <input style="color:black;" type="submit" name="submit" value="Modif">
                   </form></td>';
          echo '<tr></tr>';
      }
      ?>
      </table>
      </div>

      <br><a href="../index.php">Retour au site</a><br>
      <a href="logout.php">logout</a>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; SimplonBSM 2017</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

</body>

</php>
