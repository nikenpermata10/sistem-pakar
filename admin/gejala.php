<div class="page-header">
    <h1> Data Gejala</h1>
</div>

<?php if (isset($_SESSION['flash'])) : ?>
    <div class="flash-data" data-flashdata="<?= $_SESSION['flash']; ?>"></div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>


<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="gejala" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?= _get('q') ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
            </div>
            <div class="form-group">
                <a class="btn btn-info" href="?m=gejala_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary " href="cetak.php?m=gejala&q=<?= _get('q') ?>" target="_blank"><span class="glyphicon glyphicon-print"></span> Cetak</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Gejala</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            $q = esc_field(_get('q'));
            $rows = $db->get_results("SELECT * FROM tb_gejala 
        WHERE kode_gejala LIKE '%$q%' OR nama_gejala LIKE '%$q%'
        ORDER BY kode_gejala");
            $no = 0;
            foreach ($rows as $row) : ?>
                <tr>
                    <td><?= $row->kode_gejala ?></td>
                    <td><?= $row->nama_gejala ?></td>
                    <td class="nw">
                        <a class="btn btn-xs btn-warning" href="?m=gejala_ubah&amp;ID=<?= $row->kode_gejala ?>"><span class="glyphicon glyphicon-edit"></span>Edit</a>
                        <a class="btn btn-xs btn-danger dele" href="aksi.php?act=gejala_hapus&amp;ID=<?= $row->kode_gejala ?>"><span class="glyphicon glyphicon-trash"></span>Hapus</a>
                    </td>
                </tr>
            <?php endforeach;
            ?>
        </table>
    </div>
</div>