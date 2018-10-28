<?php
include_once("head.php"); 
include_once("headermenu.php"); 
//include_once("logincheck.php");
 
 

if(isset($_GET['action']) && $_GET['action']=='delete'){
//print_r($_GET);
	$id = $_GET['id'];
	  $sqldelete = "DELETE from bankaccountdetails where id=$id";
	mysqli_query($_SERVER['con'],$sqldelete); 
	header("Location:managebankaccount.php");
	exit(0);
}


if(isset($_GET['action']) && $_GET['action']=='edit'){

 	$id = $_GET['id'];
 	$lastInserId = $_GET['id'];
	$sqlnew = "SELECT * FROM bankaccountdetails where id=$lastInserId";
	$newrec = mysqli_query($_SERVER['con'],$sqlnew);
	$rownew = mysqli_fetch_object($newrec);

 	$_POST['bankname']  = $rownew->bankname;
	$_POST['swiftcode']  = $rownew->swiftcode;
	$_POST['routingcode']  = $rownew->routingcode;
	$_POST['MashreqBankID']  = $rownew->MashreqBankID;


	$_POST['accounttitle']  = $rownew->accounttitle;
	$_POST['AccountNumber']  = $rownew->AccountNumber;
	$_POST['AccountIBAN']  = $rownew->AccountIBAN;
 
}
	 
	 
	
?>
<link href="css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="js/bootstrap-toggle.min.js"></script>
 
<script type="text/javascript" src="jquery.timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.timepicker.css" />
 
<script>
function checkdelte(id){
//alert(id);
 
if (confirm('Are you sure you want to Remove ?')) {
    window.location.href = "managebankaccount.php?action=delete&id="+id;
    // Save it!
} 

}
</script>
  
<div class="container">

<?php
$sql = "SELECT * FROM bankaccountdetails";  
$rs_result = mysqli_query($_SERVER['con'],$sql);  
?>  

<table class="table table-bordered table-striped" border="1">  
<thead>  
<tr>   
<th>S.No</th>
<th>Account number</th>
<th>Bank name </th>
<th> &nbsp;</th>
<th> &nbsp;</th>
</tr>   
<thead>  
<tbody>  
<?php  
$k=1;
while ($row = mysqli_fetch_object($rs_result)) {  
?>  
<tr>
<td><?php echo $k;?></td>
<td><?php echo $row->AccountNumber;?></td>
<td><?php echo $row->bankname;?></td>
<td> <a href="<?php echo 'managebankaccount.php?action=edit&id='.$row->id;?>"> Edit </a> </td>

<td style="text-align:center">  &nbsp; &nbsp; <image src="remove.png" width="20" height="20" title="Delete" onclick="checkdelte(<?php echo $row->id;?>)"/> </td>
</tr>
 
<?php
$k = $k + 1;
}
?>  
</tbody>  
</table> 

	  
 
 
       <form method="post"  role="form"   action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" >
 
  <div class="panel-group">
 
    <div class="panel panel-primary">
      <div class="panel-heading">Bank account information  </div>
      <div class="panel-body">


		<div class="row">
		

      		     <label>      Bank Name  </label>   
					<input name="bankname" value="<?php echo $_POST['bankname'];?>"  class="form-control"   type="text"   placeholder="Enter  Bank Name"  required> 
	      </div>

<div class="row">
		

      		     <label>      SWIFT code(BIC code)  </label>   
					<input name="swiftcode"   value="<?php echo $_POST['swiftcode'];?>"  class="form-control"   type="text"   placeholder="Enter swift code"  required> 
	      </div>



<div class="row">
		

      		     <label>     Mashreq Bank ID  </label>   
					<input name="MashreqBankID"   value="<?php echo $_POST['MashreqBankID'];?>"  class="form-control"   type="text"   placeholder="Enter  Mashreq Bank ID"  required> 
	      </div>



<div class="row">
		

      		     <label>     Routing Code </label>   
					<input name="routingcode"   value="<?php echo $_POST['routingcode'];?>"  class="form-control"   type="text"   placeholder="Enter Routing Code"  required> 
	      </div>



<div class="row">
		

      		     <label>       Account Title </label>   
					<input name="accounttitle"   value="<?php echo $_POST['accounttitle'];?>"  class="form-control"   type="text"   placeholder="Enter  Account Title"  required> 
	      </div>



<div class="row">
		

      		     <label>    Account Number </label>   
					<input name="AccountNumber"   value="<?php echo $_POST['AccountNumber'];?>"  class="form-control"   type="text"   placeholder="Enter  Account Number"  required> 
	      </div>


<div class="row">
		

      		     <label>       Account IBAN </label>   
					<input name=" AccountIBAN"   value="<?php echo $_POST['AccountIBAN'];?>"   class="form-control"   type="text"   placeholder="Enter  Account IBAN"  required> 
	      </div>
<div class="row">
		

      		   
			
			<div class="row">
		 		<input type="hidden" name="id" value="<?php echo $lastInserId ;?> " />
				<button type="submit" name="submit" class="btn btn-primary">Save</button>
			</div>				
			  
	 </div> </div> <!-- panel close -->
 </div>

 </form>


<?php
 
   

function savedb(){


 // echo "<pre>";	print_r($_POST);


	 $bankname  = mysqli_escape_string( $_SERVER['con'],$_POST['bankname']);
$swiftcode  = mysqli_escape_string( $_SERVER['con'],$_POST['swiftcode']);
$MashreqBankID	  = mysqli_escape_string( $_SERVER['con'],$_POST['MashreqBankID']);
$routingcode  = mysqli_escape_string( $_SERVER['con'],$_POST['routingcode']);
$accounttitle	  = mysqli_escape_string( $_SERVER['con'],$_POST['accounttitle']);
$AccountNumber  = mysqli_escape_string( $_SERVER['con'],$_POST['AccountNumber']);
$AccountIBAN  = mysqli_escape_string( $_SERVER['con'],$_POST['AccountIBAN']);  
	

	 $lastInserId = $_POST['id'];
if( $lastInserId>0)
 	$sqlupdt =  "UPDATE `sippydatabase`.`bankaccountdetails` SET `bankname` = '$bankname', `swiftcode` = '$swiftcode', `MashreqBankID` = '$MashreqBankID', `routingcode` = '$routingcode', `accounttitle` = '$accounttitle', `AccountNumber` = '$AccountNumber', `AccountIBAN` = '$AccountIBAN'  WHERE `bankaccountdetails`.`id` = $lastInserId ";
else
   $sqlupdt =  "INSERT INTO bankaccountdetails (bankname,swiftcode,MashreqBankID,routingcode,accounttitle,AccountNumber,AccountIBAN) VALUES ('$bankname', '$swiftcode','$MashreqBankID','$routingcode','$accounttitle','$AccountNumber','$AccountIBAN')";

		mysqli_query($_SERVER['con'],$sqlupdt); 
		sleep(5);
	 	mysqli_close($_SERVER['con']);
	 	header("Location:managebankaccount.php");
	 	exit(0);
	
  
}
if(isset($_POST['submit']))
	savedb();

?>


</div>



<?php
mysqli_close($_SERVER['con']);
?> 
<body>
<html>
