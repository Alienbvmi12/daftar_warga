<?php 
	define("HOST","localhost");
	define("USERNAME", "root");
	define("PASS","");
	define("DB", "pwpb");
	
	$koneksi=mysqli_connect(HOST,USERNAME,PASS,DB) or die ("Gak konek");
?>