<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Text and Image Alignment</title>
</head>
<body>
        <div style="display: flex; align-items: center; border-bottom: 2px solid black; padding-bottom: 5px;">
        <img src="Assets/img/LOGO.jpg" alt="Gambar" style="max-width: 50px; margin-right: 20px;">
        <p style="font-size: 16px; font-weight: bold;">
        HASIL DIAGNOSA PENYAKIT KANKER PADA SISTEM REPRODUKSI WANITA 
        </p>
    </div>
</body>
</html>

<?php
$namapasien = $_GET['nama'];
$jeniskelamin = $_GET['jeniskelamin'];
$alamat = $_GET['alamat'];
$umur = $_GET['umur'];
$selected = (array) $_GET['selected'];
$rows = $db->get_results("SELECT kode_gejala, nama_gejala FROM tb_gejala WHERE kode_gejala IN ('" . implode("','", $selected) . "')");
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Data Diri</h3>
    </div>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Umur</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tr>
            <td><?= $namapasien ?></td>
            <td><?= $umur ?></td>
            <td><?= $alamat ?></td>
        </tr>
    </table>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gejala Yang Dipilih</h3>
    </div>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Kode Gejala</th>
                <th>Nama Gejala</th>
            </tr>
        </thead>
        <?php
        $no = 1;
        foreach ($rows as $row) :
            $gejala[$row->kode_gejala] = $row->nama_gejala;
        ?>
            <tr>
                <td><?= $row->kode_gejala ?></td>
                <td><?= $row->nama_gejala ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php

$rows = $db->get_results("SELECT * FROM tb_penyakit ORDER BY kode_penyakit");
foreach ($rows as $row) {
    $penyakit[$row->kode_penyakit] = $row;
}

$data = get_data($selected);

$b = new Bayes($selected, $penyakit, $data);

?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <strong data-toggle="collapse">Hasil Diagnosa</strong>
        </h3>
    </div>

    <div class="table-responsive collapse in" id="persentase">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
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
            <?php
            arsort($b->peh_total);
            $kode_penyakit = key($b->peh_total);
            ?>
            Berdasarkan perhitungan, penyakit yang diderita adalah <strong><?= $penyakit[$kode_penyakit]->nama_penyakit ?></strong>
            dengan hasil <strong><?= round($b->peh_total[$kode_penyakit] * 100, 2) ?>%</strong>
        </p>
        <h3>Solusi</h3>
        <p><?= $penyakit[$kode_penyakit]->keterangan ?></p>
    </div>
</div>

<table id="ttd">
    <tr>
        <td width="200px"></td>
        <td></td>
        <td width="270px" style="text-align: center;">
            <br />
            <p><strong>Diketahui oleh,</strong></p>
            <br />
            <br />
            <br />
            <br />
            <p><strong>dr. Edwin Martin Asroel, Sp. OG (K)</strong></p>
        </td>
    </tr>
</table>

<style>
    #ttd {
        border: 0;
        width: 100%;
    }

    #ttd td {
        border: 0;
    }
</style>