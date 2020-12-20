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
  /*
  fungsi cek hari senin-jumat doang
  tambahin jampel per hari (senin&kamis => +8, selasa&rabu => +9, jumat => +6)
  */
  $tahun = date("Y");
  $bulan = date("m");
  $tanggal = date("d");
  $dateAkhir = $tahun."-".$bulan."-".$tanggal;
  $dateAwal = $tahun."-".$bulan."-1";
  // echo "date awal ".$dateAwal."<BR>";
  // echo "date akhir ".$dateAkhir."<BR>";
  $i = 1;
  $counter = 0;
  $jampel = 0;
  $timestamp1 = strtotime($dateAwal);
  $timestamp2 = strtotime($dateAkhir);
  while($timestamp1 <= $timestamp2){
    $day = date('w', $timestamp1);
      if($day != '0' && $day != '6'){ //skip sabtu minggu
        // echo "Today is " .$day."<br>";
          $counter++;
          if($day == '1' || $day == '4'){ //senin kamis
            $jampel = $jampel +8;
          }else if($day == '2' || $day == '3'){ //selasa rabu
            $jampel = $jampel +9;
          }else if($day == '5'){ //jumat
            $jampel = $jampel +6;
          }
      }
      
      $i++;
      $string = $tahun.'-'.$bulan.'-'.$i;
      $timestamp1 = strtotime($string);
  }
  // echo "<br>total hari   ".$counter;
  // echo "<br>total jampel ".$jampel;

  $nama_bulan = array("Juli","Agustus","September","Oktober","November","Desember",
                      "Januari","Februari","Maret","April","Mei","Juni");

  $nama_kelas= [];
  $absen_bulan = [];
  $absen_tanggal = [];

  $chartName = [];

  $siswa = array(
      'kelas' => [],
      'nis' => [],
      'jml' => [],
      'persen' => []
  ); 

  // print_r($siswa);

  // array_push($siswa['nis'], "1234"); echo "<br>";
  // print_r($siswa);

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
              //Akun Guru
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
                  // end query ambil data
                  
                  // start insert data to array
                  // TODO insert data to array
                  if($found){
                    foreach($res as $data){
                      //TODO
                      /* masukkin semuanya */
                      //add per nis
                      //itung udh brp banyak jampel yg nis itu absen
                      //dapet tingkat kehadiran per siswa

                      //cek nis udh ada atau belom
                      if(in_array_r($data['nis'],$siswa['nis'],false)){
                        $id = array_search($data['nis'], $siswa['nis']);

                        $jampel_siswa = $siswa['jml'][$id];
                        $jampel_siswa++;
                        $siswa['jml'][$id] = $jampel_siswa;
                        echo $jampel_siswa."<br>";

                        $persen = $siswa['persen'][$id];
                        $persen = number_format(($jampel_siswa/$jampel)*100,2);
                        $siswa['persen'][$id] = $persen;
                        
                      }else{
                        array_push($siswa['kelas'], $nama_kelas[$jml_kelas]);
                        array_push($siswa['nis'], $data['nis']);
                        array_push($siswa['jml'], 0);
                        array_push($siswa['persen'], 0);
                      }

                      echo "$data[tanggal_absen] </BR>";
                      echo "$data[nis] </BR>";
                      // echo "$data[nama] </BR>";
                      // echo "$data[hari] </BR>";
                      // echo "$data[jampel] </BR>";
                      // echo "$data[jam_absen] </BR>";
                      // echo "$data[nama_matpel] </BR> </BR>";
                    }
                    echo $nama_kelas[$jml_kelas]." = ".$foundJml."<br>";
                    // print_r($absen_bulan); echo "<br>";
                  }

                  // end insert data to array

                  /* buat persentase */
                  //tambah tingkat kehadiran semua siswa per kelas
                  //bagi banyak siswa per kelas
                  
                  echo "<br>";
                  $arrayKey = array_keys($siswa['kelas'],$nama_kelas[$jml_kelas]);
                  print_r($arrayKey); echo "<BR>";
                  $persen_kelas = 0;
                  $jampel_kelas = $jampel * $foundJml;
                  $jumlah_absen = 0;
                  while($persen_kelas < sizeof($arrayKey)){
                    $jumlah_absen = $jumlah_absen + $siswa['jml'][$arrayKey[$persen_kelas]];
                    $persen_kelas++;
                  }
                  $persentase_kelas = number_format(($jumlah_absen/$jampel_kelas)*100,2);
                  echo $persentase_kelas."<BR>";
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
                  <!-- end chart -->
                  <?php
                  
                  $jml_kelas++;
                }

                echo $jml_kelas." kelas <BR>";
                print_r($chartName); echo "<BR>";
                print_r($siswa); echo "<BR>";
                print_r($nama_kelas); echo "<BR>";
                // print_r(array_keys($siswa['kelas'],"9-1")); echo "<BR>";
                echo sizeof($siswa);
              
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
    var arr_nama_bulan = <?php echo '["'.implode('","',$nama_bulan).'"]'; ?>;
    
    for(i=0;i<jml_kelas;i++){
      makeChart(arr_nama_kelas[i]);
    }

    function makeChart(chartName){
      var ctx = document.getElementById(chartName);
      var kelas = chartName.substr(12);
      var arr_data = "data"+kelas;
      var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: arr_nama_bulan,
          datasets: [{
            label: "Persentase Kehadiran",
            backgroundColor: "#4e73df",
            hoverBackgroundColor: "#2e59d9",
            borderColor: "#4e73df",
            //TODO: Buat array data untuk per kelas
            data: [42.15, 53.12, 62.51, 78.41, 98.21, 14.98],
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
                maxTicksLimit: 12
              },
              maxBarThickness: 25,
            }],
            yAxes: [{
              ticks: {
                min: 0,
                max: 100,
                maxTicksLimit: 5,
                padding: 10,
                // Include a dollar sign in the ticks
                callback: function(value, index, values) {
                  return value + ' %';
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
