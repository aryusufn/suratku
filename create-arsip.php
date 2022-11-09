<!DOCTYPE html>

<head>
    <title>Form Data Arsip</title>

    <head>
        <!-- Load file CSS Bootstrap offline -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">

        <?php include("layout/header.php"); ?>
    </head>

<body>
    <?php include("layout/sidebar.php"); ?>
    <?php include("layout/topbar.php"); ?>
    <div class="container col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

        <?php
        include "koneksi.php";
        error_reporting(0);
        $current_timezone = date_default_timezone_get();
        date_default_timezone_set('Asia/Jakarta');
        function input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nmr_srt = input($_POST["nomor_surat"]);
            $kategori = input($_POST["kategori"]);
            $judul = input($_POST["judul"]);
            // $wkt_arsip=input($_POST["waktu_pengarsipan"]);
            $waktu_pengarsipan = date('Y-m-d H:i:s');
            // $harga=input($_POST["harga"]);
            // $stok = input($_POST["stok"]);
            $direktori = "file_pdf/";
            $file_name = $_FILES['NamaFile']['name'];
            move_uploaded_file($_FILES['NamaFile']['tmp_name'], $direktori . $file_name);
            $action = $_POST['action'];


            $sql = "insert into arsip (nomor_surat, kategori, judul, waktu_pengarsipan, file) values
    ('$nmr_srt','$kategori', '$judul','$waktu_pengarsipan', '$file_name')";

            $hasil = mysqli_query($kon, $sql);

            if ($hasil) {
                echo '<script>alert("Berhasil menambahkan data."); document.location="index.php";</script>';
            } else {
                echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
            }
        }
        ?>


        <h2>Input Data Arsip</h2>
        <p>Unggah surat yang telah terbit pada form ini untuk diarsipkan.</p>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
            <div class="panel panel-danger">
                <div class="panel-heading">Catatan</div>
                <div class="panel-body">
                    <p>
                        <medium><span class="text-danger">*</span></medium>Gunakan file berformat PDF
                    </p>

                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label"> Nomor Surat </label>
                <div class="col-sm-6">
                    <input required type="text" name="nomor_surat" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label"> Kategori </label>
                <div class="col-sm-6">
                    <select name="kategori" class="form-control">
                        <option selected>Undangan</option>
                        <option>Pengumuman</option>
                        <option>Nota Dinas</option>
                        <option>Pemberitahuan</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label"> Judul </label>
                <div class="col-sm-6">
                    <input required type="text" name="judul" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label"> File Surat (PDF) </label>
                <div class="col-sm-6">
                    <input type="file" name="NamaFile" accept="application/pdf" class="form-control-file">
                </div>
            </div>
            <div class=""></div>
            <br>
            <a href="index.php" class="btn btn-primary"> Kembali </a>
            <button type="submit" name="submit" class="btn btn-danger">Simpan</button>
        </form>
    </div>
</body>
<?php include("layout/footer.php"); ?>

</html>