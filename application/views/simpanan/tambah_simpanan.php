<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- tcari nilai max menjumlahkan dengan 1 -->
    <?php
    $angmaxtam = 0;
    $angmaxtam = $angmax1 + 1;

    ?>


    <div class="container">
        <div class="row mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary"> Tambah Simpanan </h6>
                    </div>
                    <div class="card-body">


                        <!-- //menampilkan pesan error yang sudah diset tadi controler (dihapus karena pake required)-->
                        <!-- <?php echo form_open_multipart('berita/tambah_data'); ?> -->
                        <!-- ///menmapilkan input kode otomatis -->

                        <form action="<?= base_url('simpanan/prostam_simpanan'); ?>" method="POST">
                            <div class="form-group">
                                <label for="judul">Id Anggota</label>
                                <input type="text" name="id_anggota" class="form-control" id="id_anggota" value="<?= $anggota['id_anggota'] ?>" readonly>
                                <?= form_error('id_anggota', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="judul">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" value="<?= $anggota['nama'] ?>" readonly>
                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="judul">angsuran ke</label>
                                <input type="text" name="angsuran" class="form-control" id="angsuran" value="<?php echo $angmaxtam; ?>" required readonly>
                                <?= form_error('angsuran', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="judul">jumlah</label>
                                <input type="text" name="jumlah" class="form-control" id="jumlah" required>
                                <?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_simpan">tanggal</label>
                                <input type="date" class="form-control" name="tanggal_simpan" id="tanggal_simpan" required>
                                <?= form_error('tanggal_simpan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="judul">keterangan</label>
                                <input type="text" name="keterangan" class="form-control" id="keterangan">
                                <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary float-right" name="tambah">tambah data</button>
                            <button type="reset" class="btn btn-danger float-right mr-3" name="tambah">reset data</button>
                        </form>

                    </div>
                </div>




            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->