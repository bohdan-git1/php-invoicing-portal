<?php
session_start(true);
require_once('head.php');
include_once('smtp.php');
include_once("dbconfig.php");
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
 <script>
    jQuery(document).ready(function () {
	jQuery("#recalculculate").click(function() {
		$( ".Duration_min" ).each(function( index,value ) {
	//console.log('div' + index + ':' + $(this).attr('id')); 
		var mysDiv = $(this).attr('id');
		var res = mysDiv.split('_'); 
		var myId = res[2];
		var Duration_min = jQuery('Duration_min_'+myId).val();
		var price_per_1_min_ = jQuery('price_per_1_min_'+myId).val();
		var Duration_min = jQuery('Duration_min_'+myId).val();
		
		});

});

	
  });

 </script>
<style>
.Duration_min{

}
</style>
<?php 

function sendEMail($toEmail,$pdfpath) {

    $body = " 

<table>
<tr><td> Welcome to ESC-NET FZE </td></tr>
<tr><td> Please keep this email for your records. Your information is as follows:</td> </tr>
<tr><td> Please find the PDF File as attached here </td></tr>
<tr><td> &nbsp; </td> </tr>
<tr><td> &nbsp; </td> </tr>
<tr><td> Please feel free to contact us in case of any assiatnce, we are available on skype id 'mob-voip' </td> </tr>
<tr><td> Whatsapp # +16473602360  </td> </tr>
<tr><td> &nbsp;  </td> </tr>
<tr><td> Thank you for Business! </td> </tr>
<tr><td> &nbsp; </td> </tr>
<tr><td>   ESC-NET FZE  Team. </td> </tr>
</table>";
 
#$bcc = "mail@mob-voip.net";
$to = $toEmail;
$subject = 'Inter Connect Form Confirmation PDF';
		$from ='info@mob-voip.net'; 
	        $headers  = "From: " . $from . "\r\n";
		$headers .= "Reply-To: ". $from . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

 
	externalmail($to,$subject,$body,$pdfpath);
 
}


function sec2hms($secs) {
    $secs = round($secs);
    $secs = abs($secs);
    $hours = floor($secs / 3600) . ':';
    if ($hours == '0:') $hours = '';
    $minutes = substr('00' . floor(($secs / 60) % 60), -2) . ':';
    $seconds = substr('00' . $secs % 60, -2);
return ltrim($hours . $minutes . $seconds, '0');
}

function addDurationAsSeconds( $timeStamp ) {
        $timeSections = explode( ':', $timeStamp );
        $seconds =  
                   ( $timeSections[0] * 60 )        //Minutes to Seconds
                 +  ( $timeSections[1]  );           //Seconds to Seconds
 
        return $seconds;
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


$prefixmasterList = array();
$sqlp = "SELECT * FROM prefixmaster  ";
$resultp = mysqli_query($_SERVER['con'],$sqlp);
while($rowp = mysqli_fetch_object($resultp)){
 $prefixmasterList[$rowp->prefix] = $rowp->description;
}




if(isset($_GET['lastInserId']))
	$lastInserId = $_GET['lastInserId'];
 
 if(isset($_POST['lastInserId']))
	$lastInserId = $_POST['lastInserId'];
 


 $sqlmaster = "SELECT * from wsalesinvoicesmaster WHERE id = $lastInserId  ";
 $tempresultinvoiceMaster = mysqli_query($_SERVER['con'],$sqlmaster);
 $resultinvoiceMaster = mysqli_fetch_object($tempresultinvoiceMaster);
 
 
 $company_id = $resultinvoiceMaster->company_id;

$sql = "SELECT * FROM company where id=$company_id";
$oldrec = mysqli_query($_SERVER['con'],$sql);
$rowold = mysqli_fetch_object($oldrec);
$companyname = $rowold->nameofcompany;


 
$cdate = date("Y-m-d");
$sqlcurntInvcount = "select count(id) as cnt From wsalesinvoicesmaster WHERE company_id=$company_id AND date(invoicecreateddate) = '$cdate' ";
$recCountData = mysqli_query($_SERVER['con'],$sqlcurntInvcount);
$rowrecCount = mysqli_fetch_object($recCountData);
 $oldRecordsCount = $rowrecCount->cnt;
 //print_r($rowrecCount);
 if( $oldRecordsCount == 0 )
	  $oldRecordsCount = 1;
  else
	  $oldRecordsCount = $oldRecordsCount + 1;
  
$sqlnew = "SELECT * FROM company where id=$company_id";
$newrec = mysqli_query($_SERVER['con'],$sqlnew);
$rownewcompany = mysqli_fetch_object($newrec);
$company_id = $rownewcompany->id;
$companyname = $rownewcompany->nameofcompany;
//define ('PDF_HEADER_LOGO', 'logoVoip.png');


 $Condition='';
 $sql = "SELECT * from wsalesinvoiceschild WHERE invmasterid = $lastInserId  ";
 	 
 $getTotalTime = 0; 
 $totalchargedamount=0;
 $totalbiledduration =0;
 $resultinvoice = mysqli_query($_SERVER['con'],$sql);
 
$currentDate = date("Ymd");
$createdDate = date("d/m/Y");
$dueDate =  date('d/m/Y', strtotime(' + 3 day'));
$invNo = $currentDate.$oldRecordsCount;
$invoicenumber = $invNo; 


$totalchargedamount = 0;
$totalbiledduration=0;
$companiesList = array();
?>
 
<div class="container">  

<form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
<input type="hidden" name="lastInserId" value="<?php echo $lastInserId; ?>" />
<table class="table">
<tr>
<td width="25%">
<?php
$fromsql = "SELECT * FROM company where id=1";
$fromoldrec = mysqli_query($_SERVER['con'],$fromsql);
$fromrowold = mysqli_fetch_object($fromoldrec);
 

?>
From: <br>
<?php echo $fromrowold->nameofcompany; ?><br>
<?php echo $fromrowold->companyaddress; ?><br>
<?php echo $fromrowold->country; ?><br>
Tel #: <?php echo $fromrowold->telephone; ?><br>
<?php echo $fromrowold->email; ?><br>
</td>
 
<td width="50%" style="font-size:200%;color:#ff0000;text-align:center;"> INVOICE </td>
<td width="25%"> <img alt="CompanyLogo" src="logouploads/ECS-Logo1.png" width="250" heigth="200"/> </td>
</tr>
</table>

<table class="table">
<tr>
<td>To :
<select  class="form-control" name="company_id" required >
<option value="">Select Company</option>
<?php

  $sql = "SELECT id,nameofcompany FROM company";
 $result = mysqli_query($_SERVER['con'],$sql);
while($row = mysqli_fetch_object($result)){
	$companiesList[$row->id] = $row->nameofcompany;
?>
<option value="<?php echo $row->id;?>" <?php if(isset($company_id) && $company_id == $row->id) echo 'selected=selected';?> > 
<?php echo $row->nameofcompany;?></option>
<?php  
} 

?> 
</select> 


</td>
</tr>

 
<tr>
<td>Invoice Number.# <input  class="form-control" type="text" name="invoicenumber" value="<?php echo $resultinvoiceMaster->invoicenumber;?>" /> </td>
</tr>

<tr>
<td> Create Date <input type="text" name="createdDate" value="<?php echo date("d/m/Y",strtotime($resultinvoiceMaster->invoicecreateddate));?>" />  Ex:dd/mm/yyyy </td> 
</tr>
<tr>
<td> Due Date  <input type="text" name="dueDate" value="<?php echo date("d/m/Y",strtotime($resultinvoiceMaster->invoiceduedate));?>" /> Ex:dd/mm/yyyy </td>  
</tr>

<tr> <td>Invoice comments: <input type="text" class="form-control" name="invoicecomments" value="<?php echo $resultinvoiceMaster->invoicecomments;?>"/>   </td>  </tr>

<tr> <td>Paid Amount : <input type="text"  name="paidamount" value="<?php echo  $resultinvoiceMaster->paidamount;?>" />   </td>  </tr>
<tr> <td>Paid Date : <input type="text" name="paiddate" value="<?php echo date("d/m/Y",strtotime($resultinvoiceMaster->paiddate));?>" />  Ex:dd/mm/yyyy </td>  </tr>
<tr>
<td>Payment reciept url: <input type="text" class="form-control" name="paymentreciept" value="<?php echo $resultinvoiceMaster->paymentreciept;?>"/></td>   
</tr>
 
<tr>
<td>
 This invoice is for the period of <input type="text" name="fromDate" value="<?php echo $resultinvoiceMaster->invoicefromdate;?>" />  to <input type="text" name="toDate" value="<?php echo  $resultinvoiceMaster->invoicetodate;?>" />. </td>
 </tr>
 
<tr>
<td>GMT: <input type="text" class="form-control" name="gmt" value="<?php echo $resultinvoiceMaster->gmt;?>"/></td>   
</tr>

 <tr>
<td><input type="text" class="form-control" name="invoicebilleddesc" value="<?php echo $resultinvoiceMaster->invoicebilleddesc;?>" /> </td>
</tr>
</table>
 

 
 
<center> <input type="submit" name="conform"  class="btn btn-info" value="Update invoice" /> </center>

<br>
<br>

</form>
</div>
<?php
//print_r($_POST);
//=======
//print_r($_POST);

	//$company_id = $_SESSION['company_id'];


if (isset($_POST['conform'])){

	$invoicenumber = $_POST['invoicenumber'];
 
	$dueDate = $_POST['dueDate'];
	$dueDateObject = explode('/',$dueDate);
	$invoiceduedate =  date('Y-m-d',mktime(0,0,0,$dueDateObject[1],$dueDateObject[0],$dueDateObject[2]));
	
	
	$createdDate = $_POST['createdDate'];
	$createdDateObject = explode('/',$createdDate);
	$invoicecreateddate =  date('Y-m-d',mktime(0,0,0,$createdDateObject[1],$createdDateObject[0],$createdDateObject[2]));
	
	
	$fromDate = $_POST['fromDate'];
	$toDate = $_POST['toDate'];
	//$invoicefromdate  = date('Y-m-d',strtotime($fromDate));
	//$invoicetodate  = date('Y-m-d',strtotime($toDate));
	$invoicefromdate  = $fromDate;
	$invoicetodate  = $toDate;
	$gmt = $_POST['gmt'];

	 
	$invoicebilleddesc = $_POST['invoicebilleddesc'];
    	 

	$company_id =  $_POST['company_id'];
	$companyname = $companiesList[$company_id];

	$invoicecomments = $_POST['invoicecomments'];
	$paidamount = $_POST['paidamount'];
	$paiddate  =  $_POST['paiddate'];
	$paiddateObject = explode('/',$paiddate);
	$paiddate =  date('Y-m-d',mktime(0,0,0,$paiddateObject[1],$paiddateObject[0],$paiddateObject[2]));
	
	
	
	$paymentreciept = $_POST['paymentreciept'];
 
		
	 
	echo $sqlinv = "Update wsalesinvoicesmaster set 
			company_id =$company_id,
			`companyname` = '$companyname',
			`invoicenumber` ='$invoicenumber',
			`invoicecreateddate` = '$invoicecreateddate',
			`invoiceduedate` = '$invoiceduedate',
			invoicecomments = '$invoicecomments',
			paidamount = $paidamount,
			paiddate = '$paiddate',
			paymentreciept ='$paymentreciept',
			`invoicefromdate` = '$invoicefromdate',
			`invoicetodate` = '$invoicetodate',
		invoicebilleddesc = '$invoicebilleddesc',
		gmt  ='$gmt'
		
		where id = $lastInserId ";
    mysqli_query($_SERVER['con'],$sqlinv);
	 
	 

	
sleep(5);
 header('Location: wholesaleinvoiceslist.php');
exit(0); 
}
?>
  
