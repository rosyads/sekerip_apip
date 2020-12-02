<?php
    //Import File Koneksi Database
    require_once('../connect.php');
    
    $kelas = $_POST['kelas'];
    $hari = $_POST['hari'];

	//Membuat SQL Query
	$sql = "SELECT jam_pelajaran.jampel, jadwal.kd_guru, guru.nama, mata_pelajaran.nama_matpel
            FROM jadwal 
            INNER JOIN kelas 
                ON jadwal.id_kelas=kelas.id_kelas
            INNER JOIN hari 
                ON jadwal.id_hari=hari.id_hari
            INNER JOIN jam_pelajaran 
                ON jadwal.id_jampel=jam_pelajaran.id_jampel
            INNER JOIN guru 
                ON jadwal.kd_guru=guru.kd_guru
            INNER JOIN mata_pelajaran
                ON guru.id_matpel = mata_pelajaran.id_matpel
            WHERE jadwal.id_kelas = '$kelas' AND hari.hari = '$hari'
            ORDER BY jam_pelajaran.jampel ASC";

	//Mendapatkan Hasil
	$r = mysqli_query($link,$sql);

	//Membuat Array Kosong
	$result = array();

	while($row = mysqli_fetch_array($r)){

		//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat
		array_push($result,array(
            "jampel"=>$row['jampel'],
            "kd_guru"=>$row['kd_guru'],
            "nama"=>$row['nama'],
            "nama_matpel"=>$row['nama_matpel']
		));
	}

	//Menampilkan Array dalam Format JSON
	echo json_encode(array('result'=>$result));

	mysqli_close($link);
?>