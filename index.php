<?php
require("connect.php");
session_start();

$result = mysqli_query($conn, "SELECT * FROM barang order by ID_Barang desc");

$i = 0; 
while ($row = mysqli_fetch_array($result)) {
  $i++;
  $ID_Barang[$i] = $row['ID_Barang'];
  $Nama_Barang[$i] = $row['Nama_Barang'];
  $Foto[$i] = $row['Foto'];
  if($Foto[$i]==NULL)
  {
    $Foto[$i] = 'nopic.jpg'; 
  }
}

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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- Theme CSS -->
    <link href="css/grayscale.min.css" rel="stylesheet">

    <style>
    /* Full-width input fields */
    input[type=text], input[type=password] {
        width: 80%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    /* Set a style for all buttons */
    button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 80%;
    }

    button:hover {
        opacity: 0.8;
    }

    /* Extra styles for the cancel button */
    .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: #f44336;
    }

    /* Center the image and position the close button */
    .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
        position: relative;
    }

    img.avatar {
        width: 40%;
        border-radius: 50%;
    }

    .container {
        padding: 16px;
    }

    span.psw {
        float: right;
        padding-top: 16px;
    }

    /* The Modal (background) */
   .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%;  Full height 
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        padding-top: 60px;
    }

        .modal-header, h4, .close {
              background-color: #337ab7;
              color:white !important;
              text-align: center;
              font-size: 30px;
          }
          .modal-footer {
              background-color: #f9f9f9;
          }
          
    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button (x) */
    .close {
        position: absolute;
        right: 25px;
        top: 0;
        color: #000;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: red;
        cursor: pointer;
    }

    /* Add Zoom Animation */
    .animate {
        -webkit-animation: animatezoom 0.6s;
        animation: animatezoom 0.6s
    }

    @-webkit-keyframes animatezoom {
        from {-webkit-transform: scale(0)} 
        to {-webkit-transform: scale(1)}
    }
        
    @keyframes animatezoom {
        from {transform: scale(0)} 
        to {transform: scale(1)}
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
        span.psw {
           display: block;
           float: none;
        }
        .cancelbtn {
           width: 100%;
        }
    }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a href="index.php">
                    <img src="img/kecil.png">
                </a>
            </div>

            <!-- PAGE NAVIGATION -->
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>

                    <!-- 1. CARI BARANG -->
                    <li>
                        <a class="page-scroll" href="listtemu.php">Cari Barang Hilang</a>
                    </li>

                    <!-- 2. TOLONG TEMUKAN -->       
                    <li>
                        <a class="page-scroll" href="listhilang.php">Tolong Temukan</a>
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
                        <div id="id01" class="modal" >     
                               <div class="modal-dialog">
                            <div class="modal-content animate">
                                <div class="modal-header">
                                <div class="clearfix"></div>
                                          <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                                          <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
                                        </div>
                                        <div class="modal-body">

                                          <form role="form" action="login.php" method="post" >
                                              <strong class="text-primary">
                                                <span class="glyphicon glyphicon-user"></span> NRP</strong>
                                              <input type="text" class="form-control" name="uname" placeholder="Enter Username" style="width:100%;" required>
                                              
                                              <strong class="text-primary">
                                              <span class="glyphicon glyphicon-eye-open"></span> Password</strong>
                                              <input type="password" class="form-control" name="psw" placeholder="Enter password" style="width:100%;" required>

                                              <button type="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
                                          </form>
                                        </div>
                                </div>
                                </div>
                    </li>       
                    <?php
                    }
                        
                    ?>
                    <li>
                        <a class="page-scroll" href="about.php">About</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">TCARI</h1>
                        <form method="POST" action="caribarang.php" role="search">
                        	<div class="input-group">
                        		<input type="text" name="cari" class="form-control" placeholder="Masukkan Keyword">
                        		<div class="input-group-btn">
                        			<button class="btn btn-default" type="submit">
                        				<i class="glyphicon glyphicon-search"></i>
                        			</button>
                        		</div>
                        	</div>
                        </form>
                        <br>
                        <p class="intro-text">Karena yang hilang belum tentu tidak akan ditemukan
                            <br>- Vinsensia</p>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Barang Hilang Terbaru</h1>
            </div>
        </div>
        <div class="row">
        <?php for($i=1; $i<=6; $i++) { ?>
            <div class="col-md-4 portfolio-item">
                <a href="<?php echo "detail.php?id=$ID_Barang[$i]"?>">
                    <img class="img-responsive" src="img/<?php echo $Foto[$i] ?>" style="width:350px; height:250px;" alt="<?php echo $Foto[$i] ?>">
                    <h3>
                        <?php echo $Nama_Barang[$i] ?>
                    </h3>
                </a>
            </div>
        <?php } ?>
        </div>

        <div class="row">
        	<div class="col-lg-8 col-lg-offset-2">
        		<h1>Barangmu Tidak Ada Juga?</h1>
        		<p><a href="listbarang.php" class="btn btn-default btn-lg">Tampilkan Semua Barang</a>
        		</p>
        	</div>
        </div>
    </section>
    
    <!-- Contact Section -->
    <section id="contact" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h1>Hubungi Kami</h1>
                <h3>WA/SMS/TELP : 089872829292</h3>
                <p><a href="mailto:tcari.online@gmail.com">tcari.online@gmail.com</a>
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>&copy; 2017 TCari<p>
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
