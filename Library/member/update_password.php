<?php 
    include "connection.php";
    include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Change Password</title>
    <style type="text/css">
        body{
            height:650px;
            background:url("image/fotor-ai-2023121121358.jpg") center / cover no-repeat;
        }
        .wrapper{
            width: 400px;
            height: 400px;
            margin: 100px auto;
            background-color: #f5f5f5ab;
            opacity: 0.8;
            padding: 15px 15px;
        }
        /*.form-control{
            width: 150px;
        }*/
    </style>
</head>
<body>
	<div class="wrapper">
        <div style="text-align:center;">
            <h1 style="text-align: center; font-size: 35px;font-family: Lucida Conolse;">Library Manegenment System</h1>
            <h1 style="text-align: center; font-size: 20px;font-family: Lucida Conolse;">Change your password</h1>
        </div>
        <div>
            <form action="" method="post">
                <input type="text" name="username" class="form-control" placeholder="Username" required=""><br>
                <input type="text" name="email" class="form-control" placeholder="Email" required=""><br>
                <input type="password" name="password" class="form-control" placeholder="New password" required=""><br>
                <button class="btn btn-default" type="submit" name="submit">Update</button>
            </form> 
        </div>
    </div>
    <?php
        if(isset($_POST['submit'])){
            if(mysqli_query($db,"UPDATE member set password='$_POST[password]' WHERE username ='$_POST[username]' AND email='$_POST[email]'  ;")){
                ?>
                    <script type="text/javascript">
                         alert("The Password updated successfully.");
                    </script>
                <?php
            }
        }
    ?>
</body>
</html>