<?php

	include_once("frontend/function/helper.php");
	include_once("frontend/function/koneksi.php");

    $email = $_POST['email'];
	$password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email' AND password='$password'");
	
	if(mysqli_num_rows($query) == 0){
		header("location: ".BASE_URL. "login.php?notif=true");
	}else{
	
		$row = mysqli_fetch_assoc($query);

        session_start();
		
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['nama'] = $row['nama'];
		$_SESSION['level'] = $row['level'];

		if(isset($_SESSION["proses_checkout"])){
			unset($_SESSION["proses_checkout"]);
			header("location: ".BASE_URL. "checkout.php");	   
		}else{
			header("location: ".BASE_URL. "index.php");
		}

		
	}