<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Lengkapi Data Anggota
                </div>
                <div class="card-body">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif ?>

                    <!-- //menampilkan pesan error yang sudah diset tadi controler -->

                    <?php echo form_open_multipart(''); ?>
                    <div class="form-group">
                        <label for="judul">Id user</label>
                        <input type="text" name="id" class="form-control" id="id" value="<?= $anggota['id_user'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="judul">Id Anggota</label>
                        <input type="text" name="id_anggota" class="form-control" id="id_anggota" value="<?= $anggota['id_anggota'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="judul">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" value="<?= $anggota['nama'] ?>">
                    </div>

                    <div class=" form-group">
                        <label for="jenis_kelamin">jenis kelamin</label>
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                            <?php foreach ($jekel as $jk) : ?>
                                <?php if ($jk == $anggota['jenis_kelamin']) : ?>
                                    <option value="<?= $jk; ?>" selected> <?= $jk; ?></option>
                                <?php else : ?>
                                    <option value="<?= $jk; ?>"> <?= $jk; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $anggota['alamat'] ?>">
                        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Pekerjaan</label>
                        <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" value="<?= $anggota['pekerjaan'] ?>">
                        <?= form_error('pekerjaan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">No.Hp</label>
                        <input type="text" class="form-control" name="nohp" id="nohp" value="<?= $anggota['No_hp'] ?>">

                    </div>
                    <div class="form-group">
                        <label for="tanggal">Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="<?= $anggota['email'] ?>" readonly>
                    </div>

                    <label for="foto">Foto</label><br>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?php echo base_url('/gambar/fotoanggota/') . $anggota['Foto']; ?>" class="img-thumbnail">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input mb3" id="userfilefoto" name="userfilefoto" size="20">
                                        <label class="custom-file-label" for="userfile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <label for="foto_ktp">Foto KTP</label><br>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?php echo base_url('/gambar/fotoanggota/') . $anggota['foto_ktp']; ?>" class="img-thumbnail">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input mb3" id="userfilektp" name="userfilektp" size="20">
                                        <label class="custom-file-label" for="userfile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label>
                        <?php if ($anggota['status'] == 1) : ?>
                            <span class=" badge badge-primary">aktif</span>
                        <?php else : ?>
                            <span class="badge badge-danger">tidak aktif</span>
                        <?php endif ?>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" name="edit">Perbarui Data</button>
                    </form>


                </div>
            </div>




        </div>
    </div>

</div>