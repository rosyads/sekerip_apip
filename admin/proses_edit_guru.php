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
            <h1 class="h3 mb-4 text-gray-800">Edit Data Guru</h1>

            <?php
                $id = $nama = $kd_guru = $id_matpel = "";

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $id = test_input($_POST["id"]);
                    $nama = test_input($_POST["nama"]);
                    $kd_guru = test_input($_POST["kd_guru"]);
                    $id_matpel = $_POST["id_matpel"];
                    $tgl_lahir = $_POST["tgl_lahir"];
                }
                
                function test_input($data) {
                    $data = trim($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }

                
                $sql = "UPDATE guru SET nama='$nama',kd_guru='$kd_guru',id_matpel='$id_matpel',tgl_lahir='$tgl_lahir' WHERE nuptk='$id'";
                $res = mysqli_query($link,$sql);
                if($res){
                  echo "<center><h2>Data $nama berhasil di edit!</h2> <br>";
                  echo "<a href='data_guru.php'>Tabel Data Guru</a></h2></center>";
                }else{
                  echo "<center><h2>Edit Data Gagal!</h2> <br>";
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
