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
		
 	</style>
 </head>
 <body>
 	<?php 
 		$b = mysqli_query($db,"SELECT * FROM `books` ORDER BY bcount desc limit 0,3;");

 	 ?>
 	<div style=" width:100%; height: 50px; margin-top:-20px;">
 		<div style="background-color: #dd4b39; padding:10px; width:10% ; height: 50px; float: left;">
 			<h3 style="color:white; margin-top:0px">Trending:</h3>
 		</div>
 		<div style="background-color:#dd4b3994; width: 90%; height: 50px; float:left; padding: 10px;">
 			<table>
 				<?php 
 					while($b2 = mysqli_fetch_assoc($b)){
			 		echo "<tr style= 'color:black; width:400px; margin-top:0px; float:left;'>";
				 		echo "<th>"; echo "[".$b2['bid']."] &nbsp" ; echo"</th>";
				 		echo "<th>"; echo $b2['name']; echo "</th>";
				 		
			 		echo "</tr>";
			 		}
 				 ?>
 				<!-- <tr style="color:black; width:400px; margin-top:0px; float:left;"></tr> -->
 			</table>
 		</div>
 	</div>
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
 		<div class="h"><a href="expired.php">Expired book</a></div>

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

<br><br>
<!-----------Search Bar--------  -->

	<div class="srch">
		<form class="navbar-form" method="post" name="form1">
					<label for="department" style="margin: auto 40px;">Choose a Department: </label>
					<select name="department">
					<optgroup label="Educational">
						<option>ECE</option>
						<option>EEE</option>
						<option>CSE</option>

					</optgroup>
					<optgroup label="Entertainment">
						<option>Action</option>	
						<option>Comedy</option>						
						<option>Science</option>						
					</optgroup>	
				</select>
				<br>
				<div style="display: flex; align-items: center; float: left;padding-right: 5px; margin: auto 30px;">
				<input class="form-control" type="text" name="search" placeholder="Search books ...." required="" style="width:400px;height: 40px; margin: 5px;">
				<button style="background-color: #6db6b9e6 ;" type="submit" name="submit" class="btn btn-default" >
					<span class="glyphicon glyphicon-search"></span>
				</button>
			</div>
		</form>
			<form class="navbar-form" method="post" name="form1" style="display: flex; align-items: center; float: right;padding-right: 5px;margin: auto 30px;">

				<input class="form-control" type="text" name="bid" placeholder="Enter book ID" required="" style="width:400px;height: 40px; margin: 5px;">
				<button style="background-color: #6db6b9e6 ;" type="submit" name="submit1" class="btn btn-default" >
					Request
				</button>
		</form>
	</div>

<br><br><br>
 	<h2>List of Books</h2>
 	<?php
 		if (isset($_POST['submit'])) {
 			$q=mysqli_query($db,"SELECT * from books where name like '%$_POST[search]%' and department = '$_POST[department]';");
 			if(mysqli_num_rows($q)==0){
 				echo "Sorry! No book found. Try searching again.";
 			}
 			else{
 				echo "<table class='table table-bordered table-hover'>";
			 	// table header
			 	echo "<tr style= 'background-color : #6db6b9e6;'>";
			 		echo "<th>"; echo "ID" ; echo"</th>";
			 		echo "<th>"; echo "Book-Name"; echo "</th>";
			 		echo "<th>"; echo "Author Name"; echo "</th>";
			 		echo "<th>"; echo "Edition"; echo "</th>";
			 		echo "<th>"; echo "Status"; echo "</th>";
			 		echo "<th>"; echo "Quantity"; echo "</th>";
			 		echo "<th>"; echo "Deparment"; echo "</th>";
			 	echo "</tr>";

			 	while ($row = mysqli_fetch_assoc($q)) {
			 		echo "<tr>";
			 		echo "<td>" ;echo $row['bid'] ;echo "</td>" ;
			 		echo "<td>" ;echo $row['name'] ;echo "</td>" ;
			 		echo "<td>" ;echo $row['authors'] ;echo "</td>" ;
			 		echo "<td>" ;echo $row['edition'] ;echo "</td>" ;
			 		echo "<td>" ;echo $row['status'] ;echo "</td>" ;
			 		echo "<td>" ;echo $row['quantity'] ;echo "</td>" ;
			 		echo "<td>" ;echo $row['department'] ;echo "</td>" ;
			 		echo "</tr>";
			 	}
			 	echo "</table>";
 			}
 		}
 			// if button is not pressed
 		else{

 			$res = mysqli_query($db,"SELECT * FROM `books` ORDER BY `books`.`name` ASC;");

		 	echo "<table class='table table-bordered table-hover'>";
		 	// table header
		 	echo "<tr style= 'background-color : #6db6b9e6;'>";
		 		echo "<th>"; echo "ID" ; echo"</th>";
		 		echo "<th>"; echo "Book-Name"; echo "</th>";
		 		echo "<th>"; echo "Author Name"; echo "</th>";
		 		echo "<th>"; echo "Edition"; echo "</th>";
		 		echo "<th>"; echo "Status"; echo "</th>";
		 		echo "<th>"; echo "Quantity"; echo "</th>";
		 		echo "<th>"; echo "Deparment"; echo "</th>";
		 	echo "</tr>";

		 	while ($row = mysqli_fetch_assoc($res)) {
		 		echo "<tr>";
		 		echo "<td>" ;echo $row['bid'] ;echo "</td>" ;
		 		echo "<td>" ;echo $row['name'] ;echo "</td>" ;
		 		echo "<td>" ;echo $row['authors'] ;echo "</td>" ;
		 		echo "<td>" ;echo $row['edition'] ;echo "</td>" ;
		 		echo "<td>" ;echo $row['status'] ;echo "</td>" ;
		 		echo "<td>" ;echo $row['quantity'] ;echo "</td>" ;
		 		echo "<td>" ;echo $row['department'] ;echo "</td>" ;

		 		echo "</tr>";

		 	}
		 	echo "</table>";
 		}	
 		if(isset($_POST['submit1'])){
 			if (isset($_SESSION['login_member'])) {
 				$sql1=mysqli_query($db,"SELECT * FROM `books` where bid='$_POST[bid]';");
 				$row1 = mysqli_fetch_assoc($sql1);
 				$count1 = mysqli_num_rows($sql1);

 				if( $count1 != 0)
 				{

	 				mysqli_query($db,"INSERT INTO issue_book VALUES('$_SESSION[login_member]','$_POST[bid]','','','');");
	 				?>
	 				<script type="text/javascript">
	 						window.location="request.php"

	 				</script>
	 				<?php
 				}
 				else{
 					?>
	 				<script type="text/javascript">
	 					alert ("The book is not available in library.");

	 				</script>
	 				<?php
 				}
 			}
 			else{
 				?>
 				<script type="text/javascript">
 					alert ("You have to login first to request a book")
 				</script>
 				<?php
 			}
 		}

 	?>
 	
 </body>
 </html>
