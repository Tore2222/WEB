<?php 
include "navbar.php";
include "connection.php";
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Books</title>
 	<style type="text/css">
 		.srch{
 			padding-left: 10px;
 			padding-right: 5px;
 		}
 		body {
 			background-color: #337ab74a;
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
		.book{
			width: 400px;
			margin: 0px auto;
		}
		.form-control{
			background-color: #f5f5f5;
		}
 	</style>
 </head>
 <body>
 	<!-- Sidenav--------  -->
 	<div id="mySidenav" class="sidenav" >
  		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  		<div style="color: white; margin-left:60px ;">
			<?php
				if(isset($_SESSION['login_admin'])){
				echo "<img class='img-cricle profile_img' height=80 width=80  src='image/".$_SESSION['pic']."'>" ;
				echo "</br>";echo "</br>";
				echo "Welcome: ".$_SESSION['login_admin'];
			}	
			?>
		</div>
  		<div class="h"><a href="add.php">Add Books</a></div>
  		<div class="h"><a href="books.php">Delete Books</a></div>
  		<div class="h"><a href="request.php">Book request</a></div>
 		<div class="h"><a href="issue_infor.php">Issue informaion</a></div>
	</div>

	<div id="main">
 		  <span style="font-size:20px;cursor:pointer;margin-left:15px" onclick="openNav()">&#9776; OPEN</span>
 		 <div class="container">
 		 	<h2 style="color:black; font-family:Lucia Console; text-align:center"><b>ADD NEW BOOKS</b></h2><br>
 		 	<form class="book" action="" method="post">
 		 		<input type="text" name="bid" class="form-control" placeholder="Book id" required="Book id"><br>
 		 		<input type="text" name="name" class="form-control" placeholder="Book Name" required=""><br>
 		 		<input type="text" name="authors" class="form-control" placeholder="Authors Name" required=""><br>
 		 		<input type="text" name="edition" class="form-control" placeholder="Edition" required=""><br>
 		 		<input type="text" name="status" class="form-control" placeholder="Status" required=""><br>
 		 		<input type="text" name="quantity" class="form-control" placeholder="Quantity" required=""><br>
 		 		<input type="text" name="department" class="form-control" placeholder="Department" required=""><br>
 		 		<button style="text-align:center;" class="btn btn-default" type="submit" name="submit">ADD</button>
 		 	</form>
 		 </div>
 		 <?php
 		  	if (isset($_POST['submit'])) {
 		  		if (isset($_SESSION['login_admin'])) {
 		  			mysqli_query($db,"INSERT INTO books VALUES ('$_POST[bid]','$_POST[name]','$_POST[authors]','$_POST[edition]','$_POST[status]','$_POST[quantity]','$_POST[department]','0');");
 		  		?>
 		  			<script type="text/javascript">
 		  				alert("Book added successfully");
 		  			</script>
 		  		<?php
 		  		}
 		  		else{
 		  			?>
 		  			<script type="text/javascript">
 		  				alert("You need to log in first");
 		  			</script>
 		  			<?php
 		  		}
 		  	}
 		 ?>
	</div>
	<script>
		function openNav() {
  		document.getElementById("mySidenav").style.width = "250px";
  		document.getElementById("main").style.marginLeft = "250px";
  		document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
	}

		function closeNav() {
  		document.getElementById("mySidenav").style.width = "0";
  		document.getElementById("main").style.marginLeft= "0";
  		document.body.style.backgroundColor = "#337ab74a";
	}
	</script>
</body>
