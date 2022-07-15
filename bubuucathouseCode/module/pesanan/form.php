<?php

	$pagination = isset($_GET["pagination"]) ? $_GET["pagination"] : 1;
	$data_per_halaman = 10;
	$mulai_dari = ($pagination-1) * $data_per_halaman;
	$url = "my_profile.php?page=my_profile&module=pesanan&action=form";
	$queryKonfirmasipesanan = mysqli_query($koneksi, "SELECT * FROM konfirmasi_pembayaran ORDER BY pesanan_id DESC LIMIT $mulai_dari, $data_per_halaman");
	
	if(mysqli_num_rows($queryKonfirmasipesanan) == 0){
		echo "<h3>Saat ini belum ada yang Konfirmasi Pembayaran</h3>";
	}else{
	
		echo "<table class='table-list'>";
		
		echo "<tr class='baris-title'>
				<th class='kiri' >Nomor Pesanan</th>
				<th class='kiri' >Nomor Rekening</th>
				<th class='tengah' >Nama Account</th>
				<th class='tengah' >Tanggal Transfer</th>
			</tr>";
			
			$no=1;
			while($row=mysqli_fetch_assoc($queryKonfirmasipesanan)){
			
				echo "<tr>
						<td class='kiri' >$row[pesanan_id]</td>
						<td class='kiri' >$row[nomor_rekening]</td>
						<td class='tengah' >$row[nama_account]</td>
						<td class='tengah' >$row[tanggal_transfer]</td>
						
					</tr>";
					
				$no++;	
				
			}
			
		echo "</table>";
		$queryHitungKategori = mysqli_query($koneksi, "SELECT * FROM konfirmasi_pembayaran");
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