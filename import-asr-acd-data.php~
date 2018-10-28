<?php
session_start();
require_once('head.php');
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
    jQuery(document).ready(function () {

     $( "#from_date").datepicker({
      showOn: "button",
      buttonImage: "images/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select assign date",
      dateFormat: "yy-m-d"

    });
		
    $( "#to_date" ).datepicker({
      showOn: "button",
      buttonImage: "images/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select assign date",
      dateFormat: "yy-m-d"

    });

});

</script> 
<?php
//require_once('xmlrpc.inc');
include_once("headermenu.php");
  
 

//require_once('header_logged_in.php');
 ?>
  
 <div class="container">

<h1>Import ASR ACD Report data </h1>


<form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<div class="row">

 

  
  

<div class="form-group">
<label>From Date</label> 
<input type="text" id="from_date"   name="from_date"  value="<?php echo $_POST['from_date'];?>" placeholder="Please select from  date"  required  /> 
</div>


<div class="form-group">
<label>To Date</label> 
<input type="text" id="to_date" name="to_date"  value="<?php echo $_POST['to_date'];?>" placeholder="Please select to  date" required  /> 
</div>

 
 
</div>

<div class="form-group">
Origination data:
<textarea name="originationdata" class="form-control" rows='15' required> </textarea>
</div>

<div class="form-group">
Termination data
<textarea name="terminationdata" class="form-control" rows='15' required> </textarea>
</div>


<div class="form-group">
	<button type="submit" name="submit" value="submit" class="btn btn-info">Submit</button>
 </div>
 

</form>

<div class="row">
&nbsp;
</div>


<?php
 //print_r($_POST);
// print_r($_FILES);
$Condition  = '';
if(isset($_POST['submit'])){
	
	
	if( isset($_POST['from_date']) && strlen($_POST['from_date'])>0 )
	{	
		$fromDate = $_POST['from_date'];
		$Condition  = $Condition." AND date(fromdate) = '$fromDate' ";
	}

	if( isset($_POST['to_date']) && strlen($_POST['to_date'])>0 )
	{	
		$todate = $_POST['to_date'];
		$Condition  = $Condition." AND date(todate) = '$todate' ";
	}

 		
	
	$originationData = ltrim($_POST['originationdata']);
	$originationData = preg_replace("/\n/", "|", $originationData);
	 echo "<pre>";print_r($originationData);echo "</pre>";
	$originationChildData = explode("|",$originationData);
	 echo "<pre>";print_r($originationChildData);echo "</pre>";
	
	
	for($k=0;$k<=count($originationChildData);$k++){
	
		$explodeoriginationData = preg_split('/[\s]+/', $originationChildData[$k]);
	
	echo "<pre>";print_r($explodeoriginationData); echo "</pre>"; 


		 $caller_first = $explodeoriginationData[0];
		 $caller_second = $explodeoriginationData[1];
		 $numberofcalls =  $explodeoriginationData[2];
		 $billablecalls =  $explodeoriginationData[3];
		 $billedduration =  $explodeoriginationData[4];
		 $acdms = $explodeoriginationData[5];
		 $asr_per = $explodeoriginationData[6];
		 $avg_pdd_sec = $explodeoriginationData[7];
		 $revenue =  $explodeoriginationData[8];
		 

//print_r($data->sheets[0]['cells'][$i]);
			 	
	echo	$sql = "INSERT INTO  temp_asracd_origination(fromDate ,todate,`caller_first`, `caller_second`,  `numberofcalls`, `billablecalls`, `billedduration`, `acdms`, `asr_per`, `avg_pdd_sec`, `revenue`) 
				  VALUES ('$fromDate' ,'$todate','$caller_first','$caller_second',$numberofcalls,'$billablecalls', '$billedduration', '$acdms', '$asr_per', '$avg_pdd_sec',$revenue)";
	 
	
	//echo "<br>".$sql;

	mysqli_query($_SERVER['con'],$sql);

 

}












	
	$terminationData = ltrim($_POST['terminationdata']);
	$terminationData  = preg_replace("/\n/", "|", $terminationData);
	 echo "<pre>";print_r($terminationData);echo "</pre>";
	$terminationChildData = explode("|",$terminationData);
	 echo "<pre>";print_r($terminationChildData);echo "</pre>";
	
	
	for($k=0;$k<=count($terminationChildData);$k++){
	
		$explodeterminationData = preg_split('/[\s]+/', $terminationChildData[$k]);
	
	echo "<pre>";print_r($explodeterminationData); echo "</pre>"; 


		 $vendor_connection_first = $explodeterminationData[0];
		 $vendor_connection_second = $explodeterminationData[1];
		 $vendor_connection_third = $explodeterminationData[2];
		 $numberofcalls =  $explodeterminationData[3];
		 $billablecalls =  $explodeterminationData[4];
		 $billedduration =  $explodeterminationData[5];
		 $acdms = $explodeterminationData[6];
		 $asr_per = $explodeterminationData[7];
		 $avg_pdd_sec = $explodeterminationData[8];
		 $cost =  $explodeterminationData[9];
		 

//print_r($data->sheets[0]['cells'][$i]);
			 	
	echo	$sql = "INSERT INTO   temp_asracd_termination(fromDate ,todate,`vendor_connection_first`,`vendor_connection_second`,`vendor_connection_third`,   `numberofcalls`, `billablecalls`, `billedduration`, `acdms`, `asr_per`, `avg_pdd_sec`, `cost`) 
				  VALUES ('$fromDate' ,'$todate','$vendor_connection_first','$vendor_connection_second','$vendor_connection_third',$numberofcalls,'$billablecalls', '$billedduration', '$acdms', '$asr_per', '$avg_pdd_sec',$cost)";
	 
	
	//echo "<br>".$sql;

	mysqli_query($_SERVER['con'],$sql);

 

}
	header("Location: showimport_asr_acd_data.php");	exit(0);
}



	
?>


</div>
</div>
