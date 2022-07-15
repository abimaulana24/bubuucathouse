<?php

  include_once("frontend/function/helper.php");
  $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;


    if($user_id){
      header("location: ".BASE_URL);
    }

  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" href="frontend/images/kucing/logo.png" type="image/gif" sizes="16x16" />
    <title>Pet Shop | Register Page</title>
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
            <a href="index.html" class="navbar-brand">
                <img src="frontend/images/kucing/logo.png" alt="Logo Petshop" style="max-width: 70px" />
            </a>
            <button class="navbar-toggler navbar-toogler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navb">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navb">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-md-2">
                        <a href="index.html" class="nav-link">Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="produk.php" class="nav-link dropdown-toggle" id="navbardrop" data-bs-toggle="dropdown">
                            Produk
                        </a>
                        <div class="dropdown-menu">
                            <a href="produk.php?kategori_id=1" class="dropdown-item">Makanan Kucing</a>
                            <a href="produk.php?kategori_id=2" class="dropdown-item">Peralatan</a>

                        </div>
                    </li>
                    <li>
                        <a href="keranjang.php" id="button-keranjang">
                            <img src="frontend/images/cart.png" />
                            <span class="total-barang me-5"></span>
                        </a>
                    </li>
                </ul>

                <!--Desktop button-->
            </div>
        </nav>
    </div>
    <!-- akhir Navbar -->

    <main>
        <section class="section-login-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 images-login-header pl-lg-0">
                        <img src="frontend/images/bg-login1.jpg" alt="" />
                    </div>
                </div>

                <div class="row justify-content-end">
                    <div class="col-sm-12 col-md-6 col-lg-5 login-content">
                        <h3>
                            Daftarkan diri anda Segera di <br />
                            PetShop
                        </h3>
                        <form action="proses_register.php" method="POST" class="mt-3">
                            <?php 
                        
                                    $notif = isset($_GET['notif'])? $_GET['notif'] : false;
                                    $nama_lengkap = isset($_GET['nama_lengkap'])? $_GET['nama_lengkap'] : false;
                                    $email = isset($_GET['email'])? $_GET['email'] : false;
			                   

                                    if($notif == "require"){
                                      echo "<div class='notif mb-4'>Maaf, anda harus melengkapi form dibawah ini </div>";
                                    }else if($notif == "email"){
                                      echo "<div class='notif mb-4'>Maaf, email yang anda masukkan sudah terdaftar </div>";
                                    }
                                    
                            ?>
                            <div class="email-content my-5">
                                <div class="form-floating mb-3">
                                    <input type="name" class="form-control w-75" id="floatingInput"
                                        placeholder="name@example.com" name="nama_lengkap"
                                        value="<?php echo $nama_lengkap;?>" />
                                    <label for="floatingInput">Nama Anda</label>

                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control w-75" id="floatingInput"
                                        placeholder="name@example.com" name="email" value="<?php echo $email;?>" />
                                    <label for="floatingInput">Email address</label>
                                </div>
                                <div class="form-floating">
                                    <input type="password" class="form-control w-75" id="floatingPassword"
                                        placeholder="Password" name="password" />
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <div class="form-check mt-2 text-start">
                                    <input class="form-check-input" type="checkbox" onclick="myFunction()" value=""
                                        id="defaultCheck1" />
                                    <label class="form-check-label" for="defaultCheck1">
                                        Show Password
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-block w-75 mt-4 mb-2">
                                Daftar
                            </button>
                            <a class="btn btn-signup w-75 mt-2" href="login.php">
                                Masuk
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
    function myFunction() {
        var x = document.getElementById("floatingPassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>