<?php
include_once("head.php"); 
//include_once("logincheck.php");
include_once("dbconfig.php");
require_once 'excel_reader2.php';
?>
 <div class="container">
<h1> Process Upload asr acd report  </h1>

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
 
//start reading from XLS Sheet.. 
$data = new Spreadsheet_Excel_Reader("uploads/asracdreport.xls");
//echo "<pre>";print_r($data); 
 
$numRows = $data->sheets[0]['numRows'];
$uploaded = 0;

$upfilenameData = explode('_',$_SESSION['filename']);
 //print_r($upfilenameData);
$fromDate = $upfilenameData[4];
$toDate = $upfilenameData[9];

$terminationdata = 0;
 
for($i=1;$i<=$numRows;$i++){

	
	$testRowData =  $data->sheets[0]['cells'][$i];
	//echo "<pre>";print_r($testRowData); echo "</pre>"; 
	if(strcmp(trim($testRowData[1]),'Vendor/Connection')==0){
		$terminationdata = 1;
		
	}
	
	if( $terminationdata == 0 ){
			$explodeoriginationData =  $data->sheets[0]['cells'][$i];
			$caller_first = $explodeoriginationData[1];
			$numberofcalls =  $explodeoriginationData[2];
			$billablecalls =  $explodeoriginationData[3];
			$billedduration =  $explodeoriginationData[4];
			$acdms = $explodeoriginationData[5];
			$asr_per = $explodeoriginationData[6];
			$avg_pdd_sec = $explodeoriginationData[7];
			$revenue =  $explodeoriginationData[8];
			 
			//print_r($data->sheets[0]['cells'][$i]);
			echo	$sql = "INSERT INTO  temp_asracd_origination(fromDate ,todate,`caller_first`,`numberofcalls`, `billablecalls`, `billedduration`, `acdms`, `asr_per`, `avg_pdd_sec`, `revenue`) 
			VALUES ('$fromDate' ,'$toDate','$caller_first',$numberofcalls,'$billablecalls', '$billedduration', '$acdms', '$asr_per', '$avg_pdd_sec',$revenue)";
			mysqli_query($_SERVER['con'],$sql);
	}
	else
	{ 
		$explodeterminationData =  $data->sheets[0]['cells'][$i];
		//echo "<pre>";print_r($explodeterminationData); echo "</pre>"; 
		$vendor_connection_first = $explodeterminationData[1];
		$numberofcalls =  $explodeterminationData[2];
		$billablecalls =  $explodeterminationData[3];
		$billedduration =  $explodeterminationData[4];
		$acdms = $explodeterminationData[5];
		$asr_per = $explodeterminationData[6];
		$avg_pdd_sec = $explodeterminationData[7];
		$cost =  $explodeterminationData[8];
		//print_r($data->sheets[0]['cells'][$i]);
		echo	$sql = "INSERT INTO   temp_asracd_termination(fromDate ,todate,`vendor_connection_first`, `numberofcalls`, `billablecalls`, `billedduration`, `acdms`, `asr_per`, `avg_pdd_sec`, `cost`) 
		VALUES ('$fromDate' ,'$toDate','$vendor_connection_first',$numberofcalls,'$billablecalls', '$billedduration', '$acdms', '$asr_per', '$avg_pdd_sec',$cost)";
		mysqli_query($_SERVER['con'],$sql);
	}
}


 

 
	$_SESSION['SuccessMsg'] =  "Your records inserted successfully";
	unlink('uploads/asracdreport.xls');
	header("Location: showimport_asr_acd_data.php");	exit(0);
 
 
?>
