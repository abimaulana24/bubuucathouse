<?php

	$barang_id = isset($_GET['barang_id']) ? $_GET['barang_id'] : false;
	
	$nama_barang = "";
	$kategori_id = "";
	$deskripsi = "";
	$d_singkat = "";
	$gambar = "";
	$stok = "";
	$harga = "";
	
	$keterangan_gambar = "";
	$button = "Add";
	
	if($barang_id){
		$query = mysqli_query($koneksi, "SELECT * FROM barang WHERE barang_id='$barang_id'");
		$row = mysqli_fetch_assoc($query);
		
		$nama_barang = $row['nama_barang'];
		$kategori_id = $row['kategori_id'];
		$deskripsi = $row['deskripsi'];
		$d_singkat = $row['d_singkat'];
		$gambar = $row['gambar'];
		$harga = $row['harga'];
		$stok = $row['stok'];

		$button = "Update";
		
		$keterangan_gambar = "(Klik pilih gambar jika ingin mengganti gambar)";
		$gambar = "<img src='".BASE_URL."frontend/images/barang/$gambar' style='width: 200px;vertical-align: middle;' />";
	}

?>

<script src="<?php echo BASE_URL."frontend/libraries/ckeditor/ckeditor.js";?>"></script>

<form action="<?php echo BASE_URL."module/barang/action.php?barang_id=$barang_id"; ?>" method="POST"
    enctype="multipart/form-data">


    <div class="element-form">
        <label>Kategori</label>
        <span>

            <select name="kategori_id">
                <?php
					$query = mysqli_query($koneksi, "SELECT kategori_id, kategori FROM kategori  ORDER BY kategori ASC");
					while($row=mysqli_fetch_assoc($query)){
						if($kategori_id == $row['kategori_id']){
							echo "<option value='$row[kategori_id]' selected='true'>$row[kategori]</option>";
						}else{
							echo "<option value='$row[kategori_id]'>$row[kategori]</option>";
						}
					}
				?>
            </select>

        </span>
    </div>


    <div class="element-form">
        <label>Nama Kucing</label>
        <span><input type="text" name="nama_barang" value="<?php echo $nama_barang; ?>" /></span>
    </div>
    <div class="element-form">
        <label>Deskripsi Singkat Produk</label>
        <span><input type="text" name="d_singkat" value="<?php echo $d_singkat; ?>" /></span>
    </div>

    <div style="margin-bottom:10px" ;>
        <label style="font-weight:bold" ;>Deskripsi Produk</label>
        <span><textarea name="deskripsi" id="editor"><?php echo $deskripsi; ?></textarea></span>
    </div>

    <div class="element-form">
        <label>Stok</label>
        <span><input type="text" name="stok" value="<?php echo $stok; ?>" /></span>
    </div>

    <div class="element-form">
        <label>Harga</label>
        <span><input type="text" name="harga" value="<?php echo $harga; ?>" /></span>
    </div>

    <div class="element-form">
        <label>Gambar Produk<?php echo $keterangan_gambar;?></label>
        <span>
            <input type="file" name="file" /><?php echo $gambar; ?>
        </span>
    </div>



    

    <div class="element-form">
        <span><input type="submit" name="button" value="<?php echo $button; ?>" /></span>
    </div>


</form>

<script>
CKEDITOR.replace("editor");
</script>