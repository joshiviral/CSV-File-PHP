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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/dob_table.css">
  <link rel="stylesheet" type="text/css" href="http://ws1.postescanada-canadapost.ca/css/addresscomplete-2.30.min.css?key=be89-uc93-dm18-mu59" />
  <script type="text/javascript" src="http://ws1.postescanada-canadapost.ca/js/addresscomplete-2.30.min.js?key=be89-uc93-dm18-mu59"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
  $("#open").click(function(){
    $("div").show();
	});
	});
  </script>
  <style>
  table,tr,td
            {
                border: 1px solid black;
            }
			td.emsg
			{
				color:#ff6666;
			}			
  </style>		
</head>
<body>
<div align="center"><h4><p>Please note that only CSV and XLSX formate is allowed..!</p></h4></div>
<form id="upload_csv" name="myform" method="POST" enctype='multipart/form-data'>
	<div align="center" style="padding:10px;">
	<input type="file" name="file" id="file" class="ip">
	<br>
	<input type="submit" id="open">		
	</div>	
	<br>	
	<div align="center">
	<table border="1" cellspacing="1" cellpadding="3" id="data-table" align="center">
	<thead>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email ID</th>
			<th>Phone Number</th>			
			<th>C5</th>			
			<th>C6</th>			
			<th>C7</th>			
		</tr>		
			<?php 
			$cnt = 0;
			$flag=0;
			$tmp=0;	
			$path="../fupload/";
			$open=$_FILES['file']['name'];
			move_uploaded_file($_FILES['file']['tmp_name'],$path.$open);
			$store = $path.$open;
			$_SESSION['f']=$store;
			if($open)
			{				
			$fn= explode('.',$open);			
			if($fn[1]=='csv')
			{	
				$handle = fopen($open,"r");					
				//$fl=$_FILES['file']['name'];				 				
				//$first_column_read=array_map(str_getcsv,file($_FILES['file']['name'],"r"));				 				
				//$header = array_shift($first_column_read);
				while($data = fgetcsv($handle))
				{
				$tmp++;					
				?>
				<tr>
						<?php 							
							if(filter_var($data[0],FILTER_VALIDATE_INT) === false ) 
							{
							$cnt++;
							?>
							<td class="emsg"><?php echo $data[0]; ?></td>
							<td><?php echo $data[1]; ?></td>
							<td><?php echo $data[2]; ?></td>
							<td><?php echo $data[3]; ?></td>								
							<?php 																		
							}
							else
							{
							?>
							<td><?php echo $data[0]; ?></td>
							<td><?php echo $data[1]; ?></td>
							<td><?php echo $data[2]; ?></td>
							<td><?php echo $data[3]; ?></td>							
							<?php
							}
							if($data>=$data[3])
							{
							$flag++;
							?>
							<td class="emsg"><?php echo $data[4]; ?></td>
							<td class="emsg"><?php echo $data[5]; ?></td>
							<td class="emsg"><?php echo $data[6]; ?></td>
							<?php
							}
							else
							{
								break;
							}	
				}
			$_SESSION['a']=$cnt;
			$_SESSION['b']=$flag;			
			}
				
			else if($fn[1]=='xlsx')
			{	
				$handle = fopen($open,"r");									
				while($data = fgetcsv($handle))
				{
				$tmp++;					
				?>
				<tr>
						<?php 							
							if(filter_var($data[0],FILTER_VALIDATE_INT) === false ) 
							{
							$cnt++;
							?>
							<td class="emsg"><?php echo $data[0]; ?></td>
							<td><?php echo $data[1]; ?></td>
							<td><?php echo $data[2]; ?></td>
							<td><?php echo $data[3]; ?></td>								
							<?php 												
							}
							else
							{
							?>
							<td><?php echo $data[0]; ?></td>
							<td><?php echo $data[1]; ?></td>
							<td><?php echo $data[2]; ?></td>
							<td><?php echo $data[3]; ?></td>							
							<?php
							}
							if($data>=$data[3])
							{
							$flag++;
							?>
							<td class="emsg"><?php echo $data[4]; ?></td>
							<td class="emsg"><?php echo $data[5]; ?></td>
							<td class="emsg"><?php echo $data[6]; ?></td>
							<?php
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
			</thead>
			</table>			
			</div>
			<br>				
</form>
<div align="center" id="save" name="save"> 
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">	
<input type="submit" name="btn" value="Save" >
</div>
</form>
<br>
</body>
</html>