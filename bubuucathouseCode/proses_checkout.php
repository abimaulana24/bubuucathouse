<?php

session_start();
	include_once("frontend/function/helper.php");
	include_once("frontend/function/koneksi.php");
	
	
	$nama_penerima = $_POST["nama_penerima"];
	$nomor_telepon = $_POST["nomor_telepon"];
	$alamat = $_POST["alamat"];
	$kecamatan = $_POST["kecamatan"];
	
	$user_id = $_SESSION['user_id'];
	$waktu_saat_ini = date("Y-m-d H:i:s");
	
	$query = mysqli_query($koneksi, "INSERT INTO pesanan (nama_penerima, user_id, nomor_telepon, kecamatan_id, alamat, tanggal_pemesanan, status)
												VALUES ('$nama_penerima', '$user_id', '$nomor_telepon','$kecamatan','$alamat','$waktu_saat_ini','0')");
												
	if($query){
		$pesanan_id = mysqli_insert_id($koneksi);
		
		$keranjang = $_SESSION['keranjang'];
		
		foreach($keranjang AS $key => $value){
			$barang_id = $key;
			$quantity = $value['quantity'];
			$harga = $value['harga'];
		
			mysqli_query($koneksi, "INSERT INTO pesanan_detail (pesanan_id, barang_id, quantity, harga)
													VALUES ('$pesanan_id', '$barang_id', '$quantity', '$harga')");
		}
		
		unset($_SESSION["keranjang"]);
		
		header("location:".BASE_URL."my_profile.php?page=my_profile&module=pesanan&action=detail&pesanan_id=$pesanan_id");
	}

?>