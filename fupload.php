<?php 
session_start();
$db=mysqli_connect('68.178.217.40','pwocsurmonques','Rapt#19win515','pwocsurmonques');
/*echo $handle;
//$handle= $_FILES['file']['tmp_name'];
if(isset($_POST['cf']))
{
	
	if(is_uploaded_file($handle))
		{
			echo "hello...";
			$file = fopen($handle);				
			fgetcsv($file);
			while(($data = fgetcsv($file))!==FALSE)
			{	
				$item1 = mysqli_real_escape_string($db,$data[0]);
				$item2 = mysqli_real_escape_string($db,$data[1]);
				$item3 = mysqli_real_escape_string($db,$data[2]);
				$item4 = mysqli_real_escape_string($db,$data[3]);				
				$sql="INSERT INTO tbl_excel(firstname,lastname,eid,number) VALUES('$item1','$item2','$item3','$item4')";
				mysqli_query($db,$sql) or die (mysqli_error($db));				
			}fclose($file);	
			echo "Imported..";		
		}
}*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/dob_table.css">
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
  $("#open").click(function(){
    $("div").toggle();
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
<form id="upload_csv" name="myform" method="POST" enctype='multipart/form-data'  action="<?php echo $_SERVER["PHP_SELF"]; ?>" onSubmit="getPath();">
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
			if($_FILES['file']['name'])
			{				
			$fn= explode('.',$_FILES['file']['name']);				
			if($fn[1]=='csv')
			{	
				$handle = fopen($_FILES['file']['tmp_name'],"r");				
				$_SESSION['file']=$_FILES['file']['name'];				 				
				$fl=$_FILES['file']['name'];				 				
				//$first_column_read=array_map(str_getcsv,file($_FILES['file']['name'],"r"));				 				
				//$header = array_shift($first_column_read);
				while($data = fgetcsv($handle))
				{						
				?>
					<tr>
						<?php 							
							if($data>=$data[3])
							{								
							if(filter_var($data[0],FILTER_VALIDATE_INT) === false ) 
							{
								echo "<h3><font color='#ff6666'>1st column is not ID</font></h3>";
							?>
							<td class="emsg"><?php echo $data[0]; ?></td>
							<td><?php echo $data[1]; ?></td>
							<td><?php echo $data[2]; ?></td>
							<td><?php echo $data[3]; ?></td>
							<td><?php echo $data[4]; ?></td>
							<td><?php echo $data[5]; ?></td>
							<td><?php echo $data[6]; ?></td>																														
							<?php 								
							}							
							else
							{							
							?>
							<td class="emsg"><?php echo $data[0]; ?></td>
							<td class="emsg"><?php echo $data[1]; ?></td>
							<td class="emsg"><?php echo $data[2]; ?></td>
							<td class="emsg"><?php echo $data[3]; ?></td>
							<?php														
							}									
							}?>
							<td><?php echo $data[4]; ?></td>
							<td><?php echo $data[5]; ?></td>
							<td><?php echo $data[6]; ?></td>								
				<?php
				}
				echo "<h4><font color='Tomato'>4 Columns are only allowed</font></h4>";
				exit;
			}
			}			
			?>										
			</tr>			
			<div id="records"><p><?php echo "Total Records found on the sheet is ".$cnt; ?> </p></div>
			</thead>
			</table>			
			</div>
			<br>	
</form>
<div align="center"> 
<form method="post" action="csv.php">	
    <input type="submit" value="Save">
	</div>
</form>
<br>
</body>
</html>