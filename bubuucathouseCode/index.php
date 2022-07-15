<?php
    session_start();

    include_once("frontend/function/helper.php");
    include_once("frontend/function/koneksi.php");

	$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
	$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : false;
    $page = isset($_GET['page']) ? $_GET['page']: false;
	$kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id']: false;
	
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
    <link rel="icon" href="frontend/images/catlogo1.png" type="image/gif" sizes="16x16" />
    <title>Pet Shop | Home Page</title>
    <link rel="stylesheet" href="frontend/libraries/boostrap/css/bootstrap.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Assistant:wght@200;300;400;500;600;700;800&
    family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
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
                        <a href="index.php" class="nav-link">Beranda</a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="produk.php" class="nav-link">Produk</a>
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

    <!-- Header -->
    <header class="text-center">
        <h1>
            Bubuucathouse
        </h1>
        <p class="mt-3">
            Temukan Kucing Pilihan Anda di Sini
        </p>
        <a href="produk.php" class="btn btn-petshop px-4 mt-4"> Pilih Kucing </a>
    </header>

    <main>


        <!-- Title Produk terbaru -->
        <!-- <section class="section-popular" id="popular">
            <div class="container">
                <div class="row">
                    <div class="col text-center section-popular-heading">
                        <h2>
                            Produk yang Paling
                            <br />
                            Terbaru
                        </h2>
                    </div>
                </div>
            </div>
        </section> -->

        <!-- Produk -->
        <section class="section-related-product-content" id="popularContent">
            <div class="container">
                <div class="section-related-product row justify-content-center">
                    <!-- Barang -->

                    <?php 
                                    
                            $query = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY barang_id DESC LIMIT 4");

                            $no=1;
				            while($row=mysqli_fetch_assoc($query)){
					
					        
					        $barang = strtolower($row["nama_barang"]);
					        $barang = str_replace(" ","-",$barang);
					
					        $style=false;
					        if($no == 4){
						    $style="style='margin-right:0px'";
						    $no=0;
					        }

                     echo"
                            
                                      <div class='col-sm-6 col-md-6 col-lg-3 mt-4'>
                            
                                      <div class='card-related text-center d-flex flex-column shadow-sm'>
                                      <img class='gambar-terkait' src='".BASE_URL."frontend/images/barang/$row[gambar]'>
                                      <div class='nama-barang'>
                                      $row[nama_barang]
                                      </div>
                                      <div class='harga-barang'>".rupiah($row['harga'])."</div>
                                      <div class='barang-button mt-auto'>
                                      <a href='".BASE_URL."details.php?barang_id=$row[barang_id]' class='btn btn-lihat-detail px-4'>
                                      Lihat Detail
                                      </a>
                                      </div>
                                      </div>
                                      </div>
                            
                                      ";
                                      
                                      $no++;
                                    }
                                    ?>
                </div>
            </div>
        </section>
        <!-- Akhir Produk -->

        <!-- Tentang Kami -->
        <div class="container-fluid accordion mt-5" id="accordionExample">
            <div class="accordion-item" style="background-color: transparent">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button border-0 collapsed"
                        style="background-color: #ececec; color: #07284e" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Tentang Kami.
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body" style="color: #07284e">
                        <div class="container-fluid toko-ps">
                            <div class="row justify-content-end">
                                <div class="col-sm-12 col-md-8 col-lg-6">
                                    <h1>Bubuucathouse</h1>
                                </div>
                            </div>
                        </div>

                        <div class="container-fluid tentang-kami text-center">
                            <div class="row justify-content-center">
                                <div class="col-sm-6 col-md-6 col-lg-4 mt-5 mb-5">
                                    <h1>Tentang Kami</h1>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mx-4">
                                    <p>
                                        Bubuucathouse berlokasi di Jl.Teladan No.15, kuta alam, Banda Aceh
                                    </p>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mx-4">
                                    <p>
                                        Temukan berbagai macam kucing pilihan anda disini untuk menemani anda diwaktu luang
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Akhir Tentang Kami -->
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