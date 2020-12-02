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
                $id = $nama = $id_matpel = "";

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $id = test_input($_POST["id"]);
                    $nama = test_input($_POST["nama"]);
                    $id_matpel = $_POST["id_matpel"];
                    $tgl_lahir = $_POST["tgl_lahir"];
                 }
                
                function test_input($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }

                $sql = "SELECT * FROM guru WHERE nuptk = '$id'";
                $result = mysqli_query($link, $sql);
                $num = mysqli_num_rows($result);

                if($num){
                    echo "<center><h2>Data guru dengan NUPTK = $id sudah terdaftar, silakan cek daftar guru!</h2><br>";
                    echo "<a href='tambah_guru.php'\>Ulangi</a></h2><br>";
                    echo "<a href='data_guru.php'>Tabel Data Guru</a></h2></center>";
                }else{
                    $sql = "SELECT * FROM guru";
                    $result = mysqli_query($link,$sql);
                    $num = mysqli_num_rows($result)+1;
                    $kode = $num +1;
                    $kd_guru = str_pad($kode,3,"0",STR_PAD_LEFT);

                    $sql = "INSERT INTO guru(nuptk,nama,id_matpel,kd_guru,tgl_lahir) VALUE('$id','$nama','$id_matpel','$kd_guru','$tgl_lahir')";
                    $res = mysqli_query($link,$sql);
                    if($res){
                        $thn = substr($tgl_lahir,2,2);
                        $bln = substr($tgl_lahir,5,2);
                        $tgl = substr($tgl_lahir,8,2);
                        $password = $tgl.$bln.$thn;
                        $sql = "insert into akun(username,password,role) values('$id','$password','101')";
                        $res = mysqli_query($link,$sql);
                        if($res){
                          echo "<center><h3>Data $nama berhasil ditambahkan! <br>";
                          echo "<a href='data_guru.php'>Tabel Data Guru</a></h3></center>";
                        }
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
