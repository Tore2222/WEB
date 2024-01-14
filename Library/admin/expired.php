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
<!-- side Nav -->
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
  		  <div class="h"> <a href="add.php">Add Book</a></div>
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
	<div class="container">
		 
		<?php
			if(isset($_SESSION['login_admin'])){
				?>
				<div style="float: right; padding: 25px;">
					<form method="post" action="">
						<button name="submit2" type="submit" class="btn btn-default" style="background-color:#06861a; color:yellow;">RETURN</button> &nbsp &nbsp
				 		<button name="submit3" type="submit" class="btn btn-default" style="background-color:red; color:yellow;">EXPIRED</button>
			 		</form>
		 		</div>
				<div class="srch">
					<form method="post" action="" name="form1">
						<input type="text" name="username" class="form-control" placeholder="Username" required=""><br>
						<input type="text" name="bid" class="form-control" placeholder="BID" required=""><br>
						<button class="btn btn-default" name="submit" type="submit">Submit</button> <br>
						</form>
				</div>
				<?php
				if (isset($_POST['submit'])) {
					$res=mysqli_query($db,"SELECT * FROM `issue_book` where username = '$_POST[username]' and bid = '$_POST[bid]';");
					while ($row = mysqli_fetch_assoc($res)){
						$d = strtotime($row['return']);
						$c = strtotime(date("Y-m-d"));
						$diff = $c - $d;
						if ($diff >= 0) {
							$day = floor($diff/(60*60*24));
							$fine = $day*.10;
						}
					}
					$x = date("Y-m-d");

					mysqli_query($db,"INSERT INTO `fine` VALUES('$_POST[username]','$_POST[bid]','$x','$day','$fine','not paid');");
					$var1= '<p style="color:yellow; background-color:green;">Return</p>';
					mysqli_query($db,"UPDATE issue_book SET approve='$var1' WHERE username='$_POST[username]' and bid='$_POST[bid]';");
					mysqli_query($db,"UPDATE books SET quantity = quantity+1  where bid = '$_POST[bid]';");
				}
			}
		?>
		<!-- <h3 style="text-align:center;">Date expired list</h3>  
	-->
	<br>
		<?php 
		$c =0;
			if(isset($_SESSION['login_admin'])){
				$ret= '<p style="color:yellow; background-color:green;">Return</p>';
				$exp= '<p style="color:yellow; background-color:red;">EXPIRED</p>';
				if(isset($_POST['submit2'])){
					$sql="SELECT member.username,books.bid,name,authors,edition,approve,issue,issue_book.return FROM member inner join issue_book ON member.username = issue_book.username inner join books ON issue_book.bid=books.bid WHERE issue_book.approve = '$ret' ORDER BY `issue_book`.`return` DESC";
					$res = mysqli_query($db,$sql);

				}
				else if(isset($_POST['submit3'])){
					$sql="SELECT member.username,books.bid,name,authors,edition,approve,issue,issue_book.return FROM member inner join issue_book ON member.username = issue_book.username inner join books ON issue_book.bid=books.bid WHERE issue_book.approve = '$exp' ORDER BY `issue_book`.`return` DESC";
					$res = mysqli_query($db,$sql);

				}
				else{
					$sql="SELECT member.username,books.bid,name,authors,edition,approve,issue,issue_book.return FROM member inner join issue_book ON member.username = issue_book.username inner join books ON issue_book.bid=books.bid WHERE issue_book.approve != '' and issue_book.approve != 'Yes' ORDER BY `issue_book`.`return` DESC";
					$res = mysqli_query($db,$sql);

				}
				echo "<table class='table table-bordered table-hover' >";
			 	// table header
			 	
			 	echo "<tr style= 'background-color : #6db6b9e6;'>";
			 		echo "<th>"; echo "Member Username"; echo "</th>";
			 		echo "<th>"; echo "BID"; echo "</th>";
			 		echo "<th>"; echo "Book Name"; echo "</th>";
			 		echo "<th>"; echo "Author Name"; echo "</th>";
			 		echo "<th>"; echo "Edition"; echo "</th>";
			 		echo "<th>"; echo "Status"; echo "</th>";
			 		echo "<th>"; echo "Issue Date"; echo "</th>";
			 		echo "<th>"; echo "Return Date"; echo "</th>";
			 	echo "</tr>";
			 	echo "</table>";

				echo "<div class = 'scroll'>";
				echo "<table class='table table-bordered table-hover'>";
			 	while ($row = mysqli_fetch_assoc($res)) {
			 		
			 		echo "<tr>";
			 		echo "<td>" ;echo $row['username'] ;echo "</td>" ;
			 		echo "<td>" ;echo $row['bid'] ;echo "</td>" ;
			 		echo "<td>" ;echo $row['name'] ;echo "</td>" ;
			 		echo "<td>" ;echo $row['authors'] ;echo "</td>" ;
			 		echo "<td>" ;echo $row['edition'] ;echo "</td>" ;
			 		echo "<td>" ;echo $row['approve'] ;echo "</td>" ;
			 		echo "<td>" ;echo $row['issue'] ;echo "</td>" ;
			 		echo "<td>" ;echo $row['return'] ;echo "</td>" ;

			 		echo "</tr>";
			 	}
			 	
			 	echo "</table>";
			 	echo "</div>";
			}
			else{
				?>
					<h3 style="text-align:center;">Please login to see Information of Borrowed Books</h3>
				<?php
			}
		 ?>
	</div>
</div>
</body>
</html>