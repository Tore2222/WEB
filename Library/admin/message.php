<?php 
include "navbar.php";
include "connection.php";
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Message</title>
 	
 </head >
 <style type="text/css">
 		.left_box{
 			height: 600px;
 			width: 34%;
 			float: left;
 			margin-top: -20px; 
 			background-color: #8ecdd2;
 		}
 		.left_box2{
 			height: 600px;
 			width:60% ;
 			background-color: #537890;
 			border-radius: 20px;
 			float: right;
 			margin-right:30px ;
 		}
 		.list{
 			height: 500px;
 			width:300px;
 			background-color: #537890;
 			float: right;
 			color: white;
 			padding: 10px;
 			overflow-y:scroll;
 			overflow-x: hidden;
 		}
 		.left_box input
			  {
			    width: 150px;
			    height: 50px;
			    background-color: #537890;
			    padding: 10px;
			    margin: 10px;
			    border-radius: 10px;
			  }
 		.right_box{
 			height: 600px;
 			width: 66%;
 			float: right;
 			background-color: #8ecdd2;
 			margin-top: -20px;
 			padding: 10px;
 		}
 		.right_box2{
 			height: 600px;
 			width: 60%;
 			margin-top: -20px;
 			padding: 20px;
 			border-radius: 20px;
 			background-color:  #537890;
 			float: left;
 			color: white;
 		}
 		 tr:hover
			  {
			    background-color: #1e3f54;
			    cursor: pointer;
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
		}
		.admin .chatbox{
			height: 50px;
			width: 430px;
			padding: 13px 10px;
			background-color:#2eac8b ;
			border-radius: 10px;
			order :-1;

		}
 	</style>
 <body style="width: 100%; height:595px;">
		<?php
  $sql1=mysqli_query($db,"SELECT member.pic,message.username FROM member INNER JOIN message ON member.username=message.username group by username ORDER BY status ;");
?>
<!-----------------------Left box-------------------->
<div class="left_box">
  <div class="left_box2">
    <div style="color: #fff;">
      <form method="post" enctype="multipart/form-data">
        <input type="text" name="username" id="uname">
        <button type="submit" name="submit" class="btn btn-default">SHOW</button>
      </form>
    </div>
    <div class="list">
      <?php
        echo "<table id='table' class='table' >";
        while ($res1=mysqli_fetch_assoc($sql1)) 
        {
          echo "<tr>";
            echo "<td width=65>"; echo "<img class='img-circle profile_img' height=60 width=60 src='image/".$res1['pic']."'>";  echo "</td>";

            echo "<td style='padding-top:30px;'>"; echo $res1['username']; echo "</td>";

          echo "</tr>";
        }
        echo "</table>";
      ?>
    </div>
  </div>
</div>
<!-----------------------Right box-------------------->
<div class="right_box">
  <div class="right_box2">
    <?php
    /*--------------if submit is pressed-----------*/
      if(isset($_POST['submit']))
      {
        $res=mysqli_query($db,"SELECT * from message where username='$_POST[username]' ;");
        mysqli_query($db,"UPDATE message SET status='yes' where sender='member' and username='$_POST[username]' ;");

        if($_POST['username'] != ''){$_SESSION['username']=$_POST['username'];}

      ?>
        <div style="height: 70px; width: 100%; text-align: center; color: white; ">
          <h3 style="margin-top: -5px; padding-top: 10px;"> <?php echo $_SESSION['username'] ?> </h3>
        </div>
  <!---------show message----------->
            <div class="msg">
            <?php
              while ($row=mysqli_fetch_assoc($res))
              {
                if($row['sender']=='member')
                {
            ?>
              <!-------member---------------->
              <br><div class="chat user">
                <div style="float: left; padding-top: 5px;">
                  &nbsp
                  <img style="height: 40px; width: 40px; border-radius: 50%;" src="image/user-icon-vector-png-6.png">
                  &nbsp
                </div>
                <div style="float: left;" class="chatbox">
                  <?php
                    echo $row['message'];
                  ?>
                </div>
              </div>

          <?php
            }
            else
            {
          ?>
              <!-------admin---------------->

              <br><div class="chat admin">
                <div style="float: left; padding-top: 5px;">
                  &nbsp
                  <?php
                  echo "<img class='img-circle profile_img' height=40 width=40 src='image/".$_SESSION['pic']."'>";
                  ?>
                  
                  &nbsp
                </div>
                <div style="float: left;" class="chatbox">
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
        
          <div style="height: 50px; padding-top: 10px;" >
          <form action="" method="post">
            <input type="text" name="message" class="form-control" required="" placeholder="Write Message..." style="float: left"> &nbsp&nbsp
            <button class="btn btn-info btn-lg" type="submit" name="submit1"><span class="glyphicon glyphicon-send "></span>&nbsp Send</button>
          </form>
          </div>
      <?php
      }
     /*--------------if submit is not pressed-----------*/
     else
     {
      if($_SESSION['username']=='')
      {
        ?>
          <img style="margin: 100px 80px; border-radius: 50%;" src="image/tenor.gif" alt="animated">
        <?php
      }
      else
      {
        if(isset($_POST['submit1']))
        {
          mysqli_query($db,"INSERT into `library`.`message` VALUES ('', '$_SESSION[username]','$_POST[message]','no','admin');");

          $res=mysqli_query($db,"SELECT * from message where username='$_SESSION[username]' ;");
        }
        else
        {
          $res=mysqli_query($db,"SELECT * from message where username='$_SESSION[username]' ;");
        }
        ?>
        <div style="height: 70px; width: 100%; text-align: center; color: white; ">
          <h3 style="margin-top: -5px; padding-top: 10px;"> <?php echo $_SESSION['username'] ?> </h3>
        </div>
            <div class="msg">
            <?php
              while ($row=mysqli_fetch_assoc($res))
              {
                if($row['sender']=='member')
                {
            ?>
              <!-------member---------------->
              <br><div class="chat user">
                <div style="float: left; padding-top: 5px;">
                  &nbsp
                  <img style="height: 40px; width: 40px; border-radius: 50%;" src="image/user-icon-vector-png-6.png">&nbsp
                </div>
                <div style="float: left;" class="chatbox">
                  <?php
                    echo $row['message'];
                  ?>
                </div>
              </div>

          <?php
            }
            else
            {
          ?>
              <!-------admin---------------->

              <br><div class="chat admin">
                <div style="float: left; padding-top: 5px;">
                  &nbsp
                  <?php
                  echo "<img class='img-circle profile_img' height=40 width=40 src='image/".$_SESSION['pic']."'>";
                  ?>
                  
                  &nbsp
                </div>
                <div style="float: left;" class="chatbox">
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
          <div style="height: 50px; padding-top: 10px;" >
          <form action="" method="post">
            <input type="text" name="message" class="form-control" required="" placeholder="Write Message..." style="float: left"> &nbsp&nbsp
            <button class="btn btn-info btn-lg" type="submit" name="submit1"><span class="glyphicon glyphicon-send "></span>&nbsp Send</button>
          </form>
          </div>

        <?php

      }
     }
    ?>
  </div>
</div>

<script>
  var table = document.getElementById('table'),eIndex;
  for(var i=0; i< table.rows.length; i++)
  {
    table.rows[i].onclick =function()
    {
      rIndex = this.rowIndex;
      document.getElementById("uname").value = this.cells[1].innerHTML;
    }
  }
</script>
</body>
</html>