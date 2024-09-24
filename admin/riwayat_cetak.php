<h1>Laporan Riwayat Pasien Penderita Penyakit Kanker Pada Sistem Reproduksi Wanita</h1>
<table>
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
        </tr>
    <?php
        $nomor++;
    endforeach; ?>
</table>
