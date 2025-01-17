<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp" . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>

<div class="container">
    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="div row mt-3">
            <div class="col md 6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data Anggota <strong>Berhasil</strong> <?= $this->session->flashdata('flash'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif ?>
    <div class="row mt-3">
        <div class="col-md-12 ml-0">

            <div class="card shadow mb-4 ">

                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Simpanan Anggota</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body text-gray-800">
                    <div class="row mt-6 float-right">
                        <div class="col-md-12 mb-3">
                            <a href="<?= base_url(); ?>Simpananuser/edit/<?= $anggota_['id_anggota']; ?>" class="btn btn-primary">Lengkapi Data Anda </a>
                        </div>
                    </div>
                    <font size=3>
                        <table width="100%" height="300">
                            <tr>
                                <td rowspan="2" width=50%>
                                    <table width="100%">
                                        <tr>
                                            <td width="35%">Id Anggota</td>
                                            <td>:</td>
                                            <td><?= $anggota_['id_anggota']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Lengkap</td>
                                            <td>:</td>
                                            <td><?= $anggota_['nama']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>:</td>
                                            <td>
                                                <?php if ($anggota_['jenis_kelamin'] == null) : ?>
                                                    -
                                                <?php else : ?>
                                                    <?= $anggota_['jenis_kelamin'] ?>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td>
                                                <?php if ($anggota_['alamat'] == null) : ?>
                                                    -
                                                <?php else : ?>
                                                    <?= $anggota_['alamat']; ?>
                                                <?php endif ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pekerjaan</td>
                                            <td>:</td>
                                            <td>
                                                <?php if ($anggota_['pekerjaan'] == null) : ?>
                                                    -
                                                <?php else : ?>
                                                    <?= $anggota_['pekerjaan']; ?>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nomor hp</td>
                                            <td>:</td>
                                            <td>
                                                <?php if ($anggota_['No_hp'] == null) : ?>
                                                    -
                                                <?php else : ?>
                                                    <?= $anggota_['No_hp']; ?>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td>
                                                <?php if ($anggota_['email'] == null) : ?>
                                                    -
                                                <?php else : ?>
                                                    <?= $anggota_['email']; ?>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>:</td>
                                            <td>
                                                <?php if ($anggota_['status'] == null) : ?>
                                                    -
                                                <?php else : ?>
                                                    <?php if (!$anggota_['status'] == 1) : ?>
                                                        <span class="badge badge-danger">tidak aktif</span>
                                                    <?php else : ?>
                                                        <span class="badge badge-primary">aktif</span>
                                                    <?php endif; ?>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>

                                <td>
                                    <?php if ($anggota_['Foto'] == null) : ?>
                                        <center><small> foto belum ada</small>
                                        <?php else : ?>
                                            <center><img src="<?php echo base_url() . '/gambar/fotoanggota/' . $anggota_['Foto']; ?>" class="card-img" style="width: 80%;">
                                            <?php endif ?>
                                </td>


                            </tr>
                            <tr>
                                <td width="20%">
                                    <?php if ($anggota_['foto_ktp'] == null) : ?>
                                        <center> <small> foto KTP belum ada</small>
                                        <?php else : ?>
                                            <center><img src="<?php echo base_url() . '/gambar/fotoanggota/' . $anggota_['foto_ktp']; ?>" class="card-img" alt="Responsive image" style="width: 80%;">
                                            <?php endif ?>
                                </td>
                            </tr>

                        </table>
                    </font>

                    <p class="card-text"><small class="text-muted">Terdaftar semenjak <?= date('d F Y', $user['date_created']) ?></small></p>

                    <!-- table simpanan anggota per id -->
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="table-primary">
                                    <th>#</th>
                                    <th>Angsuran</th>
                                    <th>Tanggal</th>
                                    <th>keterangan</th>
                                    <th>Jumlah</th>

                                </tr>

                            </thead>
                            <tbody>

                                <?php $start = 1;
                                $totsimuser = 0;
                                foreach ($simpanan_ as $spn_) : ?>
                                    <tr>
                                        <td><?= $start++; ?></td>
                                        <td><?= $spn_['angsuran']; ?></td>
                                        <td><?= $spn_['tanggal_simpan']; ?></td>
                                        <td><?= $spn_['Keterangan']; ?></td>
                                        <td><?= rupiah($spn_['jumlah'])  . ',-'; ?></td>

                                    </tr>
                                    <?php
                                    $totsimuser = $totsimuser +  $spn_['jumlah'];
                                    ?>
                                <?php endforeach ?>
                            </tbody>
                            <?php $sisa = 1000000 - $totsimuser ?>
                            <tr>

                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total<br>Syarat Simpanan <br>________________________-<br> sisa</td>
                                <td><?= rupiah($totsimuser)  . ',-'; ?><br>
                                    <?= rupiah('1000000')  . ',-'; ?><br>
                                    <br>
                                    <?= rupiah($sisa)  . ',-'; ?></td>


                            </tr>


                        </table>
                    </div>


                </div>
            </div>


        </div>
    </div>
</div>



</div>
<!-- End of Main Content -->