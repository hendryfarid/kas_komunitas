<div class="container text-gray-800">
    <div class="row mt-3">
        <div class="col-md-11 ml-5">

            <div class="card shadow mb-4 ">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Berita</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <h5 class="card-title font-weight-bold"><?= $berita['judul'] ?></h5>
                    <h7 class="card-subtitle mb-3 text-muted"><small><?= $berita['tanggal_publish'] ?></small></h7>
                    <!-- <div class="col-md-5 my-auto "> pakai yang bawah
                        <img src="<?php echo base_url() . '/gambar/berita/' . $berita['gambar']; ?>" class="card-img">
                    </div> -->
                    <div class="col-lg-5 col-md-12 col-xs-12 thumb">
                        <a class="thumbnail" href="#">

                            <img src="<?php echo base_url() . '/gambar/berita/' . $berita['gambar']; ?>" class="img-fluid  max-width: 100%  height: auto" alt="Responsive image">
                        </a>
                    </div>
                    <br>
                    <h5>
                        <?php
                        $input = $berita['isi'];
                        $pecah = explode("\r\n", $input);


                        $text = "";

                        for ($i = 0; $i <= count($pecah) - 1; $i++) {
                            $part = str_replace($pecah[$i], "<p>" . $pecah[$i] . "</p>", $pecah[$i]);
                            $text .= $part;
                        }


                        ?>
                        <p class="card-text"><small><?= $text ?></p>
                    </h5>
                    <a href="<?= base_url() ?>berita" class="btn btn-primary">Kembali</a>
                </div>
            </div>


        </div>
    </div>
</div>



</div>
<!-- End of Main Content -->