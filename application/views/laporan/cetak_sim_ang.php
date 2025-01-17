<!DOCTYPE html>
<html>
<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp" . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
} ?>

<head>
    <title>Cetak Transaksi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php base_url(); ?>asset/css/style.css">

    <style>
        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }
    </style>
</head>

<body>
    <div>

        <table style="width: 100% ;">
            <tr>
                <td align="center">
                    <span style="line-height: 1.1; font-weight:bold;">
                        KOPERASI MANDANI DAN MERDEKA<br>
                    </span>
                    <small style=" font-weight:bold;">(Menyediakan Pangan Sehat, Fresh and healthy, Simple and easy to get,<br> Interconnected between producers and consumers)</small>

                </td>
            </tr>
        </table>
    </div>
    <hr class="line-title">

    <bold><a>LAPORAN SIMPANAN ANGGOTA</a></bold><br>
    <div class="card-body">
        <font size=3>
            <div class="table-responsive text-gray-800">
                <table border="2" width="100%" height="300">
                    <tr>
                        <td width=50%>
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
                                            <?php if ($anggota_['status'] == 1) : ?>
                                                <span class="badge badge-primary">aktif</span>
                                            <?php else : ?>
                                                <span class="badge badge-danger">tidak aktif</span>
                                            <?php endif ?>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            </table>
                        </td>



                    </tr>

                </table>
            </div>
        </font>

        <p class="card-text "><small class="text-muted text-gray-800">Terdaftar semenjak <?= date('d F Y', $user['date_created']) ?></small></p>



        <!-- table simpanan anggota per id -->
        <hr>

        <center>
            <bold>
                <h5 class="mb-0 text-gray-900">List Simpanan <?= $anggota_['nama']; ?></h5>
            </bold>
        </center>

        <div>
            <table class="table table-hover text-gray-800" width="100%" border="3">
                <thead>
                    <tr>
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
                    <td>Total<br>Syarat Simpanan <br>________________________-<br> Kekurangan</td>
                    <td><?= rupiah($totsimuser)  . ',-'; ?><br>
                        <?= rupiah('1000000')  . ',-'; ?><br>
                        <br>
                        <?= rupiah($sisa)  . ',-'; ?></td>


                </tr>


            </table>
        </div>


    </div>

    <br><br><br><br>
    <table border="0" width="100%">
        <tr>
            <td width="35%"></td>
            <td width="35%"></td>
            <td width="30%" align="center">
                <p>Padang, <?= date('d F Y') ?></p>
                <br><br><br><br>
                <p> (ADMIN KMDM)</p>

            </td>
        </tr>

    </table>
</body>

</html>