<?php 
include "navbar.php";
include "connection.php";
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Book request</title>
	<style type="text/css">
 		.srch{
 			padding-left: 10px;
 			padding-right: 5px;
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
		th,td,input{
			width: 100px;
		}
	</style>
</head>
<body>
<!-- side Nav -->
<div id="mySidenav" class="sidenav" >
  		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  		<div style="color: white; margin-left:60px ;">
			<?php
				if(isset($_SESSION['login_member'])){
				echo "<img class='img-cricle profile_img' height=80 width=80  src='image/".$_SESSION['pic']."'>" ;
				echo "</br>";echo "</br>";
				echo "Welcome: ".$_SESSION['login_member'];
			}	
			?>
		</div>
  		<div class="h"><a href="books.php">Books</a></div>
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
	<br>
	<div class="container">
	<?php 

 			$q=mysqli_query($db,"SELECT * from issue_book where username='$_SESSION[login_member]' and approve='' ; ");
 			if(mysqli_num_rows($q)==0){
 				echo "</br></br></br>";
 				echo "<h2><b>";
 				echo "There's no pending request";
 				echo "</h2></b>";
 	 			}

 			else{
 				?>
 					<form method="post">
 						
 				<?php

 				echo "<table class='table table-bordered table-hover'>";
			 	// table header
			 	echo "<tr style= 'background-color : #6db6b9e6;'>";
			 		
			 		echo "<th>"; echo "Select"; echo "</th>";
			 		echo "<th>"; echo "Book ID"; echo "</th>";
			 		echo "<th>"; echo "Approve status"; echo "</th>";
			 		echo "<th>"; echo "Request Date"; echo "</th>";
			 		echo "<th>"; echo "Return Date"; echo "</th>";
			 	echo "</tr>";

			 	while ($row = mysqli_fetch_assoc($q)) {
			 		echo "<tr>";
			 		?>
					<td><input type="checkbox" name="check[]" value="<?php echo $row["bid"] ?>"></td>
					<?php
			 		echo "<td>" ;echo $row['bid'] ;echo "</td>" ;
			 		echo "<td>" ;echo $row['approve'] ;echo "</td>" ;
			 		echo "<td>" ;echo $row['issue'] ;echo "</td>" ;
			 		echo "<td>" ;echo $row['return'] ;echo "</td>" ;
			 		echo "</tr>";
			 	}
			 	echo "</table>";
			 	?>
			 	<p><button type="submit" name="delete" class="btn btn-success" onclick="location.reload()">Delete</button></p>
			 	<?php
 			}
	 ?>
	</div>
	<?php 
		if (isset($_POST['delete'])) {
			if(isset($_POST['check'])){
				foreach ($_POST['check'] as $delete_id) {
					 mysqli_query($db, "DELETE from issue_book WHERE bid = '$delete_id' and username = '$_SESSION[login_member]'  ORDER BY bid ASC LIMIT 1;"); 
				}
			}
		}
	 ?>
</body>
</html>