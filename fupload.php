<?php 
session_start(); 
//It will get the file which was uploaded on the server directory
$op=$_SESSION['f'];
$db=mysqli_connect('68.178.217.40','pwocsurmonques','Rapt#19win515','pwocsurmonques');
if(isset($_POST['btn']))
{	
	$counter=$_SESSION['a']; 
	$fg=$_SESSION['b']; 		
	//if the counter value is imcremented then it will throw error
	if(!empty($counter))
	{
	echo "<br>"."<h4 align='center' style='color:#FF0000'><p>You must have First Column to be Number of the uploaded file:</p></h4>";	
	unlink($op);	
	}
	//else if again the flag value is imcremented then it will throw error
	else if(!empty($fg))
	{
	echo "<br>"."<h4 align='center' style='color:#FF0000'><p>You must have no more than 4 Columns of the uploaded file:</p></h4>";
	unlink($op);	
	}
	//if counter or flag value is 0 then insert into the database
	else
	{	
	$file = fopen($op,'r');		
	while(($da = fgetcsv($file))!==FALSE)
	{					
				$item1 = mysqli_real_escape_string($db,$da[0]);
				$item2 = mysqli_real_escape_string($db,$da[1]);
				$item3 = mysqli_real_escape_string($db,$da[2]);
				$item4 = mysqli_real_escape_string($db,$da[3]);				
				$sql="INSERT INTO tbl_excel(firstname,lastname,email,number) VALUES('$item1','$item2','$item3','$item4')";
				mysqli_query($db,$sql);				
	}			
	fclose($file);
	echo "<h2 align='center' style='color:#228B22'><p>Stored...!</p></h2>";	
	// delete file
	unlink($op); 
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/dob_table.css">  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="ddtf.js"></script> 
  <script type="text/javascript"> 
	function myFunction() {
	var input, filter, table, tr, td, i;
	input = document.getElementById("mylist");
	filter = input.value.toUpperCase();
	table = document.getElementById("myTable");
	tr = table.getElementsByTagName("tr");
	for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}  
  </script>
  <style>
				#data-table + #tb   {
                border: 1px solid black;
				padding: 15px;
				width:100%;
            }
			table,tr,td{
				border: 1px solid black;
				padding: 15px;
			}
			td.emsg
			{
				color:#ff6666;
			}
			th{text-align: center;padding:10px;}
.button {
  background-color: #E63F0D;
  border: none;
  color: white;
  padding: 10px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 15px;
  margin: 4px 2px;
  cursor: pointer;
}
select
{
	padding:10px;
	
}			
  </style>		
</head>
<body>
<div align="center"><h4><p>Please note that only CSV and XLSX formate is allowed..!</p></h4></div>
<form id="upload_csv" name="myform" method="POST" enctype='multipart/form-data'>
	
	<div align="center" style="padding:10px;">		
	<table cellspacing="1" cellpadding="3" >
	<tr><th><input type="file" name="file" id="file" size="60"></th></tr>	
	<tr align="center"><td><input type="submit" id="open" class="button"></td></tr>		
	</table>	
	</div>	
	
	<br>
	<br>
	
	<div align="center">
	<table cellspacing="1" cellpadding="3">
	<tr>	
	<td>	
	<select name="cl1" onchange="myFunction()">
		<option value="id">Number</option>
		<option value="FirstName">First Name</option>
		<option value="LastName" selected>LastName</option>
		<option value="emailid">EmailId</option>
		<option value="phonenumber">Contact</option>
	</select>	
	</td>
	
	<td>	
	<select name="cl2">
		<option value="id">Number</option>
		<option value="FirstName">First Name</option>
		<option value="LastName" selected>LastName</option>
		<option value="emailid">EmailId</option>
		<option value="phonenumber">Contact</option>
	</select>	
	</td>
	
	<td>	
	<select name="cl3">
		<option value="id">Number</option>
		<option value="FirstName">First Name</option>
		<option value="LastName" selected>LastName</option>
		<option value="emailid">EmailId</option>
		<option value="phonenumber">Contact</option>
	</select>	
	</td>
	
	<td>	
	<select name="cl4">
		<option value="id">Number</option>
		<option value="FirstName">First Name</option>
		<option value="LastName" selected>LastName</option>
		<option value="emailid">EmailId</option>
		<option value="phonenumber">Contact</option>
	</select>	
	</td>
		
	
	</tr>
	</table>
	</div>
	<div align="center" style="overflow-x:auto;">
	<table border="1" cellspacing="1" cellpadding="3" id="data-table" align="center">
	<tbody id="tb">
	<thead>
	
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email ID</th>
			<th>Phone Number</th>							
		</tr>
</thead>		
			<?php 
			define('MB', 1048576);
			$cnt = 0;
			$flag=0;
			$tmp=0;	
			$path="../fupload/";
			$open=$_FILES['file']['name'];
			$size=$_FILES['file']['size'];
			move_uploaded_file($_FILES['file']['tmp_name'],$path.$open);
			$store = $path.$open;
			$_SESSION['f']=$store;
			if($size >= 5*MB)
			{							
				echo "<h4 align='center' style='color:#FF0000'>File too large. File must be less than 5 megabytes.</h4> ";
			}
			else
			{	
				if($open)
				{
				$fn= explode('.',$open);
				if($fn[1]=='csv')
				{	
				$handle = fopen($open,"r");					
				//$fl=$_FILES['file']['name'];				 				
				//$first_column_read=array_map(str_getcsv,file($_FILES['file']['name'],"r"));				 				
				//$header = array_shift($first_column_read);
				$found = false;
				while($data = fgetcsv($handle))
				{
				$tmp++;
				$is_empty = false;
								
				?>
				<tr>
						<?php 							
							if(filter_var($data[0],FILTER_VALIDATE_INT) === false ) 
							{
							$cnt++;
							?>
							<td class="emsg"><?php echo $data[0]; ?></td>													
							<?php							
							}						
							else
							{								
							?>
							<td><?php echo $data[0];?></td>														
							<?php								
							}?>							
							<td><?php echo $data[1]; ?></td>
							<td><?php echo $data[2]; ?></td>
							<td><?php echo $data[3]; ?></td>
							<?php	
							if($data>=$data[4])
							{
								if(empty($data[4]))
								{
									continue;
									$data++;	
								}
								else
								{
								$flag++;
								?>
								<td class="emsg"><?php echo $data[4];?></td>
								<td class="emsg"><?php echo $data[5];?></td>
								<td class="emsg"><?php echo $data[6];?></td>
								<?php										
								}							
							}
							else
							{
								break;
							}							
				}				
			$_SESSION['a']=$cnt;
			$_SESSION['b']=$flag;			
			}
			else
			{
				echo "<h4 align='center' style='color:#FF0000'>Please check the formate..!</h4>";
				unlink($open);
				exit;
			}	
			}					
			else
			{
				echo "<h4 align='center' style='color:#FF0000'>Please Upload the File..</h4>";				
			}
			}
			
			
			if(!empty($cnt))
			{
			echo "<h4 align='center' style='color:#FF0000'><p>Error-1:First Column must be always Number..</p></h4>";						
			}			
			
			if(!empty($flag))
			{
			echo "<h4 align='center' style='color:#FF0000'><p>Error-2:First 4 Columns are only allowed..</p></h4>";			
			}			
			?>										
			</tr>						
			<div id="records">
			<h4>
			<p style="color:#228B22;"><?php echo "Total Records found on the sheet is ".$tmp; ?>
			</p>
			</h4>
			</div>			
			</tbody>
			</table>			
			</div>
			<br>				
</form>
<div align="center" id="save" name="save"> 
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">	
<input type="submit" name="btn" value="Save" class="button" >
</div>
</form>
<br>
</body>
</html>