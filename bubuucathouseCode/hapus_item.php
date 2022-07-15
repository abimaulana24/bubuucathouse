<?php

	include_once("frontend/function/helper.php");
	
	session_start();
	
	$barang_id=$_GET['barang_id'];
	$keranjang = $_SESSION['keranjang'];
	
	unset($keranjang[$barang_id]);
	
	$_SESSION['keranjang'] =$keranjang;
	
	header("location:".BASE_URL."keranjang.php");