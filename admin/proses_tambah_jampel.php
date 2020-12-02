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
            <h1 class="h3 mb-4 text-gray-800">Tambah Data Guru</h1>

            <?php
                $jam1 = $_POST["jam1"];
                $jam1 = strval($jam1);
                $jam1 = str_pad($jam1,2,"0",STR_PAD_LEFT);
                $mnt1 = $_POST["mnt1"];
                $mnt1 = strval($mnt1);
                $mnt1 = str_pad($mnt1,2,"0",STR_PAD_LEFT);
                $jam2 = $_POST["jam2"];
                $jam2 = strval($jam2);
                $jam2 = str_pad($jam2,2,"0",STR_PAD_LEFT);
                $mnt2 = $_POST["mnt2"];
                $mnt2 = strval($mnt2);
                $mnt2 = str_pad($mnt2,2,"0",STR_PAD_LEFT);
                $japel = strval($jam1).".".strval($mnt1)."-".strval($jam2).".".strval($mnt2);

                $sql = "SELECT * FROM jam_pelajaran WHERE jampel = '$japel'";
                $result = mysqli_query($link, $sql);
                $num = mysqli_num_rows($result);

                if($num){
                    echo "<center><h2>Data jam pelajaran $japel sudah terdaftar, silakan cek daftar jam pelajaran!</h2><br>";
                    echo "<a href='tambah_jampel.php'\>Ulangi</a></h2><br>";
                    echo "<a href='data_jampel.php'>Tabel Data Jam Pelajaran</a></h2></center>";
                }else{
                    $sql = "INSERT INTO jam_pelajaran(jampel) VALUE('$japel')";
                    $res = mysqli_query($link,$sql);
                    if($res){
                        echo "<center><h3>Data jam pelajaran berhasil ditambahkan! <br>";
                        echo "<a href='data_jampel.php'>Tabel Data Jam Pelajaran</a></h3></center>";
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

  <!-- custom script -->
  <script>
      function validasi(){
        var huruf= /^[a-zA-Z]+$/;
        var nomor= /^[0-9]+$/;

        var nisn = documents.forms["ftambah"]["id"].value;
        var nama = documents.forms["ftambah"]["nama"].value;

        if(!nisn.match(nomor)){
            alert("NISN hanya boleh memasukkan nomor! Silakan ulangi!");
        }

        if(!nama.match(huruf)){
            alert("Nama hanya boleh memasukkan huruf! Silakan ulangi!");
        }
      }
  </script>

</body>

</html>
