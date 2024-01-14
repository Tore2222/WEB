<?php 
	session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		Online Library Managment System
	</title>
	<link rel="stylesheet" type="text/css" href="style.css">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		nav{
	    float: right;
	    word-spacing: 30px;
	    align-items: center;
		}
		nav li {
	    display: inline-block;
	    line-height: 80px;
	    padding-right: 20px;
		}
	</style>
</head>

<body>
	<div class="wrapper">
	
		<header>
			
			<?php 
				if (isset($_SESSION['login_admin'])) {
				?>
					<nav>
						<ul>
							<li><a href="">
							<div style="color: black;display:inline-block;line-height: 80px;padding-right: 800px;">
								<?php
									echo "WELCOME:".$_SESSION['login_admin'];
								?>
							</div>
						</a></li>
							<li><a href="index.php">HOME</a></li>
							<li><a href="books.php">BOOKS</a></li>
							<li><a href="logout.php">LOG-OUT</a></li>
							<li><a href="feedback.php">FEEDBACK</a></li>
						</ul>
					</nav>
				<?php
				}
				else{
					?>
					<div class="logo">
						<a href="index.php">LIBRARY</a>		
					</div>
					<nav>
						<ul>
							<li><a href="index.php">HOME</a></li>
							<li><a href="books.php">BOOKS</a></li>
							<li><a href="login.php">LOGIN</a></li>
							<li><a href="registration.php">SIGN-UP</a></li>
							<li><a href="feedback.php">FEEDBACK</a></li>
						</ul>
					</nav>
					<?php
				}

			 ?>
			
		</header>

		<section>
			<div class="sec_img">
				<br><br><br>
				<div class="box">
				<br><br><br><br>
					<h1 style="text-align: center;font-size: 35px;">Welcome to Library !</h1><br><br>
					<h1 style="text-align: center;font-size: 20px">Opens at 09:00</h1><br>
					<h1 style="text-align: center;font-size: 20px">Closes at 17:30</h1><br>
				</div>
			</div>
		</section>
	</div>

	<?php 
		include "footer.php";
	 ?>
</body>
</html>