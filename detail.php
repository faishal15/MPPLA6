<?php
require("connect.php");
session_start();

/*CHECK IF ID IS GIVEN*/
$id = $_GET['id'];
if (null === isset( $_GET['id'] )) {
        header("HTTP/1.0 404 Not Found", true, 404);
        exit;
}

/*FETCH DETAIL BARANG*/
$sql = mysqli_query($conn, "SELECT * FROM barang WHERE ID_BARANG = '$id' LIMIT 1");
$barang = mysqli_fetch_array($sql);
$Nama_Barang = $barang['Nama_Barang'];
$ID_User = $barang['ID_User'];
$Tanggal = $barang['Tanggal'];
$Tempat = $barang['Tempat'];
$Keterangan = $barang['Keterangan'];


/*FETCH BARANG LAIN*/
$result = mysqli_query($conn, "SELECT * FROM barang");

$i = 0; 
while ($row = mysqli_fetch_array($result)) {
  $i++;
  $ID_Barang[$i] = $row['ID_Barang'];
  $List_Barang[$i] = $row['Nama_Barang'];
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
                <a class="navbar-brand page-scroll" href="detail.php">
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
                        <a class="page-scroll" href="#about">Cari barang hilang</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Login</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Tolong temukan</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- About Section -->
    <section id="about" class="container content-section text-left">
        <div class="row">
            <div class="col-md-3">
                <p class="lead">Masukkan keyword</p>
                <div class="list-group">    
                    <div class="search">
                        <input type="text" class="form-control" maxlength="30" placeholder="Search" />
                        <br>
                        <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <img class="img-responsive" src="http://placehold.it/750x500" alt="">
            </div>
            <div class="col-md-4">
                <span class="label label-success pull-right">SOLVED</span>&nbsp;<span class="label label-fail pull-right rounded">SOLVED</span>&nbsp;<span class="label label-default pull-right circle">SOLVED</span>
                <h4>Nama Barang</h4> 
                <h6><?php echo $Nama_Barang; ?></h6>
                <h4>Ditemukan Oleh</h4>
                <h6><?php echo $ID_User; ?></h6>
                <h4>Ditemukan Tanggal</h4>
                <h6><?php echo date('M j Y g:i A', strtotime($Tanggal));?></h6>
                <h4>Keterangan</h4>
                <h6><?php echo $Keterangan; ?></h6>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-12">
                <h3 class="page-header">Barang Lainnya</h3>
            </div>
            <?php for($i=1; $i<=4; $i++) { ?>
            <div class="col-sm-3 col-xs-6">
                <a href="<?php echo "detail.php?id=$ID_Barang[$i]" ?>">
                    <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                    <br>
                    <center><h4><?php echo $List_Barang[$i] ?></h4></center>
                </a>
            </div>
            <?php } ?>

        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>TCARI 2017</p>
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
