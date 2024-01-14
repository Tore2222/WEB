<?php 
	include "connection.php";
	include "navbar.php";
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title>Message</title>
	<style type="text/css">
		body{
/*    		background:url("image/message.jpg") center / cover no-repeat;*/
		}
		.wrapper{
			background:url("image/message.jpg") center / cover no-repeat;
			height: 700px;
			width: 100%;
			color: white;
			opacity: 0.9;
			margin: -20px auto;
			padding: 10px;
		}
		.form-control{
			height: 47px;
			width: 76%;
		}
		.msg{
			height: 450px;
			overflow-y: scroll;
		}
		.chat{
			display: flex;
			flex-flow: row wrap;
		}
		.user .chatbox{
			height: 50px;
			width: 430px;
			padding: 13px 10px;
			background-color:#5bc0de ;
			border-radius: 10px;
			order :-1;
		}
		.admin .chatbox{
			height: 50px;
			width: 430px;
			padding: 13px 10px;
			background-color:#2eac8b ;
			border-radius: 10px;
		}
	</style>
</head>
<body>	
	<?php 
			if (isset($_POST['submit'])) {
				mysqli_query($db,"INSERT INTO `library`.`message` VALUES('','$_SESSION[login_member]','$_POST[message]','no','member') ;");
				$res = mysqli_query($db,"SELECT * from message where username = '$_SESSION[login_member]';");
			}
			else{
				$res = mysqli_query($db,"SELECT * from message where username = '$_SESSION[login_member]';");
			}
			mysqli_query($db,"UPDATE message SET status ='yes' where sender = 'admin' and username = '$_SESSION[login_member]' ;");
		 ?>
	<div class="wrapper">
	
		<div style="height:700px; width: 500px;margin:15px auto;">
			<div style="height: 70px;background-color: #2eac8b;text-align: center; color:white; border-radius: 5px; ">
				<h2 style="padding-top: 20px;">Admin</h2>
			</div>
			<div class="msg">
				<br>
				<?php 
					while ($row=mysqli_fetch_assoc($res)) {
						if($row['sender']=='member'){


				 ?>
				<!-- member -->
				<br>
				<div class="chat user">
					<div style="float: left;padding-top: 5px;">
						&nbsp	
						<?php
							echo "<img class='img-circle profile-img' height=35 width=35  src='image/".$_SESSION['pic']."'>" ;
						?>
					</div>
					<div style="float:left;" class="chatbox">
						<?php 
							echo $row['message'];
						 ?>
					</div>
				</div>
						&nbsp	

				<?php
			}
			else{

				  ?>
					<!-- ADMIN -->
				<div class="chat admin">
					<div style="float: left;padding-top: 5px;">
						<img style="height:35px;width: 35px; border-radius:50%" src="image/user-icon-vector-png-6.png">
					</div>
					<div style="float:left;" class="chatbox">
						<?php 
							echo $row['message'];
						 ?>
					</div>
				</div>
			<?php 
				}
				}
			?>
			</div>
			<div style="height:100px; padding-top: 10px;">
				<form action="" method="post">
					<input type="text" name="message" class="form-control" required="" placeholder="Write Message...." style="float:left"> &nbsp	
					<button class="btn btn-info btn-lg" type="submit" name="submit">
						<span class="glyphicon glyphicon-send"></span>&nbspSend
					</button>
				</form>
			</div>
		</div>
</body>
	</div>
	
</html>