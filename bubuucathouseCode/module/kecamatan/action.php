<?php
    include("../../frontend/function/koneksi.php");   
    include("../../frontend/function/helper.php");   

	admin_only("kecamatan", $level);
	
	
	$kecamatan = $_POST['kecamatan'];
	$tarif = $_POST['tarif'];
	$status = $_POST['status'];
	
	$button = $_POST['button'];
	
	if($button == "Add"){
		mysqli_query($koneksi, "INSERT INTO kecamatan (kecamatan, tarif) VALUES('$kecamatan', '$tarif')");
	}
	else if($button == "Update"){
		$kecamatan_id = $_GET['kecamatan_id'];
		
		mysqli_query($koneksi, "UPDATE kecamatan SET kecamatan='$kecamatan'
												 WHERE kecamatan_id='$kecamatan_id'");
	}	
		header("location:" .BASE_URL."my_profile.php?page=my_profile&module=kecamatan&action=list");