<?php
require("connect.php");
session_start();
if(empty($_SESSION)){
	header("Location: index.php");
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
	<?php include 'sidebar.php';?>	
			
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">		
				
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Kirim Pesan</h1>
			</div>
		</div><!--/.row-->	
		
		<div class="row row-centered">
			<div class="col-md-8 col-centered">
				<div class="panel panel-default">
					<div class="panel-heading"><svg class="glyph stroked two messages"><use xlink:href="#stroked-two-messages"></use></svg> Lakukan Pengiriman Pesan</div>
					<div class="panel-body">
						<form class="form-horizontal" action="" method="post">
							<fieldset>
								<!-- Name input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="email">Kirim Ke</label>
									<div class="col-md-9">
										<input name="i_receiver" type="text" placeholder="Tulis NRP Tujuan" class="form-control" required>
									</div>
								</div>
															
								<!-- Email input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="email">Judul Pesan</label>
									<div class="col-md-9">
										<input name="i_judul" type="text" placeholder="Barang hilang" class="form-control" required>
									</div>
								</div>
																
								<!-- Message body -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Isi Pesan</label>
									<div class="col-md-9">
										<textarea class="form-control" name="i_isi" placeholder="Isi pesan yang ingin dikirimkan..." rows="5" required></textarea>
									</div>
								</div>
                                <input name="i_sender" type="hidden" class="form-control" value="<?php echo $_SESSION['uname'];?>">
																						
								<div class="form-group">
									<div class="col-md-12 widget-right">										
										<button name="kirim" value="submit" type="submit" class="btn btn-primary pull-right">Kirim</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
				
			</div><!--/.col-->
			
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
