<div class="main-wrapper">
    <!-- Start about Area -->
    <!-- <section class="about-area pt-30 pb-10">
        <div class="btn-group ml-3">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                kategori
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
            </div>
        </div>
        <div class="float-right mr-3">
            <form class="form-inline">
                <input class="form-control " type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary my-2 my-sm-0 " type="submit">Search</button>
            </form>
        </div>


    </section> -->
    <!-- End about Area -->



    <!-- Start secvice Area -->

    <section class="secvice-area pt-0 pb-50">


        <div class="container">
            <div class="row mt-3">
                <div class="col-md-11 ml-5">


                    <div class="card-body">

                        <div class="col-lg-8 col-md-12 col-xs-12 mt-4 thumb">
                            <a class="thumbnail" href="#">
                                <img src="<?php echo base_url() . '/gambar/berita/' . $berita['gambar']; ?>" class="img-fluid  max-width: 100%  height: auto" alt="Responsive image">
                            </a>
                        </div>

                        <h4 class="font-weight-bold mt-5 mb-1"><?= $berita['judul'] ?></h4>
                        <small><?= $berita['tanggal_publish'] ?></small>

                        <!-- isinya -->
                        <h5 class="mt-3">
                            <?php
                            $input = $berita['isi'];
                            $pecah = explode("\r\n", $input);
                            $text = "";
                            for ($i = 0; $i <= count($pecah) - 1; $i++) {
                                $part = str_replace($pecah[$i], "<p>" . $pecah[$i] . "</p>", $pecah[$i]);
                                $text .= $part;
                            }
                            ?>
                            <small><?= $text ?>

                        </h5>




                    </div>
                </div>
            </div>

        </div>

    </section>