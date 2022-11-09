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
        <li class="active">About</li>
      </ol>
    </div>
    <!--/.row-->

    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">About</h1>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">Tentang Saya</div>
      <div class="panel-body">
        <div class="col-md-10">
          <form role="form">
            <div class="row  fs-5 justify-content-center">
              <div class="col-md-3">
                <div class="image">
                  <img src="foto/yusuf.jpg" class="elevation-2" alt="User Image" width="150">
                </div>
              </div>
              <div class="col-md-8">
                <table border="0" cellpadding="4">
                  <tr>
                    <td>
                      <h5>Aplikasi ini dibuat oleh </h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Nama</h5>
                    </td>
                    <td>
                      <h5>: ARIANSYAH YUSUF NURFADHILLAH</h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>NIM</h5>
                    </td>
                    <td>
                      <h5>: 2031730095</h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Tanggal</h5>
                    </td>
                    <td>
                      <h5>: 06 November 2022</h5>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div><!-- /.panel-->
</body>

</html>
<?php include("layout/footer.php"); ?>