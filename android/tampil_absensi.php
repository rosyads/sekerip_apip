<?php
    //Import File Koneksi Database
    require_once('../connect.php');
    
	$nis = $_POST['nis'];
    $date = $_POST['date'];
	// $nis = '181907002';
    // $date = '2021-01';

	//Membuat SQL Query
	// $sql = "SELECT absen.tanggal_absen, hari.hari, jam_pelajaran.jampel, absen.jam_absen, 
    //             mata_pelajaran.nama_matpel
    //         FROM absen 
    //         INNER JOIN siswa 
    //             ON absen.nis=siswa.nis
    //         INNER JOIN hari 
    //             ON absen.id_hari=hari.id_hari
    //         INNER JOIN jam_pelajaran 
    //             ON absen.id_jampel=jam_pelajaran.id_jampel
    //         INNER JOIN kelas
    //             ON absen.id_kelas=kelas.id_kelas
    //         INNER JOIN guru
    //             ON absen.kd_guru=guru.kd_guru
    //         INNER JOIN mata_pelajaran
    //             ON guru.id_matpel=mata_pelajaran.id_matpel
    //         WHERE absen.nis = '$nis' && SUBSTRING(absen.tanggal_absen,1,7) = '$date'
    //         ORDER BY 
    //             absen.tanggal_absen ASC, hari.hari DESC, jam_pelajaran.jampel ASC, siswa.nama ASC";

    $sql = "SELECT absen.tanggal_absen, hari.hari, jam_pelajaran.jampel, absen.jam_absen, 
            mata_pelajaran.nama_matpel
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
            WHERE absen.nis = '$nis' && 
            absen.tanggal_absen = '$date'
            ORDER BY 
            absen.tanggal_absen ASC, hari.hari DESC, jam_pelajaran.jampel ASC, siswa.nama ASC";

	//Mendapatkan Hasil
	$r = mysqli_query($link,$sql);

	//Membuat Array Kosong
	$result = array();

	while($row = mysqli_fetch_array($r)){

		//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat
		array_push($result,array(
            "tanggal"=>$row['tanggal_absen'],
            "hari"=>$row['hari'],
            "jampel"=>$row['jampel'],
            "absen"=>$row['jam_absen'],
            "matpel"=>$row['nama_matpel']
		));
	}

	//Menampilkan Array dalam Format JSON
	echo json_encode(array('result'=>$result));

	mysqli_close($link);
?>