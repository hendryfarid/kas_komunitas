<!-- Begin Page Content -->
<div class="container-fluid">





    <div class="container">
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Transaksi</h6>
                    </div>
                    <div class="card-body">


                        <!-- //menampilkan pesan error yang sudah diset tadi controler (dihapus karena pake required)-->

                        <!-- ///menmapilkan input kode otomatis -->
                        <?php

                        $koneksi = mysqli_connect('localhost', 'root', '', 'koperasi');

                        //
                        $query = mysqli_query($koneksi, "SELECT max(id_trans) as kodeTerbesar FROM transaksi");
                        $data = mysqli_fetch_array($query);
                        $kodeTrans = $data['kodeTerbesar'];
                        $urutan = (int) substr($kodeTrans, 3, 3);

                        $urutan++;
                        $huruf = "T";
                        $kodeTrans = $huruf . sprintf("%03s", $urutan);

                        ?>

                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="judul">Id Kas</label>
                                <input type="text" name="id_trans" class="form-control" id="id_trans" value="<?= $transaksi['id_trans']; ?>" readonly>

                            </div>
                            <div class="form-group">
                                <label for="judul">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" id="tanggal" value="<?= $transaksi['tanggal']; ?>">

                            </div>
                            <div class=" form-group">
                                <label for="kategori">Jenis Kas</label>
                                <select class="form-control" id="jenis_kas" name="jenis_kas">
                                    <?php foreach ($stat_jekas as $jekas) : ?>
                                        <?php if ($jekas == $transaksi['jenis_kas']) : ?>
                                            <option value="<?= $jekas; ?>" selected> <?= $jekas; ?></option>
                                        <?php else : ?>
                                            <option value="<?= $jekas; ?>"> <?= $jekas; ?></option>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <label for="judul">Jenis Kas</label>
                                <input type="text" name="jenis_kas" class="form-control" id="jenis_kas">
                                <?= form_error('jenis_kas', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div> -->
                            <!-- <div class="form-group" name="kas_msk" id="kas_msk" hidden>
                                <label for="judul">Kas Masuk</label>
                                <input type="text" name="kas_masuk" class="form-control" id="kas_masuk" value="<?= $transaksi['kas_masuk']; ?>">
                                <?= form_error('kas_masuk', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group" name="kas_klr" id="kas_klr" hidden>
                                <label for="judul">Kas Keluar</label>
                                <input type="text" name="kas_keluar" class="form-control" id="kas_keluar" value="<?= $transaksi['kas_keluar']; ?>">
                                <?= form_error('kas_keluar', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div> -->


                            <!-- // -->
                            <div class="form-group" name="kas_msk" id="kas_msk" hidden>
                                <label for="kategori">Kas Masuk</label>
                                <select class="form-control" id="kas_masuk" name="kas_masuk">

                                    <?php foreach ($kmsk as $km) : ?>


                                        <?php if ($km['nama_kas'] == $transaksi['kas_masuk']) : ?>
                                            <option value="<?= $transaksi['kas_masuk']; ?>" selected> <?= $transaksi['kas_masuk']; ?></option>
                                        <?php else : ?>
                                            <option value="<?= $km['nama_kas']; ?>"> <?= $km['nama_kas']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('kas_masuk', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group" name="kas_klr" id="kas_klr" hidden>
                                <label for="kas_keluar">Kas Keluar</label>
                                <select class="form-control" id="kas_keluar" name="kas_keluar">

                                    <?php foreach ($kklr as $kl) : ?>
                                        <?php if ($kl['nama_kas'] == $transaksi['kas_keluar']) : ?>
                                            <option value="<?= $transaksi['kas_keluar']; ?>" selected> <?= $transaksi['kas_keluar']; ?></option>
                                        <?php else : ?>
                                            <option value="<?= $kl['nama_kas']; ?>"> <?= $kl['nama_kas']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('kas_keluar', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <!--  -->
                            <div class="form-group">
                                <label for="judul">Keterangan</label>
                                <input type="text" name="keterangan" class="form-control" id="keterangan" value="<?= $transaksi['keterangan']; ?>">
                                <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="judul">Jumlah</label>
                                <input type="text" name="jumlah" class="form-control" id="jumlah" value="<?= $transaksi['jumlah']; ?>">
                                <?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary float-right" name="tambah">Perbarui Data</button>

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


<!-- //cuman menmpilkan isi combo box ke input text  -->
<!-- <script>
    function ddlselect() {
        var d = document.getElementById("jenis_kas");
        var displaytext = d.options[d.selectedIndex].text;
        document.getElementById("kas_masuk").value = displaytext;
    }
</script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type='text/javascript'>
    $(window).load(function() {
        $("#jenis_kas").change(function() {
            console.log($("#jenis_kas option:selected").val());
            if ($("#jenis_kas option:selected").val() == 'Kas Masuk') {
                $('#kas_msk').prop('hidden', false);
                $('#kas_klr').prop('hidden', 'true');
            } else if ($("#jenis_kas option:selected").val() == 'Kas Keluar') {
                $('#kas_msk').prop('hidden', 'true');
                $('#kas_klr').prop('hidden', false);
            }
        });
    });
</script>