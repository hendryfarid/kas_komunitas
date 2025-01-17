<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">MyAccount</h6>
    </div>
    <div class="card-body text-gray-900">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->

            <div class="card mb-3" style="max-width: 540px;">

                <?= $this->session->flashdata('messege'); ?>

                <div class="row no-gutters">

                    <div class="col-md-4">

                        <?php if ($anggota_['Foto'] == null) : ?>
                            <center> <small> foto belum ada</small>
                            <?php else : ?>
                                <img src="<?php echo base_url() . '/gambar/fotoanggota/' . $anggota_['Foto']; ?>" class="card-img">
                            <?php endif ?>
                    </div>

                    <div class="col-md-8">
                        <div class="card-body" style="text-align: center;">
                            <strong>
                                <a style="font-size: 25px;" class="card-title"><?= $user['name']; ?></a>
                            </strong>
                            <p class="card-text"><?= $user['email']; ?></p>
                            <p class="card-text"><small class="text-muted">member since <?= date('d F Y', $user['date_created']) ?></small></p>
                            <a href="<?= base_url(); ?>user/edit/<?= $user['id']; ?>" class="badge badge-success  float-right  btn btn-success btn-circle"> <i class="far fa-edit"></i></a>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>
</div>