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
          <h1 class="h3 mb-4 text-gray-800">Olah Data Akun</h1>

          <!-- query ambil data -->
          <?php 
            $sql="SELECT * FROM akun ORDER BY role ASC";
            $res=mysqli_query($link,$sql);
            $ketemu=mysqli_num_rows($res);
          ?>
          <!-- end query ambil data -->

          <!-- tabel siswa -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Akun</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Role</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if($ketemu){
                        foreach($res as $data){
                          ?>
                            <tr>
                              <td><?php echo "$data[username]"; ?></td>
                              <td><?php echo "$data[password]"; ?></td>
                              <?php 
                                if($data["role"] == "00"){
                                    $role = "Admin";
                                }else if($data["role"] == "01"){
                                    $role = "Bagian Absensi";
                                }else if($data["role"] == "10"){
                                    $role = "Bagian Keuangan";
                                }else if($data["role"] == "11"){
                                    $role = "Siswa";
                                }
                              ?>
                              <td><?php echo "$role"; ?></td>
                              <td><?php echo "<a class='btn btn-warning' href='edit_akun.php?id=$data[id_akun]'>Edit</a> "; 
                                   echo "<a class='btn btn-danger' href='hapus_akun.php?id=$data[id_akun]'>Hapus</a>"; ?></td>
                            </tr>
                          <?php
                        }
                      }else{?>
                        <tr><td colspan="4"><center>Tidak ada data.</td><center></tr><?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- end tabel siswa -->

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
