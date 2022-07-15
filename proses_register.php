<?php

	include_once("frontend/function/helper.php");
	include_once("frontend/function/koneksi.php");
    
    $level = "customer";
	  $nama_lengkap = $_POST['nama_lengkap'];
  	$email = $_POST['email'];
  	$password =$_POST['password'];

    unset($_POST['password']);
    $dataForm = http_build_query($_POST);

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email'");

    if(empty($nama_lengkap) ||empty($email) || empty($password)){
		header("location: ".BASE_URL. "daftar.php?notif=require&$dataForm");
    }elseif(mysqli_num_rows($query) == 1){
		header("location: ".BASE_URL. "daftar.php?notif=email&$dataForm");
	}else{
            $password = $password;
            mysqli_query($koneksi, "INSERT INTO user (level, nama, email, password) 
									VALUES ('$level', '$nama_lengkap','$email', '$password')");
        header("location: ".BASE_URL. "login.php");
    }

?>