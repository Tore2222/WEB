
<?php 
include "navbar.php";
include "connection.php";
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Fine Caculator</title>
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
				if(isset($_SESSION['login_admin'])){
					echo "<img class='img-cricle profile_img' height=80 width=80  src='image/".$_SESSION['pic']."'>" ;
					echo "</br>";echo "</br>";
					echo "Welcome: ".$_SESSION['login_admin'];
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
	 	
 	<h2>List of Members</h2>
 	<?php
 		
 			$res = mysqli_query($db,"SELECT * FROM `fine` where username = '$_SESSION[login_member]';");

		 	echo "<table class='table table-bordered table-hover'>";
		 	// table header
		 	echo "<tr style= 'background-color : #6db6b9e6;'>";
		 		echo "<th>"; echo "Username " ; echo"</th>";
			 	echo "<th>"; echo "Bid "; echo "</th>";
			 	echo "<th>"; echo "Returned "; echo "</th>";
			 	echo "<th>"; echo "Days "; echo "</th>";
			 	echo "<th>"; echo "Fine in $ "; echo "</th>";
			 	echo "<th>"; echo "Status "; echo "</th>";

		 	echo "</tr>";

		 	while ($row = mysqli_fetch_assoc($res)) {
		 		echo "<tr>";
		 		echo "<td>" ;echo $row['username'] ;echo "</td>" ;
		 		echo "<td>" ;echo $row['bid'] ;echo "</td>" ;
		 		echo "<td>" ;echo $row['returned'] ;echo "</td>" ;
		 		echo "<td>" ;echo $row['day'] ;echo "</td>" ;
		 		echo "<td>" ;echo $row['fine'] ;echo "</td>" ;
		 		echo "<td>" ;echo $row['status'] ;echo "</td>" ;

		 		echo "</tr>";
		 	}
		 	echo "</table>";
 		

 	?>
 	</div>
 </body>
 </html>
