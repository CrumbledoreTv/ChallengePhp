<?php
error_reporting(E_ALL);
ini_set("display_errors", true);

include_once("page/connexion.php");
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

    <title>Challenge PHP de Simon</title>

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
      echo '<script type="text/javascript" src="js/script.js"></script>
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
  color : <?php echo $data['titre']; ?>;
  font-family: <?php echo $data['police']; ?>, sans-serif;
  font-family: <?php echo $data['police']; ?>, sans-serif;
  font-family: <?php echo $data['police']; ?>, monospace;
}
#navColor{
  background-color: <?php echo $data['navbar']; ?>;
}
a{
  color: <?php echo $data['url']; ?>;
}
.btn{
  background-color: <?php echo $data['bouton']; ?>;
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
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="page/repertory.php">Repertory</a>
                    </li>
                    <li>
                        <a href="page/about.php">About</a>
                    </li>
                    <li>
                        <a href="page/contact.php">Contact</a>
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
								 <form class="form" role="form" method="post" action="page/loginCheck.php" accept-charset="UTF-8" id="login-nav">
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
                          <a href="page/admin.php">Administration</a>
                          </li>';
                    }

                     ?>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
    <?php
          $carou = mysqli_query($cnx, "SELECT * FROM carou");
          $dataCarou = mysqli_fetch_assoc($carou);
     ?>
        <!-- Indic -->
        <ol class="carousel-indicators">
            <?php echo '<li data-target="#myCarousel" data-slide-to="0" class="active"></li>'; ?>

            <?php $i=1; while ($dataCarou = mysqli_fetch_assoc($carou)) {
              echo '<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>';
              $i++;
            } ?>

        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <?php
          mysqli_data_seek($carou, 0);

          $dataCarou = mysqli_fetch_assoc($carou);

          echo '<div class="item active">
              <div class="fill" style="background-image:url(\'imgCarousel/'.$dataCarou['image'].'\');"></div>
              <div class="carousel-caption">
                  <h2 >'.$dataCarou['title'].'</h2>
                  <p>'.$dataCarou['subtitle'].'</p>
              </div>
          </div>';

        while($dataCarou = mysqli_fetch_assoc($carou)){
          echo '<div class="item">
              <div class="fill" style="background-image:url(\'imgCarousel/'.$dataCarou['image'].'\');"></div>
              <div class="carousel-caption">
                  <h2 >'.$dataCarou['title'].'</h2>
                  <p>'.$dataCarou['subtitle'].'</p>
              </div>
          </div>';
        }
           ?>

        </div>

        <!-- Controls -->
        <?php
        if( $data['fleche'] == "off"){
          $_SESSION['checkF']= false;
        }elseif( $data['fleche'] == ""){
          $_SESSION['checkF']= true;
          echo '<a class="left carousel-control" href="#myCarousel" data-slide="prev">
              <span class="icon-prev"></span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
              <span class="icon-next"></span>
          </a>';
        }
         ?>

    </header>

    <!-- Page Content -->
    <div class="container">

        <!-- Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome !
                </h1>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 ><i class="fa fa-fw fa-check"></i> Lorem ipsum7</h4>
                    </div>
                    <div class="panel-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?</p>
                        <a href="#" class="btn btn-default">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 ><i class="fa fa-fw fa-gift"></i> Dolor Sit</h4>
                    </div>
                    <div class="panel-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?</p>
                        <a href="#" class="btn btn-default">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 ><i class="fa fa-fw fa-compass"></i> Amet</h4>
                    </div>
                    <div class="panel-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?</p>
                        <a href="#" class="btn btn-default">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- Repertory Section -->
        <div class="row">
          <div class="col-lg-12">
                <h2  class="page-header">Last creation</h2>
          </div>

          <?php

          $res = mysqli_query($cnx, "SELECT img FROM users WHERE added='1' LIMIT 10");

          while($data = mysqli_fetch_assoc($res)){
          echo '<div class="portfolio-item col-md-4 col-sm-6">
                  <a href="page/repertory.php">
                    <img class="img-responsive img-portfolio img-hover" src="imgProfil/'.$data['img'].'">
                  </a>
                </div>';
          }
           ?>
         </div>
        <!-- /.row -->


        <hr>

        <!-- Call to Action Section -->
        <div class="well">
            <div class="row">
                <div class="col-md-8">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-lg btn-default btn-block" href="#">Call to Action</a>
                </div>
            </div>
        </div>

        <hr>

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
    <script src="js/bootstrap.min.js"></script>
    <script>
        $('.carousel').carousel({
            interval: 5000
        })
    </script>

</body>

</php>
