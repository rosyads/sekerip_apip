<?php
 require_once '../connect.php';
 $response = array();
 if(isset($_GET['action'])) {
    switch($_GET['action']){
        case 'login':
            if(isValid(array('username', 'password','role'))){
                //getting values 
                $username = $_POST['username'];
                $password = $_POST['password']; 
                $roleAndro = $_POST['role']; 

                if($roleAndro == "Siswa" ){
                    //creating the check query 
                    $stmt = $link->prepare("SELECT id_akun, username, role, siswa.nama, kelas.nama_kelas, siswa.tgl_lahir, 
                                siswa.Agama, siswa.id_kelas, siswa.saldo
                    FROM akun 
                    INNER JOIN siswa
                        ON akun.username = siswa.nis 
                    INNER JOIN kelas
                        ON siswa.id_kelas = kelas.id_kelas
                    WHERE username = ? AND password = ?");
                    $stmt->bind_param("ss",$username, $password);
                    $stmt->execute();
                    $stmt->store_result();

                    //if the user exist with given credentials 
                    if($stmt->num_rows > 0) {
                        $stmt->bind_result($id, $username, $role, $nama, $kelas, $tgl_lahir, $agama, $id_kelas, $saldo);
                        $stmt->fetch();

                        $user = array(
                        'id'=>$id, 
                        'username'=>$username, 
                        'role'=>$role,
                        'nama'=>$nama,
                        'kelas'=>$kelas,
                        'tgl_lahir'=>$tgl_lahir,
                        'agama'=>$agama,
                        'id_kelas'=>$id_kelas,
                        'saldo' => $saldo
                        );
                        $response['error'] = false; 
                        $response['message'] = 'Login successfull'; 
                        $response['user'] = $user; 
                    }else{
                        //if the user not found 
                        $response['error'] = true; 
                        $response['message'] = 'Invalid username or password';
                    }
                }else if($roleAndro == "Guru"){
                    //creating the check query 
                    $stmt = $link->prepare("SELECT id_akun, username, role, guru.nama, guru.kd_guru, mata_pelajaran.nama_matpel
                    FROM akun 
                    INNER JOIN guru
                        ON akun.username = guru.nuptk
                    INNER JOIN mata_pelajaran
                        ON guru.id_matpel = mata_pelajaran.id_matpel
                    WHERE username = ? AND password = ?");
                    $stmt->bind_param("ss",$username, $password);
                    $stmt->execute();
                    $stmt->store_result();

                    //if the user exist with given credentials 
                    if($stmt->num_rows > 0) {
                        $stmt->bind_result($id, $username, $role, $nama_guru, $kd_guru, $nama_matpel);
                        $stmt->fetch();

                        $user = array(
                        'id'=>$id, 
                        'username'=>$username, 
                        'role'=>$role,
                        'nama'=>$nama_guru,
                        'kd_guru'=>$kd_guru,
                        'nama_matpel'=>$nama_matpel
                        );
                        $response['error'] = false; 
                        $response['message'] = 'Login successfull'; 
                        $response['user'] = $user; 
                    }else{
                        //if the user not found 
                        $response['error'] = true; 
                        $response['message'] = 'Invalid username or password';
                    }
                }else if($roleAndro == "Bendahara"){
                    //creating the check query 
                    $stmt = $link->prepare("SELECT id_akun, username, role FROM akun WHERE username = ? AND password = ?");
                    $stmt->bind_param("ss",$username, $password);
                    $stmt->execute();
                    $stmt->store_result();

                    //if the user exist with given credentials 
                    if($stmt->num_rows > 0) {
                        $stmt->bind_result($id, $username, $role);
                        $stmt->fetch();

                        $user = array(
                            'id'=>$id, 
                            'username'=>$username, 
                            'role'=>$role
                        );
                        $response['error'] = false; 
                        $response['message'] = 'Login successfull'; 
                        $response['user'] = $user; 
                    }else{
                        //if the user not found 
                        $response['error'] = true; 
                        $response['message'] = 'Invalid username or password';
                    }
                }
                
                
            } else {
                $response['error'] = true; 
                $response['message'] = 'Invalid data.';

                $username = "181907002";
                $password = "020306";

                //creating the check query 
                $stmt = $link->prepare("SELECT id_akun, username, role, siswa.nama, kelas.nama_kelas, siswa.tgl_lahir, 
                siswa.Agama, siswa.id_kelas, siswa.saldo
                FROM akun 
                INNER JOIN siswa
                    ON akun.username = siswa.nis 
                INNER JOIN kelas
                    ON siswa.id_kelas = kelas.id_kelas
                WHERE username = ? AND password = ?");
                $stmt->bind_param("ss",$username, $password);
                $stmt->execute();
                $stmt->store_result();

                //if the user exist with given credentials 
                if($stmt->num_rows > 0) {
                    $stmt->bind_result($id, $username, $role, $nama, $kelas, $tgl_lahir, $agama, $id_kelas, $saldo);
                    $stmt->fetch();

                    $user = array(
                    'id'=>$id, 
                    'username'=>$username, 
                    'role'=>$role,
                    'nama'=>$nama,
                    'kelas'=>$kelas,
                    'tgl_lahir'=>$tgl_lahir,
                    'agama'=>$agama,
                    'id_kelas'=>$id_kelas,
                    'saldo' => $saldo
                    );
                    $response['error'] = false; 
                    $response['message'] = 'Login successfull'; 
                    $response['user'] = $user; 
                }
            }
            break;
        case 'absen':
            if(isValid(array('nis', 'kelas', 'kd_guru', 'hari', 'jam'))){
                //getting values 
                $nis = $_POST['nis'];
                $kd_guru = $_POST['kd_guru']; 
                $hari = $_POST['hari'];
                $jam = $_POST['jam']; 
                $kelas = $_POST['kelas'];
                $date = date("Y-m-d");

                $sql = "SELECT siswa.nis, kelas.nama_kelas, jadwal.kd_guru, hari.hari, jam_pelajaran.jampel,
                            hari.id_hari, jam_pelajaran.id_jampel, kelas.id_kelas
                        FROM siswa
                        INNER JOIN kelas
                            ON siswa.id_kelas = kelas.id_kelas
                        INNER JOIN jadwal
                            ON kelas.id_kelas = jadwal.id_kelas
                        INNER JOIN hari
                            ON jadwal.id_hari = hari.id_hari
                        INNER JOIN jam_pelajaran
                            ON jadwal.id_jampel = jam_pelajaran.id_jampel
                        WHERE kelas.nama_kelas = '$kelas' && hari.hari = '$hari' 
                            && siswa.nis = '$nis' && jadwal.kd_guru = '$kd_guru'";
                
                $res = mysqli_query($link,$sql);
                $ketemu = mysqli_num_rows($res);
                if($ketemu){
                    foreach($res as $data){
                        $sqlCheck = "SELECT * FROM absen 
                            WHERE tanggal_absen = '$date' && nis='$data[nis]' && kd_guru='$data[kd_guru]'
                                && id_hari = '$data[id_hari]' && id_jampel = '$data[id_jampel]'";
                        $resCheck = mysqli_query($link,$sqlCheck);
                        if(!mysqli_num_rows($resCheck)){
                            $sql = "INSERT INTO absen(kd_guru,nis,id_hari,id_jampel,id_kelas,jam_absen,tanggal_absen) 
                                VALUES ('$data[kd_guru]','$data[nis]','$data[id_hari]','$data[id_jampel]','$data[id_kelas]','$jam','$date')";
                            $res = mysqli_query($link, $sql);
                        }
                    }
                    $response['error'] = false; 
                    $response['message'] = 'Absen Berhasil';
                }else{
                    $response['error'] = true; 
                    $response['message'] = 'Absen gagal';
                }
            } else {
                $response['error'] = true; 
                $response['message'] = 'Invalid data.';
            }
            break;
        case 'bayar':
            if(isValid(array('nis', 'kelas', 'tahun', 'bulan', 'tanggal', 'jam', 'type', 'bulanBayar', 'nominal'))){
                //getting values 
                $nis = $_POST['nis'];
                $kelas = $_POST['kelas'];
                $tahun = $_POST['tahun']; 
                $bulan = $_POST['bulan'];
                $tanggal = $_POST['tanggal']; 
                $jam = $_POST['jam'];
                $type = $_POST['type'];
                $bulanBayar = $_POST['bulanBayar'];
                $nominal = $_POST['nominal'];
                                        
                $date = date("Y-m-d");

                if($bulan > 6){
                    $semester = "ganjil";
                    $tahun_ajar = $tahun."/".($tahun+1);
                }else{
                    $semester = "genap";
                    $tahun_ajar = ($tahun-1)."/".$tahun;
                }

                $sqlCheck = "SELECT * FROM bayar 
                            WHERE tahun_ajar='$tahun_ajar' && semester='$semester' && bulan='$bulanBayar'
                            && tanggal_bayar='$date' && alokasi='SPP' && nis='$nis' && nominal='$nominal'";
                $resCheck = mysqli_query($link,$sqlCheck);
                $ketemu = mysqli_num_rows($resCheck);
                if($ketemu == 0){
                    $sqlBayar = "INSERT INTO bayar(tahun_ajar,semester,bulan,tanggal_bayar,alokasi,nis,nominal)
                        VALUES ('$tahun_ajar','$semester','$bulanBayar','$date','SPP','$nis','$nominal')";
                    $resBayar = mysqli_query($link,$sqlBayar);
                    $sqlSaldo = "UPDATE siswa 
                            SET saldo = saldo-200000 
                            WHERE nis='$nis'";
                    $resSaldo = mysqli_query($link,$sqlSaldo);
                    $ketemuBayar = $resBayar;
                    $ketemuSaldo = $resSaldo;
                    if($ketemu && $ketemu1){
                        $response['error'] = false; 
                        $response['message'] = 'Pembayaran Berhasil';   
                    }else{
                        $response['error'] = true; 
                        $response['message'] = 'Pembayaran gagal';
                    }
                }else{
                    $response['error'] = true;
                    $response['message'] = 'Pembayaran sudah dilakukan';
                }
            } else {
                $response['error'] = true; 
                $response['message'] = 'Invalid data.';
            }
            break;
            case 'bayar':
            if(isValid(array('nis', 'kelas', 'tahun', 'bulan', 'tanggal', 'jam', 'type', 'bulanBayar', 'nominal'))){
                //getting values 
                $nis = $_POST['nis'];
                $kelas = $_POST['kelas'];
                $tahun = $_POST['tahun']; 
                $bulan = $_POST['bulan'];
                $tanggal = $_POST['tanggal']; 
                $jam = $_POST['jam'];
                $type = $_POST['type'];
                $bulanBayar = $_POST['bulanBayar'];
                $nominal = $_POST['nominal'];
                                        
                $date = date("Y-m-d");

                if($bulan > 6){
                    $semester = "ganjil";
                    $tahun_ajar = $tahun."/".($tahun+1);
                }else{
                    $semester = "genap";
                    $tahun_ajar = ($tahun-1)."/".$tahun;
                }

                $sqlCheck = "SELECT * FROM bayar 
                            WHERE tahun_ajar='$tahun_ajar' && semester='$semester' && bulan='$bulanBayar'
                            && tanggal_bayar='$date' && alokasi='SPP' && nis='$nis' && nominal='$nominal'";
                $resCheck = mysqli_query($link,$sqlCheck);
                $ketemu = mysqli_num_rows($resCheck);
                if($ketemu == 0){
                    $sqlBayar = "INSERT INTO bayar(tahun_ajar,semester,bulan,tanggal_bayar,alokasi,nis,nominal)
                        VALUES ('$tahun_ajar','$semester','$bulanBayar','$date','SPP','$nis','$nominal')";
                    $resBayar = mysqli_query($link,$sqlBayar);
                    $sqlSaldo = "UPDATE siswa 
                            SET saldo = saldo-200000 
                            WHERE nis='$nis'";
                    $resSaldo = mysqli_query($link,$sqlSaldo);
                    $ketemuBayar = $resBayar;
                    $ketemuSaldo = $resSaldo;
                    if($ketemu && $ketemu1){
                        $response['error'] = false; 
                        $response['message'] = 'Pembayaran Berhasil';   
                    }else{
                        $response['error'] = true; 
                        $response['message'] = 'Pembayaran gagal';
                    }
                }else{
                    $response['error'] = true;
                    $response['message'] = 'Pembayaran sudah dilakukan';
                }
            } else {
                $response['error'] = true; 
                $response['message'] = 'Invalid data.';
            }
            break;
        case 'bayar':
            if(isValid(array('nis', 'kelas', 'tahun', 'bulan', 'tanggal', 'jam', 'type', 'bulanBayar', 'nominal'))){
                //getting values 
                $nis = $_POST['nis'];
                $kelas = $_POST['kelas'];
                $tahun = $_POST['tahun']; 
                $bulan = $_POST['bulan'];
                $tanggal = $_POST['tanggal']; 
                $jam = $_POST['jam'];
                $type = $_POST['type'];
                $bulanBayar = $_POST['bulanBayar'];
                $nominal = $_POST['nominal'];
                                        
                $date = date("Y-m-d");

                if($bulan > 6){
                    $semester = "ganjil";
                    $tahun_ajar = $tahun."/".($tahun+1);
                }else{
                    $semester = "genap";
                    $tahun_ajar = ($tahun-1)."/".$tahun;
                }

                $sqlCheck = "SELECT * FROM bayar 
                            WHERE tahun_ajar='$tahun_ajar' && semester='$semester' && bulan='$bulanBayar'
                            && tanggal_bayar='$date' && alokasi='SPP' && nis='$nis' && nominal='$nominal'";
                $resCheck = mysqli_query($link,$sqlCheck);
                $ketemu = mysqli_num_rows($resCheck);
                if($ketemu == 0){
                    $sqlBayar = "INSERT INTO bayar(tahun_ajar,semester,bulan,tanggal_bayar,alokasi,nis,nominal)
                        VALUES ('$tahun_ajar','$semester','$bulanBayar','$date','SPP','$nis','$nominal')";
                    $resBayar = mysqli_query($link,$sqlBayar);
                    $sqlSaldo = "UPDATE siswa 
                            SET saldo = saldo-200000 
                            WHERE nis='$nis'";
                    $resSaldo = mysqli_query($link,$sqlSaldo);
                    $ketemuBayar = $resBayar;
                    $ketemuSaldo = $resSaldo;
                    if($ketemuBayar && $ketemuSaldo){
                        $response['error'] = false; 
                        $response['message'] = 'Pembayaran Berhasil';   
                    }else{
                        $response['error'] = true; 
                        $response['message'] = 'Pembayaran gagal';
                    }
                }else{
                    $response['error'] = true;
                    $response['message'] = 'Pembayaran sudah dilakukan';
                }
            } else {
                $response['error'] = true; 
                $response['message'] = 'Invalid data.';
            }
            break;    
        case 'top_up':
            if(isValid(array('nis', 'kelas', 'nominal'))){
                //getting values 
                $nis = $_POST['nis'];
                $kelas = $_POST['kelas'];
                $nominal = $_POST['nominal'];

                $sqlCheck = "SELECT * FROM siswa 
                            WHERE nis='$nis'";
                $resCheck = mysqli_query($link,$sqlCheck);
                $ketemu = mysqli_num_rows($resCheck);
                if($ketemu){
                    $sqlSaldo = "UPDATE siswa 
                            SET saldo = $nominal 
                            WHERE nis='$nis'";
                    $resSaldo = mysqli_query($link,$sqlSaldo);
                    $ketemuSaldo = $resSaldo;
                    if($ketemuSaldo){
                        $response['error'] = false; 
                        $response['message'] = 'Top up Berhasil.';   
                    }else{
                        $response['error'] = true; 
                        $response['message'] = 'Top up gagal.';
                    }
                }else{
                    $response['error'] = true;
                    $response['message'] = 'Data siswa tidak ditemukan.';
                }
            } else {
                $response['error'] = true; 
                $response['message'] = 'Invalid data.';
            }
            break;
        default:
            $response['error'] = true; 
            $response['message'] = 'Invalid Action.';
        break;
    }
 } else {
    $response['error'] = true; 
    $response['message'] = 'Invalid Request.';
 }
 function isValid($params){
    foreach($params as $param) {
        //if the paramter is not available or empty
        if(isset($_POST[$param])) {
            if(empty($_POST[$param])){
                return false;
            }
        } else {
            return false;
        }
    }
    //return true if every param is available and not empty 
    return true; 
}
echo json_encode($response);
?>