<?php
session_start();
$handle = $_SESSION['file'];
echo $handle;
$db=mysqli_connect('68.178.217.40','pwocsurmonques','Rapt#19win515','pwocsurmonques');
//$handle= $_FILES['file']['tmp_name'];
$file = fopen($handle,'r');				
fgetcsv($file);
while(($data = fgetcsv($file))!==FALSE)
{					
				
				$item1 = mysqli_real_escape_string($db,$data[0]);
				$item2 = mysqli_real_escape_string($db,$data[1]);
				$item3 = mysqli_real_escape_string($db,$data[2]);
				$item4 = mysqli_real_escape_string($db,$data[3]);				
				$sql="INSERT INTO tbl_excel(firstname,lastname,eid,number) VALUES('$item1','$item2','$item3','$item4')";
				mysqli_query($db,$sql) or die (mysqli_error($db));				
				}			
fclose($file);
$url="fupload.php";
	echo "<script>location.href='$url'</script>";
?>