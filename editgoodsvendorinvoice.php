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
	//	alert('hi');
		var k=0;
		var totalchargedamount = 0;
		for(k=1;k<10;k++){
		
	 
		var myId = k;
		var qty = jQuery("#qty_"+myId).val();
		if( qty>0){
		// alert(qty);
		
		var price = jQuery("#price_"+myId).val();
		// alert(price);
		var chargedAmt = 0;
		 
			  chargedAmt = qty * price;
		 
		
		//alert(chargedAmt);
		  
		jQuery("#chargedAmt_"+myId).val(chargedAmt);
		totalchargedamount = totalchargedamount + chargedAmt;
		
		}}
		jQuery("#totalchargedamount").val(totalchargedamount);
		jQuery("#subtotalchargedamount").val(totalchargedamount);
		
		
}) 	
});


 

 
 </script>
<style>
.Duration_min{

};
.fromdatecal{
};

.todatecal{
};
</style>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
    jQuery(document).ready(function () {

     $(".fromdatecal").datepicker({
      showOn: "button",
      buttonImage: "images/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select assign date",
      dateFormat: "d-m-yy"

    });
		
    $(".todatecal" ).datepicker({
      showOn: "button",
      buttonImage: "images/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select assign date",
      dateFormat: "d-m-yy"

    });

});

</script> 
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
 


  $sqlmaster = "SELECT * from ws_goodservice_vendorinvoice_master  WHERE id = $lastInserId  ";
 $tempresultinvoiceMaster = mysqli_query($_SERVER['con'],$sqlmaster);
 $resultinvoiceMaster = mysqli_fetch_object($tempresultinvoiceMaster);
//echo "<pre>";print_r($resultinvoiceMaster);echo "</pre>";
 
 
 $company_id = $resultinvoiceMaster->company_id;

$sql = "SELECT * FROM company where id=$company_id";
$oldrec = mysqli_query($_SERVER['con'],$sql);
$rowold = mysqli_fetch_object($oldrec);
$companyname = $rowold->nameofcompany;


 
$cdate = date("Y-m-d");
$sqlcurntInvcount = "select count(id) as cnt From  ws_goodservice_vendorinvoice_master WHERE company_id=$company_id AND date(invoicecreateddate) = '$cdate' ";
$recCountData =mysqli_query($_SERVER['con'],$sqlcurntInvcount);
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
 $sql = "SELECT * from ws_goodservice_vendorinvoice_child WHERE invmasterid = $lastInserId  ";
 	 
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
 
<td width="50%" style="font-size:200%;color:#ff0000;text-align:center;"> Vendor Goods Service INVOICE </td>
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




Edit your Goods here..
<table border="1" cellpadding="2" cellspacing="2" class="table" >

  <tr style="background-color:#000000;color:#FFFFFF;">
		    
		    <td>Item Id</td>
		    <td>Description </td>
		     <td> Period(fromdate,todate) </td>
 			
		    <td>Quantity</td>
		    <td>Price</td>
		    <td>Amount</td>
		<td border="0" cellpadding="2" cellspacing="2" style="border-right:1px solid #FFFFFF;background-color:#FFFFFF;">&nbsp;</td>

 </tr>

<?php
$invmasterId = $resultinvoiceMaster->id;
 $sqlchild = "SELECT * from ws_goodservice_vendorinvoice_child WHERE invmasterid = $invmasterId";
$resultChild =  mysqli_query($_SERVER['con'],$sqlchild);
 $rk=0;$k=1;
while($k<6 or $rowChild = mysqli_fetch_object($resultChild)){
//echo "<pre>";print_r($rowChild);
?>
 
	<tr>
	<td>   
	<select  name="prefix[]"  >
<option value="">Select prefix</option>
<?php
  $sql = "SELECT * FROM serviceprefixmaster";
 $result = mysqli_query($_SERVER['con'],$sql);
while($row = mysqli_fetch_object($result)){
?>
<option value="<?php echo $row->prefix;?>"   <?php if(strcmp(trim($row->prefix),trim($rowChild->prefix))==0) echo 'selected';?> > 
<?php echo $row->prefix;?></option>
<?php  
} 

?> 
</select>

	 </td>			
	<td>
<select  name="description[]"   >
<option value="">Select description</option>
<?php
  $sql = "SELECT * FROM serviceprefixmaster";
 $result =  mysqli_query($_SERVER['con'],$sql);
while($row = mysqli_fetch_object($result)){
?>
<option value="<?php echo $row->description;?>"  <?php if(strcmp(trim($row->description),trim($rowChild->Description))==0) echo 'selected';?> > <?php echo $row->description;?></option>
<?php  
} 

?> 
</select>


  </td>
<td>
<input type="text" name="descrfromDates[]" value="<?php echo $rowChild->descrfromDate?>" class="fromdatecal" /><br/>  to <input type="text"    name="descrtoDates[]" value="<?php echo $rowChild->descrtoDate;?>" class="todatecal" />
</td>

	<td><input type="text" name="quantity[]" id="qty_<?php echo $k;?>" value="<?php echo $rowChild->quantity?>" />  </td>
	<td>
		<input type="text" name="price_per_1_min[]"  id="price_<?php echo $k;?>"  value="<?php echo $rowChild->price_per_1_min?>" />
		
	</td>
	<td style="text-align:right"><input type="text" id="chargedAmt_<?php echo $k;?>"   name="Charged_Amount[]"  value="<?php echo $rowChild->Charged_Amount?>" /> </td>  
	<td style="border-right:1px solid #FFFFFF;color:red;text-align:left;"> USD</td>  

	</tr>

	

	<?php
		$k=$k+1;

 
	}
?>


 <tr style="border-right:1px solid #FFFFFF;text-align:right;">
 <td colspan="3" style="text-align:right"> &nbsp;</td>
 <td colspan="2" style="text-align:right">Total : 
 <input type="text" name="totalchargedamount" id="totalchargedamount" value="<?php echo $resultinvoiceMaster->invoiceamount;?>" /> 
   
 </td>
 <td style="border:0px 0px 0px 0px  solid #FFFFFF;color:red;text-align:left;"> USD</td>  
</tr>

<tr style="border-right:1px solid #FFFFFF;text-align:right;">
 <td colspan="5" style="text-align:right"> Outstanding : 
<input type="text" name="outstanding" value="<?php echo $resultinvoiceMaster->outstanding;?>" /> 
   
 </td>
 <td style="border:0px 0px 0px 0px  solid #FFFFFF;color:red;text-align:left;"> USD</td>  
</tr>

<tr style="border-right:1px solid #FFFFFF;text-align:right;">
<td> <input type="button" name="recalculculate" id="recalculculate"  value="recalculculate" /> </td>
 <td colspan="4" style="text-align:right"> Subtotal :
<input type="text" name="subtotalchargedamount" id="subtotalchargedamount"  value="<?php echo $resultinvoiceMaster->invoiceamount;?>" /> 
</td>
 <td style="border:0px 0px 0px 0px  solid #FFFFFF;color:red;text-align:left;"> USD</td>  
</tr>
 </table>

<tr> <td>Invoice comments: <input type="text" class="form-control" name="invoicecomments" value="<?php echo $resultinvoiceMaster->invoicecomments;?>"/>   </td>  </tr>

<tr> <td>Company comments: <input type="text" class="form-control" name="companycomments" value="<?php echo $resultinvoiceMaster->companycomments;?>"   placeholder="Cost to cost"  />    </td>  </tr>


<tr> <td>Paid Amount : <input type="text"  name="paidamount" value="<?php echo  $resultinvoiceMaster->paidamount;?>" />   </td>  </tr>
<tr> <td>Paid Date : <input type="text" name="paiddate" value="<?php echo date("d/m/Y",strtotime($resultinvoiceMaster->paiddate));?>" />  Ex:dd/mm/yyyy </td>  </tr>
<tr>
<td>Payment reciept url: <input type="text" class="form-control" name="paymentreciept" value="<?php echo $resultinvoiceMaster->paymentreciept;?>"/></td>   
</tr>
 
<tr>
<td>
 This invoice is for the period of <input type="text" name="fromDate" value="<?php echo date("d/m/Y",strtotime($resultinvoiceMaster->invoicefromdate));  ?>" />  to <input type="text" name="toDate" value="<?php echo date("d/m/Y",strtotime($resultinvoiceMaster->invoicetodate)); ?>" />. </td>
 </tr>
 
<tr>
<td>GMT: <input type="text" class="form-control" name="gmt" value="<?php echo $resultinvoiceMaster->gmt;?>"/></td>   
</tr>



 <tr>
<td><input type="text" class="form-control" name="invoicebilleddesc" value="<?php echo $resultinvoiceMaster->invoicebilleddesc;?>" /> </td>
</tr>

 <tr>
<td>
<input type="text" class="form-control" name="invoicedisputeemail" value="<?php echo $resultinvoiceMaster->invoicedisputeemail;?>" />
</td>
</tr>


 <tr>
<td>
<p><input type="text" class="form-control" name="paymentscanbedone"  value="<?php echo $resultinvoiceMaster->paymentscanbedone;?>" /> </td>
</tr>


 <tr>
<td>
<p>Select Bank accont  <select class="form-control" name="invoiceLocalBank">
<?php
  $sqlsev = "SELECT * FROM bankaccountdetails";
 $resultsev =  mysqli_query($_SERVER['con'],$sqlsev);
while($rowsev = mysqli_fetch_object($resultsev)){
?>
<option value="<?php echo $rowsev->id;?>"> <?php echo $rowsev->AccountNumber.'-'. $rowsev->bankname;?></option>
<?php  
} 

?> 
</select> </td>
</tr>



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
	$fromDateObject = explode('/',$fromDate);
	$invoicefromdate =  date('Y-m-d',mktime(0,0,0,$fromDateObject[1],$fromDateObject[0],$fromDateObject[2]));
	
	$toDate = $_POST['toDate'];
	$toDateObject = explode('/',$toDate);
	$invoicetodate =  date('Y-m-d',mktime(0,0,0,$toDateObject[1],$toDateObject[0],$toDateObject[2]));
	
	
	
	 
 
	$gmt = $_POST['gmt'];

	 
	$invoicebilleddesc = $_POST['invoicebilleddesc'];
    	 
$totalchargedamount = $_POST['totalchargedamount'];
$ftotamount = round($totalchargedamount,0);
	$company_id =  $_POST['company_id'];
	$companyname = $companiesList[$company_id];

	$invoicecomments = $_POST['invoicecomments'];

	$companycomments = $_POST['companycomments'];

	$paidamount = $_POST['paidamount'];
	$paiddate  =  $_POST['paiddate'];
	$paiddateObject = explode('/',$paiddate);
	$paiddate =  date('Y-m-d',mktime(0,0,0,$paiddateObject[1],$paiddateObject[0],$paiddateObject[2]));
	
	
	
	$paymentreciept = $_POST['paymentreciept'];

 	$totalchargedamount = $_POST['totalchargedamount'];
	
	$invoicebilleddesc = $_POST['invoicebilleddesc'];
	$invoicedisputeemail = $_POST['invoicedisputeemail'];
	$paymentscanbedone = $_POST['paymentscanbedone'];
	$invoiceLocalBank = $_POST['invoiceLocalBank'];
	 

   
	  $sqlinv = "Update ws_goodservice_vendorinvoice_master set 
			company_id =$company_id,
			`companyname` = '$companyname',
			`invoicenumber` ='$invoicenumber',
			`invoicecreateddate` = '$invoicecreateddate',
			`invoiceduedate` = '$invoiceduedate',
			invoicecomments = '$invoicecomments',
			companycomments = '$companycomments',
  			invoiceamount = $totalchargedamount, 
			invoicesubtotal	= $totalchargedamount, 
			 
			invoicedisputeemail = '$invoicedisputeemail',
			paymentscanbedone = '$paymentscanbedone',
			invoiceLocalBank = '$invoiceLocalBank',
			paidamount = $paidamount,
			paiddate = '$paiddate',
			paymentreciept ='$paymentreciept',
			`invoicefromdate` = '$invoicefromdate',
			`invoicetodate` = '$invoicetodate',
		invoicebilleddesc = '$invoicebilleddesc',
		gmt  ='$gmt'
		
		where id = $lastInserId ";
  	 mysqli_query($_SERVER['con'],$sqlinv);
	
	 $sqldelete  = "delete from ws_goodservice_vendorinvoice_child where 	invmasterid = $lastInserId ";
	 mysqli_query($_SERVER['con'],	 $sqldelete );
	$invmasterid = $lastInserId;
	$prefixData = $_POST['prefix'];
	$descriptionData = $_POST['description'];
 	$descrfromDates = $_POST['descrfromDates'];
 	$descrtoDates = $_POST['descrtoDates'];
 	
	$quantityData  = $_POST['quantity'];
	$price_per_1_minData =$_POST['price_per_1_min'];
	$Charged_AmountData = $_POST['Charged_Amount'];
	 
 
	
	for($k=0;$k<count($prefixData);$k++){
	 
		 $prefix  =  $prefixData[$k];
		 $Description = $descriptionData[$k];
		 $descrfromDate = $descrfromDates[$k];
		 $descrtoDate = $descrtoDates[$k];
		 $price_per_1_min =  $price_per_1_minData[$k];
		 $quantity  = $quantityData[$k]; 
		 $Charged_Amount =  round($Charged_AmountData[$k],2);
		 $BilledDuration_min =  0;
		 $customerName = '';
		 $numberofCalls = 0;
		 $fromDate  = date('Y-m-d',strtotime($fromDate));
		 $todate  = date('Y-m-d',strtotime($toDate));
		 //print_r($data->sheets[0]['cells'][$i]);
		
		$account_id = $company_id;

		
		if(  $quantity >0){
		  	$sqlchd = "INSERT INTO   ws_goodservice_vendorinvoice_child (invmasterid,customerName,company_id,`account_id`, `prefix`,  `Description`, `price_per_1_min`,  `quantity`,  `BilledDuration_min`, `Charged_Amount`,fromDate,toDate,descrfromDate,descrtoDate) 
		  VALUES ($invmasterid,'$customerName',$company_id,$account_id, '$prefix', '$Description', '$price_per_1_min','$quantity', '$BilledDuration_min', '$Charged_Amount','$fromDate','$todate','$descrfromDate','$descrtoDate')";
			mysqli_query($_SERVER['con'],$sqlchd);
		}
	 }

	 

mysqli_close($_SERVER['con']);
mysqli_close($_SERVER['con']);	
sleep(5);
header('Location: wsgoods_vendorinvoices_list.php');
exit(0); 
}
?>
  
