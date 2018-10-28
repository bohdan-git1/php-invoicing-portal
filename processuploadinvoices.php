<?php
include_once("head.php"); 
//include_once("logincheck.php");
include_once("dbconfig.php");
require_once 'excel_reader2.php';
?>
 <div class="container">
<h1> Process Upload Invoices  </h1>

<div class="row">
<?php
 if(isset($_SESSION['SuccessMsg'])){
?>
<div class="alert alert-success">
  <strong><?php echo $_SESSION['SuccessMsg']; ?> !</strong> 
</div>
<?php 
unset($_SESSION['SuccessMsg']);
}
?>
</div>



<div class="row">

<p> <a href="index.php"> Back to home Page </a> </p>
  
<?php
  

//$reseller_id = $_POST['reseller_id'];

$oldVouchersList = array();
$sql = "SELECT distinct voucher_id from mastervouchers where voucher_status=0 ";
$result = mysqli_query($_SERVER['con'],$sql);
while($row = mysqli_fetch_object($result)){
$oldVouchersList[] = $row->voucher_id;
}
//echo "<pre>";print_r($oldVouchersList); 


//start reading from XLS Sheet.. 
$data = new Spreadsheet_Excel_Reader("uploads/invoices.xls");
//echo "<pre>";print_r($data); 
 
$numRows = $data->sheets[0]['numRows'];
$uploaded = 0;

$upfilenameData = explode('_',$_SESSION['filename']);
//print_r($upfilenameData);
$fromDate = $upfilenameData[3];
$toDate = $upfilenameData[8];


for($i=1;$i<=$numRows;$i++){

	$uploaded = 1;
	$row =  $data->sheets[0]['cells'][$i];
//echo "<pre>"; print_r($row); echo "</pre>";
	$id = $row[2];
	 
	 $customerName = $row[1];
	 $accountData = explode('.',$customerName);
	//print_r($accountData);		
	 $account_id = 	$accountData[1];
	 $prefix  = $row[2];
	 $country = $row[3];
	 $Description = $row[4];
	 $price_per_1_min =  $row[5];
	 $price_per_n_min =   $row[6];
	 $numberofCalls =  $row[7];
	 $Duration_min =  $row[8];
	 $BilledDuration_min =  $row[9];
	 $Charged_Amount =  $row[10];

//print_r($data->sheets[0]['cells'][$i]);
	 
	  	$sql = "INSERT INTO wholesaleinvoicebasedata(customerName ,`account_id`, `prefix`, `country`, `Description`, `price_per_1_min`, `price_per_n_min`, `numberofCalls`, `Duration_min`, `BilledDuration_min`, `Charged_Amount`,fromDate,toDate) 
		  VALUES ('$customerName','$account_id', '$prefix', '$country', '$Description', '$price_per_1_min','$price_per_n_min','$numberofCalls', '$Duration_min', '$BilledDuration_min', '$Charged_Amount','$fromDate','$toDate')";
	 
	
	//echo "<br>".$sql;

	mysqli_query($_SERVER['con'],$sql);

 
}

 if ( $uploaded == 1){
	$_SESSION['SuccessMsg'] =  "Your records inserted successfully";
	  unlink('uploads/invoices.xls');
	  header("Location: invoicehistory.php");	exit(0);
 }

 
?>
