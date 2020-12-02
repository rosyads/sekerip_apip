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
            <h1 class="h3 mb-4 text-gray-800">Tambah Data Siswa</h1>

            <?php
                $id = $_POST["id"];
                $nama = $_POST["nama"];
                $kelas = $_POST["kelas"];
                $agama = $_POST["agama"];
                $tgl_lahir = $_POST["tgl_lahir"];

                $sql = "SELECT * FROM siswa WHERE nis = '$id'";
                $result = mysqli_query($link, $sql);
                $num = mysqli_num_rows($result);

                if($num){
                    echo "<center><h2>Data siswa dengan NIS = $id sudah terdaftar, silakan cek daftar siswa!</h2><br>";
                    echo "<a href='tambah_siswa.php'\>Ulangi</a></h2><br>";
                    echo "<a href='data_siswa.php'>Tabel Data Siswa</a></h2></center>";
                }else{
                    $sql = "insert into siswa(nis,nama,id_kelas,tgl_lahir,agama) values('$id','$nama','$kelas','$tgl_lahir','$agama')";
                    $res = mysqli_query($link,$sql);
                    if($res){
                        $thn = substr($tgl_lahir,2,2);
                        $bln = substr($tgl_lahir,5,2);
                        $tgl = substr($tgl_lahir,8,2);
                        $password = $tgl.$bln.$thn;
                        $sql = "insert into akun(username,password,role) values('$id','$password','011')";
                        $res = mysqli_query($link,$sql);
                        if($res){
                          echo "<center><h3>Data $nama berhasil ditambahkan! <br>";
                          echo "<a href='data_siswa.php'>Tabel Data Siswa</a></h3></center>";
                        }else{
                          echo "<center><h3>Tambah Akun Siswa Gagal!</h3> <br>";
                        }                        
                    }else{
                        echo "<center><h3>Tambah Data Siswa Gagal!</h3> <br>";
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
