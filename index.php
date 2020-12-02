<?php
	include "connect.php";
	session_start();
	if(isset($_SESSION['username'])){
		$sesname = $_SESSION['username'];

		$q = "select * from akun where username = '$sesname'";
		$result = mysqli_query($link, $q);
		$num = mysqli_num_rows($result);

		if($num == 1){
			$acc = mysqli_fetch_assoc($result);
			$role = $acc["role"];

			if($role == '00'){
				$_SESSION['username'] = $sesname;
				header('location:./admin/index.php');
			}elseif($role == '01'){
				$_SESSION['username'] = $sesname;
				header('location:./absensi/index.php');
			}elseif($role == '10'){
				$_SESSION['username'] = $sesname;
				header('location:./keuangan/index.php');
			}
		}
		
	}
?>
<html>
<head>
	<title>SMP Ganesa Satria</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<style type="text/css">
		body {
			background-image:url(img/showcase.jpg);
			background-size: cover;

		}
	</style>
</head>

<body>

	<div class="container">

		<div class="login-box">
			<div class="row">
				<div class="col-md-6 login"> 
					<h2>Login</h2>
					<form action="validation.php" method="post">
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="user" class="form-control" required autocomplete="off">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="Password" name="pass" class="form-control" autocomplete="off">
						</div>
						<button type="submit" class="btn btn-primary">Login</button>
					</form>
				</div>	

			</div>

		</div>

	</div>

</body>

</html>