<?php
    //Import File Koneksi Database
    require_once('../connect.php');
    
    $kd_guru = $_POST['kd_guru'];
    $hari = $_POST['hari'];
    // $kd_guru = '002';
    // $hari = 'Senin';

	//Membuat SQL Query
	$sql = "SELECT DISTINCT jadwal.id_kelas,kelas.nama_kelas, jam_pelajaran.jampel
            FROM jadwal
            INNER JOIN kelas
            ON jadwal.id_kelas=kelas.id_kelas
            INNER JOIN hari
            ON jadwal.id_hari = hari.id_hari
            INNER JOIN jam_pelajaran
            ON jadwal.id_jampel=jam_pelajaran.id_jampel
            WHERE kd_guru = '$kd_guru' && hari='$hari'
            ORDER BY jam_pelajaran.jampel ASC";

	//Mendapatkan Hasil
	$r = mysqli_query($link,$sql);

	//Membuat Array Kosong
	$result = array();

	while($row = mysqli_fetch_array($r)){

		//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat
		array_push($result,array(
            "id_kelas"=>$row['id_kelas'],
            "nama_kelas"=>$row['nama_kelas'],
            "jampel"=>$row['jampel']
		));
	}

	//Menampilkan Array dalam Format JSON
	echo json_encode(array('result'=>$result));

	mysqli_close($link);
?>