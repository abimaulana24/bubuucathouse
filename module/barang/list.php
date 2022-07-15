<?php 
	$search = isset($_GET["search"]) ? $_GET["search"] : false;

	$where = "";
	$search_url = "";
	if($search){
		$search_url = "&search=$search";
		$where = "WHERE barang.nama_barang LIKE '%$search%'";
	}
?>


<div class="search-section">
    <form action="<?php echo BASE_URL."my_profile.php"; ?>" method="GET">
        <input type="hidden" name="page" value="<?php echo $_GET["page"]; ?>">
        <input type="hidden" name="module" value="<?php echo $_GET["module"]; ?>">
        <input type="hidden" name="action" value="<?php echo $_GET["action"]; ?>">
        <input class="search-engine" type="text" autocomplete="off" name="search" value="<?php echo $search; ?>">
        <input class="search-button" type="submit" value="search">
    </form>
</div>

<div id="frame-tambah">
    <a href="<?php echo BASE_URL."my_profile.php?page=my_profile&module=barang&action=form"; ?>" class="tombol-action">+
        Tambah Produk</a>
</div>

<?php

	
	$pagination = isset($_GET["pagination"]) ? $_GET["pagination"] : 1;
	$data_per_halaman = 10;
	$mulai_dari = ($pagination-1) * $data_per_halaman;
	$url = "my_profile.php?page=my_profile&module=barang&action=list";

	$query = mysqli_query($koneksi, "SELECT barang.*, kategori.kategori FROM barang JOIN kategori ON barang.kategori_id=kategori.kategori_id $where LIMIT $mulai_dari, $data_per_halaman");
	
	if(mysqli_num_rows($query) == 0){
		echo "<h3>Saat ini belum ada barang dalam di dalam table barang </h3>";
	}
	else{
	
		echo "<table class='table-list'>";
		
		echo "<tr class='baris-title'>
				<th class='kolom-nomor' >No</th>
				<th class='kiri' >Barang</th>
				<th class='kiri' >Kategori</th>
				<th class='kiri' >Harga</th>
				
				<th class='tengah' >Action</th>
			</tr>";
			
			$no=1;
			while($row=mysqli_fetch_assoc($query)){
			
				echo "<tr>
						<td class='kolom-nomor' >$no</td>
						<td class='kiri' >$row[nama_barang]</td>
						<td class='kiri' >$row[kategori]</td>
						<td class='kiri' >".rupiah($row["harga"])."</td>
						
						<td class='tengah' >
							<a class='tombol-action' href='".BASE_URL."my_profile.php?page=my_profile&module=barang&action=form&barang_id=$row[barang_id]'>Edit</a>
						</td>
					</tr>";
					
				$no++;	
				
			}
			echo "</table>";
		
		$queryHitungKategori = mysqli_query($koneksi, "SELECT * FROM barang $where");
		pagination($queryHitungKategori, $data_per_halaman, $pagination, "my_profile.php?page=my_profile&module=barang&action=list$search_url");
		
	}

?>