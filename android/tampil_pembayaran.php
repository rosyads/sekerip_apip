<?php
    //Import File Koneksi Database
    require_once('../connect.php');
    
    $nis = $_POST['nis'];

	//Membuat SQL Query
	$sql = "SELECT bulan, tanggal_bayar, nominal
            FROM bayar
            WHERE nis = '$nis'";

	//Mendapatkan Hasil
	$r = mysqli_query($link,$sql);

	//Membuat Array Kosong
	$result = array();

	while($row = mysqli_fetch_array($r)){

		//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat
		array_push($result,array(
            "bulan"=>$row['bulan'],
            "tanggal_bayar"=>$row['tanggal_bayar'],
            "nominal"=>$row['nominal']
		));
	}

	//Menampilkan Array dalam Format JSON
	echo json_encode(array('result'=>$result));

	mysqli_close($link);
?>