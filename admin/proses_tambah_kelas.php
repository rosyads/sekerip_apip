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
            <h1 class="h3 mb-4 text-gray-800">Tambah Data Kelas</h1>

            <?php
                $nama_kelas = $_POST["nama"];
                $sql = "SELECT * FROM kelas WHERE nama_kelas = '$nama_kelas'";
                $result = mysqli_query($link, $sql);
                $num = mysqli_num_rows($result);

                if($num){
                    echo "<center><h2>Data kelas dengan nama kelas = $nama_kelas sudah terdaftar, silakan cek daftar kelas!</h2><br>";
                    echo "<a href='tambah_kelas.php'\>Ulangi</a></h2><br>";
                    echo "<a href='data_kelas.php'>Tabel Data Kelas</a></h2></center>";
                }else{
                    $sql = "INSERT INTO kelas(nama_kelas) VALUE('$nama_kelas')";
                    $res = mysqli_query($link,$sql);
                    if($res){
                        echo "<center><h3>Data $nama_kelas berhasil ditambahkan! <br>";
                        echo "<a href='data_kelas.php'>Tabel Data Kelas</a></h3></center>";
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