<?php
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$umur = $_POST['umur'];
$selected = (array)$_POST['selected'];

$gejala = [];
$rows = $db->get_results("SELECT kode_gejala, nama_gejala FROM tb_gejala WHERE kode_gejala IN ('" . implode("','", $selected) . "')");
foreach ($rows as $row) {
    $gejala[$row->kode_gejala] = $row->nama_gejala;
}

$rows = $db->get_results("SELECT * FROM tb_penyakit ORDER BY kode_penyakit");
foreach ($rows as $row) {
    $penyakit[$row->kode_penyakit] = $row;
}

$data = get_data($selected);
$b = new Bayes($selected, $penyakit, $data);

// Get the top diagnosis result
arsort($b->peh_total);
$kode_penyakit = key($b->peh_total);
$nama_penyakit = $penyakit[$kode_penyakit]->nama_penyakit;
$persentase = round($b->peh_total[$kode_penyakit] * 100, 2);
$keterangan = $penyakit[$kode_penyakit]->keterangan;

// Insert into database
$gejala_str = implode(", ", $gejala);
$selected_str = implode(", ", $selected);
$sql = "INSERT INTO tb_diagnosis (nama, umur, alamat, gejala, selected_gejala, hasil_diagnosis, persentase, keterangan) VALUES ('$nama', '$umur', '$alamat', '$gejala_str', '$selected_str', '$nama_penyakit', '$persentase', '$keterangan')";
$db->query($sql);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Data Diri</h3>
    </div>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Nama Pasien</th>
                <th>Umur</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tr>
            <td><?= $nama ?></td>
            <td><?= $umur ?></td>
            <td><?= $alamat ?></td>
        </tr>
    </table>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gejala Yang Di Pilih</h3>
    </div>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Gejala</th>
            </tr>
        </thead>
        <?php
        $no = 1;
        foreach ($gejala as $kode => $namagejala) :
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $namagejala ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a href="#eh" data-toggle="collapse">Hasil Diagnosa</a>
        </h3>
    </div>

    <div class="table-responsive collapse in" id="persentase">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Kode Penyakit</th>
                    <th>Nama Penyakit</th>
                    <th>Nilai Akhir</th>
                    <th>Persentase</th>
                </tr>
            </thead>
            <?php foreach ($b->peh_total as $key => $val) : ?>
                <tr class="warning">
                    <td><?= $key ?></td>
                    <td><?= $penyakit[$key]->nama_penyakit ?></td>
                    <td><?= round($b->peh_total[$key], 4) ?></td>
                    <td><?= round($val * 100, 2) ?>%</td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
    <div class="panel-footer">
        <p>
            Berdasarkan perhitungan, penyakit yang diderita adalah <a href="?m=penyakit"><strong><?= $nama_penyakit ?></strong></a>
            dengan hasil <strong><?= $persentase ?>%</strong>
        </p>
        <h3>Solusi</h3>
        <p><?= $keterangan ?></p>
        <p>
            <a class="btn btn-success" href="?m=konsultasi"><span class="glyphicon glyphicon-refresh"></span> Konsultasi Lagi</a>
            <a class="btn btn-primary" href="cetak.php?m=hasil&<?= http_build_query(array('selected' => $selected)) ?>&nama=<?= $nama ?>&umur=<?= $umur ?>&alamat=<?= $alamat ?>&jeniskelamin=<?= $jeniskelamin ?>" target="_blank"><span class="glyphicon glyphicon-print"></span> Cetak</a>
        </p>
    </div>
</div>

<script>
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Diagnosa Penyakit Sukses Dilakukan',
        confirmButtonText: `
    <i class="glyphicon glyphicon-thumbs-up"></i> Hasil Diagnosa Adalah <?= $nama_penyakit ?></strong>
            dengan hasil <strong><?= $persentase ?>%</strong>`,
        timer: 4000
    });
</script>