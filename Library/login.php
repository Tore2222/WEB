<?php
include "connection.php";
include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<style type="text/css">
		section{
			margin-top:-20px ;
		}
		.box1{
		    height: 450px;
		    width: 430px;
		    background-color: #f2f4e9;
		    margin: 0 auto;
		    opacity: 0.7;
		    padding: 20px;
		}
		label{
			font-size: 14px;
			font-weight: 600;
		}
	</style>
</head>
<body>
		
		<!-- <nav class="navbar navbar-inverse">
			<div class="container-fuild">
				<div class="navbar-header">
					<a class="navbar-brand active" href="index.php">LIBRARY</a>		
				</div>
				<ul class="nav navbar-nav">
					<li><a href="index.php">HOME</a></li>
					<li><a href="books.php">BOOKS</a></li>
					
					<li><a href="feedback.php">FEEDBACK</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="member_login.php"><span class="glyphicon glyphicon-log-in"> LOGIN</span></a></li>
					<li><a href="registration.php" style="margin-right: 20px;"><span class="glyphicon glyphicon-user"> SIGN-UP </span></a></li>
				</ul>
			</div>
		</nav> -->
	<!-- <header>
		<div class="logo">
				<a href="index.php">LIBRARY</a>		
			</div>
			<nav>
				<ul>
					<li><a href="index.php">HOME</a></li>
					<li><a href="books.php">BOOKS</a></li>
					<li><a href="login.php">LOGIN</a></li>
					<li><a href="registration.php">REGISTRATION</a></li>
					<li><a href="">FEEDBACK</a></li>
				</ul>
			</nav>
	</header> -->
	<section>
		<div class="login_img">
			<br><br><br>
			<div class="box1">
				<h1 style="text-align: center; font-size: 35px;font-family: Lucida Conolse;">Library Manegenment System</h1>
				<h1 style="text-align: center; font-size: 25px;">LOGIN</h1><br>
				<form name="login" action="" method="post">
					<b><p style="padding-left: 50px; font-size: 15px; font-weight: 700;">Login as:</p></b>
					<input style="margin-left: 50px; width:18px;" type="radio" name="user" id="member" value="member" checked ="">
					<label for="member">Member</label>
						<input style="margin-left: 50px; width:18px;" type="radio" name="user" id="librarian" value="librarian">
					<label for="librarian">Librarian</label>
					<input style="margin-left: 50px; width:18px;" type="radio" name="user" id="admin" value="admin">
					<label for="admin">Admin</label>
					
					

					<div class="login">
						<input class="form-control" type="text" name="username" placeholder="Username" required=""> <br>
						<input class="form-control" type="password" name="password" placeholder="Password" required=""> <br>
						<button class="btn btn-default" type="sumbmit" name="submit" value="Login" style="color: black;width: 70px;height: 30px;">Login</button>
						<!-- <input class="btn btn-default" type="sumbmit" name="submit" value="Login" style="color: black;width: 70px;height: 30px;"> -->
					</div>
					<p style="color: black; padding: 15px  0;">
						<a style="color: black;" href="update_password.php">Forgot password? </a>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
						New to this website? 
						<a style="color: black;" href="registration.php"> Sign Up</a>
					</p>
				</form>
			</div>
		</div>
	</section>
	<footer>
		<p style= "color : black; text-align: center;"><br>
		Email: &nbsp Online.library@gmail.com <br><br>Moblie number:&nbsp &nbsp +84123456789
		</p>
	</footer>

	<?php 

	 if(isset($_POST['submit'])){
	 	if($_POST['user'] == 'admin'){
	 		$count =0;
	 	$res= mysqli_query($db,"SELECT * FROM `admin` WHERE username = '$_POST[username]' and password = '$_POST[password]' and status ='yes';");
	 	$row = mysqli_fetch_assoc($res);

	 	$count = mysqli_num_rows($res);
	 	if($count == 0){
	 		?>
				 			
				<div class = "alert alert-danger" style="width : 400px; margin-left: 550px;    margin-top: -140px; ">
					<strong>
						The Username and Password doesn't match.
					</strong>
				</div>

	 		<?php
	 	}
	 	else{
	 		// ---if username or password matches---- 
	 		$_SESSION['login_admin'] = $_POST['username'];
	 		$_SESSION['pic'] = $row['pic'];
	 		?>
	 			<script type="text/javascript">
	 				window.location= "admin/index.php"
	 			</script>
	 		<?php

	 	}

	 	}if($_POST['user'] == 'librarian'){
	 		$count =0;
	 	$res= mysqli_query($db,"SELECT * FROM `librarian` WHERE username = '$_POST[username]' and password = '$_POST[password]' ;");
	 	$row = mysqli_fetch_assoc($res);

	 	$count = mysqli_num_rows($res);
	 	if($count == 0){
	 		?>
				 			
				<div class = "alert alert-danger" style="width : 400px; margin-left: 550px;    margin-top: -140px;">
					<strong>
						The Username and Password doesn't match.
					</strong>
				</div>

	 		<?php
	 	}
	 	else{
	 		// ---if username or password matches---- 
	 		$_SESSION['login_librarian'] = $_POST['username'];
	 		$_SESSION['pic'] = $row['pic'];
	 		?>
	 			<script type="text/javascript">
	 				window.location= "librarian/index.php"
	 			</script>
	 		<?php

	 	}
	 	}
	 	else{

	 	$count =0;
	 	$res= mysqli_query($db,"SELECT * FROM `member` WHERE username = '$_POST[username]' && password = '$_POST[password]';");
	 	$row = mysqli_fetch_assoc($res);
	 	$count = mysqli_num_rows($res);
	 	if($count == 0){
	 		?>
				 			
				<div class = "alert alert-danger" style="width : 400px; margin-left: 550px;    margin-top: -140px;">
					<strong>
						The Username and Password doesn't match.
					</strong>
				</div>

	 		<?php
	 	}
	 	else{
	 		$_SESSION['login_member'] = $_POST['username'];
	 		$_SESSION['pic'] = $row['pic'];
	 		?>
	 			<script type="text/javascript">
	 				window.location= "member/index.php"
	 			</script>
	 		<?php

	 	}
	 }
	 }
	 ?>
	
</body>
</html>