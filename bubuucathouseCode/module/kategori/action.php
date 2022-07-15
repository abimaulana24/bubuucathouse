<?php
    include("../../frontend/function/koneksi.php");   
    include("../../frontend/function/helper.php");   

	admin_only("kategori", $level);
	
	
	$kategori = $_POST['kategori'];
	
	$button = $_POST['button'];
	
	if($button == "Add"){
		mysqli_query($koneksi, "INSERT INTO kategori (kategori) VALUES('$kategori')");
	}
	else if($button == "Update"){
		$kategori_id = $_GET['kategori_id'];
		
		mysqli_query($koneksi, "UPDATE kategori SET kategori='$kategori'
												 WHERE kategori_id='$kategori_id'");
	}	
		header("location:" .BASE_URL."my_profile.php?page=my_profile&module=kategori&action=list");