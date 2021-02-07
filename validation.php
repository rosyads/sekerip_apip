<?php

session_start();

include "connect.php";

$name = $_POST['user'];
$pass = $_POST['pass'];

$q = "SELECT * FROM akun WHERE username = '$name' AND password = '$pass'";

$result = mysqli_query($link, $q);

$num = mysqli_num_rows($result);

if($num == 1){
	$acc = mysqli_fetch_assoc($result);
	$role = $acc["role"];

	if($role == '000'){
		$_SESSION['username'] = $name;
		header('location:admin/index.php');
	}elseif($role == '001'){
		$_SESSION['username'] = $name;
		header('location:absensi/index.php');
	}elseif($role == '010'){
		$_SESSION['username'] = $name;
		header('location:keuangan/index.php');
	}elseif($role == '101'){
		$_SESSION['username'] = $name;
		$_SESSION['role'] = "Guru";
		header('location:absensi/index.php');
	}else{
		include 'index.php';
		echo "<script>alert('User tidak ditemukan!'); history.back();";
		echo "</script>";	
	}
}else{
	include 'index.php';
	echo "<script>alert('Username atau Password Salah!'); history.back();";
	echo "</script>";

}
