<?php
include "navbar.php";
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Approve Request</title>
<style type="text/css">
 		.srch{
 			width: 400px;
 			padding-left: 10px;
 			padding-right: 5px;
 		}
 		.form-control{

 		}
 		body {
 			 font-family: "Lato", sans-serif;
 			 transition: background-color .5s;
		}

		.sidenav {
  			height: 100%;
  			margin-top: 50px;
  			width: 0;
  			position: fixed;
  			z-index: 1;
  			top: 0;
  			left: 0;
  			background-color: #111;
 			overflow-x: hidden;
  			transition: 0.5s;
 			padding-top: 60px;
		}

		.sidenav a {
  			padding: 8px 8px 8px 32px;
  			text-decoration: none;
  			font-size: 20px;
  			color: #818181;
  			display: block;
  			transition: 0.3s;
		}

		.sidenav a:hover {
		  	color: #f1f1f1;
		}

		.sidenav .closebtn {
		  position: absolute;
		  top: 0;
		  right: 25px;
		  font-size: 36px;
		  margin-left: 50px;
		}

		#main {
  			transition: margin-left .5s;
 			 padding: 16px;
		}

		@media screen and (max-height: 450px) {
  			.sidenav {padding-top: 15px;}
 			.sidenav a {font-size: 18px;}
		}
		.img-cricle{
			margin-left: 30px;
		}
		.h:hover{
			color: black;
			width: 100%;
			height: 50px;
			background-color: rgb(0 0 0 / 58%);
		}
		.scroll{
			width: 100%;
			height: 500px;
			overflow:auto;
		}
		th,td{
			width: 10%;
		}
 	</style>
 </head>
 <body>
 	<!-- Sidenav--------  -->
 	<div id="mySidenav" class="sidenav" >
  		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  		<div style="color: white; margin-left:60px ;">
			<?php
				if(isset($_SESSION['login_librarian'])){
					echo "<img class='img-cricle profile_img' height=80 width=80  src='image/".$_SESSION['pic']."'>" ;
					echo "</br>";echo "</br>";
					echo "Welcome: ".$_SESSION['login_librarian'];
				}
			?>
		</div>
  		
  		<div class="h"><a href="request.php">Book request</a></div>
 		<div class="h"><a href="issue_infor.php">Issue informaion</a></div>
 		<div class="h"><a href="expired.php">Expired list</a></div>

	</div>

	<div id="main">

 		 <span style="font-size:20px;cursor:pointer;margin-left:15px" onclick="openNav()">&#9776; OPEN</span>

	<script>
		function openNav() {
  		document.getElementById("mySidenav").style.width = "250px";
  		document.getElementById("main").style.marginLeft = "250px";
  		document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
	}

		function closeNav() {
  		document.getElementById("mySidenav").style.width = "0";
  		document.getElementById("main").style.marginLeft= "0";
  		document.body.style.backgroundColor = "white";
	}
	</script>
<!-----------Search Bar--------  -->
<div class="container">
<h3 style="float:left;">Search one username at a time to approve </h3>

	<div class="srch">
		<form class="navar-form" method="post" name="form1" style="display: flex; align-items: center; padding-right: 5px;">

				<input class="form-control" type="text" name="search" placeholder="Search username" required="" style="width:400px;height: 40px; margin: 5px;">
				<button style="background-color: #6db6b9e6 ;" type="submit" name="submit" class="btn btn-default" >
					<span class="glyphicon glyphicon-search"></span>
				</button>
		</form>
	</div>
	 	
 	<h2>New Request</h2>
 	<?php
 		if (isset($_POST['submit'])) {
 			$q=mysqli_query($db,"SELECT firstname ,lastname,username,email,phonenumber FROM `librarian` where username like '%$_POST[search]%' and status='';");
 			if(mysqli_num_rows($q)==0){
 				echo "Sorry! No librarian found with that username. Try searching again.";
 			}
 			else{
 				echo "<table class='table table-bordered table-hover'>";
			 	// table header
			 	echo "<tr style= 'background-color : #6db6b9e6;'>";
			 		echo "<th>"; echo "Fristname" ; echo"</th>";
			 		echo "<th>"; echo "Lastname"; echo "</th>";
			 		echo "<th>"; echo "Username"; echo "</th>";
			 		echo "<th>"; echo "Email"; echo "</th>";
			 		echo "<th>"; echo "Phone number"; echo "</th>";
			 	echo "</tr>";

			 	while ($row = mysqli_fetch_assoc($q)) {
			 		$_SESSION['test_name'] = $row['username'];
			 		echo "<tr>";
				 		echo "<td>" ;echo $row['firstname'] ;echo "</td>" ;
			 			echo "<td>" ;echo $row['lastname'] ;echo "</td>" ;
			 			echo "<td>" ;echo $row['username'] ;echo "</td>" ;
			 			echo "<td>" ;echo $row['email'] ;echo "</td>" ;
			 			echo "<td>" ;echo $row['phonenumber'] ;echo "</td>" ;
			 		echo "</tr>";
			 	}
			 	echo "</table>";
			 	?>
			 	<form method="post"> 
			 	<button type="submit" name="submit1" style="font-size: 18px;font-weight: 700;" class="btn btn-default"><span style="color:red;" class="glyphicon glyphicon-remove-sign"></span>REMOVE</button>
			 	<button type="submit" name="submit2" style="font-size: 18px;font-weight: 700;" class="btn btn-default"><span style="color:green;" class="glyphicon glyphicon-ok-sign"></span>APPROVE</button>
			 	</form>	
			 	<?php
			 	
 			}
 		}
 			// if button is not pressed
 		else{

 			$res = mysqli_query($db,"SELECT firstname ,lastname,username,email,phonenumber FROM `librarian` where status = '';");

		 	echo "<table class='table table-bordered table-hover'>";
		 	// table header
		 	echo "<tr style= 'background-color : #6db6b9e6;'>";
		 		echo "<th>"; echo "Frist name" ; echo"</th>";
			 	echo "<th>"; echo "Last name"; echo "</th>";
			 	echo "<th>"; echo "Username"; echo "</th>";
			 	echo "<th>"; echo "Email"; echo "</th>";
			 	echo "<th>"; echo "Phone number"; echo "</th>";
		 	echo "</tr>";

		 	while ($row = mysqli_fetch_assoc($res)) {
		 		echo "<tr>";
		 		echo "<td>" ;echo $row['firstname'] ;echo "</td>" ;
		 		echo "<td>" ;echo $row['lastname'] ;echo "</td>" ;
		 		echo "<td>" ;echo $row['username'] ;echo "</td>" ;
		 		echo "<td>" ;echo $row['email'] ;echo "</td>" ;
		 		echo "<td>" ;echo $row['phonenumber'] ;echo "</td>" ;
		 		echo "</tr>";
		 	}
		 	echo "</table>"; 	
 		}
			if (isset($_POST['submit1'])) {
			 		mysqli_query($db," DELETE * from librarian where username = '$_SESSION[test_name]' and status='';");
			 		unset($_SESSION['test_name']);

			 	}
			 	if (isset($_POST['submit2'])) {
			 		mysqli_query($db,"UPDATE librarian SET status='yes' where username = '$_SESSION[test_name]';");
			 		unset($_SESSION['test_name']);

			 	}

 	?>
 	</div>
 </body>
 </html>
