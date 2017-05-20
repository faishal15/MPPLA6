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
$ID_Barang1 = $barang['ID_Barang'];
$Nama_Barang = $barang['Nama_Barang'];
$ID_User = $barang['ID_User'];
$Tanggal = $barang['Tanggal'];
$Tempat = $barang['Tempat'];
$Keterangan = $barang['Keterangan'];
$Foto = $barang['Foto'];
$Security = $barang['Security_Ques'];
$result3 = mysqli_query($conn, "SELECT Status FROM transaksi where ID_Barang='$ID_Barang1'");
$row3 = mysqli_fetch_array($result3);
$status = $row3['Status'];
$result4 = mysqli_query($conn, "SELECT Nama_User,No_Telepon FROM users where ID_User='$ID_User'");
$row4 = mysqli_fetch_array($result4);
$nama = $row4['Nama_User'];
$telpon = $row4['No_Telepon'];
if($Foto==NULL)
{
    $Foto = 'nopic.jpg'; 
}
/*FETCH BARANG LAIN*/
$result = mysqli_query($conn, "SELECT * FROM barang order by rand()");

$i = 0; 
while ($row = mysqli_fetch_array($result)) {
  $i++;
  $ID_Barang[$i] = $row['ID_Barang'];
  $List_Barang[$i] = $row['Nama_Barang'];
  $Foto2[$i] = $row['Foto'];
  if($Foto2[$i]==NULL)
  {
    $Foto2[$i] = 'nopic.jpg'; 
  }
}

$sql2 = "select MAX(ID_Message) from message";
$result2=mysqli_query($conn, $sql2);
$row2=mysqli_fetch_array($result2);
$nilaikode = substr($row2[0], 2);
$kode = (int) $nilaikode;
$kode = $kode + 1;
$id_baru = "MS".str_pad($kode, 3, "0", STR_PAD_LEFT);

if(isset($_POST["kirim"]))
{
    if(!empty($_SESSION))
    {
        $sql = "INSERT INTO message (ID_Message, Judul_Message, Isi_Message, ID_Sender, ID_Receiver, Tanggal)
        VALUES ('$id_baru','".$_POST["i_judul"]."','".$_POST["i_isi"]."','".$_POST["i_sender"]."','".$_POST["i_receiver"]."',now())";

        if ($conn->query($sql) === TRUE) {
        echo "<script type= 'text/javascript'>alert('Pesan Berhasil Dikirim');</script>";
        } else {
        echo "<script type= 'text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error."');</script>";
        }
    }
    else
    {
        echo "<script>alert('Anda belum login! Pesan tidak terkirim');</script>";
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
                <a href="index.php">
                    <img src="img/kecil.png">
                </a>
            </div>

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
                        <a class="page-scroll" href="index.php#contact">Contact</a>
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
                                          <h2><span class="glyphicon glyphicon-lock"></span> Login</h2>
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

    <!-- About Section -->
    <section id="about" class="container content-section text-left">
        <div class="row">
            <div class="col-md-3">
                <p class="lead">Masukkan keyword</p>
                <div class="list-group">    
                    <div class="search">
                        <form method="POST" action="caribarang.php" role="search">
                        <input type="text" name="cari" class="form-control" maxlength="30" placeholder="Search" />
                        <br>
                        <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <img class="img-responsive" src="img/<?php echo $Foto ?>" style="width:600px; height:400px;" alt="">
                <br>
                <center>
                <a data-target="#<?php echo $ID_User?>" data-toggle="modal" class="btn btn-primary">Hubungi</a>
                </center>
            </div>
            <div class="modal fade" id="<?php echo $ID_User?>" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 style="color:blue;" class="modal-title">Kirim Pesan</h4>
                    </div>
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label style="color:blue;" class="col-md-3 control-label">NRP</label>
                            <div class="col-md-9">
                            <input name="i_receiver" type="text" class="form-control" value="<?php echo $ID_User?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="color:blue;" class="col-md-3 control-label">Pertanyaan Sekuritas</label>
                            <div class="col-md-9">
                            <input name="i_secure" value="<?php echo $Security?>" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="color:blue;" class="col-md-3 control-label">Telepon</label>
                            <div class="col-md-9">
                            <input name="i_telp" value="<?php echo $telpon?>" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="color:blue;" class="col-md-3 control-label">Judul Pesan</label>
                            <div class="col-md-9">
                            <input name="i_judul" type="text" placeholder="Masukkan Judul Pesan" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="color:blue;" class="col-md-3 control-label">Pesan</label>
                            <div class="col-md-9">
                            <textarea class="form-control" name="i_isi" placeholder="Ketikkan pesan yang ingin dikirimkan..." rows="5"></textarea>
                            </div>
                        </div>
                        <input name="i_sender" type="hidden" class="form-control" value="<?php echo $_SESSION['uname'];?>">
                        <button name="kirim" value="submit" type="submit" class="btn btn-info btn-fill pull-right">Submit</button>
                    </form>
                   </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    if($status=='CLEAR'){
                        echo '<span class="label label-success pull-right">SOLVED</span>';
                    }
                    else
                    {?>
                        <span class="label label-default pull-right circle">NOT SOLVED</span>
                    <?php 
                    }
                    ?>
                <h4>Nama Barang</h4> 
                <h6><?php echo $Nama_Barang; ?></h6>
                <h4>Ditemukan Oleh</h4>
                <h6><?php echo $ID_User; ?> - <?php echo $nama; ?></h6>
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
                    <img class="img-responsive portfolio-item" src="img/<?php echo $Foto2[$i]?>" style="width:300px; height:200px;" alt="">
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
