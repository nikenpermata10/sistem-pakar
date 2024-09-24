<div class="page-header">
    <h1>Tambah Gejala</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode_gejala" value="<?= set_value('kode_gejala', kode_oto('kode_gejala', 'tb_gejala', 'G', 2)) ?>" />
            </div>
            <div class="form-group">
                <label>Nama Gejala <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_gejala" value="<?= set_value('nama_gejala') ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-info"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=gejala"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>