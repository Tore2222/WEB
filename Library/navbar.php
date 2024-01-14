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
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
	<?php 
	if(isset($_SESSION['login_member'])){
		$r=mysqli_query($db,"SELECT COUNT(status) as total from message where status='no' and username = '$_SESSION[login_member]' and sender = 'librarian' ;");
		$c=mysqli_fetch_assoc($r);
// --------timer----------
		$b = mysqli_query($db,"SELECT * from issue_book where username='$_SESSION[login_member]' and approve='Yes' ORDER BY `return` ASC limit 0,1 ;");
		$bid = mysqli_fetch_assoc($b);
		// echo $bid['bid'];
		$t =  mysqli_query($db,"SELECT * from `timer` where name='$_SESSION[login_member]' and bid ='$bid[bid]';");
		$res = mysqli_fetch_assoc($t);
		// echo $res['tm'];
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
									<!-- --------------------timer---------------->

									<script>
									var countDownDate = new Date("<?php 
											echo $res['tm'];
										 ?>").getTime();

									var x = setInterval(function() {

									  var now = new Date().getTime();

									  var distance = countDownDate - now;

									  // Time calculations for days, hours, minutes and seconds
									  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
									  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
									  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
									  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

									  // Display the result in the element with id="demo"
									  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
									  + minutes + "m " + seconds + "s ";

									  // If the count down is finished, write some text
									  if (distance < 0) {
									    clearInterval(x);
									    document.getElementById("demo").innerHTML = "EXPIRED";
									  }
									}, 1000);
									</script>
									<!-- -----------timer------- -->
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
							<li><a href="login.php"><span class="glyphicon glyphicon-log-in"> LOGIN</span></a></li>
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