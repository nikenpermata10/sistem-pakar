<?php
session_start();
require_once 'functions.php';



/** LOGIN */
if ($mod == 'login') {
    $user = esc_field($_POST['user']);
    $pass = esc_field($_POST['pass']);

    $row = $db->get_row("SELECT * FROM tb_admin WHERE user='$user' AND pass='$pass'");
    if ($row) {
        $_SESSION['login'] = $row->user;
        redirect_js("index.php");
    } else {
        print_msg("Salah kombinasi username dan password.");
    }
} else if ($mod == 'password') {
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $pass3 = $_POST['pass3'];

    $row = $db->get_row("SELECT * FROM tb_admin WHERE user='$_SESSION[login]' AND pass='$pass1'");

    if ($pass1 == '' || $pass2 == '' || $pass3 == '')
        print_msg('Field bertanda * harus diisi.');
    elseif (!$row)
        print_msg('Password lama salah.');
    elseif ($pass2 != $pass3)
        print_msg('Password baru dan konfirmasi password baru tidak sama.');
    else {
        $db->query("UPDATE tb_admin SET pass='$pass2' WHERE user='$_SESSION[login]'");
        print_msg('Password berhasil diubah.', 'success');
    }
} elseif ($act == 'logout') {
    unset($_SESSION['login']);
    header("location:../index.php");
}

/** PENYAKIT */
elseif ($mod == 'penyakit_tambah') {
    $kode_penyakit = $_POST['kode_penyakit'];
    $nama_penyakit = $_POST['nama_penyakit'];
    $keterangan = $_POST['keterangan'];

    if (!$kode_penyakit || !$nama_penyakit)
        print_msg("Field yang bertanda * tidak boleh kosong!");
    elseif ($db->get_results("SELECT * FROM tb_penyakit WHERE kode_penyakit='$kode_penyakit'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("INSERT INTO tb_penyakit (kode_penyakit, nama_penyakit, keterangan) VALUES ('$kode_penyakit', '$nama_penyakit', '$keterangan')");
        $_SESSION['flash'] = 'Penyakit Berhasil Ditambahkan';
        redirect_js("index.php?m=penyakit");
        // unset($_SESSION['flash']);
    }
} else if ($mod == 'penyakit_ubah') {
    $nama_penyakit = $_POST['nama_penyakit'];
    $keterangan = $_POST['keterangan'];

    if (!$nama_penyakit)
        print_msg("Field yang bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_penyakit SET nama_penyakit='$nama_penyakit', keterangan='$keterangan' WHERE kode_penyakit='$_GET[ID]'");
        $_SESSION['flash'] = 'Penyakit Berhasil Diubah';
        redirect_js("index.php?m=penyakit");
    }
} else if ($act == 'penyakit_hapus') {
    $db->query("DELETE FROM tb_penyakit WHERE kode_penyakit='$_GET[ID]'");
    $_SESSION['flash'] = 'Penyakit Berhasil Dihapus';
    header("location:index.php?m=penyakit ");
}

/** GEJALA */
if ($mod == 'gejala_tambah') {
    $kode_gejala = $_POST['kode_gejala'];
    $nama_gejala = $_POST['nama_gejala'];

    if (!$kode_gejala || !$nama_gejala)
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($db->get_results("SELECT * FROM tb_gejala WHERE kode_gejala='$kode_gejala'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("INSERT INTO tb_gejala (kode_gejala, nama_gejala) VALUES ('$kode_gejala', '$nama_gejala')");
        $_SESSION['flash'] = 'Gejala Berhasil Ditambahkan';
        redirect_js("index.php?m=gejala");
    }
} else if ($mod == 'gejala_ubah') {
    $nama_gejala = $_POST['nama_gejala'];

    if (!$nama_gejala)
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_gejala SET nama_gejala='$nama_gejala' WHERE kode_gejala='$_GET[ID]'");
        $_SESSION['flash'] = 'Gejala Berhasil Diubah';
        redirect_js("index.php?m=gejala");
    }
} else if ($act == 'gejala_hapus') {
    $db->query("DELETE FROM tb_gejala WHERE kode_gejala='$_GET[ID]'");
    $_SESSION['flash'] = 'Gejala Berhasil Dihapus';
    header("location:index.php?m=gejala");
}

/** ATURAN TAMBAH */
else if ($mod == 'aturan_tambah') {
    $kode_penyakit = $_POST['kode_penyakit'];
    $kode_gejala = $_POST['kode_gejala'];
    $nilai = $_POST['nilai'];

    $kombinasi_ada = $db->get_row("SELECT * FROM tb_aturan WHERE kode_penyakit='$kode_penyakit' AND kode_gejala='$kode_gejala'");

    if (!$kode_penyakit || !$kode_gejala || !$nilai)
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($kombinasi_ada)
        print_msg("Kombinasi diagnosa dan gejala sudah ada!");
    else {
        $db->query("INSERT INTO tb_aturan (kode_penyakit, kode_gejala, nilai) VALUES ('$kode_penyakit', '$kode_gejala', '$nilai')");
        $_SESSION['flash'] = 'Basis Pengetahuan Berhasil Ditambahkan';
        redirect_js("index.php?m=aturan");
    }
} else if ($mod == 'aturan_ubah') {
    $kode_penyakit = $_POST['kode_penyakit'];
    $kode_gejala = $_POST['kode_gejala'];
    $nilai = $_POST['nilai'];

    $kombinasi_ada = $db->get_row("SELECT * FROM tb_aturan WHERE kode_penyakit='$kode_penyakit' AND kode_gejala='$kode_gejala' AND ID<>'$_GET[ID]'");

    if (!$kode_penyakit || !$kode_gejala || !$nilai)
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($kombinasi_ada)
        print_msg("Kombinasi penyakit dan gejala sudah ada!");
    else {
        $db->query("UPDATE tb_aturan SET kode_penyakit='$kode_penyakit', kode_gejala='$kode_gejala', nilai='$nilai' WHERE ID='$_GET[ID]'");
        $_SESSION['flash'] = 'Basis Pengetahuan Berhasil Diubah';
        redirect_js("index.php?m=aturan");
    }
    header("location:index.php?m=aturan");
} else if ($act == 'aturan_hapus') {
    $db->query("DELETE FROM tb_aturan WHERE ID='$_GET[ID]'");
    $_SESSION['flash'] = 'Basis Pengetahuan Berhasil Dihapus';
    header("location:index.php?m=aturan");
}

if ($act == 'riwayat_hapus') {
    $db->query("DELETE FROM tb_diagnosis WHERE id_diagnosis='$_GET[ID]'");
    $_SESSION['flash'] = 'Riwayat Berhasil Dihapus';
    header("location:index.php?m=riwayat");
}