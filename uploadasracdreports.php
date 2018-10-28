<?php
include_once("head.php"); 
//include_once("logincheck.php");
include_once("dbconfig.php");
session_start();
?>
 <div class="container">
<h1>   Upload ASR ACD Reports  </h1>


 <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

 <div class="row">
  
 
  <div class="form-group">

  <label> Please select File to upload :</label> 
  
   
	<input type="file" name="asracdrepo" />
	</div>
	
 <div class="form-group">
	<button type="submit" name="submit" value="submit" class="btn btn-info">Submit</button>
 </div>
 
 </div>
 
</form>

<p> <a href="dashboard.php"> Back to home Page </a> </p>
 </div>
<?php


 //print_r($_POST);
// print_r($_FILES);
if(isset($_POST['submit'])){

	$target_dir = "uploads/";
	$target_file = "asracdreport.xls";
	$target_file = $target_dir .$target_file;
	//$target_file = $target_dir . basename($_FILES["vouchers"]["name"]);
	$uploadOk = 1;
 
	// Check if image file is a actual image or fake image
       if(isset($_POST["submit"]) &&  $_FILES["asracdrepo"]["error"]!=4 ) {
        $uploadOk = 1;  

	    if (@move_uploaded_file($_FILES["asracdrepo"]["tmp_name"], $target_file)) 
        	echo "The file ". basename( $_FILES["asracdrepo"]["name"]). " has been uploaded.";
    	  
		$_SESSION['SuccessMsg'] =  basename( $_FILES["asracdrepo"]["name"]). " has been uploaded.";
		$_SESSION['filename'] = $_FILES["asracdrepo"]["name"];

		header("Location: processuploadasracdreport.php");	exit(0);


       }else
	{
		echo "File has not uploaded due to internal errors";
	}
  
 
 
 }

//echo $sqlupdt;

?>

<?php include_once("footer.php"); ?>
	
