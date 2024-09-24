<h1>Penyakit</h1>
<table>
    <thead>
        <tr class="nw">
            <th>Kode</th>
            <th>Nama Penyakit</th>            
            <th>Keterangan</th>
        </tr>
    </thead>
    <?php
    $q = esc_field(_get('q'));
    $rows = $db->get_results("SELECT * FROM tb_penyakit 
        WHERE kode_penyakit LIKE '%$q%' OR nama_penyakit LIKE '%$q%' OR keterangan LIKE '%$q%' 
        ORDER BY kode_penyakit");
    $no = 0;

    foreach ($rows as $row) : ?>
        <tr>
            <td><?= $row->kode_penyakit ?></td>
            <td><?= $row->nama_penyakit ?></td>            
            <td><?= $row->keterangan ?></td>
        </tr>
    <?php endforeach ?>
</table>