<?php 
include "navbar.php";
include "connection.php";
 ?>


<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<style type="text/css">
		section{
			margin-top:-20px ;
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
					
					<li><a href="">FEEDBACK</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="login.php"><span class="glyphicon glyphicon-log-in"> LOGIN</span></a></li>
					<li><a href="registration.php" style="margin-right: 20px;"><span class="glyphicon glyphicon-user" > SIGN-UP </span></a></li>
				</ul>
			</div>
		</nav> -->
	<section>
		<div class="reg_img">
			<br>
			<div class="box2">
				<h1 style="text-align: center; font-size: 25px;font-family: Lucida Conolse;">Library Manegenment System</h1>
				<h1 style="text-align: center; font-size: 20px;">REGISTRATION</h1>
			<form name="login" action="" method="post">
				<div class="login">
					<input class="form-control" type="text" name="firstname" placeholder="First Name" required=""> <br>
					<input class="form-control" type="text" name="lastname" placeholder="Last Name" required=""> <br>
					<input class="form-control" type="text" name="username" placeholder="User Name" required=""> <br>
					<input class="form-control" type="password" name="password" placeholder="Password" required=""> <br>
					<input class="form-control" type="number" name="phonenumber" placeholder="Phone Number" required=""><br>
					<input class="form-control" type="text" name="email" placeholder="Email" required=""> <br>
					<button class="btn btn-default" type="submit" name="submit" value="Login" style="color: black;width: 70px;height: 30px;">Sign up</button>
				</div>
			</form>
			
			</div>
		</div>
	</section>
	<footer>
			<p style= "color : black; text-align: center;">
				<br>
				Email: &nbsp Online.library@gmail.com <br><br>
				Moblie number:&nbsp &nbsp +84123456789
			</p>
	</footer>

	<?php 
	if(isset($_POST['submit'])){
		// $sql = "";

		$count = 0;
		$sql = "SELECT username from `member`";
		$res = mysqli_query($db,$sql);

		while($row=mysqli_fetch_assoc($res)){
			if($row['username'] == $_POST['username'])
			{
				$count = $count +1;
			}
		}
		if($count == 0){
		mysqli_query($db,"INSERT INTO `member`(id,firstname,lastname,username,password,phonenumber,email,pic) VALUES('','$_POST[firstname]','$_POST[lastname]','$_POST[username]','$_POST[password]','$_POST[phonenumber]','$_POST[email]','user-icon-vector-png-6.png');");

		?>
			<script type="text/javascript">
				alert("Registration successfull");
	 			window.location= "../login.php"
	 		</script>
		<?php
		}
		else{
			?>
				<script type="text/javascript">
				alert("The Username already exist");
				</script>
			<?php
		}
	}	

	?>


</body>
