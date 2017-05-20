<?php
session_start();
if(empty($_SESSION)){
	header("Location: /mppl/index.php");
}
else {
	$username = $_SESSION["uname"];
}
?>

<?php
require("connect.php");
$result = mysqli_query($conn, "SELECT * FROM users where ID_User = '$username'");

$i = 0; 
while ($row = mysqli_fetch_array($result)) {
  $i++;
  $ID_User[$i] = $row['ID_User'];
  $Foto_User[$i] = $row['Foto'];
  $Nama[$i] = $row['Nama_User'];
  $Telepon[$i] = $row['No_Telepon'];
  $Password[$i] = $row['password_user'];
}
mysqli_close($conn);
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
				<center>
				<h1 class="page-header">Profil Diri</h1>
				<center>
			</div>
		</div><!--/.row-->	
		
		<div class="row row-centered">
			<div class="col-md-8 col-centered">
				<div class="panel panel-default">
					<div class="panel-heading"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Mohon diisi dengan lengkap dan jujur</div>
					<br>
                	<center><img class="img-circle img-responsive img-center" style="width:200px; height:200px;" src="../img/<?php echo $Foto_User[$i]?>"></center>
            <!-- </div> -->
					<div class="panel-body">
						<form class="form-horizontal" action="" method="post">
							<fieldset>
								<!-- Name input-->
								<div class="form-group">
									<label class="col-md-3 control-label">ID</label>
									<div class="col-md-8">
									<input name="ID" type="text" value="<?php echo $ID_User[$i]?>" class="form-control" disabled>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Nama</label>
									<div class="col-md-8">
									<input name="name" type="text" value="<?php echo $Nama[$i]?>" class="form-control" disabled>
									</div>
								</div>
										
								<!-- Email input-->
								<div class="form-group">
									<label class="col-md-3 control-label">Nomor Telepon</label>
									<div class="col-md-8">
										<input name="telp" type="text" value="<?php echo $Telepon[$i]?>" class="form-control" disabled>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Password</label>
									<div class="col-md-8">
										<input name="password" type="password" value="<?php echo $Password[$i]?>" class="form-control" disabled>
									</div>
								</div>
													
								<!-- Form actions -->
								<div class="form-group">
									<div class="col-md-11">
										<a href="editprofil.php?editid=<?php echo $ID_User[$i] ?>"><button type="button" class="btn btn-default btn-md pull-right">Ubah Data</button></a>
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
