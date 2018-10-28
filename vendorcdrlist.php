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

function getAccountCDRs($limit, $offset) {
	
	$wholeseller_id = $_GET['wholeseller_id'];
	$fromDate = $_GET['from_date'];
	$todate  = $_GET['to_date'];
	
	


	 $fromSalesDate = date("D M j Y",strtotime($fromDate));
	 $toSalesDate = date("D M j Y",strtotime($todate));
  
	$params = array(new xmlrpcval(array("i_account"   => new xmlrpcval($wholeseller_id, "int"),
										"limit" 	=> new xmlrpcval(100, "int"),
										"start_date" => new xmlrpcval("00:00:00.000 GMT $fromSalesDate","string"),                 
										"end_date" 	 => new xmlrpcval("23:59:59.000 GMT $toSalesDate","string"),
										"offset"  => new xmlrpcval(0, "int"),
										),'struct'));
										
//"start_date" => new xmlrpcval("09:00:29.000 GMT Wed Apr 21 2016","string"),                 
//"end_date"	=> new xmlrpcval("22:50:50.000 GMT Thu Apr 28 2016","string"),
																				
	$msg = new xmlrpcmsg('exportVendorsCDRs_Mera', $params);
	 $cli = new xmlrpc_client($_SERVER['xmlRpcUrl']);
	$cli->setSSLVerifyPeer(false);
	$cli->setSSLVerifyHost(false);
	//$cli->setCredentials('VC','jaihind999', CURLAUTH_DIGEST);
	  $cli->setCredentials($_SERVER['xmlUser'],$_SERVER['xmlPass'], CURLAUTH_DIGEST);
	   

	$r = $cli->send($msg, 20);       /* 20 seconds timeout */
 //echo "<pre>"; print_r($r);echo "</pre>"; 
	if ($r->faultCode()) {
		$error = $r->faultString();
		return array();
	}
	
	$res = $r->value()->structMem('cdrs');
	//echo "<pre>";print_r($res); echo "</pre>";
	$res = $res->scalarVal();
	$cdrs= array();
	$i=0;
//$p=0;
	$cdrDataString = array();
	foreach( $res as $obj ) {
		//$p = $p+1;
		 $cdrDataString[] = $obj->me['string'];
	}
	echo "<pre>";print_r($cdrDataString); echo "</pre>";

	$BaseDataList = array();
	for($k=0;$k<sizeof($cdrDataString);$k++){
			$EachRecord = $cdrDataString[$k];
			$myOrgData = explode(",",$EachRecord);
			$BaseDataList[$k]['HOST'] = str_replace("HOST=","",$myOrgData[0]); 
			$BaseDataList[$k]['CONFID'] = str_replace("CONFID=","",$myOrgData[1]); 
			$BaseDataList[$k]['CALLID '] = str_replace("CALLID= ","",$myOrgData[2]); 
			$BaseDataList[$k]['SRC-IP'] = str_replace("SRC-IP=","",$myOrgData[3]); 
			$BaseDataList[$k]['DST-IP'] = str_replace("DST-IP=","",$myOrgData[4]); 
			$BaseDataList[$k]['SRC-NAME'] = str_replace("SRC-IP=","",$myOrgData[5]); 
			$BaseDataList[$k]['DST-NAME'] = str_replace("DST-NAME=","",$myOrgData[6]); 
			$BaseDataList[$k]['SRC-NUMBER-IN'] = str_replace("SRC-NUMBER-IN=","",$myOrgData[7]); 
			$BaseDataList[$k]['SRC-NUMBER-BILL'] = str_replace("SRC-NUMBER-BILL=","",$myOrgData[8]); 
			$BaseDataList[$k]['SRC-NUMBER-OUT'] = str_replace("SRC-NUMBER-OUT=","",$myOrgData[9]); 
			$BaseDataList[$k]['DST-NUMBER-IN'] = str_replace("DST-NUMBER-IN=","",$myOrgData[10]); 
			$BaseDataList[$k]['DST-NUMBER-BILL'] = str_replace("DST-NUMBER-BILL=","",$myOrgData[11]); 
			$BaseDataList[$k]['DST-NUMBER-OUT'] = str_replace("DST-NUMBER-OUT=","",$myOrgData[12]); 
			$BaseDataList[$k]['SETUP-TIME'] = str_replace("SETUP-TIME=","",$myOrgData[13]); 
			$BaseDataList[$k]['CONNECT-TIME'] = str_replace("CONNECT-TIME=","",$myOrgData[14]); 
			$BaseDataList[$k]['DISCONNECT-TIME'] = str_replace("DISCONNECT-TIME=","",$myOrgData[15]); 
			$BaseDataList[$k]['ELAPSED-TIME'] = str_replace("ELAPSED-TIME=","",$myOrgData[16]); 
			$BaseDataList[$k]['DISCONNECT-CODE-Q931'] = str_replace("DISCONNECT-CODE-Q931=","",$myOrgData[17]); 
	}
	 

	//echo "<pre>"; print_r($cdrs); echo "</pre>";
	return $BaseDataList;

}


$cdrs_per_page = 5;
$page = 1;
$cdrs = getAccountCDRs(1,100);
$cdr_count = count($cdrs);

$title = "Call History";

//require_once('header_logged_in.php'); ?>
  
 <div class="container">

<h1>Vendors CDRs List</h1>


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
<td width="160">HOST  </td>
<td width="160">CONFID </td>
<td width="160">CALLID </td>
<td width="100">SRC-IP</td>
<td width="200">DST-IP  </td>
<td width="100">SRC-NAME</td>
<td width="100">DST-NAME</td>
<td width="100">SRC-NUMBER-IN</td>
<td width="100">SRC-NUMBER-BILL</td>
<td width="100">SRC-NUMBER-OUT</td>
<td width="100">DST-NUMBER-IN</td>
<td width="100">DST-NUMBER-BILL</td>
<td width="100">DST-NUMBER-OUT</td>
<td width="100">SETUP-TIME</td>
<td width="100">CONNECT-TIME</td>
<td width="100">DISCONNECT-TIME</td>
<td width="100">ELAPSED-TIME</td>
<td width="100">DISCONNECT-CODE-Q931</td>
</tr>
<?php
if($cdr_count>0) {

	foreach($cdrs as $cdr) {
	?>	
	<tr class="border_bottom_payments">
 
	<td> <?php echo $cdr['HOST'];?></td>			
	<td> <?php echo $cdr['CONFID'];?></td>			
	<td> <?php echo $cdr['CALLID'];?></td>
	<td> <?php echo $cdr['SRC-IP'];?></td>
	<td> <?php echo $cdr['DST-IP'];?></td>
	<td> <?php echo $cdr['SRC-NAME'];?></td>
	<td> <?php echo $cdr['DST-NAME'];?></td>
	<td> <?php echo $cdr['SRC-NUMBER-IN'];?></td>
	<td> <?php echo $cdr['SRC-NUMBER-BILL'];?></td>
	<td> <?php echo $cdr['SRC-NUMBER-OUT'];?></td>
	<td> <?php echo $cdr['DST-NUMBER-IN'];?></td>
	<td> <?php echo $cdr['DST-NUMBER-BILL'];?></td>
	<td> <?php echo $cdr['DST-NUMBER-OUT'];?></td>
	<td> <?php echo $cdr['SETUP-TIME'];?></td>
	<td> <?php echo $cdr['CONNECT-TIME'];?></td>
	<td> <?php echo $cdr['DISCONNECT-TIME'];?></td>
	<td> <?php echo $cdr['ELAPSED-TIME'];?></td>
	<td> <?php echo $cdr['DISCONNECT-CODE-Q931'];?></td>
</tr>
<?php
	}
?>
 <tr> <td colspan='6'> <input type="submit" value="Generate Payment request" name="generatepaymentrequest" /> </td> </tr>
<?php
} else {
	echo "<td colspan='6'>No calls found</td>";
}

?>

 </table>
</div>
</div>
