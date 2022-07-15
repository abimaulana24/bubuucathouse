<?php
  session_start();

	include_once("frontend/function/helper.php");
	include_once("frontend/function/koneksi.php");

    $page = isset($_GET['page']) ? $_GET['page']: false;
	$kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id']: false;
	
	$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
	$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : false;
	$level = isset($_SESSION['level']) ? $_SESSION['level'] : false;
    $keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : array();
    $totalBarang = count($keranjang);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Pet Shop | Keranjang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;1,700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="frontend/styles/main.css" />
</head>

<body>
    <!-- Navbar -->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow">
            <a href="index.php" class="navbar-brand">
                <img src="frontend/images/catlogo1.png" alt="Logo Petshop" style="max-width: 70px" />
            </a>
            <button class="navbar-toggler navbar-toogler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navb">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navb">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-md-2">
                        <a href="index.php" class="nav-link ">Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <!-- <a href="produk.php" class="nav-link dropdown-toggle" id="navbardrop" data-bs-toggle="dropdown">
                            Produk
                        </a>
                        <div class="dropdown-menu">
                            <a href="produk.php?kategori_id=1" class="dropdown-item">Makanan Kucing</a>
                            <a href="produk.php?kategori_id=2" class="dropdown-item">Peralatan</a>

                        </div> -->
                        <a href="produk.php" class="nav-link">Produk</a>
                    </li>
                    <li class="nav-item mx-md-2 my-auto ms-auto">
                        <a href="<?php echo BASE_URL. "keranjang.php"; ?>" id="button-keranjang">
                            <img src="<?php echo BASE_URL."frontend/images/icon-cart.png";?>" />
                            <?php
                                if($totalBarang != 0){
                                   echo "<span class='total-barang' >$totalBarang</span>";
                                }
                            ?>
                        </a>
                    </li>

                    <?php
		      if($user_id){
							      echo "
                     <li class='nav-item dropdown '> 
                          <a class='nav-link dropdown-toggle' id='navbardrop' data-bs-toggle='dropdown' >
                           Hi <b>$nama</b>
                          </a> 
                          <div class='dropdown-menu nama-index'>
								              <a href='".BASE_URL."my_profile.php?page=my_profile&module=pesanan&action=list' class='dropdown-item'>Dashboard</a>	
								              <a href='".BASE_URL."logout.php' class='dropdown-item'>Logout</a>	                 
                          </div>
                      </li>
                </ul>";
				  }else{
					 echo "<form action='login.php' class='ms-auto form-inline my-2 my-lg-0 d-none d-sm-block'>
                        <button class='btn btn-login btn-navbar-right my-2 my-sm-0 px-4' style='color: white'>Masuk</button>
                  </form>";
						    }	
				?>



            </div>
        </nav>
    </div>
    <!-- akhir Navbar -->

    <main style="color: #13403a;">
        <section class="section-checkout-header"></section>
        <section class="section-cart-content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 pl-lg-0">
                        <div class="card card-cart" style="border-radius: 10px; border: 0px none;">
                            <h2>Keranjang</h2>

                            <hr>
                            <?php

	                            if($totalBarang == 0){
		                            echo "<h3>Saat ini belum ada data di dalam keranjang belanja anda</h3>";
	                            }else{
	
		                            $no=1;
		
		                            echo "<table class='table-list'>
				                            <tr class='baris-title'>
				                            	<th class='tengah'>No</th>
		                            			<th class='kiri'>Gambar Barang</th>
		                            			<th class='kiri'>Nama Barang</th>
		                            			<th class='tengah'>Qty</th>
		                            			<th class='kiri'>Harga Satuan</th>
		                            			<th class='tengah'>Total</th>
		                            		</tr>";

		                            $subtotal = 0;
		                            foreach($keranjang AS $key => $value){
		                            	$barang_id = $key;
                                    
		                            	$nama_barang = $value["nama_barang"];
		                            	$quantity = $value["quantity"];
		                            	$gambar = $value["gambar"];
		                            	$harga = $value["harga"];
                                    
		                            	$total = $quantity * $harga;
		                            	$subtotal = $subtotal + $total;
                                    
		                            	echo "<tr>
		                            			<td class='tengah'>$no</td>
		                            			<td class='kiri'><img src='".BASE_URL."frontend/images/barang/$gambar' height='100px' /></td>
		                            			<td class='kiri'>$nama_barang</td>
		                            			<td class='tengah' ><input type ='text' name='$barang_id' value='$quantity' class='update-quantity' /></td>
		                            			<td class='kiri'>".rupiah($harga)."</td>
		                            			<td class='tengah hapus_item'>".rupiah($total)."<a href='".BASE_URL."hapus_item.php?barang_id=$barang_id'><img src='".BASE_URL."frontend/images/delete.png'</a></td>
		                            		</tr>";
                                    
		                            	$no++;
                                    
		                            }
                                
		                            echo "<tr>
                                
		                            		<td colspan='5' class='kanan'><b>Sub Total</b></td>
		                            		<td class='tengah'><b>".rupiah($subtotal)."</b></td>
		                            	  </tr>";
                                
		                            echo "</table>";
                                    
		
                            		echo "<div id='frame-button-keranjang'>
				                            <a class='btn btn-pilih-barang shadow mb-4'id='lanjut-belanja' href='".BASE_URL."produk.php'>< Lanjut Belanja</a>
                            				<a  class='btn btn-pilih-barang shadow mb-4'id='lanjut-pemesanan' href='".BASE_URL."checkout.php'> Lanjut Checkout ></a>
			                            </div>";
                                
                            	}
	
                            ?>

                        </div>
                    </div>



                </div>
            </div>
        </section>
    </main>

    <!-- footer -->

    <div class="shadow-lg">
        <hr aria-hidden="true" />
    </div>

    <footer>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-6 col-lg-3 text-start">
                    <img src="frontend/images/catlogo1.png" width="100px" alt="" />
                </div>
                <div class="col-sm-4 col-md-6 col-lg-3">
                    <h5>Info</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Kontak</a></li>
                    </ul>
                </div>
                <!-- <div class="col-sm-4 col-md-6 col-lg-3">
                    <h5>Perusahaan</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Bantuan Pelayanan</a></li>
                    </ul>
                </div> -->
                <div class="col-sm-4 col-md-6 col-lg-3">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Jl. Teladan No. 15</a></li>
                        <li><a href="#">Kuta Alam,</a></li>
                        <li><a href="#">Banda Aceh</a></li>
                        <li><a href="whatsapp://send?text=Hello&phone=+6289681165515">+6289681165515</a></li>
                    </ul>
                </div>
            </div>
            <hr aria-hidden="true" class="my-3" />

            <div class="row">
                <div class="col-lg-4">
                    <a href="" class="me-2"><i class="bx bxl-instagram"></i> </a>
                    <a href="" class="mx-2"><i class="bx bxl-twitter"></i></a>
                    <a href="" class="mx-2"><i class="bx bxl-facebook"></i></a>
                    <a href="" class="mx-2"><i class="bx bxl-youtube"></i></a>
                </div>
            </div>

            <ul class="text-4 inline-block mt-3 lg-flex" style="padding: 0">
                <li>
                    <a href=""> Privacy Policy </a>
                </li>
                <li>
                    <span aria-hidden="true" class="color-textBlackSoft px-4 hidden lg-inline">|</span>
                    <a href=""> Terms of Use </a>
                </li>
                <li>
                    <span aria-hidden="true" class="color-textBlackSoft px-4 hidden lg-inline">|</span>
                    <a href=""> CA Supply Chain Act </a>
                </li>
                <li>
                    <span aria-hidden="true" class="color-textBlackSoft px-4 hidden lg-inline">|</span>
                    <a href=""> Cookie Preferences </a>
                </li>
            </ul>
            <p>© 2022 Aby. All rights reserved.</p>
        </div>
    </footer>


    <!-- Akhir Footer -->

    <script src="frontend/libraries/jquery/jquery-3.6.0.min.js"></script>
    <script src="frontend/libraries/boostrap/js/bootstrap.js"></script>
    <script src="frontend/libraries/retina/retina.min.js"></script>
    <script>
    $(".update-quantity").on("input", function(e) {
        var barang_id = $(this).attr("name");
        var value = $(this).val();

        $.ajax({
                method: "POST",
                url: "update_keranjang.php",
                data: "barang_id=" + barang_id + "&value=" + value
            })
            .done(function(data) {
                var json = $.parseJSON(data);
                if (json.status == true) {
                    location.reload();
                } else {
                    alert(json.pesan);
                    location.reload();
                }
            });

    });
    </script>
</body>

</html>