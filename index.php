<!DOCTYPE html>
<html>

<head>
    <!-- Load file CSS Bootstrap offline -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <?php include("layout/header.php"); ?>

</head>

<body>
    <?php include("layout/sidebar.php"); ?>
    <?php include("layout/topbar.php"); ?>

    <div class="container col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Surat</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Arsip Surat</h1>
            </div>
        </div>
        <div class="panel panel-danger">
            <div class="panel-body">
                <p>Berikut ini adalah surat-surat yang telah terbit dan diarsipkan.</p>
                <p>Klik "Lihat" pada kolom aksi untuk menampilkan surat.</p>
            </div>
        </div>
        <form class="form-group row" method="get" action="">
            <div class="col-sm-11">

                <input type="text" class="form-control" placeholder="Cari surat" name="cari">

            </div>
            <input type="submit" class="btn btn-primary" value="cari" />
        </form>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <!-- <th style="text-align: center;">No</th> -->
                    <th style="text-align: center;">Nomor Surat</th>
                    <th style="text-align: center;">Kategori</th>
                    <th style="text-align: center;">Judul</th>
                    <th style="text-align: center;">Waktu Pengarsipan</th>
                    <th style="text-align: center;" colspan='2'>Aksi</th>
                </tr>
            </thead>
            <?php
            include "koneksi.php";

            $batas = 7;
            $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
            $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

            $previous = $halaman - 1;
            $next = $halaman + 1;

            $sql = mysqli_query($kon, "select * from arsip");
            $jumlah_data = mysqli_num_rows($sql);
            $total_halaman = ceil($jumlah_data / $batas);

            $hasil = mysqli_query($kon, "select * from arsip limit $halaman_awal, $batas");
            $no = $halaman_awal + 1;

            if (isset($_GET['cari'])) {
                $sql = mysqli_query($kon, "SELECT * FROM arsip WHERE judul LIKE '%" .
                    $_GET['cari'] . "%'");
            }

            while ($data = mysqli_fetch_array($sql)) {
            ?>
                <tbody>
                    <tr>
                        <!-- <td style="text-align: center;"><?php echo $no++; ?></td> -->
                        <td style="text-align: center;"><?php echo $data["nomor_surat"]; ?></td>
                        <td style="text-align: center;"><?php echo $data["kategori"]; ?></td>
                        <td style="text-align: center;"><?php echo $data["judul"]; ?></td>
                        <td style="text-align: center;"><?php echo $data["waktu_pengarsipan"]; ?></td>
                        <td style="text-align: center;">
                            <a href="hapus-arsip.php?nomor_surat=<?php echo htmlspecialchars($data['nomor_surat']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus arsip surat ini?');" class="btn btn-danger"> Hapus </a>
                            <a href="download.php?filename=<?php echo htmlspecialchars($data['file']); ?>" class="btn btn-warning" role="button">Unduh</a>
                            <a href="lihat-arsip.php?nomor_surat=<?php echo htmlspecialchars($data['nomor_surat']); ?>" class="btn btn-primary" role="button">Lihat</a>
                        </td>
                    </tr>
                </tbody>
            <?php
            }
            ?>
        </table>
        <a href="create-arsip.php" class="btn btn-primary" role="button">Arsipkan Surat</a>
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if ($halaman > 1) {
                                                echo "href='?halaman=$previous'";
                                            } ?>>Previous</a>
                </li>
                <?php
                for ($x = 1; $x <= $total_halaman; $x++) {
                ?>
                    <li class="page-item"><a class="page-link" href="?halaman= <?php echo $x ?>"><?php echo $x; ?></a></li>
                <?php
                }
                ?>
                <li class="page-item">
                    <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                echo "href='?halaman=$next'";
                                            } ?>>Next</a>
                </li>
            </ul>
        </nav>
    </div>
</body>

</html>
<?php include("layout/footer.php"); ?>