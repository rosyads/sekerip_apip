<?php 
  include 'header.php'; 
  if(isset($_SESSION['role'])){
    $sql = "SELECT * FROM guru WHERE nuptk = '$_SESSION[username]'";
    $res = mysqli_query($link,$sql);
    $ketemu = mysqli_num_rows($res);

    if($ketemu){
      $acc = mysqli_fetch_assoc($res);
      $kd_guru = $acc["kd_guru"];
    }

  }
  date_default_timezone_set("Asia/Jakarta");
  $tahun = date("Y");
  $bulan = date("m");
  $tanggal = date("d");
  $nama_bulan = array("","Januari","Februari","Maret","April","Mei","Juni",
                      "Juli","Agustus","September","Oktober","November","Desember");

  $nama_kelas= [];
  $absen_bulan = [];
  $absen_tanggal = [];

  $chartName = [];

  //fungsi ngecek udah ada data yg dicari di array atau belum
  function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }
    return false;
  }
  
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SMP Ganesa Satria - Absensi</title>

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
          <h1 class="h3 mb-4 text-gray-800">Olah Data Absensi Siswa</h1>

          <?php
            if(isset($kd_guru)){
              $sql="SELECT DISTINCT jadwal.id_kelas,kelas.nama_kelas 
                    FROM jadwal
                    INNER JOIN kelas
                      ON jadwal.id_kelas=kelas.id_kelas
                        WHERE kd_guru = '$kd_guru'";
              $res=mysqli_query($link,$sql);
              $ketemu=mysqli_num_rows($res);
              if($ketemu){
                $jml_kelas = 0;
                foreach($res as $data){
                  array_push($nama_kelas, $data["nama_kelas"]);
                }
                while($jml_kelas < $ketemu){
                
                  //query ambil data
                    $sql="SELECT absen.tanggal_absen, siswa.nis, siswa.nama, hari.hari, jam_pelajaran.jampel, absen.jam_absen, kelas.nama_kelas
                        FROM absen 
                        INNER JOIN siswa 
                          ON absen.nis=siswa.nis
                        INNER JOIN hari 
                          ON absen.id_hari=hari.id_hari
                        INNER JOIN jam_pelajaran 
                          ON absen.id_jampel=jam_pelajaran.id_jampel
                        INNER JOIN kelas
                          ON absen.id_kelas=kelas.id_kelas
                        WHERE absen.kd_guru = '$kd_guru' && kelas.nama_kelas = '$nama_kelas[$jml_kelas]'
                        ORDER BY siswa.nama ASC";
                    $res=mysqli_query($link,$sql);
                    $found=mysqli_num_rows($res);
                  ?>
                  <!-- end query ambil data -->
                  
                  <!-- tabel absensi -->
                  <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Data Absensi Kelas <?php echo $nama_kelas[$jml_kelas]; ?></h6>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>Tanggal</th>
                              <th>NIS</th>
                              <th>Nama</th>
                              <th>Hari</th>
                              <th>Jam Pelajaran</th>
                              <th>Jam Absen</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                              if($found){
                                foreach($res as $data){
                                  ?>
                                    <tr>
                                      <td><?php echo "$data[tanggal_absen]"; ?></td>
                                      <td><?php echo "$data[nis]"; ?></td>
                                      <td><?php echo "$data[nama]"; ?></td>
                                      <td><?php echo "$data[hari]"; ?></td>
                                      <td><?php echo "$data[jampel]"; ?></td>
                                      <td><?php echo "$data[jam_absen]"; ?></td>
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
                  <!-- end tabel absensi -->
                  <?php
                  $jml_kelas++;
                }
              
              }
            }else{
              //Akun Absensi
              $sql="SELECT DISTINCT jadwal.id_kelas,kelas.nama_kelas 
                    FROM jadwal
                    INNER JOIN kelas
                      ON jadwal.id_kelas=kelas.id_kelas";
              $res=mysqli_query($link,$sql);
              $ketemu=mysqli_num_rows($res);
              if($ketemu){
                $jml_kelas = 0;
                foreach($res as $data){
                  array_push($nama_kelas, $data["nama_kelas"]);
                }
                while($jml_kelas < $ketemu){
                  //query ambil data
                  $sql="SELECT absen.tanggal_absen, siswa.nis, siswa.nama, hari.hari, jam_pelajaran.jampel, absen.jam_absen, 
                        kelas.nama_kelas, mata_pelajaran.nama_matpel
                  FROM absen 
                  INNER JOIN siswa 
                    ON absen.nis=siswa.nis
                  INNER JOIN hari 
                    ON absen.id_hari=hari.id_hari
                  INNER JOIN jam_pelajaran 
                    ON absen.id_jampel=jam_pelajaran.id_jampel
                  INNER JOIN kelas
                    ON absen.id_kelas=kelas.id_kelas
                  INNER JOIN guru
                    ON absen.kd_guru=guru.kd_guru
                  INNER JOIN mata_pelajaran
                    ON guru.id_matpel=mata_pelajaran.id_matpel
                  WHERE kelas.nama_kelas = '$nama_kelas[$jml_kelas]'
                  ORDER BY 
                    absen.tanggal_absen ASC, hari.hari DESC, jam_pelajaran.jampel ASC, siswa.nama ASC";
                  $res=mysqli_query($link,$sql);
                  $found=mysqli_num_rows($res);

                  $sqlKelas = "SELECT * FROM siswa 
                              INNER JOIN kelas 
                                ON siswa.id_kelas=kelas.id_kelas 
                              WHERE kelas.nama_kelas='$nama_kelas[$jml_kelas]'";
                  $resKelas = mysqli_query($link,$sqlKelas);
                  $foundJml = mysqli_num_rows($resKelas);
                  echo $nama_kelas[$jml_kelas]." = ".$foundJml."<br>";
                  //TODO: masukin array utk label sama data2nya
                  // end query ambil data
                  
                  // start insert data to array
                  // TODO insert data to array
                  if($found){
                    foreach($res as $data){
                      //kelompokin berdasarkan bulan
                      // if(in_array_r(substr($data['tanggal_absen'],5,2),$absen_bulan)){

                      // }else{
                        
                      //   array_push($absen_bulan,substr($data['tanggal_absen'],5,2));
                      // }
                      //atas ga kepake (atau belum).

                      //TODO 
                      //ambil data hari weekdays dlm 6 bulan (1 semester). 
                      //itung hari sampe hari ini. 
                      //masukkin semuanya
                      //dalam seminggu 40 jampel, sebulan 160 jampel
                      //dibagi banyak siswa



                      echo "$data[tanggal_absen] </BR>";
                      echo "$data[nis] </BR>";
                      echo "$data[nama] </BR>";
                      echo "$data[hari] </BR>";
                      echo "$data[jampel] </BR>";
                      echo "$data[jam_absen] </BR>";
                      echo "$data[nama_matpel] </BR> </BR>";
                    }
                    echo $nama_kelas[$jml_kelas]." = ".$foundJml."<br>";
                    print_r($absen_bulan); echo "<br>";
                  }

                  // end insert data to array
                  ?>
                  
                  <!-- start chart -->
                  <div class="row">

                    <div class="col-xl-8 col-lg-7">

                      <!-- Area Chart -->
                      <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary">Chart Absensi <?php echo $nama_kelas[$jml_kelas]; ?></h6>
                        </div>
                        <div class="card-body">
                          <div class="chart-area">
                            <canvas id="chartAbsensi<?php echo $nama_kelas[$jml_kelas]; ?>"></canvas>
                            <?php array_push($chartName, "chartAbsensi".$nama_kelas[$jml_kelas]); ?>
                          </div>
                        </div>
                      </div>

                    </div>

                  </div>
                  <!-- end chart --><?php
                  
                  $jml_kelas++;
                }

                echo $jml_kelas;
                print_r($chartName); echo "<BR>";
              
              }
            }?>
                  
            
            

          

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

  <!-- Page level plugins -->
  <script src="../vendor/chart.js/Chart.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <script>

    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    var jml_kelas = <?php echo $jml_kelas; ?>;
    var arr_nama_kelas = <?php echo '["'.implode('","',$chartName).'"]'; ?>;
    
    for(i=0;i<jml_kelas;i++){
      makeChart(arr_nama_kelas[i]);
    }

    function number_format(number, decimals, dec_point, thousands_sep) {
      // *     example: number_format(1234.56, 2, ',', ' ');
      // *     return: '1 234,56'
      number = (number + '').replace(',', '').replace(' ', '');
      var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
          var k = Math.pow(10, prec);
          return '' + Math.round(n * k) / k;
        };
      // Fix for IE parseFloat(0.55).toFixed(0) = 0;
      s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
      if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
      }
      if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
      }
      return s.join(dec);
    }

    function makeChart(chartName){
      var ctx = document.getElementById(chartName);
      var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ["January", "February", "March", "April", "May", "June"],
          datasets: [{
            label: "Revenue",
            backgroundColor: "#4e73df",
            hoverBackgroundColor: "#2e59d9",
            borderColor: "#4e73df",
            data: [4215, 5312, 6251, 7841, 9821, 14984],
          }],
        },
        options: {
          maintainAspectRatio: false,
          layout: {
            padding: {
              left: 10,
              right: 25,
              top: 25,
              bottom: 0
            }
          },
          scales: {
            xAxes: [{
              time: {
                unit: 'month'
              },
              gridLines: {
                display: false,
                drawBorder: false
              },
              ticks: {
                maxTicksLimit: 6
              },
              maxBarThickness: 25,
            }],
            yAxes: [{
              ticks: {
                min: 0,
                max: 15000,
                maxTicksLimit: 5,
                padding: 10,
                // Include a dollar sign in the ticks
                callback: function(value, index, values) {
                  return '$' + number_format(value);
                }
              },
              gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2]
              }
            }],
          },
          legend: {
            display: false
          },
          tooltips: {
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            callbacks: {
              label: "%"
            }
          },
        }
      });
    }
  </script>

</body>

</html>
