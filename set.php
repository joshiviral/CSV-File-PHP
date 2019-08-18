<?php
session_start();
$user=$_POST['username'];
$pd=$_POST['pwd'];
if(isset($_POST['submit']))
{
	if($user=="admin" && $pd=="admin")
	{
	$url="set_home.php";
	echo "<script>location.href='$url'</script>";	
	}
	else
	{	
	echo "Your username is"." ".$user." "."and password is"." ".$pd." ";
	}
}
if(isset($_POST['ck']))
{
setcookie("TestCookie", $value);
echo $_COOKIE["TestCookie"];
setcookie($user, $value, time()+3600); 	
setcookie($pd, $value, time()+3600); 	
/*$url="set_home.php";
echo "<script>location.href='$url'</script>";*/
}
?> 
<!DOCTYPE html>
<html lang="en">
  <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<style>
	form{
		padding:10px;	  
		}  
  </style>
  <body>
  <form id="myform" method="post" action="set.php">
  <div align="center"> 
  Username:<input type="text" id="username"  name="username"><br><br>
  Password:<input type="password" id="pwd" name="pwd"><br><br>
  <input type="submit" name="submit" value="Login">
  
  <input type="submit" name="ck" value="Cookie">
  </div>
  </form>  
  </body>
  </html>