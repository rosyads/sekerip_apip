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
                $id = $_GET['id'];
                $sql = "SELECT * FROM akun WHERE id_akun='$id'";
                $res = mysqli_query($link,$sql);
                $ketemu = mysqli_num_rows($res);

                if($ketemu){
                    while($data=mysqli_fetch_array($res)){ ?>
                        <form method="POST" action="proses_edit_akun.php" name="fedit">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="50%" cellspacing="0">
                                    <thead>
                                        <tr><th>Username</th> <td><?php echo "$data[username]"; ?></td></tr>
                                        <tr><th>Password</th> <td><?php echo "$data[password]"; ?></td></tr>
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
                                        <tr><th>Role</th> <td><?php echo "$role"; ?></td></tr>
                                    </thead>
                                </table>

                                <h2 class="h3 mb-4 text-gray-800">Masukkan Data Baru</h2>

                                <table class="table table-bordered" id="dataTable" width="50%" cellspacing="0">
                                <thead>
                                    <?php echo "<input type ='hidden' name='id' value='$data[id_akun]' maxlength='12' required>"; ?>
                                    <tr><th>Username</th> <td><?php echo "<input type ='text' name='username' maxlength='25' value='$data[username]' required autocomplete='off'>"; ?></td></tr>
                                    <tr><th>Password</th> <td><?php echo "<input type ='text' name='password' maxlength='50' value='$data[password]' required autocomplete='off'>"; ?></td></tr>
                                    <?php if($role == "Siswa"){?>
                                        <input type ='hidden' name='role' value='11' required><?php
                                    }else{?>
                                        <tr><th>Role</th> 
                                        <td><select name="role" required>
                                            <?php 
                                                if($role == "Admin"){?>
                                                    <option value="">------------------</option>
                                                    <option value="00" selected>Admin</option>
                                                    <option value="01">Bagian Absensi</option>
                                                    <option value="10">Bagian Keuangan</option> <?php
                                                }else if($role == "Bagian Absensi"){?>
                                                    <option value="">------------------</option>
                                                    <option value="00">Admin</option>
                                                    <option value="01" selected>Bagian Absensi</option>
                                                    <option value="10">Bagian Keuangan</option> <?php
                                                }else if($role == "Bagian Keuangan"){?>
                                                    <option value="">------------------</option>
                                                    <option value="00">Admin</option>
                                                    <option value="01">Bagian Absensi</option>
                                                    <option value="10" selected>Bagian Keuangan</option> <?php
                                                }
                                            ?>
                                        </select></td></tr><?php
                                    } ?>
                                </thead>
                                </table>
                                <hr><center><input type='submit' class="btn btn-primary" name='btn_submit' value='Edit'></center>
                            </div>
                        </form>
                    <?php
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
