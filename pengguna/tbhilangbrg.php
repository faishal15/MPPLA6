<?php
$editid = isset($_GET['editid']) ? $_GET['editid']:'';
if ($editid!="") {
    require("connect.php");
    $sql = "select * from barang where ID_Barang='$editid'";                   
    $result=mysqli_query($conn, $sql);
    $row=mysqli_fetch_array($result);
    $p_id = $row['ID_Barang'];
    $p_id_u = $row['ID_User'];
    $p_nama = $row['Nama_Barang'];
    $p_tgl = $row['Tanggal'];
    $p_tempat = $row['Tempat'];
    $p_kategori = $row['Kategori'];
    $p_foto = $row['Foto'];
    $p_security = $row['Security_Ques'];
    $p_keterangan = $row['Keterangan'];
    $p_edit = 'readonly';
    
    mysqli_close($conn);
} else {
    $p_id = "";
    $p_id_u = "";
    $p_nama = "";
    $p_tgl = "";
    $p_tempat = "";
    $p_kategori = "";
    $p_foto = "";
    $p_security = "";
    $p_keterangan = "";
    $p_edit = "";
}

$act = isset($_GET['act']) ? $_GET['act']:'';
if ($act=="upd") {
    $ps_id = $_POST['i_id'];
    $ps_old_id = $_POST['i_old_id'];
    $ps_id_u = $_POST['i_id_u'];
    $ps_gambar1 = $_FILES['i_gambar']['name'];
    $ps_nama = $_POST['i_nama'];
    $ps_tgl = $_POST['i_tgl'];
    $ps_tmpt = $_POST['i_tmpt'];
    $ps_kat = $_POST['i_kat'];
    $ps_sec = $_POST['i_sec'];
    $ps_ket = $_POST['i_ket'];

    if ($ps_gambar1!=Null)
    {
    $target_dir = "barang/";
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
    
    if ($editid=="") {
        $sql = "INSERT INTO barang (ID_Barang, ID_User, Nama_Barang, Tanggal, Tempat, Kategori, 
            Keterangan, Foto, Security_Ques)
VALUES ('$ps_id', '$ps_id_u', '$ps_nama', '$ps_tgl', '$ps_tmpt', '$ps_kat', '$p_ket', '$ps_gambar', '$ps_sec')";
    } else {
    $sql = "UPDATE barang SET
    ID_Barang = '$ps_id',
    ID_User = '$ps_id_u',
    Nama_Barang = '$ps_nama',
    Tanggal = '$ps_tgl',
    Tempat = '$ps_tmpt',
    Kategori = '$ps_kat',
    Keterangan = '$ps_ket',
    Foto = '$ps_gambar',
    Security_Ques = '$ps_sec'
    WHERE ID_Barang = '$ps_old_id'
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
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>TCARI</span></a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> User <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							<li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
							<li><a href="#"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
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
						<a class="" href="brghilang.php">
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
				<h1 class="page-header">Tambah Barang Hilang</h1>
			</div>
		</div><!--/.row-->	
		
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Form Tambah Barang Hilang</div>
					<div class="panel-body">
						<form class="form-horizontal" action="" method="post" action="?act=upd<?php echo ($editid!="") ? "&editid=$editid":"";  ?>" enctype="multipart/form-data">
							<fieldset>
								<!-- Name input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Nama Barang</label>
									<div class="col-md-9">
									<input id="name" name="name" type="text" placeholder="Masukkan Nama Barang" class="form-control" required>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Gambar Barang</label>
									<div class="col-md-9">
									<input id="gambar" name="gambar" type="file" class="form-control" onchange="readURL(this);" required>
									<img id="ilang" src="#" alt="your image" />
									</div>
								</div>
							
								<script type="text/javascript">
									function readURL(input) {
										if (input.files && input.files[0]) {
											var reader = new FileReader();

											reader.onload = function (e) {
												$('#ilang')
												.attr('src', e.target.result)
												.width(150)
												.height(200);
											};
											reader.readAsDataURL(input.files[0]);
										}
									}
								</script>

								<!-- Email input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="email">Lokasi Kehilangan</label>
									<div class="col-md-9">
										<input id="lokasi" name="lokasi" type="text" placeholder="Lokasi kehilangan" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="email">Tanggal</label>
									<div class="col-md-9">
										<input id="tanggal" name="tanggal" type="date" class="form-control" required>
									</div>
								</div>
								
								<!-- Message body -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Deskripsi</label>
									<div class="col-md-9">
										<textarea class="form-control" id="deskrip" name="deskrip" placeholder="Deskripsikan keterangan barang anda yang hilang..." rows="5" required></textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="email">Pertanyaan Security</label>
									<div class="col-md-9">
										<input id="quest" name="quest" type="text" placeholder="Tambahkan pertanyaan terkait barang" class="form-control" required>
									</div>
								</div>
								
								<!-- Form actions -->
								<div class="form-group">
									<div class="col-md-12 widget-right">
										<button type="submit" class="btn btn-default btn-md pull-right">Submit</button>
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
