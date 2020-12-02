<?php
	include "../connect.php";
	session_start();
	if(isset($_SESSION['username'])){
		$sesname = $_SESSION['username'];

		$q = "select * from akun where username = '$sesname'";
		$result = mysqli_query($link, $q);
		$num = mysqli_num_rows($result);

		if($num == 1){
			$acc = mysqli_fetch_assoc($result);
			$role = $acc["role"];

			if($role == '000'){
                $_SESSION['username'] = $sesname;
                header('location:./admin/index.php');
			}elseif($role == '001'){
				$_SESSION['username'] = $sesname;
				header('location:./absensi/index.php');
			}elseif($role == '010'){
				$_SESSION['username'] = $sesname;
				
			}elseif($role == '101'){
				$_SESSION['username'] = $sesname;
				$_SESSION['role'] = "Guru";
				header('location:./absensi/index.php');
			}
		}
		
	}else{
        header("location:../index.php");
    }
?>