<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SMP Ganesa Satria - Admin</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php include 'sidebar.html'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php include 'topbar.html'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Tambah Data Jadwal</h1>

            <?php
                $kelas = $_POST["kelas"];
                $hari = $_POST["hari"];
                $jampel = $_POST["jampel"];
                $guru = $_POST["guru"];

                $sql = "SELECT jadwal.*,kelas.nama_kelas,hari.hari,jam_pelajaran.jampel,jadwal.kd_guru,guru.nama
                        FROM jadwal 
                        INNER JOIN kelas 
                            ON jadwal.id_kelas=kelas.id_kelas
                        INNER JOIN hari 
                            ON jadwal.id_hari=hari.id_hari
                        INNER JOIN jam_pelajaran 
                            ON jadwal.id_jampel=jam_pelajaran.id_jampel
                        INNER JOIN guru 
                            ON jadwal.kd_guru=guru.kd_guru 
                        WHERE jadwal.id_kelas = '$kelas' 
                            AND jadwal.id_hari='$hari' 
                            AND jadwal.id_jampel='$jampel' 
                            AND jadwal.kd_guru='$guru'";
                $result = mysqli_query($link, $sql);
                $num = mysqli_num_rows($result);

                if($num){
                    echo "<center><h2>Data jadwal kelas $data[nama_kelas] 
                        pada hari $data[hari] jam $data[jampel] dengan guru $data[nama] sudah ada, 
                        silakan cek daftar jadwal!</h2><br>";
                    echo "<a href='tambah_jadwal.php'\>Ulangi</a></h2><br>";
                    echo "<a href='data_jadwal.php'>Tabel Data Jadwal</a></h2></center>";
                }else{
                    $sql = "INSERT INTO jadwal(id_kelas,id_hari,id_jampel,kd_guru) VALUE('$kelas','$hari','$jampel','$guru')";
                    $res = mysqli_query($link,$sql);
                    if($res){
                        echo "<center><h3>Data jadwal berhasil ditambahkan! <br>";
                        echo "<a href='data_jadwal.php'>Tabel Data Jadwal</a></h3></center>";
                    }else{
                        echo "<center><h3>Tambah Data Gagal!</h3> <br>";
                    }
                }
            ?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include '../footer.html'; ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <?php include "../logout_modal.html" ?>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>
