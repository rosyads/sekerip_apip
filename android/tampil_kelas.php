<?php
    //Import File Koneksi Database
    require_once('../connect.php');
    
    $kd_guru = $_POST['kd_guru'];
    $id_kelas = $_POST['id_kelas'];
    // $id_kelas = '4';

	//Membuat SQL Query
	$sql = "SELECT DISTINCT siswa.nis, siswa.nama
            FROM siswa
            INNER JOIN kelas
            ON siswa.id_kelas=kelas.id_kelas
            WHERE siswa.id_kelas = '$id_kelas'
            ORDER BY siswa.nis ASC";

	//Mendapatkan Hasil
	$r = mysqli_query($link,$sql);

	//Membuat Array Kosong
	$result = array();

	while($row = mysqli_fetch_array($r)){

		//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat
		array_push($result,array(
            "nis"=>$row['nis'],
            "nama"=>$row['nama']
		));
	}

	//Menampilkan Array dalam Format JSON
	echo json_encode(array('result'=>$result));

	mysqli_close($link);
?>