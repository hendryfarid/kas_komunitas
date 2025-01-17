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
                    <h6 class="m-0 font-weight-bold text-primary">Detail Simpananan Anggota</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">


                    <center>

                        <h5 class="mb-0 text-gray-900 mb-4">List simpanan <b><?= $anggota_['nama']; ?></b></h5>

                    </center>
                    <div class="row mt-3  float-left mt-0">

                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover text-gray-800" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="table-primary">
                                    <th>#</th>
                                    <th>Angsuran</th>
                                    <th>Tanggal</th>

                                    <th>keterangan</th>
                                    <th>Jumlah</th>
                                    <th>Action</th>

                                </tr>

                            </thead>
                            <tbody>

                                <?php $start = 1;
                                $totsimuser = 0;
                                foreach ($simpanan_ as $spn_) : ?>
                                    <tr>
                                        <td><?= $start++; ?></td>
                                        <td><?= $spn_['angsuran']; ?></td>
                                        <td><?= date('d/F/Y', strtotime($spn_['tanggal_simpan'])); ?></td>

                                        <td><?= $spn_['Keterangan']; ?></td>
                                        <td><?= rupiah($spn_['jumlah'])  . ',-'; ?></td>
                                        <td>
                                            <a href="<?= base_url(); ?>simpanan/prosed_simpanan/<?= $anggota_['id_anggota']; ?>/<?= $spn_['id']; ?>" class=" float-left  btn btn-success btn-circle mr-1 "> <i class="far fa-edit"></i></a>
                                            <a href="<?= base_url(); ?>simpanan/hapus_simpanan/<?= $spn_['id']; ?>" class=" float-left mb-2 btn btn-danger btn-circle" onclick="return confirm('Yakin Ingin Menghapus Data?');"> <i class="fas fa-trash"></i></a>
                                        </td>

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
                                <td></td>
                                <td>Total<br>Syarat Simpanan <br>________________________-<br> Kekurangan</td>
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