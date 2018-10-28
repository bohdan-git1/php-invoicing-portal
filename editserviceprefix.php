<?php
include_once("head.php"); 
include_once("headermenu.php");
 

if(isset($_GET['action']) && $_GET['action']=='delete'){
//print_r($_GET);
	$id = $_GET['id'];
	$sqldelete = "DELETE from serviceprefixmaster where id=$id";
	mysqli_query($_SERVER['con'],$sqldelete); 
	header("Location:serviceprefixmasterlist.php");
	exit(0);
}


	$id = $_GET['id'];
 	$lastInserId = $_GET['id'];
	$sqlnew = "SELECT * FROM serviceprefixmaster where id=$lastInserId";
	$newrec = mysqli_query($_SERVER['con'],$sqlnew);
	$rownew = mysqli_fetch_object($newrec);

	 	
?>
<link href="css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="js/bootstrap-toggle.min.js"></script>
 
<script type="text/javascript" src="jquery.timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.timepicker.css" />
 
  
<div class="container">
 
       <form method="post"  role="form"   action="<?php echo $_SERVER['PHP_SELF']."?action=edit&id=$lastInserId"; ?>" enctype="multipart/form-data" >
 
  <div class="panel-group">
 
    <div class="panel panel-primary">
      <div class="panel-heading">Service Prefix information  </div>
      <div class="panel-body">

	  
 

		<div class="row">
		

      		     <label>     Prefix  </label>   
					<input name="prefix"  class="form-control"   type="text"   placeholder="Enter prefix"  value="<?php echo $rownew->prefix;?>"   required> 
	      </div>
			<div class="row">
			 <label>     Description  </label>   
				<input name="description"  class="form-control"   type="text"   placeholder="Enter description"  value="<?php echo $rownew->description;?>"  required> 
			</div>
			
			<div class="row">
			<br>
<input type="hidden" name="id" value="<?php echo $lastInserId ;?> " />
				<button type="submit" name="submit" class="btn btn-primary">Save</button>
			</div>				
			  
	 </div> </div> <!-- panel close -->
 </div>

 </form>


<?php
 
   

function savedb(){
/// echo "<pre>";	print_r($_POST);
$lastInserId = $_POST['id'];
	 $company_id = 0; //$_POST['company_id'];
	 $prefix  = mysqli_escape_string($_SERVER['con'], $_POST['prefix']);
	 $description  = mysqli_escape_string($_SERVER['con'],$_POST['description']);
	
  
       $sqlupdt =  "Update serviceprefixmaster set  `prefix`='$prefix', `description` = '$description'  Where id = $lastInserId ";

		 mysqli_query($_SERVER['con'],$sqlupdt); 
		sleep(5);
	 	mysqli_close($_SERVER['con']);
	 	 header("Location:serviceprefixmasterlist.php");
	 	exit(0);
	
  
}
if(isset($_POST['submit']))
	savedb();

?>


</div>

<body>
<html>
