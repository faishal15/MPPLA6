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
$result = mysqli_query($conn, "SELECT * FROM message where ID_Sender='$username' order by tanggal desc");

$i = 0; 
while ($row = mysqli_fetch_array($result)) {
  $i++;
  $ID_Message[$i] = $row['ID_Message'];
  $ID_Sender[$i] = $row['ID_Sender'];
  $ID_Receiver[$i] = $row['ID_Receiver'];
  $Isi_Message[$i] = $row['Isi_Message'];
  $Judul_Message[$i] = $row['Judul_Message'];
  $Tanggal[$i] = $row['Tanggal'];
  // $result2 = mysqli_query($conn, "SELECT * FROM users where ID_User='$ID_Receiver[$i]'");
  // $row2 = mysqli_fetch_array($result2);
  // $penerima[$i] = $row2['Nama_User'];
  if (strlen($Isi_Message[$i]) > 120)
  {
  	$stringCut = substr($Isi_Message[$i], 0, 120);

    // make sure it ends in a word so assassinate doesn't become ass...
    $Isi_Message[$i] = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
  }
}
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

</head>

<body>
	<?php include 'navbar.php';?>
	<?php include 'sidebar.php';?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Pesan Terkirim</h1>
					<div class="panel-heading">Kotak Pesan</div>
						<?php for($i=1; $i<=sizeof($ID_Message); $i++) { ?>
							<a href="pesandetail.php?editid=<?php echo $ID_Receiver[$i]?>-<?php echo $Judul_Message[$i]?>" class="list-group-item">
							<!-- <span class="glyphicon glyphicon-star-empty"></span> --><span class="name" style="min-width: 120px;
							display: inline-block;"><?php echo $ID_Receiver[$i]?></span> <span class=""><?php echo $Judul_Message[$i]?></span>
							<span class="text-muted" style="font-size: 11px;"> - <?php echo $Isi_Message[$i]?></span> <span
							class="badge"><?php echo date('M j Y g:i A', strtotime($Tanggal[$i]));?></span> <span class="pull-right"><span class="glyphicon glyphicon-paperclip"></span></span></a><a href="#">
						<?php } ?>  
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
