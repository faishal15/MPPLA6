<?php
session_start();
if(empty($_SESSION)){
	header("Location: index.php");
}
?>

<?php
$editid = isset($_GET['editid']) ? $_GET['editid']:'';
if ($editid!="") {
    require("connect.php");
    $sql = "select * from users where ID_User='$editid'";                   
    $result=mysqli_query($conn, $sql);
    $row=mysqli_fetch_array($result);
    $p_id = $row['ID_User'];
    $p_nama = $row['Nama_User'];
    $p_telp = $row['No_Telepon'];
    $p_foto = $row['Foto'];
    $p_password = $row['password_user'];
    $p_edit = 'readonly';
    
    mysqli_close($conn);
	} else {
	    $p_id = "";
	    $p_nama = "";
	    $p_telp = "";
	    $p_foto = "";
	    $p_password = "";
	    $p_edit = "";
	}

	$act = isset($_GET['act']) ? $_GET['act']:'';
	if ($act=="upd") {
	    $ps_id = $_POST['i_id'];
	    $ps_old_id = $_POST['i_old_id'];
	    $ps_gambar1 = $_FILES['i_gambar']['name'];
	    $ps_nama = $_POST['i_nama'];
	    $ps_telp = $_POST['i_telp'];
	    $ps_pass = $_POST['i_pass'];

	    if ($_FILES['i_gambar']['name']=="")
	    {
	    	$sql = "UPDATE users SET
		    ID_User = '$ps_id',
		    Nama_User = '$ps_nama',
		    No_Telepon = '$ps_telp',
		    password_user = '$ps_pass'
		    WHERE ID_User = '$ps_old_id'
		    ";
		}
		else
		{
		    $target_dir = "../img/";
		    $target_file = $target_dir . $ps_gambar1;
		    $uploadOk = 1;
		    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		    $ps_gambar = $ps_nama . "." . $imageFileType;
		    $target_file = $target_dir . $ps_gambar;
		    $check = getimagesize($_FILES["i_gambar"]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		    
		    if ($uploadOk == 0) {
		        echo "Sorry, your file was not uploaded.";
		    } else {
		        if (move_uploaded_file($_FILES["i_gambar"]["tmp_name"], $target_file)) {
		            echo "The file ". $ps_gambar. " has been uploaded.";
		        } else {
		            echo "Sorry, there was an error uploading your file.";
		        }
		    }
		    
		    $sql = "UPDATE users SET
		    ID_User = '$ps_id',
		    Nama_User = '$ps_nama',
		    No_Telepon = '$ps_telp',
		    Foto = '$ps_gambar',
		    password_user = '$ps_pass'
		    WHERE ID_User = '$ps_old_id'
		    ";	
		}
	    
	require("connect.php");

	$result=mysqli_query($conn, $sql);
	mysqli_close($conn);

	header("location:index.php");
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
				<h1 class="page-header">Edit Data Diri</h1>
			</div>
		</div><!--/.row-->	
		
		<div class="row row-centered">
			<div class="col-md-8 col-centered">
				<div class="panel panel-default">
					<div class="panel-heading"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Form Edit Data Diri</div>
					<div class="panel-body">
						<form class="form-horizontal" method="post" action="?act=upd<?php echo ($editid!="") ? "&editid=$editid":"";?>" enctype="multipart/form-data">
							<fieldset>
								<!-- Name input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Nama</label>
									<div class="col-md-9">
									<input name="i_nama" type="text" value="<?php echo $p_nama?>" class="form-control" required>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Foto</label>
									<div class="col-md-9">
									<img src="../img/<?php echo $p_foto?>" style="width:200px; height:200px;" alt="your image" />
									<input name="i_gambar" type="file" class="form-control" onchange="readURL(this);">
									<img id="profil" src="#" alt="your image" />
									</div>
								</div>
													
								<!-- Email input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="email">Nomor Telepon</label>
									<div class="col-md-9">
										<input name="i_telp" type="text" value="<?php echo $p_telp?>" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="email">Password</label>
									<div class="col-md-9">
										<input name="i_pass" type="text" value="<?php echo $p_password?>" class="form-control" required>
									</div>
								</div>
								<input name="i_old_id" type="hidden" value="<?php echo $p_id?>" class="form-control">
								<input name="i_id" type="hidden" value="<?php echo $p_id?>" class="form-control">
								
								<script type="text/javascript">
									function readURL(input) {
										if (input.files && input.files[0]) {
											var reader = new FileReader();

											reader.onload = function (e) {
												$('#profil')
												.attr('src', e.target.result)
												.width(200)
												.height(200);
											};
											reader.readAsDataURL(input.files[0]);
										}
									}
								</script>

								<div class="form-group">
									<div class="col-md-12 widget-right">
									<center>										
										<button type="reset" class="btn btn-default">Reset</button>
										<button type="submit" class="btn btn-primary">Ubah</button>
									</center>
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
