<!-- Begin Page Content -->
<div class="container-fluid">




    <!-- <?php var_dump($berita) ?> -->
    <div class="container">
        <?php if ($this->session->flashdata('flash')) : ?>
            <div class="div row mt-3">
                <div class="col md 6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Data Berita <strong>Berhasil</strong> <?= $this->session->flashdata('flash'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <div class="row mt-3">
            <div class="col-md-6">
                <a href="<?= base_url(); ?>berita/tambah" class="btn btn-primary">Tambah Berita </a>
            </div>
        </div>



        <div class="row mt-3">
            <div class="col-md-6">
                <form action="<?= base_url('Berita') ?>" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari Judul" name="keyword_berita" autocomplete="off" autofocus>
                        <div class="input-group-append">
                            <input class="btn btn-primary" type="submit" name="submit_" value="Search">
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <small>
            <h7 class="mt-2">Jumlah data ditemukan : <?= $total_rows  ?></h7>
        </small>

        <!-- coba -->
        <div class="row row-cols-1 row-cols-md-2">
            <?php if (empty($berita)) : ?>
                <div class="alert alert-danger" role="alert">
                    Berita tidak ditemukan
                </div>
            <?php endif  ?>

            <?php foreach ($berita as $brt) : ?>

                <div class="card mb-1 mt-4 ml-3 text-gray-800" style="max-width: 510px;">

                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="<?php echo base_url() . '/gambar/berita/' . $brt['gambar']; ?>" class="card-img">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">

                                <h5 class="card-title"><b> <?= $brt['judul'] ?></b></h5>

                                <p class="card-text"><small class="text-muted"> <?= $brt['tanggal_publish'] ?></small></p>
                                <hr>
                                </hr>
                                <p class="card-text"> <?= substr($brt['isi'], 0, 97) . '...';  ?><br><br> <a href="<?= base_url(); ?>berita/detail/<?= $brt['id']; ?>"> baca selengkapnya..</a></p>
                                <hr>
                                </hr>

                                <a href="<?= base_url(); ?>berita/hapus/<?= $brt['id']; ?>" class="badge badge-danger float-right mb-2 btn btn-danger btn-circle" onclick="return confirm('Yakin ingin menghapus data?');"> <i class="fas fa-trash"></i></a>
                                <a href="<?= base_url(); ?>berita/edit/<?= $brt['id']; ?>" class="badge badge-success  float-right  btn btn-success btn-circle"> <i class="far fa-edit"></i></a>
                                <a href="<?= base_url(); ?>berita/detail/<?= $brt['id']; ?>" class="badge badge-primary float-right  btn btn-primary btn-circle"><i class="fas fa-info-circle"></i></a>

                            </div>
                        </div>
                    </div>


                </div>

            <?php endforeach ?>

        </div>



        <?= $this->pagination->create_links(); ?>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

</div>