                        <?php 
				        if($level == "admin"){ 
			
			            ?>
                        <div id="frame-tambah">
                            <a href="<?php echo BASE_URL."my_profile.php?page=my_profile&module=pesanan&action=form"; ?>"
                                class="tombol-action">Daftar Konfirmasi</a>
                        </div>
                        <?php
				        }
			            ?>

                        <?php


$pagination = isset($_GET["pagination"]) ? $_GET["pagination"] : 1;
$data_per_halaman = 10;
$mulai_dari = ($pagination - 1) * $data_per_halaman;
$url = "my_profile.php?page=my_profile&module=pesanan&action=list";

if($level == "admin"){
	$queryPesanan = mysqli_query($koneksi, "SELECT pesanan.*, user.nama FROM pesanan JOIN user ON pesanan.user_id=user.user_id ORDER BY pesanan.tanggal_pemesanan DESC LIMIT $mulai_dari, $data_per_halaman");
}else{
	$queryPesanan = mysqli_query($koneksi, "SELECT pesanan.*, user.nama FROM pesanan JOIN user ON pesanan.user_id=user.user_id WHERE pesanan.user_id='$user_id' ORDER BY pesanan.tanggal_pemesanan DESC LIMIT $mulai_dari, $data_per_halaman");
}

	if(mysqli_num_rows($queryPesanan) == 0){
		echo "<h3>Saat ini belum ada data pesanan</h3>";
	}else{
	
		echo "<table class='table-list'>
				<tr class='baris-title'>
					<th class='kiri'>Nomor Pesanan</th>
					<th class='kiri'>Status</th>
					<th class='kiri'>Nama</th>
					<th class='tengah'>Action</th>
				</tr>";
		
		$adminButton = "";
		while($row=mysqli_fetch_assoc($queryPesanan)){
			if($level == "admin"){
				$adminButton = "<a class='tombol-action' href='".BASE_URL."my_profile.php?page=my_profile&module=pesanan&action=status&pesanan_id=$row[pesanan_id]'>Update Status</a>";
			}
			
			$status = $row['status'];
			echo "<tr>
					<td class='kiri'>$row[pesanan_id]</td>
					<td class='kiri'>$arrayStatusPesanan[$status]</td>
					<td class='kiri'>$row[nama]</td>
					<td class='tengah'>
						<a class='tombol-action' href='".BASE_URL."my_profile.php?page=my_profile&module=pesanan&action=detail&pesanan_id=$row[pesanan_id]'>Detail Pesanan </a>
						$adminButton
					</td>
				</tr>";
		}
		
		echo "</table>";

		
		$queryHitungKategori = mysqli_query($koneksi, "SELECT * FROM pesanan ");
		pagination($queryHitungKategori, $data_per_halaman, $pagination, "my_profile.php?page=my_profile&module=pesanan&action=list");
		
	}
?>