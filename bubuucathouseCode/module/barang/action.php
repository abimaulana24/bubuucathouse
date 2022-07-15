<?php
    include("../../frontend/function/koneksi.php");   
    include("../../frontend/function/helper.php");   
	
	admin_only("barang", $level);
	
	$nama_barang = $_POST['nama_barang'];
	$kategori_id = $_POST['kategori_id'];
	$deskripsi = $_POST['deskripsi'];
	$d_singkat = $_POST['d_singkat'];
	
	$button = $_POST['button'];
	$harga = $_POST['harga'];
	$stok = $_POST['stok'];
	$edit_gambar = "";
	
    if($_FILES["file"]["name"] != "")
    {
        $nama_file = $_FILES["file"]["name"];
        move_uploaded_file($_FILES["file"]["tmp_name"], "../../frontend/images/barang/" . $nama_file);
         
        $edit_gambar  = ", gambar='$nama_file'";
    }
     
	
	if($button == "Add")
	{
		mysqli_query($koneksi, "INSERT INTO barang (nama_barang, kategori_id, deskripsi,d_singkat, gambar, harga, stok) 
											VALUES('$nama_barang', '$kategori_id', '$deskripsi', '$d_singkat', '$nama_file', '$harga', '$stok')");
	}
    elseif($button == "Update")
    {
		$barang_id = $_GET['barang_id'];
		
		mysqli_query($koneksi, "UPDATE barang SET kategori_id='$kategori_id',
												  nama_barang='$nama_barang',
												  deskripsi='$deskripsi',
												  d_singkat='$d_singkat',
												  harga='$harga',
												  stok='$stok'
												  $edit_gambar WHERE barang_id='$barang_id'");
	}
	
		header("location:" .BASE_URL."my_profile.php?page=my_profile&module=barang&action=list");
?>