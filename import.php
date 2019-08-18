<?php
$db=mysqli_connect('68.178.217.40','pwocsurmonques','Rapt#19win515','pwocsurmonques');
$file_data = fopen($_FILES['csv_file']['tmp_name'], 'r');
if(!empty($_FILES['csv_file']['tmp_name']))
{
 $file_data = fopen($_FILES['csv_file']['tmp_name'], 'r');
//print_r($_FILES['csv_file']);
 fgetcsv($file_data);
 while($row = fgetcsv($file_data))
 {
  $data[] = array(
   'firstname'=> $row[0],
   'lastname' => $row[1],
   'emailid'  => $row[2],
   'phonenumber' => $row[3]
  );
 }	
	echo json_encode($data);   
	$fl= mysql_real_escape_string(file_get_contents($_FILES['csv_file']['tmp_name']));
	echo $fl;
}
 
?>