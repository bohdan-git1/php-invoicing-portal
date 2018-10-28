<?php
session_start();
require_once('head.php');

	
function sec2hms($secs) {
    $secs = round($secs);
    $secs = abs($secs);
    $hours = floor($secs / 3600) . ':';
    if ($hours == '0:') $hours = '';
    $minutes = substr('00' . floor(($secs / 60) % 60), -2) . ':';
    $seconds = substr('00' . $secs % 60, -2);
return ltrim($hours . $minutes . $seconds, '0');
}

function converToMMHH($timeStamp){

	    $timeSections = explode(':',$timeStamp);
		$hours =  $timeSections[0];
		$minutes = $timeSections[1];
		$seconds = $timeSections[2];
	
		$totaLMinutes = ($hours * 60) + $minutes;
	  	$resultTimestamp = $totaLMinutes.':'.$seconds;
		return $resultTimestamp;
	
}


function addDurationAsSeconds( $timeStamp ) {
        $timeSections = explode( ':', $timeStamp );
        $seconds =  
                   ( $timeSections[0] * 60 )        //Minutes to Seconds
                 +  ( $timeSections[1]  );           //Seconds to Seconds
 
        return $seconds;
}
	
if(isset($_GET['action']) && $_GET['action'] == 'delete'){
	$did = $_GET['id'];
	$sqld = "delete from tempwsaleinvoicedata where id=$did";
	mysqli_query($_SERVER['con'],$sqld);
	
}
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">

<div class="container">
<h2>Confirm invoice Data </h2>
<div class="row">
<table  class="table"  border="0" bgcolor="#dbeefc" cellpadding="5">
		  <tr align="center" class="bg_head_payments white font_18">
		   <td width="160">customerName </td>
		    <td width="160">Prefix </td>
		    <td width="160">country </td>
		    <td width="160">Description </td>
		    <td width="100">price_per_1_min</td>
  		    <td width="100">Duration min</td>
		    <td width="100">Charged Amount</td>
            <td width="200">from Date </td>
            <td width="100">to Date</td>
        </tr>
 <?php
 	$Condition='';
	if( isset($_POST['wholeseller_id']) )
	{	
		$wholeseller_id = $_POST['c'];
		$Condition = " AND account_id like '$wholeseller_id' ";
	}

 	$sql = "SELECT * from tempwsaleinvoicedata WHERE 1= 1  ";
 	 
  $getTotalTime = 0; 
 $totalchargedamount=0;
 $totalbiledduration =0;
 $result = mysqli_query($_SERVER['con'],$sql);
while($row = mysqli_fetch_object($result)){
	//print_r($row);
	 ?>	
	<tr class="border_bottom_payments">
  	<td> <?php echo $row->CustomerName;?></td>		
	<td> <?php echo $row->prefix;?></td>			
	<td> <?php echo $row->country;?></td>
	<td> <?php echo $row->Description;?></td>
	<td> <?php echo $row->price_per_1_min;?></td>
	<td> <?php echo $row->Duration_min;?></td>
	<td> <?php echo $row->Charged_Amount;?></td>
	<td> <?php echo $row->fromdate;?></td>
	<td> <?php echo $row->todate;?></td>
	<td> <a href="<?php echo 'showimportinvoicesdata.php?action=delete&id='.$row->id;?>"> Delete </a> </td>
	
	</tr>
<?php
	$getTotalTime +=  addDurationAsSeconds($row->Duration_min);
	$totalchargedamount = $totalchargedamount + $row->Charged_Amount;
	}
	
	  $seconds  = gmdate( $getTotalTime );
	//$totalbiledduration = sec2hms($seconds);
	$totalbiledduration = converToMMHH(sec2hms($seconds));



?>	
 <tr> <td colspan='10'>  Billed Duration mm:ss <?php echo $totalbiledduration;?>  &nbsp; charged Amount : <?php echo $totalchargedamount; ?> </td> </tr>

 <tr> <td colspan='10'> <a href="generateinvoice.php">Generate Invoice </a> </td> </tr>
 

 </table>
 </div>
