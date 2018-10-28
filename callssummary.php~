<?php
require_once('xmlrpc.inc');
require_once('head.php');
session_start();
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
require_once('xmlrpc.inc');
require_once('head.php');
session_start();

 function addDurationAsSeconds( $timeStamp ) {
        $timeSections = explode( ':', $timeStamp );
        $seconds =  
                   ( $timeSections[0] * 60 )        //Minutes to Seconds
                 +  ( $timeSections[1]  );           //Seconds to Seconds
 
        return $seconds;
    }
 

function getAccountCDRs($limit, $offset) {
	
	$wholeseller_id = $_GET['wholeseller_id'];
	$fromDate = $_GET['from_date'];
	$todate  = $_GET['to_date'];
	

 	$fromSalesDate = date("D M j Y",strtotime($fromDate));
	$toSalesDate = date("D M j Y",strtotime($todate));
	$endOfData = false;
	
	$params = array(new xmlrpcval(array("i_account"   => new xmlrpcval($wholeseller_id, "int"),
										"limit" 	=> new xmlrpcval('1', "int"),
										"start_date" => new xmlrpcval("00:00:00.000 GMT $fromSalesDate","string"),                 
										"end_date" 	 => new xmlrpcval("23:59:59.000 GMT $toSalesDate","string"),

	
"offset" 	=> new xmlrpcval($offset, "int"),									 
										),'struct'));
	//echo "<pre>"; print_r($params); echo "</pre>";									
	//"start_date" => new xmlrpcval("09:00:29.000 GMT Wed Apr 21 2016","string"),                 
	//"end_date"	=> new xmlrpcval("22:50:50.000 GMT Thu Apr 28 2016","string"),
																				
	    

	$msg = new xmlrpcmsg('getAccountCDRs', $params);
	$cli = new xmlrpc_client($_SERVER['xmlRpcUrl']);
	$cli->setSSLVerifyPeer(false);
	$cli->setSSLVerifyHost(false);
	$cli->setCredentials($_SERVER['xmlUser'],$_SERVER['xmlPass'], CURLAUTH_DIGEST);




	$r = $cli->send($msg, 20);       /* 20 seconds timeout */

	if ($r->faultCode()) {
		$error = $r->faultString();
		return array();
	}
	echo "<pre>"; print_r($r); echo "</pre>";
	$res = $r->value()->structMem('cdrs');
	$res = $res->scalarVal();
	$cdrs= array();
	$i=0;

	foreach( $res as $obj ) {
		
		$prefix = $obj->structMem('prefix');
		$prefix = $prefix->scalarVal();
		
		/*
		$cli = $obj->structMem('cli');
		$cli = $cli->scalarVal();

		$cld = $obj->structMem('cld');
		$cld = $cld->scalarVal();

		$country = $obj->structMem('country');
		$country = $country->scalarVal();

		$connect_time = $obj->structMem('connect_time');
		$connect_time = $connect_time->scalarVal();

		$cost = $obj->structMem('cost');
		$cost = $cost->scalarVal();
		*/

		$billed_duration = $obj->structMem('billed_duration');
		$billed_duration = $billed_duration->scalarVal();

		
		$duration = sprintf("%02d:%02d",ceil($billed_duration/60)-1, fmod($billed_duration,60));
		
		$cdrs[$i]['prefix'] = $prefix ;
		//$cdrs[$i]['cli'] = $cli ;
		$cdrs[$i]['duration'] = $duration;
		/*
		$cdrs[$i]['cld'] = $cld;
		$cdrs[$i]['country'] = $country;
		$cdrs[$i]['connect_time'] = $connect_time;
		$cdrs[$i]['cost'] = sprintf("%01.2f USD",$cost);
		*/

		$i++;
	}
	$_SESION['largeData'][] = $cdrs;	
echo "<pre>"; print_r($cdrs); echo "</pre>";
sleep(5);
	return $cdrs;

}


$cdrs_per_page = 200;
$page = 1;
print_r($_GET);
if(isset($_GET['Go'])){
	$endofData=1;
	$offset=0;
	while($endofData<=2){
	   $cdrs = getAccountCDRs(200,$offset);
	echo 'countg'.	count($cdrs);
	if(count($cdrs) == 0)
	{
		break;
	$endofData = 11;
		echo "<pre>"; print_r($_SESSION); echo "</pre>";
	}
	   $offset = $offset + 1;
	$endofData = $endofData + 1;
	 }
	$cdr_count = count($cdrs);
 }

$title = "Call History";

//require_once('header_logged_in.php'); ?>
  
 <div class="container">

<h1>Calls History </h1>


<form role="form" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<div class="row">

 <div class="col-md-3">

  <label>Wholeseller</label>
 
<select  name="wholeseller_id" required >
<option value="">Select Wholeseller</option>
<?php
  $sql = "SELECT id,accountname FROM accountusers Where accountgroup_id=62";
 $result = mysqli_query($_SERVER['con'],$sql);
while($row = mysqli_fetch_object($result)){
?>
<option value="<?php echo $row->id;?>" <?php if(isset($_GET['wholeseller_id']) && $_GET['wholeseller_id'] == $row->id) echo 'selected=selected';?> ><?php echo $row->accountname;?></option>
<?php  
} 

?> 
</select> 
</div>

  
<div class="col-md-4">
<label>From Date</label> 
<input type="text" id="from_date"   name="from_date"  value="<?php echo $_GET['from_date'];?>" placeholder="Please select from  date" required /> 
</div>

<div class="col-md-5">
<label>To Date</label> 
<input type="text" id="to_date" name="to_date"  value="<?php echo $_GET['to_date'];?>" placeholder="Please select to  date" required /> 

<input type="submit" name="Go" value="submit" />
</div>



 
</div>



</form>

<div class="row">
&nbsp;
</div>

<div class="row">
 <table  class="table"  border="0" bgcolor="#dbeefc" cellpadding="5">
		  <tr align="center" class="bg_head_payments white font_18">
		   <td width="160">Prefix </td>
		    <td width="160">CLD </td>
		    <td width="160">CLI </td>
		    <td width="100">Duration</td>
            <td width="200">Date </td>
            <td width="100">Amount</td>
        </tr>
<?php
if($cdr_count>0) {

      $getTotalTime = 0;

	foreach($cdrs as $cdr) {
	?>	
	<tr class="border_bottom_payments">
 
	<td> <?php echo $cdr['prefix'];?></td>			
	<td> <?php echo $cdr['cld'];?></td>			
	<td> <?php echo $cdr['cli'];?></td>
	<td> <?php echo $cdr['duration'];?></td>
	<td> <?php echo $cdr['connect_time'];?></td>
	<td> <?php echo $cdr['cost'];?></td>
</tr>
<?php
  $getTotalTime +=  addDurationAsSeconds($cdr['duration']);
	}
?>
<tr>
<td> <?php  $seconds  = gmdate( $getTotalTime );
echo $seconds;

echo "<br/>";

$getHours = floor($seconds / 3600);
$getMins = floor(($seconds - ($getHours*3600)) / 60);
$getSecs = floor($seconds % 60);
echo $getHours.':'.$getMins.':'.$getSecs;


function sec2hms($secs) {
    $secs = round($secs);
    $secs = abs($secs);
    $hours = floor($secs / 3600) . ':';
    if ($hours == '0:') $hours = '';
    $minutes = substr('00' . floor(($secs / 60) % 60), -2) . ':';
    $seconds = substr('00' . $secs % 60, -2);
return ltrim($hours . $minutes . $seconds, '0');
}

echo '<br/>';
echo sec2hms($seconds);


 ?> </td>

</tr>
 <tr> <td colspan='6'> <input type="submit" value="Generate Payment request" name="generatepaymentrequest" /> </td> </tr>
<?php
} else {
	echo "<td colspan='6'>No calls found</td>";
}

?>

 </table>
</div>
</div>
