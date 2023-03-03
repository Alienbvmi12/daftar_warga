<?php session_start(); include "koneksi_db.php";?>
<!DOCTYPE html>
<html>
	<head>
	<title>Data warga</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="http://localhost:8080/bootstrap/css/bootstrap.css" rel="stylesheet">
	<script src="http://localhost:8080/bootstrap/js/bootstrap.js"></script>
	<script src="jquery-3.5.1.min.js"></script>
	<?php if(isset($_GET['nik'])){
		$sql = mysqli_query($koneksi, "select * from data_warga where nik='".$_GET['nik']."'");
		$data = mysqli_fetch_array($sql);
		$data['ttl'] = explode("/", $data['ttl']);
		?>
	</head>
	<body>
		<div class="container">
			<div class="mt-5 pb-4 mb-5 text-center" style="border-bottom : 3px solid black"> <!--Form Head-->
				<h2>Form Manipulasi Info Warga</h2>
			</div> <!--Until Here-->
			
			<div> <!--Form body-->
				<form action="proses.php" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Nik:</label>
								<input type="search" class="form-control" value="<?=$data['nik']?>" minlength="16" maxlength="16" name="nik" id="nik" oninput="verif('nik', 'cover')" required>
							</div>
							
							<div class="form-group">
								<label>Nama:</label>
								<textarea type="search" class="form-control" maxlength="50" name="nama" required><?=$data['nama']?></textarea>
							</div>
							
							<div class="form-group">
								<label>Tempat/tanggal lahir:</label>
								<div class="input-group">
									<input type="search" name="ttl" class="form-control" maxlength="39" value="<?=$data['ttl'][0]?>" required><input class="form-control" type="date" value="<?=$data['ttl'][1]?>" name="ttl2" required>
								</div>
							</div>
							
							<div class="form-group">
								<label>Agama:</label>
								<select id="agama" name="agama" class="form-control" required>
									<option value="">--pilih agama--</option>
									<option value="Islam">Islam</option>
									<option value="Protestan">Protestan</option>
									<option value="Katolik">Katolik</option>
									<option value="Hindu">Hindu</option>
									<option value="Buddha">Buddha</option>
									<option value="Konghucu">Konghucu</option>
									<option value="Lainnya">Lainnya</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							
							<div class="form-group">
								<label>Pekerjaan:</label>
								<input type="search" class="form-control" maxlength="30" name="pekerjaan" value="<?=$data['pekerjaan']?>" required>
							</div>
							
							<div class="form-group">
								<label>Alamat:</label>
								<textarea name="alamat" class="form-control" maxlength="50" required><?=$data['alamat']?></textarea>
							</div>
							
							<div class="form-group">
								<label>Telepon:</label>
								<input type="search" name="telepon" class="form-control" maxlength="13" id="telepon" value="<?=$data['telepon']?>" oninput="verif('telepon', 'cover2')" required>
							</div>
							
							<div class="form-group">
								<label>Email:</label>
								<input type="search" class="form-control" name="email" value="<?=$data['email']?>" maxlength="40" required>
							</div>
							
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Foto:</label><br>
								<button type="button" class="btn btn-info" onclick="document.querySelector('#gambar').click();"> Select Photo</button>
								<input type="file" name="gambar" id="gambar" accept="image/*" style="display : none;" value="<?=$data['gambar']?>">
							</div>
							<img src="<?=$data['gambar'];?>" width="200" id="gambar-prev">
						</div>
					</div>
					<input type="submit" class="btn btn-info" id="edit" value="edit" name="edit">
					<data id="cover"></data>
					<data id="cover2"></data>
					<data id="cover3"></data>
			</div> <!--Until Here-->
		</div>
			<input type="hidden" name="nik-toedit" id="nik-toedit" value="<?=$data['nik']?>"><?php }?>
			</form>
	</body>
	<script>
		function verif(nik, cover){
		if(document.getElementById(nik).value.match(/[a-z]/i) || document.getElementById(nik).value.match(/[~`!#$%\^&*=\-\[\]\\;'._@,/{}|\\":<>\?()]/g)){
				
				document.getElementById(nik).value = document.getElementById(cover).value;
				
			}
			else{
				document.getElementById(cover).value = document.getElementById(nik).value;
			}
		}
		
		document.getElementById("agama").value = "<?=$data['agama']?>";
		
		let upload = document.getElementById("gambar");
		let preview = document.getElementById("gambar-prev");
		
		upload.onchange = () => {
			const reader = new FileReader();
			reader.readAsDataURL(upload.files[0]);
			console.log(upload.files[0]);
			alert("Ukuran gambar: "+(upload.files[0].size / 1000)+" KB");
			reader.onload = () => {
				preview.setAttribute("src", reader.result);
			}
		}
		
		</script>
</html>