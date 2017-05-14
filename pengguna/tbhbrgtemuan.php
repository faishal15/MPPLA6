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
$uploadOk = 0;
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
		require("connect.php");
		$sql2 = "select MAX(ID_Barang) from barang";
		$result2=mysqli_query($conn, $sql2);
		$row2=mysqli_fetch_array($result2);
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
	    mysqli_close($conn);
	}

	$act = isset($_GET['act']) ? $_GET['act']:'';
	if ($act=="upd") {
	    $nilaikode = substr($row2[0], 1);
   		$kode = (int) $nilaikode;
   		$kode = $kode + 1;
   		$id_baru = "B".str_pad($kode, 3, "0", STR_PAD_LEFT);
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

	        $sql = "INSERT INTO barang (ID_Barang, ID_User, Nama_Barang, Tanggal, Tempat, Kategori, 
	            Keterangan, Foto, Security_Ques)
	VALUES ('$id_baru', '$ps_id_u', '$ps_nama', '$ps_tgl', '$ps_tmpt', '$ps_kat', '$ps_ket', '$ps_gambar', '$ps_sec')";
		}
		else
		{
	        $sql = "INSERT INTO barang (ID_Barang, ID_User, Nama_Barang, Tanggal, Tempat, Kategori, 
	            Keterangan, Foto, Security_Ques)
	VALUES ('$id_baru', '$ps_id_u', '$ps_nama', '$ps_tgl', '$ps_tmpt', '$ps_kat', '$ps_ket', '$ps_gambar', '$ps_sec')"; 
		}
	    
	require("connect.php");

	$result=mysqli_query($conn, $sql);

	$id_transaksi = "TR".str_pad($kode, 3, "0", STR_PAD_LEFT);
	$sql3 = "INSERT INTO transaksi (ID_Transaksi, ID_Barang, ID_Penemu, Status, Kategori)
	VALUES ('$id_transaksi', '$id_baru', '$username', 'NOT CLEAR', '$ps_kat')";
	$result3=mysqli_query($conn, $sql3);
	
	mysqli_close($conn);
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
			<li><a href="hubadmin.php"><svg class="glyph stroked mobile device"><use xlink:href="#stroked-mobile-device"></use></svg> Call Admin</a></li>
		</ul>	
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
			<?php 	
				if ($uploadOk == 0) {
			  
			    } else {
			        if (move_uploaded_file($_FILES["i_gambar"]["tmp_name"], $target_file)) {
			            echo "<div class='alert bg-success bg-dismissable' role='alert'>Success! The file ". $ps_gambar. " has been uploaded. <a href='#' class='close' data-dismiss='alert'>&times;</a></div>";
			        } else {
			            echo "<div class='alert bg-danger bg-dismissable' role='alert'>Sorry, there was an error uploading your file. <a href='#' class='close' data-dismiss='alert'>&times;</a></div>";
			        }
			    }
		
		    ?>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Tambah Barang Temuan</h1>
			</div>
		</div><!--/.row-->	
		
		<div class="row row-centered">
			<div class="col-md-8 col-centered">
				<div class="panel panel-default">
					<div class="panel-heading"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Form Tambah Barang Temuan</div>
					<div class="panel-body">
						<form class="form-horizontal" method="POST" action="?act=upd<?php echo ($editid!="") ? "&editid=$editid":""; ?>" enctype="multipart/form-data">
							<fieldset>
								<!-- Name input-->
								<div class="form-group">
									<label class="col-md-3 control-label">Nama Barang</label>
									<div class="col-md-9">
									<input name="i_nama" type="text" placeholder="Masukkan Nama Barang Temuan" class="form-control" required>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Gambar Barang</label>
									<div class="col-md-9">
									<input name="i_gambar" type="file" class="form-control" onchange="readURL(this);">
									<img id="temu" src="#" alt="your image">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Lokasi Ditemukan</label>
									<div class="col-md-9">
										<input name="i_tmpt" type="text" placeholder="Lokasi ditemukan" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Tanggal</label>
									<div class="col-md-9">
										<input name="i_tgl" type="date" class="form-control" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Deskripsi</label>
									<div class="col-md-9">
										<textarea class="form-control" name="i_ket" placeholder="Deskripsikan keterangan barang yang anda temukan..." rows="5"></textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Pertanyaan Security</label>
									<div class="col-md-9">
										<input name="i_sec" type="text" placeholder="Tambahkan pertanyaan terkait barang" class="form-control" required>
									</div>
								</div>
								
								<input type="hidden" name="i_kat" type="text" class="form-control" value="Ditemukan" required>
								<input type="hidden" name="i_id_u" type="text" class="form-control" value="<?php echo $_SESSION['uname'];?>" required>

								<button type="submit" class="btn btn-info btn-fill pull-right">Submit</button>
								
								<script type="text/javascript">
									function readURL(input) {
										if (input.files && input.files[0]) {
											var reader = new FileReader();

											reader.onload = function (e) {
												$('#temu')
												.attr('src', e.target.result)
												.width(320)
												.height(150);
											};
											reader.readAsDataURL(input.files[0]);
										}
									}
								</script>

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
