<?php 
	include "connection.php";
	include "navbar.php";
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Profile</title>
 	<style type="text/css">
 		.wrapper{
 			width: 500px;
 			margin: 0 auto;
/* 			color: white;*/
 		}
 	</style>
 </head>
 <body style="background-color: #6db6b9e6;" >
 	<div class="container">
 		<form action="" method="post">
 			<button class="btn btn-default" style="float: right;" name="submit1" type="submit">
 				Edit
 			</button>
 		</form>
 		<div class="wrapper">
 			<?php
 			if(isset($_POST['submit1'])){
 				?>
 				<script type="text/javascript">
 					window.location ="edit.php";
 				</script>
 				<?php
 			}
 			$q = mysqli_query($db,"SELECT * FROM member where username='$_SESSION[login_member]';");
 			?>
 			<h2 style="text-align:center">My Proflie</h2>
 			<?php
 				$row = mysqli_fetch_assoc($q);
 				echo "<div style='text-align:center'><img class='img-circle profile-img' height=100 width=100 src='image/".$_SESSION['pic']."'></div>";
 			?>
 			<div style="text-align:center;><b ">Welcome</b>
	 			<h4>
	 				<?php
	 					echo $_SESSION['login_member']; 
	 				?>
	 			</h4>
 			</div>
 			<?php
				echo "<b>";
 				echo "<table class='table table-bordered'>";
 					echo "<tr>";
 						echo "<td>";
 							echo "<b> First Name:</b>";
 						echo "</td>";
 						echo "<td>";
 							echo $row['firstname'];
 						echo "</td>";
 					echo "</tr>";

 					echo "<tr>";
 						echo "<td>";
							echo "<b> Last Name:</b>";
 						echo "</td>";
 						echo "<td>";
							echo $row['lastname'];
 						echo "</td>";
 					echo "</tr>";

 					echo "<tr>";
 						echo "<td>";
							echo "<b> User Name:</b>";
 						echo "</td>";
 						echo "<td>";
							echo $row['username'];
 						echo "</td>";
 					echo "</tr>";

 					echo "<tr>";
 						echo "<td>";
							echo "<b> Password:</b>";
 						echo "</td>";
 						echo "<td>";
							echo $row['password'];
 						echo "</td>";
 					echo "</tr>";

 					echo "<tr>";
 						echo "<td>";
						 	echo "<b> Email:</b>";
 						echo "</td>";
 						echo "<td>";
							 echo $row['email'];
 						echo "</td>";
 					echo "</tr>";

 					echo "<tr>";
 						echo "<td>";
							 echo "<b>Phone number:</b>";
 						echo "</td>";
 						echo "<td>";
						 	echo $row['phonenumber'];
 						echo "</td>";
 					echo "</tr>";
 				echo "</table>";
				echo "</b>";
 			?>
 		</div>
 		
 	</div>
 </body>
 </html>