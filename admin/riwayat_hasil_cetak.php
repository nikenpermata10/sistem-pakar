<?php
$id = intval($_GET['ID']);

$detail = $db->get_row("SELECT * FROM tb_diagnosis WHERE id_diagnosis = $id");

if (!$detail) {
    echo "<p>Data tidak ditemukan.</p>";
    exit;
}

$gejala_codes = explode(",", $detail->selected_gejala);

$gejala_list = $db->get_results("SELECT * FROM tb_gejala WHERE kode_gejala IN ('" . implode("','", array_map('trim', $gejala_codes)) . "')");

$rows = $db->get_results("SELECT * FROM tb_penyakit ORDER BY kode_penyakit");
foreach ($rows as $row) {
    $penyakit[$row->kode_penyakit] = $row;
}

$gejala_selected = array_map('trim', $gejala_codes);
$data = get_data($gejala_selected);
$b = new Bayes($gejala_selected, $penyakit, $data);
arsort($b->peh_total);
$kode_penyakit = key($b->peh_total);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h1> Hasil Diagnosis Pasien Penyakit Kanker Pada Sistem Reproduksi Wanita</h1>
    </div>
    <div class="panel-body">
        <h4>Data Diri</h4>
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th>Nama</th>
                <td width='75%' align="center"><?= htmlspecialchars($detail->nama) ?></td>
            </tr>
            <tr>
                <th>Umur</th>
                <td width='75%' align="center"><?= htmlspecialchars($detail->umur) ?></td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td width='75%' align="center"><?= htmlspecialchars($detail->alamat) ?></td>
            </tr>
        </table>

        <h4>Gejala Yang Dipilih</h4>
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Kode Gejala</th>
                    <th>Nama Gejala</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($gejala_list as $gejala) : ?>
                    <tr>
                        <td><?= htmlspecialchars($gejala->kode_gejala) ?></td>
                        <td><?= htmlspecialchars($gejala->nama_gejala) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h4>Waktu</h4>
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th>Waktu Diagnosa</th>
                <td><?= htmlspecialchars($detail->waktu) ?></td>
            </tr>
        </table>
    </div>
</div>

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
            <tbody>
                <?php foreach ($b->peh_total as $key => $val) : ?>
                    <tr class="warning">
                        <td><?= htmlspecialchars($key) ?></td>
                        <td><?= htmlspecialchars($penyakit[$key]->nama_penyakit) ?></td>
                        <td><?= round($val, 4) ?></td>
                        <td><?= round($val * 100, 2) ?>%</td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="panel-footer">
        <p>
            Berdasarkan perhitungan, penyakit yang diderita adalah <strong><?= htmlspecialchars($penyakit[$kode_penyakit]->nama_penyakit) ?></strong>
            dengan hasil <strong><?= round($b->peh_total[$kode_penyakit] * 100, 2) ?>%</strong>
        </p>
        <h3>Solusi</h3>
        <p><?= htmlspecialchars($penyakit[$kode_penyakit]->keterangan) ?></p>
    </div>
</div>

<table id="ttd">
    <tr>
        <td width="200px"></td>
        <td></td>
        <td width="270px" style="text-align: center;">
            <br />
            <p><strong>Diketahui oleh,</strong></p>
            <br /><br /><br /><br />
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