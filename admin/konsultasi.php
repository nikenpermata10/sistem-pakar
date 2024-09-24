<div class="page-header">
    <h1> Diagnosa</h1>
</div>
<?php
$success = false;
if ($_POST) {
    if (count((array)$_POST['selected']) > 1) {
        $success = true;
        include 'hasil.php';
    } else {
        // print_msg('Pilih minimal 2 gejala');
        echo "<script>
        Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Pilih minimal 2 gejala',
            showConfirmButton: false,
            timer: 3000
          });
          </script>";
    }
}
if (!$success) : ?>
    <form action="?m=konsultasi" method="post">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Pilih Gejala</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll" /></th>
                            <th>Kode</th>
                            <th>Nama Gejala</th>
                        </tr>
                    </thead>
                    <?php
                    $rows = $db->get_results("SELECT * FROM tb_gejala ORDER BY kode_gejala");
                    $no = 0;
                    foreach ($rows as $row) : ?>
                        <tr>
                            <td><input type="checkbox" name="selected[]" value="<?= $row->kode_gejala ?>" /></td>
                            <td><?= $row->kode_gejala ?></td>
                            <td><?= $row->nama_gejala ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="panel-footer">
                <button class="btn btn-success" name="submit"><span class="glyphicon glyphicon-ok"></span> Proses Diagnosa</button>
            </div>
        </div>
    </form>
    <script>
        $(function() {
            $("#checkAll").click(function() {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
        });
    </script>
<?php endif ?>