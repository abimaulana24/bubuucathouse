<?php
  session_start();
  
    include("../../frontend/function/koneksi.php");   
    include("../../frontend/function/helper.php");   
     
	// admin_only("user", $level); 

    $user_id = $_GET['user_id'];
	
    $nama = $_POST['nama'];
	$email = $_POST["email"];
	$level = $_POST["level"];

	mysqli_query($koneksi, "UPDATE user SET nama='$nama',
											   email='$email',										   
											   level='$level'
											   WHERE user_id='$user_id'");

    header("location: ".BASE_URL."my_profile.php?page=my_profile&module=user&action=list");
?>