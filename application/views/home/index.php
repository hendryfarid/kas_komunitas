<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp" . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>
<div class="container-fluid">



    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div>
                                    <a href=" <?= base_url(); ?>/berita" class=" float-left text-xs font-weight-bold text-primary text-uppercase mb-1">Total berita </a><br>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $totber; ?> Berita
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div>
                                    <a href=" <?= base_url(); ?>/simpanan" class=" float-left text-xs font-weight-bold text-success text-uppercase mb-1">Simpanan Anggota </a><br>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php echo rupiah($jum_sim) ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div>
                                    <a href=" <?= base_url(); ?>anggota/anggota_tidakaktif" class=" float-left text-xs font-weight-bold text-info text-uppercase mb-1">Anggota Belum Aktif </a><br>
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            <?= $jumang_ta ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <?php
                                            $tot = $jumang_ak / $jumlah_ang;
                                            $rata = $tot * 100;

                                            ?>
                                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $rata  ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">

                                <i class="fas fa-user-times fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    <a href=" <?= base_url(); ?>anggota" class=" float-left text-xs font-weight-bold text-warning text-uppercase mb-1">Total Anggota Aktif </a><br>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $jumang_ak ?> <smal> dari</smal> <?= $jumlah_ang ?> anggota
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- //baba -->
            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Koperasi MDM
                    </h6>
                </div>
                <div class="card-body">
                    <p>
                        Pemenuhan kebutuhan sebagai konsumen di era normal baru lebih menguntungkan jika mau dan mampu terlibat dalam perencanaan dan pengadaan barang/jasa yang dibutuhkan..
                    </p>
                    <p class="mb-0">
                        Koperasi MDM <br>
                        Menyediakan Pangan Sehat <br>
                        - Fresh and healthy <br>
                        - Simple and easy to get<br>
                        - Interconnected between producers and consumers
                    </p>
                </div>
            </div>
        </div>



    </div>






</div>
</div>