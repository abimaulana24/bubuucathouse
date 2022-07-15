<div id="frame-tambah">
    <a class="tombol-action"
        href="<?php echo BASE_URL."my_profile.php?page=my_profile&module=kecamatan&action=form"; ?>">+
        Tambah Kecamatan</a>
</div>

<?php


	$pagination = isset($_GET["pagination"]) ? $_GET["pagination"] : 1;
	$data_per_halaman = 3;
	$mulai_dari = ($pagination-1) * $data_per_halaman;
	$url = "my_profile.php?page=my_profile&module=kecamatan&action=list";
	$queryKecamatan = mysqli_query($koneksi, "SELECT * FROM kecamatan ORDER BY kecamatan ASC LIMIT $mulai_dari, $data_per_halaman");
	
	if(mysqli_num_rows($queryKecamatan) == 0){
		echo "<h3>Saat ini belum ada nama kecamatan yang didalam database.</h3>";
	}
	else{
		echo "<table class='table-list'>";
		
			echo "<tr class='baris-title'>
					<th class='kolom-nomor'>No</th>
					<th class='kiri'>kecamatan</th>
					<th class='kiri'>Tarif</th>
					
					<th class='tengah'>Action</th>
				 </tr>";
				 
			$no = 1;
			while($rowKecamatan=mysqli_fetch_assoc($queryKecamatan)){
				echo "<tr>
						<td class='kolom-nomor'>$no</td>
						<td>$rowKecamatan[kecamatan]</td>
						<td>".rupiah($rowKecamatan['tarif'])."</td>
						<td class='tengah'>
							<a class='tombol-action' href='".BASE_URL."my_profile.php?page=my_profile&module=kecamatan&action=form&kecamatan_id=$rowKecamatan[kecamatan_id]"."'>Edit</a>
						</td>
					 </tr>";
				
				$no++;
			}
		
		echo "</table>";

		$queryHitungKategori = mysqli_query($koneksi, "SELECT * FROM kecamatan");
		$total_data = mysqli_num_rows($queryHitungKategori);
		$total_halaman = ceil($total_data / $data_per_halaman);

		$batasPosisiNomor = 2;
		$batasJumlahHalaman = 5;
		$mulaiPagination = 1;
		$batasAkhirPagination = $total_halaman;

		echo "
		 <nav aria-label='Page navigation example'>
		 <ul class='pagination justify-content-start mt-4'>";

		 if($pagination > 1){
			 $prev = $pagination - 1;
			 echo "<li class='page-item'><a class='page-link' href='".BASE_URL."$url&pagination=$prev'>Previous</a></li>";
			}

			if($total_halaman >= $batasJumlahHalaman){

				if($pagination > $batasPosisiNomor){
					$mulaiPagination = $pagination - ($batasPosisiNomor - 1);
				}
				
				$batasAkhirPagination = ($mulaiPagination - 1) + $batasJumlahHalaman;
				if($batasAkhirPagination >= $total_halaman){
					$batasAkhirPagination = $total_halaman;
				}
			}

			for($i = $mulaiPagination; $i <= $batasAkhirPagination; $i++){
				if($pagination == $i){
				echo "<li class='page-item active'><a class='page-link' href='".BASE_URL."$url&pagination=$i'>$i</a></li>";
				
			}else{
				echo "<li class='page-item'><a class='page-link' href='".BASE_URL."$url&pagination=$i'>$i</a></li>";
				
			}
			}
			if($pagination < $total_halaman){
			 $next = $pagination + 1;
			 echo "<li class='page-item'><a class='page-link' href='".BASE_URL."$url&pagination=$next'>Next</a></li>";
			}
		echo "</ul>
		</nav>";
	}
?>