<!DOCTYPE html>

<head>
    <title>Form Edit Data Arsip</title>

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

        $nomor_surat = $_GET['nomor_surat'];

        $data = $kon->query("SELECT nomor_surat, kategori, judul, file FROM arsip WHERE nomor_surat = '$nomor_surat' ");

        if ($data->num_rows == 1) {
            $data = $data->fetch_assoc();
        }

        ?>
        <h2>Update Data Arsip</h2>

        <form action="simpan-edit.php?nomor_surat=<?php echo $data['nomor_surat']; ?>" method="post" enctype="multipart/form-data">
            <!-- <fieldset> -->
            <div class="panel panel-danger">
                <div class="panel-heading">Catatan</div>
                <div class="panel-body">
                    <p>
                        <medium><span class="text-danger">*</span></medium>Gunakan file berformat PDF
                    </p>
                </div>
            </div>
            <div class="form-group">
                <label>Nomor Surat </label>
                <input type="text" name="nomor_surat" class="form-control" value="<?php echo $data['nomor_surat'] ?>" disabled />

            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori" class="form-control">
                    <option value="<?php echo $data['kategori'] ?>"><?php echo $data['kategori'] ?></option>
                    <option>Undangan</option>
                    <option>Pengumuman</option>
                    <option>Nota Dinas</option>
                    <option>Pemberitahuan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" placeholder="Masukkan Judul" value="<?php echo $data['judul'] ?>" />

            </div>
            <div class="form-group ">
                <label> File Surat (PDF) </label>
                <object data="file_pdf/<?php echo $data['file'] ?>" width="100%" height="700px"></object>
                <input type="file" name="NamaFileEdit" accept="application/pdf" class="form-control-file">
            </div>


            <!-- <div class="form-group">
            <label>Waktu Pengarsipan</label>
            <input type="date" name="waktu_pengarsipan" class="form-control" placeholder="Masukkan Waktu Pemgarsipan" required />

        </div> -->
            <!-- <div class="form-group">
            <label>Foto : </label>
            <input type="file" name="foto" accept="image/*" placeholder="Masukkan Gambar" required />
            <form name="menu.php" enctype="multipart/form-data"
            action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
        </div>
        <div class="form-group">
            <label>Jenis Barang : </label>
            <label><input type="radio" name="jenis_menu" value="Makanan">Makanan</label>
            <label><input type="radio" name="jenis_menu" value="Minuman"> Minuman</label>
            <label><input type="radio" name="jenis_menu" value="Snack"> Snack</label>
        </div>
        <div class="form-group">
            <label>Harga </label>
            <input type="text" name="harga" class="form-control" placeholder="Masukkan Harga Barang" required />
            <label>Stok </label>
            <input type="text" name="stok" class="form-control" placeholder="Masukkan Stok" required />
        </div> -->
            <div class=""></div>
            <br>
            <a href="index.php" class="btn btn-primary"> Kembali </a>
            <button type="submit" name="action" value="edit" class="btn btn-danger">Simpan</button>
            <!-- </fieldset> -->
        </form>
    </div>
</body>
<?php include("layout/footer.php"); ?>

</html>