<?php
require("connect.php");
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TCARI-Cari yang hilang yuk</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- Theme CSS -->
    <link href="css/grayscale.min.css" rel="stylesheet">

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">
                    <i class="fa fa-play-circle"></i> <span class="light">TCARI
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                <a class="page-scroll" href="#about">Cari Barang Hilang</a>
            </li>

            <!-- 2. TOLONG TEMUKAN -->       
            <li>
                <a class="page-scroll" href="listbarang.php">Tolong Temukan</a>
            </li>

            <!-- 3. KONTAK -->
            <li>
                <a class="page-scroll" href="#contact">Contact</a>
            </li>

            <!-- 4. LOGIN, USER PROFILE, LOGOUT  --> 
            <?php
            if(!empty($_SESSION)){
                include("connect.php");

                $username  = $_SESSION['uname'];
                echo '<li>
                <a class="page-scroll" href="pengguna">'.$username.'</a>
                </li>';
                echo '<li>
                <a class="page-scroll" href="logout.php">Logout</a>
                </li>';
                }
            else 
            {?>

             <li>
                <a class="page-scroll" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</a>
                <div id="id01" class="modal">                  
                  <form class="modal-content animate" action="login.php" method="post">
                    <div class="imgcontainer">
                      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                    </div>

                    <div class="container">
                        <p color="black">Masukkan</p>
                        <input type="text" class="form-control" placeholder="Enter Username" name="uname" required>
                        <input type="password" class="form-control" placeholder="Enter Password" name="psw" required>
                        <button type="submit" name="submit">Login</button>
                    </div>
                  </form>
                </div>
            </li>       
            <?php
                    }
                
            ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">About The Site
                </h1>
                <p>TCari adalah sistem informasi berbentuk aplikasi berbasis web untuk menangani barang-barang yang hilang dan juga ditemukan dalam lingkungan Teknik Informatika ITS.</p>  

                <p>Kalau kamu pernah kehilangan barang di lingkungan Teknik Informatika ITS, kamu bisa mencari barangmu di sini. Kalau kamu menemukan barang tak bertuan di lingkungan Teknik Informatika ITS, kamu juga bisa membuat postingannya atau <a href="index.php#contact">menghubungi admin.</a></p>
            </div>
        </div>

        <!-- Team Members Row -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Our Team</h2>
            </div>
            <div class="col-lg-3 col-sm-6 text-center">
                <img class="img-circle img-responsive img-center" src="img/avauli.jpg" alt="">
            </div>
            <div class="col-lg-9 col-sm-12 text-left">
                <h3>Fatihah Ulya H.
                    <small>5114100104</small>
                </h3>
                <p>"Kita ingin senang, walaupun itu sederhana." - Pidi Baiq</p>
            </div>  
            </div>

            <div class="col-lg-12">
            <div class="col-lg-9 col-sm-12 text-right">
                <h3>M. Faishal Ilham
                    <small>5114100076</small>
                </h3>
                <p>"Do what you can't." - Samsung</p>
            </div>
            <div class="col-lg-3 col-sm-6 text-center">
                <img class="img-circle img-responsive img-center" src="img/avaical.jpg" alt="">
            </div>
            </div>

            <div class="col-lg-12">
             <div class="col-lg-3 col-sm-6 text-center">
                <img class="img-circle img-responsive img-center" src="img/avapina.jpg" alt="">
            </div>

            <div class="col-lg-9 col-sm-12 text-left">
                <h3>Vinsensia Sipriana Z.
                    <small>5114100066</small>
                </h3>
                <p>"You've got a friend in me." - Toy Story</p>
            </div>
            </div>
      
    </section>
         <!-- Introduction Row -->
        

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>&copy; 2017 TCari | <a href="about.php">About</a><p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script>

    <!-- Theme JavaScript -->
    <script src="js/grayscale.min.js"></script>

</body>

</html>
