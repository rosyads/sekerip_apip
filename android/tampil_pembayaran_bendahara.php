<?php
    //Import File Koneksi Database
    require_once('../connect.php');
    
	$username = $_POST['username'];
	// $nis = '181907002';

	//Membuat SQL Query
	$sql = "SELECT nis, bulan, tanggal_bayar, nominal
            FROM bayar 
            ORDER BY tanggal_bayar DESC";     

	//Mendapatkan Hasil
	$r = mysqli_query($link,$sql);

	//Membuat Array Kosong
	$result = array();

	while($row = mysqli_fetch_array($r)){

		//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat
		array_push($result,array(
            "nis"=>$row['nis'],
            "bulan"=>$row['bulan'],
            "tanggal_bayar"=>$row['tanggal_bayar'],
            "nominal"=>$row['nominal']
		));
	}

	//Menampilkan Array dalam Format JSON
	echo json_encode(array('result'=>$result));

	mysqli_close($link);
?>