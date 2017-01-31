<?php
// error_reporting(E_ALL);
// ini_set("display_errors", true);

include_once("connexion.php");
session_start();

$res = mysqli_query($cnx,"SELECT * FROM style");
$data = mysqli_fetch_assoc($res);

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
       if( $data['neige'] == "off"){
         $_SESSION['checkN']= false;
       }elseif( $data['neige'] == ""){
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
  color : <?php echo $data['titre'] ?>;
  font-family: <?php echo $data['police']; ?>, sans-serif;
  font-family: <?php echo $data['police']; ?>, sans-serif;
  font-family: <?php echo $data['police']; ?>, monospace;
}
#navColor{
  background-color: <?php echo $data['navbar'] ?>;
}
a{
  color: <?php echo $data['a'] ?>;
}
.btn{
  background-color: <?php echo $data['bouton'] ?>;
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

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Repertory</h1>
                <ol class="breadcrumb">
                    <li><a href="../index.php">Home</a>
                    </li>
                    <li class="active">Portfolio</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->



<?php

$res = mysqli_query($cnx, "SELECT * FROM users WHERE added='1'");


 ?>
        <!-- Friends -->
        <?php

        $row =1;

        while($data = mysqli_fetch_assoc($res)){

          // CALCUL AGE #maldecrane
          $ageux = explode("/", $data['dateBirth']);
          $todayday = date("d/m/Y");
          $today = explode("/", $todayday);

          // date du jour
          $jour = intval($today[0]);
          $mois = intval($today[1]);
          $annee = intval($today[2]);

          // date anniv
          $day = intval($ageux[0]);
          $month = intval($ageux[1]);
          $year = intval($ageux[2]);

          if($month > $mois){
            $age = $annee - $year;
            $age = $age - 1;
          }else if($month == $mois && $day > $jour){
            $age = $annee - $year;
            $age = $age - 1;
          }else{
            $age = $annee - $year;
          }

          if($row%3 == 0){
            echo '<div class="row">';
          }

          echo '<div class="col-md-4 img-portfolio">
                <img class="img-responsive img-hover" src="../imgProfil/'.$data['img'].'">
                <h3>'.$data['pseudo'].'</h3>
                <p>'.$age.' ans <span>'.$data['dateBirth'].'</span></p>

                <p>'.$data['messages'].'</p>
                <h4>Games</h4>
                <table class="table table-striped  table-hover">
                    <thead>
                        <tr>
                            <th>Game</td>
                            <th>Username</td>
                        </tr>
                    </thead>
                    <tr>
                        <td>'.$data['jeux'].'</td>
                        <td>'.$data['pseudo'].'</td>
                    </tr>
                </table>
            </div>';
            if($row%3 == 0){
              echo "</div>";
            }
            $row = $row+1;
          }

         ?>

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
