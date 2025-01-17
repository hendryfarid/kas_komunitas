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
        <section class="about-area pt-20 pb-70">
            <div class="float-right mr-3">
                <form action="<?= base_url('f_berita') ?>/berita/<?= $infokat ?>" method="POST" class="form-inline">
                    <div class="input-group">
                        <input class="form-control " type="search" placeholder="Search" aria-label="Search" name="keyword_berita" autocomplete="off" autofocus>
                        <div class="input-group-append">
                            <input class="btn btn-outline-primary my-2 my-sm-0 " type="submit" name="submit_" value="Search">
                        </div>
                    </div>

                </form>
            </div>

        </section>

        <div class="container">


            <div class="row">
                <?php if (empty($detailberita)) : ?>
                    <div class="alert alert-danger" role="alert">
                        Berita tidak ditemukan
                    </div>
                <?php endif  ?>

                <?php foreach ($detailberita as $brt) : ?>
                    <div class="col-md-4 single-service">
                        <a clas href="<?= base_url(); ?>f_berita/detail/<?= $brt['id']; ?>"><img src="<?php echo base_url() . '/gambar/berita/' . $brt['gambar']; ?>" class="d-block mx-auto img-fluid" width="80%" height="80%"></a>
                        <div class="desc">
                            <a clas href="<?= base_url(); ?>f_berita/detail/<?= $brt['id']; ?>">
                                <h2 class="text-uppercase"><?= $brt['judul'] ?></h2>
                            </a>
                            <small class="text-muted ml-4"> <?= $brt['tanggal_publish'] ?></small>

                            <p>
                                <?= substr($brt['isi'], 0, 97) . '...';  ?>
                            </p>
                            <a class="text-uppercase view-details" href="<?= base_url(); ?>f_berita/detail/<?= $brt['id']; ?>">Baca Selengkapnya...</a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <?= $this->pagination->create_links(); ?>
        </div>

    </section>