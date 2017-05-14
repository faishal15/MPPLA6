<?php
session_start();
if(empty($_SESSION)){
	header("Location: index.php");
}
else
{
	$username = $_SESSION["uname"];
}
?>

<?php
require("connect.php");
$result = mysqli_query($conn, "SELECT * FROM message where ID_Receiver='$username'");

$i = 0; 
while ($row = mysqli_fetch_array($result)) {
  $i++;
  $ID_Message[$i] = $row['ID_Message'];
  $ID_Sender[$i] = $row['ID_Sender'];
  $ID_Receiver[$i] = $row['ID_Receiver'];
  $Isi_Message[$i] = $row['Isi_Message'];
  $Judul_Message[$i] = $row['Judul_Message'];
  $Tanggal[$i] = $row['Tanggal'];
}
mysqli_close($conn);
?>

<style>
body{ margin-top:50px;}
.nav-tabs .glyphicon:not(.no-margin) { margin-right:10px; }
.tab-pane .list-group-item:first-child {border-top-right-radius: 0px;border-top-left-radius: 0px;}
.tab-pane .list-group-item:last-child {border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;}
.tab-pane .list-group .checkbox { display: inline-block;margin: 0px; }
.tab-pane .list-group input[type="checkbox"]{ margin-top: 2px; }
.tab-pane .list-group .glyphicon { margin-right:5px; }
.tab-pane .list-group .glyphicon:hover { color:#FFBC00; }
a.list-group-item.read { color: #222;background-color: #F3F3F3; }
hr { margin-top: 5px;margin-bottom: 10px; }
.nav-pills>li>a {padding: 5px 10px;}

.ad { padding: 5px;background: #F5F5F5;color: #222;font-size: 80%;border: 1px solid #E5E5E5; }
.ad a.title {color: #15C;text-decoration: none;font-weight: bold;font-size: 110%;}
.ad a.url {color: #093;text-decoration: none;}
</style>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>TCARI-Cari barang yang hilang yuk</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
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
			<li><a href="index.php"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
			<li class="parent ">
				<a href="#sub-item-1">
					<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg></span> Kelola Barang 
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
					<span data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked two messages"><use xlink:href="#stroked-two-messages"></use></svg></span> Message
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
			<li><a href="hubadmin.php"><svg class="glyph stroked mobile device"><use xlink:href="#stroked-mobile-device"></use></svg> Call Admin</a></li>
		</ul>
		
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Pesan Masuk</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Kotak Pesan</div>
					<ul class="nav nav-tabs">
						<li class="active"><a href="#home" data-toggle="tab"><span class="glyphicon glyphicon-inbox">
						</span>Primary</a></li>
						<li><a href="#settings" data-toggle="tab"><span class="glyphicon glyphicon-plus no-margin">
						</span></a></li>
					</ul>
						<div class="tab-content">
							<div class="tab-pane fade in active" id="home">
								<div class="list-group">
									<?php for($i=1; $i<=sizeof($ID_Message); $i++) { ?>
										<a href="pesandetail.php?editid=<?php echo $ID_Sender[$i]?>" class="list-group-item">
										<span class="glyphicon glyphicon-star-empty"></span><span class="name" style="min-width: 120px;
										display: inline-block;"><?php echo $ID_Sender[$i]?></span> <span class=""><?php echo $Judul_Message[$i]?></span>
										<span class="text-muted" style="font-size: 11px;">- <?php echo $Isi_Message[$i]?></span> <span
										class="badge">12:10 AM</span> <span class="pull-right"><span class="glyphicon glyphicon-paperclip">
									</span></span></a><a href="#" class="list-group-item">
									<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
	</div><!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/bootstrap-table.js"></script>
		
</body>

</html>
