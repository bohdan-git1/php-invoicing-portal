<?php
session_start();
require_once('head.php');
include_once("headermenu.php");
	
 
if(isset($_GET['action']) && $_GET['action'] == 'deletetermination'){
	$did = $_GET['id'];
	$sqld = "delete from temp_asracd_termination where id=$did";
	mysqli_query($_SERVER['con'],$sqld);
	
}

if(isset($_GET['action']) && $_GET['action'] == 'deleteorigination'){
	$did = $_GET['id'];
	$sqld = "delete from temp_asracd_origination where id=$did";
	mysqli_query($_SERVER['con'],$sqld);
	
}

 

?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">

<div class="container">
<h2> ASR ACD Report  </h2>

<center> <b> Origination</b></center>
<div class="row">
<table  class="table"  border="0" bgcolor="#dbeefc" cellpadding="5">
		  <tr align="center" class="bg_head_payments white font_18">
		    <td> From Date </td>
		    <td> To Date </td>
		    <td width="160">Caller </td>
		    <td width="160">Number of calls </td>
		    <td width="160">Billable Calls </td>
		    <td width="160">Billed Duration min </td>
		    <td width="100">ACD,mm:ss</td>
  		    <td width="100">ASR %</td>
		    <td width="100">Average PDD sec</td>
			<td width="100">Revenue</td>
             
            
        </tr>
 <?php
 	$Condition='';
	if( isset($_POST['wholeseller_id']) )
	{	
		$wholeseller_id = $_POST['c'];
		$Condition = " AND account_id like '$wholeseller_id' ";
	}

 	$sql = "SELECT * from  asracd_origination WHERE 1=1  ";
 	 
  $getTotalTime = 0; 
 $totalchargedamount=0;
 $totalbiledduration =0;
 $result = mysqli_query($_SERVER['con'],$sql);
while($row = mysqli_fetch_object($result)){
	//print_r($row);
	 ?>	
	<tr class="border_bottom_payments">
	<td> <?php echo $row->fromdate;?></td>		
	<td> <?php echo $row->todate;?></td>			
  	<td> <?php echo $row->caller?></td>		
	<td> <?php echo $row->numberofcalls;?></td>			
	<td> <?php echo $row->billablecalls;?></td>
	<td> <?php echo $row->billedduration;?></td>
	<td> <?php echo $row->acdms;?></td>
	<td> <?php echo $row->asr_per;?></td>
	<td> <?php echo $row->avg_pdd_sec;?></td>
	<td> <?php echo $row->revenue;?></td>
	
	
	</tr>
<?php
	}
?>	
 
 </table>
 </div>

 
<center> <b>Termination</b></center> 
<div class="row">
<table  class="table"  border="0" bgcolor="#dbeefc" cellpadding="5">
		  <tr align="center" class="bg_head_payments white font_18">
		  <td> From Date </TD>
			<TD> Todate </td>
		   <td width="160">Vendor/Connection </td>
		    <td width="160">Number of calls </td>
		    <td width="160">Billable Calls </td>
		    <td width="160">Billed Duration min </td>
		    <td width="100">ACD,mm:ss</td>
  		    <td width="100">ASR %</td>
		    <td width="100">Average PDD sec</td>
			<td width="100">Cost</td>
			 
 
        </tr>
 <?php
 	$Condition='';
	if( isset($_POST['wholeseller_id']) )
	{	
		$wholeseller_id = $_POST['c'];
		$Condition = " AND account_id like '$wholeseller_id' ";
	}

 	$sql = "SELECT * from  asracd_termination WHERE 1=1  ";
 	 
  $getTotalTime = 0; 
 $totalchargedamount=0;
 $totalbiledduration =0;
 $result = mysqli_query($_SERVER['con'],$sql);
while($row = mysqli_fetch_object($result)){
	//print_r($row);
	 ?>	
	<tr class="border_bottom_payments">
	<td> <?php echo $row->fromdate;?></td>		
	<td> <?php echo $row->todate;?></td>			
   	<td> <?php echo $row->vendor_connection;?></td>		
	<td> <?php echo $row->numberofcalls;?></td>			
	<td> <?php echo $row->billablecalls;?></td>
	<td> <?php echo $row->billedduration;?></td>
	<td> <?php echo $row->acdms;?></td>
	<td> <?php echo $row->asr_per;?></td>
	<td> <?php echo $row->avg_pdd_sec;?></td>
	<td> <?php echo $row->cost;?></td>
	
	
	</tr>
<?php
	}
?>	
 

 </table>
 </div>

 
