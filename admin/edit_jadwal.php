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
            <h1 class="h3 mb-4 text-gray-800">Edit Data Jadwal</h1>

            <?php 
                $id = $_GET['id'];
                $sql = "SELECT jadwal.id_jadwal,kelas.nama_kelas,hari.hari,jam_pelajaran.jampel,jadwal.kd_guru,guru.nama
                        FROM jadwal 
                        INNER JOIN kelas 
                            ON jadwal.id_kelas=kelas.id_kelas
                        INNER JOIN hari 
                            ON jadwal.id_hari=hari.id_hari
                        INNER JOIN jam_pelajaran 
                            ON jadwal.id_jampel=jam_pelajaran.id_jampel
                        INNER JOIN guru 
                            ON jadwal.kd_guru=guru.kd_guru 
                        WHERE id_jadwal='$id'";
                $res = mysqli_query($link,$sql);
                $ketemu = mysqli_num_rows($res);

                if($ketemu){
                    while($data=mysqli_fetch_array($res)){ ?>
                        <form method="POST" action="proses_edit_jadwal.php" name="fedit" onsubmit="return validasi()">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="50%" cellspacing="0">
                                    <thead>
                                        <tr><th>Kelas</th> <td><?php echo "$data[nama_kelas]"; ?></td></tr>
                                        <tr><th>Hari</th> <td><?php echo "$data[hari]"; ?></td></tr>
                                        <tr><th>Jam Pelajaran</th> <td><?php echo "$data[jampel]"; ?></td></tr>
                                        <tr><th>Kode Guru</th> <td><?php echo "$data[kd_guru]"; ?></td></tr>
                                        <tr><th>Guru Pengampu</th> <td><?php echo "$data[nama]"; ?></td></tr>
                                    </thead>
                                </table>

                                <?php 
                                    $kelas = $data["nama_kelas"];
                                    $hari = $data["hari"];
                                    $jampel = $data["jampel"];
                                    $guru = $data["kd_guru"];                      
                                ?>

                                <h2 class="h3 mb-4 text-gray-800">Masukkan Data Baru</h2>

                                <table class="table table-bordered" id="dataTable" width="50%" cellspacing="0">
                                <thead>
                                    <?php echo "<input type ='hidden' name='id' value='$data[id_jadwal]' required>"; ?>
                                    <tr><th>Kelas</th> 
                                    <td><select name="kelas" required>
                                        <option value="">-----</option>
                                        <?php //ambil data kelas
                                            $sql="SELECT * FROM kelas";
                                            $res=mysqli_query($link,$sql);
                                            $ketemu=mysqli_num_rows($res);
                                            if($ketemu){
                                                foreach($res as $data){
                                                    if($data["nama_kelas"] == $kelas){
                                                        echo "<option value='$data[id_kelas]' selected>$data[nama_kelas]</option>";    
                                                    }else{
                                                        echo "<option value='$data[id_kelas]'>$data[nama_kelas]</option>";
                                                    }
                                                }
                                            }
                                        ?>
                                    </select></td></tr>
                                    <tr><th>Hari</th> 
                                    <td><select name="hari" required>
                                        <option value="">--------</option>
                                        <?php //ambil data hari
                                            $sql="SELECT * FROM hari";
                                            $res=mysqli_query($link,$sql);
                                            $ketemu=mysqli_num_rows($res);
                                            if($ketemu){
                                                foreach($res as $data){
                                                    if($data["hari"] == $hari){
                                                        echo "<option value='$data[id_hari]' selected>$data[hari]</option>";
                                                    }else{
                                                        echo "<option value='$data[id_hari]'>$data[hari]</option>";
                                                    }
                                                }
                                            }
                                        ?>
                                    </select></td></tr>
                                    <tr><th>Jam Pelajaran</th> 
                                    <td><select name="jampel" required>
                                        <option value="">-------------</option>
                                        <?php //ambil data jam pelajaran
                                            $sql="SELECT * FROM jam_pelajaran";
                                            $res=mysqli_query($link,$sql);
                                            $ketemu=mysqli_num_rows($res);
                                            if($ketemu){
                                                foreach($res as $data){
                                                    if($data["jampel"] == $jampel){
                                                        echo "<option value='$data[id_jampel]' selected>$data[jampel]</option>";
                                                    }else{
                                                        echo "<option value='$data[id_jampel]'>$data[jampel]</option>";
                                                    }
                                                }
                                            }
                                        ?>
                                    </select></td></tr>
                                    <tr><th>Guru</th> 
                                    <td><select name="guru" required>
                                        <option value="">-----------------------------------</option>
                                        <?php //ambil data guru
                                            $sql="SELECT * FROM guru";
                                            $res=mysqli_query($link,$sql);
                                            $ketemu=mysqli_num_rows($res);
                                            if($ketemu){
                                                foreach($res as $data){
                                                    if($data["kd_guru"] == $guru){
                                                        echo "<option value='$data[kd_guru]' selected>$data[kd_guru] - $data[nama]</option>";
                                                    }else{
                                                        echo "<option value='$data[kd_guru]'>$data[kd_guru] - $data[nama]</option>";
                                                    }
                                                } 
                                            }
                                        ?>
                                    </select></td></tr>
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
