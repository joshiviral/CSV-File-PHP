<?php 
session_start();
$user=$_SESSION['us'];
$pd=$_SESSION['pd'];
$ck=$_COOKIE['TestCookie'];
echo $ck;
if(isset($_POST['sub']))
{
	$url="set.php";
	echo "<script>location.href='$url'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <style>
  form{
	  padding:10px;	  
  }
  </style>
  </head>
  <body>
  <form id="myform" name="myform" action="set_home.php" method="post" >
  <div align="center">
  <p>The Username <?php echo $user; ?> came through Session variable from set.php</p>
  <br>
  <p>Password is <?php echo $pd; ?>came through Session varible from set.php</p>
  <br>
  
  <a href="set_about_us.php">About Us</a>
  <input type="submit" name="sub" value="home">
  </div> 
  </form>  
  </body>
</html>