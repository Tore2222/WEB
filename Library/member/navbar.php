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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<?php 
	if(isset($_SESSION['login_member'])){
		$r=mysqli_query($db,"SELECT COUNT(status) as total from message where status='no' and username = '$_SESSION[login_member]' and sender = 'admin' ;");
		$c=mysqli_fetch_assoc($r);
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
					<li><a href="fine.php">FINES</a></li>

				</ul>
				<?php 
					if (isset($_SESSION['login_member'])){
						?>	

							<ul class="nav navbar-nav navbar-right">
									
							<li><a href=""><p style="font-size: 20px; color: red;" id="demo"></p></a></li>
								<li><a href="message.php"><span class="glyphicon glyphicon-envelope"></span>&nbsp<span class="badge bg-green"> 
									<?php 
									echo $c['total'];
									 ?>
								</span> </a></li>
								<li><a style="padding:10px 15px"  href="profile.php">
									<div style="color: white;">
										<?php
											echo "<img class='img-circle profile-img' height=30 width=30  src='image/".$_SESSION['pic']."'>" ;
											echo " ".$_SESSION['login_member'];
										?>
									</div>
								</a></li>
								
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
		<?php
			if (isset($_SESSION['login_member'])) {
				$day =0;
				$exp= '<p style="color:yellow; background-color:red;">EXPIRED</p>';
				$res=mysqli_query($db,"SELECT * from `issue_book` where username = '$_SESSION[login_member]' and approve = '$exp';");
				while ($row = mysqli_fetch_assoc($res)) {
					$d = strtotime($row['return']);
					$c = strtotime(date("Y-m-d"));
					$diff = $c - $d;
					if ($diff >= 0) {
						$day = $day+ floor($diff/(60*60*24));
					
					
					}
			}	
			// echo $day;
				$_SESSION['fine'] = $day*.10;
		}
		 ?>

</body>
</html>