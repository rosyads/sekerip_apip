<?php 
  include 'header.php'; 
  $nama_kelas = [];
  $chartName = [];
  $dataName = [];
  $nama_bulan = array("Juli","Agustus","September","Oktober","November","Desember",
                      "Januari","Februari","Maret","April","Mei","Juni");
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
                $sql="SELECT bayar.bulan,bayar.tanggal_bayar,bayar.nis,bayar.nominal,siswa.nama 
                    FROM bayar
                    INNER JOIN siswa
                      ON bayar.nis = siswa.nis
                    INNER JOIN kelas
                      ON siswa.id_kelas = kelas.id_kelas
                    WHERE kelas.nama_kelas = '$nama_kelas[$jml_kelas]'
                    ORDER BY nama ASC";
                $res=mysqli_query($link,$sql);
                $found=mysqli_num_rows($res);

                $array_pembayaran_kelas[$nama_kelas[$jml_kelas]] = [0,0,0,0,0,0,0,0,0,0,0,0];
            
                // end query ambil data

                // start insert data to array
                if($found){
                  foreach($res as $data){
                    if($data['bulan'] == "Juli"){
                      $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][0] = $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][0] + $data['nominal'];
                    }else if($data['bulan'] == "Agustus"){
                      $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][1] = $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][1] + $data['nominal'];
                    }else if($data['bulan'] == "September"){
                      $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][2] = $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][2] + $data['nominal'];
                    }else if($data['bulan'] == "Oktober"){
                      $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][3] = $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][3] + $data['nominal'];
                    }else if($data['bulan'] == "November"){
                      $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][4] = $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][4] + $data['nominal'];
                    }else if($data['bulan'] == "Desember"){
                      $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][5] = $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][5] + $data['nominal'];
                    }else if($data['bulan'] == "Januari"){
                      $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][6] = $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][6] + $data['nominal'];
                    }else if($data['bulan'] == "Februari"){
                      $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][7] = $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][7] + $data['nominal'];
                    }else if($data['bulan'] == "Maret"){
                      $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][8] = $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][8] + $data['nominal'];
                    }else if($data['bulan'] == "April"){
                      $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][9] = $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][9] + $data['nominal'];
                    }else if($data['bulan'] == "Mei"){
                      $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][10] = $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][10] + $data['nominal'];
                    }else if($data['bulan'] == "Juni"){
                      $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][11] = $array_pembayaran_kelas[$nama_kelas[$jml_kelas]][11] + $data['nominal'];
                    }

                  }

                }

          ?>

          <!-- start chart -->
          <div class="row">

            <div class="col-xl-8 col-lg-7">

              <!-- Area Chart -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Chart Total Pembayaran SPP <?php echo $nama_kelas[$jml_kelas]; ?></h6>
                </div>
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="chartPembayaran<?php echo $nama_kelas[$jml_kelas]; ?>"></canvas>
                    <?php 
                      array_push($chartName, "chartPembayaran".$nama_kelas[$jml_kelas]); 
                      array_push($dataName, "data".$nama_kelas[$jml_kelas]);
                    ?>
                  </div>
                </div>
              </div>

            </div>

          </div>
          <!-- end chart -->

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

  <!-- Page level plugins -->
  <script src="../vendor/chart.js/Chart.min.js"></script>
  
  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <script>

    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    var jml_kelas = <?php echo $jml_kelas; ?>;
    var arr_chart_kelas = <?php echo '["'.implode('","',$chartName).'"]'; ?>;
    var arr_nama_bulan = <?php echo '["'.implode('","',$nama_bulan).'"]'; ?>;
    var arr_nama_kelas = <?php echo '["'.implode('","',$nama_kelas).'"]'; ?>;
    // var arr_persentase = <?php //echo '["'.implode('","',$array_persentase_kelas).'"]'; ?>;

    var arr_pembayaran = <?php echo json_encode($array_pembayaran_kelas); ?>;
    // console.log(arr_persentase["8-3"]);

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

    
    for(i=0;i<jml_kelas;i++){
      makeChart(arr_chart_kelas[i], arr_nama_kelas[i]);
    }

    function makeChart(chartName, className){
      var ctx = document.getElementById(chartName);
      var kelas = chartName.substr(15);
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
            data: arr_pembayaran[className],
            // data: [4215, 5312, 6251, 7841, 9821, 14984],
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
                // max: 100,          
                // maxTicksLimit: 5,  
                padding: 10,
                // Include a dollar sign in the ticks
                callback: function(value, index, values) {
                  return 'Rp. ' + number_format(value);
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
