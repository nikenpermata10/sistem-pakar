<div class="page-header">
    <h1>Tambah Penyakit</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode_penyakit" value="<?= set_value('kode_penyakit', kode_oto('kode_penyakit', 'tb_penyakit', 'P', 2)) ?>" />
            </div>
            <div class="form-group">
                <label>Nama Penyakit <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_penyakit" value="<?= set_value('nama_penyakit') ?>" />
            </div>
            <div class="form-group">
                <label>Solusi</label>
                <textarea class="form-control" name="keterangan" rows="5"><?= set_value('keterangan') ?></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-info simpa"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=penyakit"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>