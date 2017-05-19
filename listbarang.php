<?php
require("connect.php");
session_start();

$batas=9; 
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * $batas;
$result = mysqli_query($conn, "SELECT * FROM barang order by ID_Barang desc limit $start_from,$batas");

$i = 0; 
while ($row = mysqli_fetch_array($result)) {
    $i++;
    $ID_Barang[$i] = $row['ID_Barang'];
    $id_user[$i] = $row['ID_User'];
    $nama_barang[$i] = $row['Nama_Barang'];
    $Foto[$i] = $row['Foto'];
    $Security[$i] = $row['Security_Ques'];
    if($Foto[$i]==NULL)
    {
        $Foto[$i] = 'nopic.jpg'; 
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
    <section id="about" class="container content-section text-center">
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
            <div class="col-md-9">
            <h1>LIST BARANG HILANG</h1>
                <div class="row">
                    <?php if ($i>0) for($i=1; $i<=sizeof($ID_Barang); $i++) { ?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <a href="<?php echo "detail.php?id=$ID_Barang[$i]"?>">
                            <img src="img/<?php echo $Foto[$i] ?>" style="width:320px; height:150px;" alt="Barang">
                            </a>
                            <div class="caption">
                                <!-- <h4 class="pull-right">$24.99</h4> -->
                                <h4><a href="<?php echo "detail.php?id=$ID_Barang[$i]"?>"><?php echo $nama_barang[$i]?></a></h4>
                                <p>
                                    <a href="<?php echo "detail.php?id=$ID_Barang[$i]"?>" class="btn btn-primary">Lihat</a>
                                    <a data-target="#<?php echo $ID_Barang[$i]?>" data-toggle="modal" class="btn btn-list">Hubungi</a>
                                </p>
                            </div>
                        </div>
                        <div class="modal fade" id="<?php echo $ID_Barang[$i]?>" role="dialog">
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
                                        <input name="i_receiver" type="text" class="form-control" value="<?php echo $id_user[$i]?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label style="color:blue;" class="col-md-3 control-label">Pertanyaan Sekuritas</label>
                                        <div class="col-md-9">
                                        <input name="i_secure" value="<?php echo $Security[$i]?>" class="form-control" disabled>
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
                                    <input name="i_id" type="hidden" class="form-control" value="MS004">
                                    <input name="i_sender" type="hidden" class="form-control" value="<?php echo $_SESSION['uname'];?>">
                                    <button name="kirim" value="submit" type="submit" class="btn btn-info btn-fill pull-right">Submit</button>
                                </form>
                               </div>
                            </div>
                        </div>
                        <!-- <div id="<?php echo $id_user[$i]?>" class="modal">                  
                            <form class="modal-content animate" action="login.php" method="post">
                                <div class="imgcontainer">
                                    <span onclick="document.getElementById('<?php echo $id_user[$i]?>').style.display='none'" class="close" title="Close Modal">&times;</span>
                                </div>

                                <div class="container">
                                    <p color="black">Masukkan</p>
                                        <input type="text" class="form-control" placeholder="Kepada" value="<?php echo $id_user[$i]?>" required>
                                        <input type="password" class="form-control" placeholder="Pesan" name="psw" required>
                                        <button type="submit" name="submit">Kirim</button>
                                    </div>
                            </form>
                        </div> -->
                    </div>
                    <?php } ?>
                    <div class="row text-center">
                        <div class="col-lg-12">
                            <?php  
                            $sql = "SELECT COUNT(ID_Barang) FROM barang";  
                            $rs_result = mysqli_query($conn, $sql);  
                            $row = mysqli_fetch_array($rs_result);  
                            $total_records = $row[0];  
                            $total_pages = ceil($total_records / $batas);  
                            $pagLink = "<ul class='pagination'>";  
                            for ($i=1; $i<=$total_pages; $i++) { 
                               $pagLink .= "<li><a href='listbarang.php?page=".$i."'>".$i."</a></li>";  
                           };  
                           echo $pagLink . "</ul>";  
                           ?>
                        </div>
                    </div>
                </div>
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
