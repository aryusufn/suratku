<?php
include('koneksi.php');

$nomor_surat = $_GET['nomor_surat'];
$kategori = $_POST['kategori'];
$judul = $_POST['judul'];

$direktori = "file_pdf/";
$file_name = $_FILES['NamaFileEdit']['name'];
move_uploaded_file($_FILES['NamaFileEdit']['tmp_name'], $direktori . $file_name);

$action = $_POST['action'];

$queryShow = "SELECT * FROM arsip WHERE nomor_surat = '$nomor_surat';";
$sqlShow = mysqli_query($kon, $queryShow);
$result = mysqli_fetch_assoc($sqlShow);

unlink("file_pdf/" . $result['file']);

function edit_data($kon, $nmr, $ktgr, $jdl, $flnm)
{
    $upd = "UPDATE arsip
            SET     kategori = '$ktgr',
                    judul = '$jdl',
                    file = '$flnm'
            WHERE   nomor_surat = '$nmr' ";
    return $kon->query($upd);
}

function edit_data_kosong($kon, $nmr, $ktgr, $jdl)
{
    $upd = "UPDATE arsip
            SET     kategori = '$ktgr',
                    judul = '$jdl'
            WHERE   nomor_surat = '$nmr' ";
    return $kon->query($upd);
}

if (strtolower($action) == 'edit') {

    if (!empty($file_name)) {
        $check = edit_data($kon, $nomor_surat, $kategori, $judul, $file_name);
        if ($check) {
            echo '<script>alert("Berhasil mengubah data."); document.location="index.php";</script>';
        } else {
            echo "<div class='alert alert-danger'> Data Gagal diubah.</div>";
            echo mysqli_error($kon);
        }
    } else {
        $check = edit_data_kosong($kon, $nomor_surat, $kategori, $judul);
        if ($check) {
            echo '<script>alert("Berhasil mengubah data."); document.location="index.php";</script>';
        } else {
            echo "<div class='alert alert-danger'> Data Gagal diubah.</div>";
            echo mysqli_error($kon);
        }
    }
}
