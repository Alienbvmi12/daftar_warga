<?php session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Data warga</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="http://localhost/bootstrap/css/bootstrap.css" rel="stylesheet">
		<link rel="icon" type="image/png" href="https://th.bing.com/th/id/R.3938e0e2787cbf423ab5b52f29792bdf?rik=qji9xIGM2UZEFQ&riu=http%3a%2f%2fpluspng.com%2fimg-png%2fdatabase-icons-download-248-free-database-icon-page-1-1113.png&ehk=8uSv1qR7vuw2WFFZ%2bpJm91aqdImDEAcCHequf8IcYVA%3d&risl=&pid=ImgRaw&r=0">
		<script src="http://localhost/bootstrap/js/bootstrap.min.js"></script>
		<script src="http://localhost/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	</head>
	<body>
	<div class="container">
		<div class="mt-5 pb-4 mb-5 text-center" style="border-bottom : 3px solid black"> <!--Form Head-->
			<h2>Form Daftar Warga</h2>
		</div> <!--Until Here-->
		
		<?php
				include "koneksi_db.php";
				
				if(isset($_SESSION['konfirm'])){
					if($_SESSION['konfirm'] == true){
						print " 
						<div class=\"alert alert-success alert-dismissible fade show\">
							<strong>Berhasil</strong> ".$_SESSION['message']."
						</div>";
					}
					else{
						print "
						<div class=\"alert alert-danger alert-dismissible\">
							<strong>Gagal</strong> ".$_SESSION['message']."
						</div>";
					}
					unset($_SESSION['konfirm']);
				}
			?>
		
		<div> <!--Form body-->
			<form class="needs-validation" action="proses.php" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Nik:</label>
							<input type="search" class="form-control" minlength="16" maxlength="16" name="nik" id="nik" oninput="verif('nik', 'cover')" required></td>
						</div>
						
						<div class="form-group">
							<label>Nama:</label>
							<textarea type="search" class="form-control" maxlength="50" name="nama" required></textarea>
						</div>
						
						<div class="form-group">
							<label>Tempat/tanggal lahir:</label>
							<div class="input-group">
								<input type="search" name="ttl" class="form-control" maxlength="39" required><input class="form-control" type="date" name="ttl2" required>
							</div>
						</div>
						
						<div class="form-group">
							<label>Agama:</label>
							<select name="agama" class="form-control" required>
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
							<input type="search" class="form-control" maxlength="30" name="pekerjaan" required>
						</div>
						
						<div class="form-group">
							<label>Alamat:</label>
							<textarea name="alamat" class="form-control" maxlength="50" required></textarea>
						</div>
						
						<div class="form-group">
							<label>Telepon:</label>
							<input type="search" name="telepon" class="form-control" maxlength="13" id="telepon" oninput="verif('telepon', 'cover2')" required>
						</div>
						
						<div class="form-group">
							<label>Email:</label>
							<input type="search" class="form-control" name="email" maxlength="40" required>
						</div>
						
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Foto:</label><br>
							<button class="btn btn-info" style="" onclick="document.querySelector('#gambar').click();"> Select Photo</button>
							<input type="file" class="form-control" name="gambar" id="gambar" accept="image/*" style="display : none;" required>
						</div>
						<img src="" id="gambar-prev" style="width : 100%;">
						<br>
						<br>
					</div>
				</div>
				<input type="submit" class="btn btn-info" id="submit" name="add">
				<button type="button" onclick="print();" class="btn btn-info">print</button>
				<data id="cover"></data>
				<data id="cover2"></data>
				<data id="cover3"></data>
			</form>

		</div> <!--Until Here-->
		
		<div class="mt-5 pb-4 mb-5 text-center" style="border-bottom : 3px solid black">
			<h2>Data Warga</h2>
		</div>
	</div>
	<div class="container">
		<input id="mySearch" class="form-control" placeholder="Search.." type="search">
	</div>
	<div class="m-5" style="border-radius : 20px; overflow : hidden;">
			<table class="table table-striped">
				<thead class="thead-dark">
					<tr>
						<th>No</th>
						<th>Foto</th>
						<th>Nik</th>
						<th>Nama</th>
						<th>TTL</th>
						<th>Agama</th>
						<th>Pekerjaan</th>
						<th>Alamat</th>
						<th>Telepon</th>
						<th>Email</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody id="badanTabel">
					<?php
						$sql = mysqli_query($koneksi, "select * from data_warga order by nama");
						$no = 1;
						while($data = mysqli_fetch_array($sql)){
							echo "
							<tr>
								<td>{$no}</td>
								<td><img src=\"{$data['gambar']}\" width=\"100px\"></td>
								<td>{$data['nik']}</td>
								<td>{$data['nama']}</td>
								<td>{$data['ttl']}</td>
								<td>{$data['agama']}</td>
								<td>{$data['pekerjaan']}</td>
								<td>{$data['alamat']}</td>
								<td>{$data['telepon']}</td>
								<td>{$data['email']}</td>
								<td>
									<a class='badge badge-warning' href='editndel.php?nik=".$data['nik']."'>Edit</a>
									<a class='badge badge-danger' onclick=\"return confirm('yakin hapus {$data['nama']}?')\" href='proses.php?nik=".$data['nik']."&hapus=true'>Hapus</a>
								</td>
							</tr>
							";
							$no++;
						}
						
						if(isset($_SESSION['img']) AND $_SESSION['delete'] == true){
							$file= $_SESSION['img'];
							$file= explode("/", $file);
							$file = end($file);
							if(file_exists(__DIR__."\\img\\".$file)){
								unlink(__DIR__."\\img\\".$file);
							}
							unset($_SESSION['img']);
							unset($_SESSION['delete']);
						}
					?>
				</tbody>
			</table>
		</div>
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
			
			
			let upload = document.getElementById("gambar");
			let preview = document.getElementById("gambar-prev");
			
			upload.onchange = () => {
				const reader = new FileReader();
				reader.readAsDataURL(upload.files[0]);
				console.log(upload.files[0]);
				alert("Ukuran gambar: "+(upload.files[0].size / 1000)+" KB");
				reader.onload = () => {
					preview.setAttribute("src", reader.result);
					preview.setAttribute("width", "200px");
				}
			}
			
			(function () {
			  'use strict'

			  // Fetch all the forms we want to apply custom Bootstrap validation styles to
			  var forms = document.querySelectorAll('.needs-validation')

			  // Loop over them and prevent submission
			  Array.prototype.slice.call(forms)
				.forEach(function (form) {
				  form.addEventListener('submit', function (event) {
					if (!form.checkValidity()) {
					  event.preventDefault()
					  event.stopPropagation()
					}

					form.classList.add('was-validated')
				  }, false)
				})
			})()
			
			$(document).ready(function(){
			  $("#mySearch").on("input", function() {
				var value = $(this).val().toLowerCase();
				$("#badanTabel tr").filter(function() {
				  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			  });
			});
			
			</script>
</html>

<?php 
		$sql = mysqli_query($koneksi, "select * from data_warga order by nama");
		$no = 1;
		while($data = mysqli_fetch_array($sql)){ ?>
		<div class="card m-2 wider" style="float : left;">
			<div class="wider-cover">
				<img src="<?=$data['gambar']?>" class="card-img-top wider">
			</div>
			<div class="card-body">
				<h5 class="card-title" style="height : 50px; overflow:hidden;"><?=$data['nama'];?></h5>
				<p class="card-subtitle mb-1"><?=$data['email'];?></p>
				<p class="card-subtitle mb-4" style="height : 70px; overflow : hidden;"><?=$data['nik'];?></p>
				
				<a class="badge badge-warning" href="editndel.php?nik=<?=$data['nik']?>">Edit</a>
				<a class="badge badge-danger" onclick="return confirm('yakin hapus {$data['nama']}?')"  href="proses.php?nik=<?=$data['nik']?>">Hapus</a>
			 </div>
		</div>
		<?php }?>

