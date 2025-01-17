<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="assetfrontend/assetfrontend/img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="Colorlib">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Komunitas</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,300,500,600" rel="stylesheet">
    <!--
		CSS
		============================================= -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assetfrontend/css/linearicons.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assetfrontend/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assetfrontend/css/nice-select.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assetfrontend/css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assetfrontend/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assetfrontend/css/main.css">
</head>

<body>

    <div class="main-wrapper-first">          
        <div class=" relative">
            <header>
                <div class="container">
                    <div class="header-wrap">
                        <div class="header-top d-flex justify-content-between align-items-center">
                            <!-- <div class="logo" style="width: 200px; height: 100px;">
                                <a href="<?php echo base_url() ?>f_home/"><img src="<?= base_url() ?>/assetfrontend/img/logo1.png" alt=""></a>
                            </div> -->
                            <div class="main-menubar d-flex align-items-center">
                                <nav class="row">
                                    <ul>
                                        <a href="<?php echo base_url() ?>f_home/">Home</a>
                                    </ul>
                                    <ul class="nav-item dropdown">
                                        <a class=" dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Berita
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <?php foreach ($kategori_ber as $katber) : ?>
                                                <a class="dropdown-item" href="<?php echo base_url() ?>f_berita/berita/<?= $katber['id_kategori']; ?>"><?= $this->session->unset_userdata('keyword_berita'); ?><?= $katber['kategori']; ?></a>
                                            <?php endforeach; ?>
                                        </div>
                                    </ul>
                                    <ul>
                                        <a href="<?php echo base_url() ?>f_home/visimisi">VisiMisi</a>
                                    </ul>
                                    <ul>
                                        <!-- ini untuk mengakhiri sistem login apabila kembali ke menu frontend -->
                                        <a href="<?php echo base_url() ?>auth" target="_blank">
                                            Login</a>
                                    </ul>

                                </nav>

                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="banner-area relative">
                <div class="overlay hero-overlay-bg"></div>
                <div class="container">
                    <div class="row height align-items-center justify-content-center">
                        <div class="col-lg-7">
                            <div class="banner-content text-center">

                                <p><img src="<?= base_url() ?>/assetfrontend/img/logosaja.png" height="50%" width="50%" alt=""></p>
                                <h1 class="text-uppercase text-white"><span>AXSI SOLO RAYA</span> <br> </h1>
                                <p class="text-white p-2 mb-30">
                                    Jl. Prof Moh Yamin No 3 Cerbonan Karanganyar Jawa Tengah
                                    <br> 

                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
