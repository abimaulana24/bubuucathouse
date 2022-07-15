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
    <title>Pet Shop | Checkout</title>
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
                        <a href="produk.php" class="nav-link dropdown-toggle" id="navbardrop" data-bs-toggle="dropdown">
                            Produk
                        </a>
                        <div class="dropdown-menu">
                            <a href="produk.php?kategori_id=1" class="dropdown-item">Makanan Kering</a>

                            <a href="produk.php?kategori_id=2" class="dropdown-item">Peralatan</a>
                        </div>
                    </li>
                    <li class="nav-item mx-md-2 my-auto ms-auto">
                        <a href="<?php echo BASE_URL. "keranjang.php"; ?>" id="button-keranjang">
                            <img src="<?php echo BASE_URL."frontend/images/icon-cart.png";?>" />
                            <?php
                                if($totalBarang != 0){
                                   echo "<span class='total-barang' style='color:white'>$totalBarang</span>";
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
        <section class="section-checkout-content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-8 pl-lg-0">
                        <div class="card card-details" style="border-radius: 10px; border: 0px none;">
                            <h2>Checkout</h2>
                            <h5>
                                Alamat Pengiriman
                            </h5>
                            <hr>
                            <form action="<?php echo BASE_URL."proses_checkout.php"; ?>" method="POST">

                                <div class="form-group mb-4">
                                    <label>Nama Penerima </label><input type="text" class="form-control w-75"
                                        name="nama_penerima" autocomplete='off' />
                                </div>
                                <div class="form-group mb-4">
                                    <label>Nomor Telepon / Handphone </label><input type="text"
                                        class="form-control w-75" name="nomor_telepon" autocomplete='off' />
                                </div>
                                <div class="form-group mb-4">
                                    <label>Alamat Lengkap Penerima </label><input type="text" class="form-control w-75"
                                        name="alamat" autocomplete='off'/>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Kecamatan </label>
                                    <span>
                                        <select name="kecamatan">
                                            <?php
			                        			$query = mysqli_query($koneksi, "SELECT * FROM kecamatan");
						
			                        			while($row=mysqli_fetch_assoc($query)){
			                        			echo "<option value='$row[kecamatan_id]'>$row[kecamatan] (".rupiah($row["tarif"]).")</option>";
			                        			}
			                        		?>
                                        </select>
                                    </span>
                                </div>
                                <button type="submit" class="btn btn-pilih-alamat shadow mb-4">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card card-details card-check shadow " style="border-radius: 10px; ">
                            <h2>Ringkasan Belanja</h2>
                            <hr>
                            <table class="table-ringkas">


                                <?php
				                $subtotal = 0;
				                foreach($keranjang AS $key => $value){
					
				                	$barang_id = $key;
					
				                	$nama_barang = $value['nama_barang'];
				                	$harga = $value['harga'];
				                	$quantity = $value['quantity'];
					
				                	$total = $quantity * $harga;
				                	$subtotal = $subtotal + $total;
                                    
                                    
                                }
                                echo "<tr>
						            <td colspan='2' class='tengah'><b>Total Belanja</b></td>
						            <td class='tengah'><b>".rupiah($subtotal)."</b></td>
						            </tr>";
                            
                            ?>
                            </table>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>