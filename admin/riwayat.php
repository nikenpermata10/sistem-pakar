<div class="page-header">
    <h1>Riwayat Pasien</h1>
</div>

<?php if (isset($_SESSION['flash'])) : ?>
    <div class="flash-data" data-flashdata="<?= $_SESSION['flash']; ?>"></div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="riwayat" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?= _get('q') ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="cetak.php?m=riwayat&q=<?= _get('q') ?>" target="_blank"><span class="glyphicon glyphicon-print"></span> Cetak</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Alamat</th>
                    <th>Gejala</th>
                    <th>Hasil Diagnosa</th>
                    <th>Persentase</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            $q = esc_field(_get('q'));
            $rows = $db->get_results("SELECT * FROM tb_diagnosis 
            WHERE nama LIKE '%$q%' OR umur LIKE '%$q%' OR jeniskelamin LIKE '%$q%' OR alamat LIKE '%$q%' OR gejala LIKE '%$q%' OR hasil_diagnosis LIKE '%$q%' OR persentase LIKE '%$q%' OR keterangan LIKE '%$q%' OR waktu LIKE '%$q%' 
            ORDER BY waktu DESC");
            $nomor = 1;
            foreach ($rows as $row) : ?>
                <tr>
                    <td><?= $nomor ?></td>
                    <td><?= $row->nama ?></td>
                    <td><?= $row->umur ?></td>
                    <td><?= $row->alamat ?></td>
                    <td><?= $row->gejala ?></td>
                    <td><?= $row->hasil_diagnosis ?></td>
                    <td><?= $row->persentase ?>%</td>
                    <td><?= $row->waktu ?></td>
                    <td class="nw">
                        <a class="btn btn-xs btn-info" target="_blank" href="cetak.php?m=riwayat_hasil&q=<?= _get('q') ?>&amp;ID=<?= $row->id_diagnosis ?>"><span class="glyphicon glyphicon-print"></span></a>
                        <a class="btn btn-xs btn-danger dele" href="aksi.php?act=riwayat_hapus&amp;ID=<?= $row->id_diagnosis ?>"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
            <?php
                $nomor++;
            endforeach; ?>
        </table>
    </div>
</div>