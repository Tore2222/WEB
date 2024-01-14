<?php 
	session_start();
	if (isset($_SESSION['login_librarian'])) {
		unset($_SESSION['login_librarian']);	
	}
	header("location:../index.php");
 ?>