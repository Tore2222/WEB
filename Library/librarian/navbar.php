<?php 
	session_start();
	include "connection.php";

 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php 
	if(isset($_SESSION['login_librarian'])){

		$r=mysqli_query($db,"SELECT COUNT(status) as total from message where status='no' and username = '$_SESSION[login_librarian]' and sender = 'member' ;");
		$c=mysqli_fetch_assoc($r);	
		$sql_app=mysqli_query($db,"SELECT COUNT(status) as total from librarian where status='';");
		$a= mysqli_fetch_assoc($sql_app);
	}
 ?>
<nav class="navbar navbar-inverse">
			<div class="container-fuild">
				<div class="navbar-header">
					<a class="navbar-brand active" href="index.php">LIBRARY</a>		
				</div>
				<ul class="nav navbar-nav">
					<li><a href="index.php">HOME</a></li>
					<li><a href="books.php">BOOKS</a></li>
				</ul>
				<?php 
					if (isset($_SESSION['login_librarian'])){
						?>
							<ul class="nav navbar-nav">
								<!-- <li><a href="profile.php">PROFILE</a></li> -->
								<li><a href="member-information.php">MEMBER-INFORMATION</a></li>
								<li><a href="fine.php">FINES</a></li>

							</ul>
							<ul class="nav navbar-nav navbar-right">
								<li><a href="librarian_status.php"><span class="glyphicon glyphicon-user"></span>&nbsp
									<span class="badge bg-green"> 
									<?php 
									echo $a['total'];
									 ?>
									</span>
								 </a></li>
								<li><a href="message.php"><span class="glyphicon glyphicon-envelope"></span>&nbsp
									<span class="badge bg-green"> 
										<?php 
										echo $c['total'];
										 ?>
									</span> 
								</a></li>
								<li><a style="padding:10px 15px" href="profile.php">
									<div style="color: white;">
										<?php
											echo "<img class='img-cricle profile_img' height=30 width=30  src='image/".$_SESSION['pic']."'>" ;
											echo "  ".$_SESSION['login_librarian'];
										?>
									</div>
									</a>
								</li>
								<li><a href="profile.php" style="margin-right: 20px;"><span>PROFILE </span></a></li>
								<li><a href="logout.php" style="margin-right: 20px;"><span class="glyphicon glyphicon-user">LOG-OUT </span></a></li>

							</ul>
						<?php
					}
					else{
						?>
						<ul class="nav navbar-nav navbar-right">
							<li><a href="../login.php"><span class="glyphicon glyphicon-log-in"> LOGIN</span></a></li>
							<li><a href="registration.php" style="margin-right: 20px;"><span class="glyphicon glyphicon-user"> SIGN-UP </span></a></li>
						</ul>
						<?php

					}
				 ?>
				<ul class="nav navbar-nav">
					<li><a href="feedback.php">FEEDBACK</a></li>
				</ul>
			</div>
		</nav>

</body>
</html>