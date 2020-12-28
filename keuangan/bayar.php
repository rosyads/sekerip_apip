<?php 
  include 'header.php'; 
  $nama_kelas = [];
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SMP Ganesa Satria - Keuangan</title>

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
          <h1 class="h3 mb-4 text-gray-800">Keuangan</h1>

          <!-- query ambil data -->
          <?php 
            $sql = "SELECT * FROM kelas
                    ORDER BY nama_kelas ASC";
            $res = mysqli_query($link,$sql);
            $ketemu = mysqli_num_rows($res);
            
            if($ketemu){
              $jml_kelas = 0;
              foreach($res as $data){
                array_push($nama_kelas, $data["nama_kelas"]);
              }
              while($jml_kelas < $ketemu){
                $sql="SELECT bayar.*,siswa.nama 
                    FROM bayar
                    INNER JOIN siswa
                      ON bayar.nis = siswa.nis
                    INNER JOIN kelas
                      ON siswa.id_kelas = kelas.id_kelas
                    WHERE kelas.nama_kelas = '$nama_kelas[$jml_kelas]'
                    ORDER BY nama ASC, tanggal_bayar ASC, bulan ASC";
                $res=mysqli_query($link,$sql);
                $found=mysqli_num_rows($res);
            
          ?>
          <!-- end query ambil data -->

          <!-- tabel saldo -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Pembayaran SPP Kelas <?php echo $nama_kelas[$jml_kelas]; ?></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable<?php echo $nama_kelas[$jml_kelas]; ?>" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>NIS</th>
                      <th>Nama</th>
                      <th>Semester</th>
                      <th>Tahun Ajar</th>
                      <th>Bulan</th>
                      <th>Tanggal Bayar</th>
                      <th>Nominal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if($found){
                        foreach($res as $data){
                          ?>
                            <tr>
                              <td><?php echo "$data[nis]"; ?></td>
                              <td><?php echo "$data[nama]"; ?></td>
                              <td><?php echo "$data[semester]"; ?></td>
                              <td><?php echo "$data[tahun_ajar]"; ?></td>
                              <td><?php echo "$data[bulan]"; ?></td>
                              <td><?php echo "$data[tanggal_bayar]"; ?></td>
                              <td><?php echo "$data[nominal]"; ?></td>
                          <?php
                        }
                      }else{?>
                        <tr><td colspan="7"><center>Tidak ada data.</td><center></tr><?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- end tabel saldo -->
          <?php 
                $jml_kelas++;
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
