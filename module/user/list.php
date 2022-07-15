<?php

    $pagination = isset($_GET["pagination"]) ? $_GET["pagination"] : 1;
	$data_per_halaman = 10;
	$mulai_dari = ($pagination-1) * $data_per_halaman;
	$url = "my_profile.php?page=my_profile&module=user&action=list";
    $no=1;
      
    $queryAdmin = mysqli_query($koneksi, "SELECT * FROM user ORDER BY nama ASC LIMIT $mulai_dari, $data_per_halaman");
      
    if(mysqli_num_rows($queryAdmin) == 0)
    {
        echo "<h3>Saat ini belum ada data user yang dimasukan</h3>";
    }
    else
    {
        echo "<table class='table-list'>";
          
            echo "<tr class='baris-title'>
                    <th class='kolom-nomor'>No</th>
                    <th class='kiri'>Nama</th>
                    <th class='kiri'>Email</th>
              
                    <th class='kiri'>Level</th>
                    <th class='tengah'h>Action</th>
                 </tr>";
  
            while($rowUser=mysqli_fetch_array($queryAdmin))
            {
                echo "<tr>
                        <td class='kolom-nomor'>$no</td>
                        <td>$rowUser[nama]</td>
                        <td>$rowUser[email]</td>
                       
                        <td>$rowUser[level]</td>
                        <td class='tengah'><a class='tombol-action' href='".BASE_URL."my_profile.php?page=my_profile&module=user&action=form&user_id=$rowUser[user_id]"."'>Edit</a></td>
                     </tr>";
              
                $no++;
            }
          
        //AKHIR DARI TABLE
        echo "</table>";

        $queryHitungKategori = mysqli_query($koneksi, "SELECT * FROM user");
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