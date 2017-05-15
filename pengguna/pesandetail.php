<?php
require("connect.php");
session_start();
if(empty($_SESSION)){
	header("Location: index.php");
}
else
{
	$username = $_SESSION["uname"];
}

$editid = isset($_GET['editid']) ? $_GET['editid']:'';
if ($editid!="") 
{
    require("connect.php");
    $result = mysqli_query($conn, "SELECT * FROM message where (ID_Sender='$editid' AND ID_receiver='$username') or (ID_Sender='$username' and ID_receiver='$editid')");

    $i = 0; 
	while ($row = mysqli_fetch_array($result)) {
	  $i++;
	  $ID_Message[$i] = $row['ID_Message'];
	  $ID_Sender[$i] = $row['ID_Sender'];
	  $ID_Receiver[$i] = $row['ID_Receiver'];
	  $Isi_Message[$i] = $row['Isi_Message'];
	  $Judul_Message[$i] = $row['Judul_Message'];
	  $Tanggal[$i] = $row['Tanggal'];
	  $result3 = mysqli_query($conn, "SELECT Nama_User,Foto FROM users where ID_User='$ID_Sender[$i]'");
	  $row3 = mysqli_fetch_array($result3);
	  $nama[$i] = $row3['Nama_User'];
	  $Foto[$i] = $row3['Foto'];
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
    $sql = "INSERT INTO message (ID_Message, Judul_Message, Isi_Message, ID_Sender, ID_Receiver, Tanggal)
    VALUES ('$id_baru','".$_POST["i_judul"]."','".$_POST["i_isi"]."','".$_POST["i_sender"]."','".$_POST["i_receiver"]."',now())";

    if ($conn->query($sql) === TRUE) {
    echo "<script type= 'text/javascript'>alert('Pesan Berhasil Dikirim!');</script>";
    } else {
    echo "<script type= 'text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error."');</script>";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>TCARI-Cari barang yang hilang yuk</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<?php include 'navbar.php';?>
		
		<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		
		<ul class="nav menu">
			<li><a href="index.php"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"></use></svg>Profile</a></li>
			<li class="parent ">
				<a href="#sub-item-1">
					<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>Kelola Barang</span>  
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="tbhilangbrg.php">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Tambah Barang Hilang
						</a>
					</li>
					<li>
						<a class="" href="brghilang.php">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Daftar Barang Hilang
						</a>
					</li>
					<li>
						<a class="" href="tbhbrgtemuan.php">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Tambah Barang Temuan
						</a>
					</li>
					<li>
						<a class="" href="brgtemuan.php">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Daftar Barang Temuan
						</a>
					</li>
				</ul>
			</li>
			<li class="parent ">
				<a href="#sub-item-2">
					<span data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked two messages"><use xlink:href="#stroked-two-messages"></use></svg>Message</span> 
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li>
						<a class="" href="kirimpesan.php">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Kirim Pesan
						</a>
					</li>
					<li>
						<a class="" href="kotakpesan.php">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Pesan Masuk
						</a>
					</li>
				</ul>
			</li>
			<li><a href="hubadmin.php"><svg class="glyph stroked mobile device"><use xlink:href="#stroked-mobile-device"></use></svg>Call Admin</a></li>
		</ul>
		
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">		
				
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Pesan dari <?php echo $nama[$i]?></h1>
			</div>
		</div><!--/.row-->	
		
		<div class="row row-centered">
			<div class="col-md-10 col-centered">
			
				<div class="panel panel-default chat">
					<div class="panel-heading" id="accordion"><svg class="glyph stroked two-messages"><use xlink:href="#stroked-two-messages"></use></svg> Chat</div>
					<div class="panel-body">
						<ul>
							<?php for($i=1; $i<=sizeof($ID_Message); $i++) { ?>
							<?php if($ID_Sender[$i]!=$username) : ?>
							    <li class="right clearfix">
								<span class="chat-img pull-right">
									<img src="../img/<?php echo $Foto[$i]?>" style="width:80px; height:80px;" alt="User Avatar" class="img-circle" />
								</span>
								<div class="chat-body clearfix">
									<div class="header">
										<strong class="primary-font"><?php echo $nama[$i]?></strong> <small class="text-muted"><?php echo date('M j Y g:i A', strtotime($Tanggal[$i]));?> - <?php echo $Judul_Message[$i]?></small>
									</div>
									<p>
										<?php echo $Isi_Message[$i]?> 
									</p>
								</div>
							</li>
							<?php else : ?>
							    <li class="left clearfix">
								<span class="chat-img pull-left">
									<img src="../img/<?php echo $Foto[$i]?>" style="width:80px; height:80px;" alt="User Avatar" class="img-circle" />
								</span>
								<div class="chat-body clearfix">
									<div class="header">
										<strong class="primary-font"><?php echo $nama[$i]?></strong> <small class="text-muted"><?php echo date('M j Y g:i A', strtotime($Tanggal[$i]));?> - <?php echo $Judul_Message[$i]?></small>
									</div>
									<p>
										<?php echo $Isi_Message[$i]?> 
									</p>
								</div>
							</li>
							<?php endif; ?>
							<?php } ?>
						</ul>
					</div>
					
					<div class="panel-footer">
						<form method="post">
						<div class="input-group">
							<input name="i_judul" type="text" class="form-control input-md" placeholder="Ketikkan judul..."/>
							<input name="i_isi" type="text" class="form-control input-md" placeholder="Ketikkan pesan..."/>
							<input name="i_sender" type="hidden" class="form-control" value="<?php echo $_SESSION['uname'];?>">
							<input name="i_receiver" type="hidden" class="form-control" value="<?php echo $editid;?>">
							<span class="input-group-btn">
								<button class="btn btn-success btn-md" value="submit" type="submit" name="kirim">Send</button>
							</span>
						</div>
						</form>
					</div>
				</div>
				
			</div>
			
		</div><!--/.row-->
	</div>	<!--/.main-->
		  

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		$('#calendar').datepicker({
		});

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
