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
    <link rel="icon" href="frontend/images/catlogo1.png" type="image/gif" sizes="16x16" />
    <title>Pet Shop | Details Page</title>
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
                    <li class="nav-item dropdown">
                    <a href="produk.php" class="nav-link">Produk</a>
                        <!-- <div class="dropdown-menu">
                            <a href="produk.php?kategori_id=1" class="dropdown-item">Makanan Kucing</a>

                            <a href="produk.php?kategori_id=2" class="dropdown-item">Peralatan</a>
                        </div> -->
                    </li>
                    <li class="nav-item mx-md-2 my-auto ms-auto">
                        <a href="<?php echo BASE_URL. "keranjang.php"; ?>" id="button-keranjang">
                            <img src="<?php echo BASE_URL."frontend/images/icon-cart.png";?>" />
                            <?php
                                if($totalBarang != 0){
                                   echo "<span class='total-barang' style='color:white'  >$totalBarang</span>";
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

    <main>
        <section class="section-details-header"></section>
        <section class="section-details-content">
            <div class="container">
                <div class="row">
                    <div class="col pl-0">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Beranda</li>
                                <li class="breadcrumb-item">Detail</li>
                                <?php
                                      $barang_id = $_GET['barang_id'];
                  
                                      $query = mysqli_query($koneksi, "SELECT * FROM barang WHERE barang_id='$barang_id'");
                                      $row = mysqli_fetch_assoc($query);


                                      echo "<li class='breadcrumb-item active'>$row[nama_barang]</li>";
                                              
                                ?>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-sm-9 col-md-9 col-lg-12 food-detail">
                        <div class="row justify-content-start mt-4 ms-2">
                            <div class="col-sm-12 col-md-6 col-lg-6 text-center">
                                <?php 
                                      echo "
                                          <img src='".BASE_URL."frontend/images/barang/$row[gambar]'/>
                                      ";
                                ?>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 mt-3">
                                <?php
                                      echo "
                                      <h1>$row[nama_barang]</h1>
                                      <h3>Stok : $row[stok]</h3>
                                      <p>".rupiah($row['harga'])."</p>
                                      <h3>$row[d_singkat]</h3>
                                      <div class='barang-button mt-auto'>
                                            <a href='".BASE_URL."tambah_keranjang.php?barang_id=$row[barang_id]' class='btn btn-add-cart my-3 px-4'>
                                            + Add to Cart
                                            </a>
                                      </div>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-deskripsi mt-5" id="deskripsi">
            <div class="container">
                <div class="row">
                    <div class="col text-start deskripsi border">
                        <h2>Deskripsi Produk</h2>
                        <hr />
                        <?php
                              echo"
                              <p>
                                  $row[deskripsi]
                              </p>";
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-related-product" id="productTerkait">
            <div class="container">
                <div class="row">
                    <div class="col text-start section-related-product-header">
                        <h2>Produk Lainnya</h2>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-related-product-content" id="popularContent">
            <div class="container">
                <div class="section-related-product row justify-content-center">
                    <!-- Barang -->

                    <?php 
                          if($kategori_id){
					                    $kategori_id = "AND barang.kategori_id='$kategori_id'";
				                  }
                          $query = mysqli_query($koneksi, "SELECT DISTINCT * FROM barang ORDER BY rand() LIMIT 4");
                          $no=1;
				                  while($row=mysqli_fetch_assoc($query)){
					
                  
                                echo"<div class='col-sm-6 col-md-6 col-lg-3'>
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
                                </div>";
                                $no++;
				                      }
                                    
                    ?>
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