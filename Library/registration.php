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
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

	<style type="text/css">
		section{
			margin-top:-20px ;
			height: 550px;
			width: 100%;
			background: url(image/Background.jpeg) center / cover no-repeat; 
		}
		.box{
			 height: 450px;
		    width: 430px;
		    background-color: #f2f4e9;
		    margin: 0 auto;
		    opacity: 0.7;
		    padding: 20px;
		    padding-top: 140px;
		}
		label{
			font-weight: 600;
			font-size: 18px;
		}
	</style>
</head>
<body>
<section>
	<br><br><br>
	<div class="box">
		<form name="signup" action="" method="post">
					<b><p style="padding-left: 50px; font-size: 15px; font-weight: 700;">Sign up as:</p></b>

					<input style="margin-left: 50px; width:18px;" type="radio" name="user" id="librarian" value="librarian">
					<label for="librarian">Librarian</label>
					<input style="margin-left: 50px; width:18px;" type="radio" name="user" id="member" value="member" checked ="">
					<label for="member">Member</label> &nbsp&nbsp&nbsp
					<button class="btn btn-default" type="submit" name="submit1" style="color:black; font-weight:700;width: 70px; height:30px">OK</button>
		</form>			
	</div>
	<?php 
		if (isset($_POST['submit1'])) {
			if($_POST['user'] =='librarian'){
				?>
	 			<script type="text/javascript">
	 				window.location= "librarian/registration.php"
	 			</script>
	 		<?php
			}
			else{
				?>
				<script type="text/javascript">
	 				window.location= "member/registration.php"
	 			</script>
	 			<?php
			}
		}
	 ?>
</section>		
<footer>
		<p style= "color : black; text-align: center;"><br>
		Email: &nbsp Online.library@gmail.com <br><br>Moblie number:&nbsp &nbsp +84123456789
		</p>
	</footer>
</body>
