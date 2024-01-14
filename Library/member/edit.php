<?php 
	include "connection.php";
	include "navbar.php";
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit profile</title>
	<style type="text/css">
		.form-control{
			width: 280px;
			height: 40px;
		}
		form{
			padding-left: 630px;
		}
		label{
			margin-bottom: 0px;
		}
	</style>
</head>
<body style="background-color: #6db6b9e6;">
	<h2 style="text-align:center">Edit Information</h2>
	<?php 
		$sql = "SELECT * FROM member WHERE username = '$_SESSION[login_member]'";
		$result = mysqli_query($db,$sql) or die(mysql_error());
		while($row  = mysqli_fetch_assoc($result)){
			$firstname = $row['firstname'];
			$lastname = $row['lastname'];
			$username = $row['username'];
			$email = $row['email'];
			$password = $row['password'];
			$phonenumber = $row['phonenumber'];
		}
	 ?>
	<div class="profile_infor" >
		<div style="text-align:center;">
			<span>Welcome,</span>
			<h4 >
				<?php 
					echo $_SESSION['login_member'];
				 ?>
			</h4><br> 
		</div>
		<form action="" method="post" enctype="multipart/form-data">
			<input class="form-control" type="file" name="file">
			<label><h4><b>First Name:</b></h4></label>
			<input class="form-control" type="text" name="firstname" value="<?php echo $firstname; ?>">
			<label><h4><b>Last Name:</b></h4></label>
			<input class="form-control" type="text" name="lastname" value="<?php echo $lastname; ?>">
			<label><h4><b>User Name:</b></h4></label>
			<input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
			<label><h4><b>Password:</b></h4></label>
			<input class="form-control" type="text" name="password" value="<?php echo $password; ?>">
			<label><h4><b>Email:</b></h4></label>
			<input class="form-control" type="text" name="email" value="<?php echo $email; ?>">
			<label><h4><b>Phone number:</b></h4></label>
			<input class="form-control" type="text" name="phonenumber" value="<?php echo $phonenumber; ?>"><br>
			<div style="padding-left:200px;">
			<button class="btn btn-default" type="submit "name="submit">Save</button>
			</div>
		</form>
	</div>
	<?php 
		if (isset($_POST['submit'])) {
			move_uploaded_file($_FILES['file']['tmp_name'], "image/".$_FILES['file']['name']);
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$phonenumber = $_POST['phonenumber']; 
			$pic = $_FILES['file']['name'];

			$sql1="UPDATE member SET pic='$pic',firstname='$firstname',lastname = '$lastname',username='$username',email='$email',phonenumber='$phonenumber' WHERE username='".$_SESSION['login_member']."';";
			if (mysqli_query($db,$sql1)) {
				?>
					<script type="text/javascript">
						alert("Saved Successfully");
						window.location="profile.php";
					</script>
				<?php
			}
		}
	 ?>
</body>
</html>