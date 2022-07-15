<?php

	$kecamatan_id = isset($_GET['kecamatan_id']) ? $_GET['kecamatan_id'] : false;
	
	$kecamatan = "";
	$tarif = "";
    $button = "Add";
	
	if($kecamatan_id){
		$queryKecamatan = mysqli_query($koneksi, " SELECT * FROM kecamatan WHERE kecamatan_id='$kecamatan_id'");
		$row = mysqli_fetch_assoc($queryKecamatan);
		$kecamatan = $row['kecamatan'];
        $tarif = $row['tarif'];

		$button = "Update";
	}

?>
<form action="<?php echo BASE_URL."module/kecamatan/action.php?kecamatan_id=$kecamatan_id"; ?>" method="POST">


    <div class="element-form">
        <label>Kecamatan</label>
        <span><input type="text" name="kecamatan" value="<?php echo $kecamatan; ?>" /></span>
    </div>

    <div class="element-form">
        <label>Tarif</label>
        <span><input type="text" name="tarif" value="<?php echo $tarif; ?>" /></span>
    </div>

    

    <div class="element-form tombol-add">
        <span><input type="submit" name="button" value="<?php echo $button; ?>" /></span>
    </div>


</form>