<?php
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
	
	 

$( ".savecomments" ).click(function(){
	 
	
	var sid = jQuery(this).attr("id");
  	var notes_comments = jQuery('#cdata-'+sid).val();
	 
	var	data = {
		invoice_id:sid,
		invoicecomments:notes_comments,
		action:'invoicecomment'
	};
	//alert(data);
	
	 $.post("updatecomments.php", data, function(resp){
        alert('Your comment updated.');
		jQuery('#mastercmnt'+sid).text(notes_comments);
		jQuery('#mastercmnt'+sid).show('slow');
		jQuery("#childcmnt"+sid).hide('slow');
    });
	
 });


  $( ".showcomments" ).click(function(){
		
		var masterdivid = jQuery(this).attr("id");
		var k = masterdivid.split('mastercmnt')	;
		//alert(k);
		 
		jQuery('#'+masterdivid).hide('slow');
		jQuery("#childcmnt"+k[1]).show('slow');
		  
 });
  



$( ".savepayments" ).click(function(){
	 
	
	var sid = jQuery(this).attr("id");
  	var paidamount = jQuery('#pdata-'+sid).val();
	 
	var	data = {
		invoice_id:sid,
		paidamount:paidamount,
		action:'invoicepayments'
	};
	//alert(data);
	
	 $.post("updateinvoicepayments.php", data, function(resp){
        alert('Your payment updated.');
		jQuery('#masterpmnt'+sid).text(paidamount);
		jQuery('#masterpmnt'+sid).show('slow');
		jQuery("#childpmnt"+sid).hide('slow');
    });
	
 });

 
 
 
$( ".savepaymentdate" ).click(function(){
	 
	
	var sid = jQuery(this).attr("id");
  	var paiddate = jQuery('#pddata-'+sid).val();
	 
	var	data = {
		invoice_id:sid,
		paiddate:paiddate,
		action:'invoicepaymentdate'
	};
	//alert(data);
	
	 $.post("updateinvoicepayments.php", data, function(resp){
        alert('Your payment date updated.');
		jQuery('#masterpdmnt'+sid).text(paiddate);
		jQuery('#masterpdmnt'+sid).show('slow');
		jQuery("#childpdmnt"+sid).hide('slow');
    });
	
 });

 
  $( ".showpaymentdate" ).click(function(){
		
		var masterdivid = jQuery(this).attr("id");
		var k = masterdivid.split('masterpdmnt')	;
		//alert(k);
		 
		jQuery('#'+masterdivid).hide('slow');
		jQuery("#childpdmnt"+k[1]).show('slow');
		  
 });
 

  $( ".showpayments" ).click(function(){
		
		var masterdivid = jQuery(this).attr("id");
		var k = masterdivid.split('masterpmnt')	;
		//alert(k);
		 
		jQuery('#'+masterdivid).hide('slow');
		jQuery("#childpmnt"+k[1]).show('slow');
		  
 });
	 
});

 
function checkdelte(id){
//alert(id);
 
if (confirm('Are you sure you want to Remove ?')) {
    window.location.href = "wholesaleinvoiceslist.php?action=delete&id="+id;
    // Save it!
} 

}


function lockinvoice(id){
//alert(id);
 
if (confirm('Are you sure you want to Lock the invoice ?')) {
    window.location.href = "wholesaleinvoiceslist.php?action=lock&id="+id;
    // Save it!
} 

}


</script>

<div class="container">

<?php



 $getTotalTime = 0;


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


if(isset($_GET['action']) && $_GET['action']=='delete'){
//print_r($_GET);
	$id = $_GET['id'];
	$sqldelete = "DELETE from wsalesinvoicesmaster where id=$id";
	mysqli_query($_SERVER['con'],$sqldelete); 
	//header("Location:prefixmasterlist.php");
	//exit(0);
}


if(isset($_GET['action']) && $_GET['action']=='lock'){
//print_r($_GET);
	$id = $_GET['id'];
	$sqldelete = "update wsalesinvoicesmaster set lockedinvoice=1  where id=$id";
	mysqli_query($_SERVER['con'],$sqldelete); 
	//header("Location:prefixmasterlist.php");
	//exit(0);
}

?>



<?php
include_once("headermenu.php");
?>
<form role="form" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 


<h1>Whole Sales Invoices List </h1>


<div class="row">

<div class="col-md-3">

   <label>Company Name</label>
 
<select  name="company_id" required >
<option value="">Select Company</option>
<?php
  $sql = "SELECT id,nameofcompany FROM company";
 $result = mysqli_query($_SERVER['con'],$sql);
while($row = mysqli_fetch_object($result)){
?>
<option value="<?php echo $row->id;?>" <?php if(isset($_GET['company_id']) && $_GET['company_id'] == $row->id) echo 'selected=selected';?> > 
<?php echo $row->nameofcompany;?></option>
<?php  
} 

?> 
</select> 
</div>
  
  
<div class="col-md-3">
<label>From Date</label> 
<input type="text" id="from_date"   name="from_date"  value="<?php echo $_GET['from_date'];?>" placeholder="Please select from  date" /> 
</div>

<div class="col-md-3">
<label>To Date</label> 
<input type="text" id="to_date" name="to_date"  value="<?php echo $_GET['to_date'];?>" placeholder="Please select to  date" /> 

<input type="submit" name="Go" value="submit" />
</div>


<div class="col-md-3">

   <label>Sort By:</label>
 
<select  name="sortfield">
<option value="">Select field</option>
<option value="company_id">Company Name </option>
<option value="invoicecreateddate">Invoice Date </option>
<option value="invoiceamount">Amount</option>
<option value="paidamount">Paid Amount </option>
<option value="paiddate">Paid Date </option>
</select> 
</div>

 
</div>



</form>

<div class="row">
&nbsp;
</div>

<div class="row">
 <table  class="table"  border="0" bgcolor="#dbeefc" cellpadding="5">
		  <tr align="center" class="bg_head_payments white font_18">
		<td>S.No.</td>
		   <td>Company Name </td>
		    <td>GMT</td>
		    <td>Invoice No </td>
		    <td>Invoice Date </td>
		    <td>From Date</td>
		    <td>To Date</td>
			<td>Total Minutes</td>
			<td>Amount</td>
			<td>Paid Amount </td>
			<td>Paid Date </td>
			<td> Comments </td>
			<td width="10%">&nbsp; </td>
        </tr>
<?php

$condition = " Where 1 = 1   ";
if (isset($_GET['Go'])){
if (strlen($_GET['company_id'])>0 && isset($_GET['company_id'])){
	$company_id = $_GET['company_id'];
	$condition = $condition." AND company_id = $company_id";
	$linkurl  = $linkurl."&company_id=$company_id"; 
	}


	if (strlen(trim($_GET['from_date']))>0 && isset($_GET['from_date'])){
	 $from_date = $_GET['from_date'];
	$condition = $condition." AND DATE(invoicecreateddate)>='$from_date' ";

 
	$linkurl  = $linkurl."&reseller_id=$reseller_id"; 

	}

	if (strlen(trim($_GET['to_date']))>0 && isset($_GET['to_date'])){

		$to_date = $_GET['to_date'];
		$condition = $condition." AND DATE(invoicecreateddate)<='$to_date' ";


		$to_date = $_GET['to_date'];
	}
	
	if (strlen(trim($_GET['sortfield']))>0 && isset($_GET['sortfield'])){

		$sortfield = $_GET['sortfield'];
		$sortByData =  " order by $sortfield ";
	}


}

$sumtotalinv = 0;
 $sql = "SELECT * From wsalesinvoicesmaster $condition $sortByData  ";
 $result = mysqli_query($_SERVER['con'],$sql);
$sno = 0;
 while($rowinv = mysqli_fetch_object($result)){
$sno = $sno+1;

	?>	
	<tr class="border_bottom_payments">
	<td> <?php echo $sno;?></td>
	<td> <?php echo $rowinv->companyname;?></td>
	<td> <?php echo 'GMT+0'; ?>			
	<td> <?php echo $rowinv->invoicenumber;?></td>			
	<td> <?php echo $rowinv->invoicecreateddate;?></td>
	<td> <?php echo $rowinv->invoicefromdate;?></td>
	<td> <?php echo $rowinv->invoicetodate;?></td>
	<td> <?php echo $rowinv->invoiceTotalminutes;?></td>
	<td> <?php echo $rowinv->invoiceamount;?>$</td>
	<td>

<span title='Click here to update your payments' class="showpayments" id="<?php echo 'masterpmnt'.$rowinv->id; ?>" > <?php if( $rowinv->paidamount == 0) echo 'Add your payments here.'; else  echo $rowinv->paidamount;?> </span>
<span id="<?php echo 'childpmnt'.$rowinv->id; ?>" style='display:none'> 
<input type='text' value="<?php echo $rowinv->paidamount;?>" class="form-control"   id="pdata-<?php echo $rowinv->id;?>" >    <img src ="make_comment.png"  class="savepayments"  id="<?php echo $rowinv->id;?>"   title="Save Payments" /> 
</span>
</td>
 	
	
<td>

<span title='Click here to update your payment date' class="showpaymentdate" id="<?php echo 'masterpdmnt'.$rowinv->id; ?>" > <?php if( strlen($rowinv->paiddate) == 0) echo 'Add your payment date here.'; else  echo $rowinv->paiddate;?> </span>
<span id="<?php echo 'childpdmnt'.$rowinv->id; ?>" style='display:none'> 
<input type='text' value="<?php echo $rowinv->paiddate;?>" class="form-control"   id="pddata-<?php echo $rowinv->id;?>" >    <img src ="make_comment.png"  class="savepaymentdate"  id="<?php echo $rowinv->id;?>"   title="Save Payment date" /> 
</span>
</td>

<td>

<span title='Click here to update your comments' class="showcomments" id="<?php echo 'mastercmnt'.$rowinv->id; ?>" > <?php if( strlen(trim($rowinv->invoicecomments)) == 0) echo 'Add your comments here.'; else  echo $rowinv->invoicecomments;?> </span>
<span id="<?php echo 'childcmnt'.$rowinv->id; ?>" style='display:none'> 
<input type='text' value="<?php echo $rowinv->invoicecomments;?>" class="form-control"   id="cdata-<?php echo $rowinv->id;?>" >    <img src ="make_comment.png"  class="savecomments"  id="<?php echo $rowinv->id;?>"   title="Save Comments" /> 
</span>
</td>
 	


	<td>
	 <a href="<?php echo 'generateinvoicepdf.php?id='.$rowinv->id;?>"> <img src="geneatepdf.png" width="20" height="20"   title="Generater Pdf"/> </a> &nbsp;
<?php if($rowinv->lockedinvoice==0){?>
   &nbsp; &nbsp; <img src="remove.png" width="20" height="20" title="Delete" onclick="checkdelte(<?php echo $rowinv->id;?>)"/>
 <img src="invoice_lock.png" width="20" height="20" title="locke your invoice" onclick="lockinvoice(<?php echo $rowinv->id;?>)"/>  
<?php } ?>

		



	 </td>
	
	
	</tr>
<?php
	$sumpaidAmount = $sumpaidAmount +  $rowinv->paidamount;
	$sumtotalinv = $sumtotalinv +  $rowinv->invoiceamount;
	$getTotalTime +=  addDurationAsSeconds($rowinv->invoiceTotalminutes);

	}

	$seconds  = gmdate($getTotalTime);
	$totalbiledduration = converToMMHH(sec2hms($seconds));
	//$totalbiledduration  =  sec2hms($seconds);

$balanceAmount =  $sumtotalinv - $sumpaidAmount;
?>

<tr>
<td>&nbsp; </td> <td>&nbsp; </td> <td>&nbsp; </td>  <td>&nbsp;</td> <td>&nbsp; </td> <td>&nbsp; </td> 
<td>&nbsp;<b>Total</b> :  </td><td><?php echo $totalbiledduration;?></td>  <td> <?php echo $sumtotalinv; ?>$ </td> <td><?php echo $sumpaidAmount; ?>$ </td> 
<td> Balance Amount : <?php echo $balanceAmount; ?>$ </td> <td>&nbsp; </td>  <td>&nbsp;</td>
</tr>

 </table>
</div>
</div>

