<?php
require_once('head.php');

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

 

session_start();
  $sql = "SELECT * From wsalesconsumptionmaster $condition";
$result = mysqli_query($_SERVER['con'],$sql);
$sno = 0;
$consumptionList = array();
while($rowinv = mysqli_fetch_object($result)){
	$consumptionList[$rowinv->invoicecreateddate]['invoicecreateddate'] = $rowinv->invoicecreateddate;
	$consumptionList[$rowinv->invoicecreateddate]['invoicenumber'] = $rowinv->invoicenumber;
	$consumptionList[$rowinv->invoicecreateddate]['description'] = substr($rowinv->invoicefromdate, 0, 10).'-'.substr($rowinv->invoicetodate, 0, 10);
	$consumptionList[$rowinv->invoicecreateddate]['invoiceamount'] = $rowinv->invoiceamount;
	$consumptionList[$rowinv->invoicecreateddate]['invoiceTotalminutes'] = $rowinv->invoiceTotalminutes;
	$consumptionList[$rowinv->invoicecreateddate]['paiddate'] = $rowinv->paiddate;
	$consumptionList[$rowinv->invoicecreateddate]['paidamount'] = $rowinv->paidamount;
}

$sql = "SELECT * From wsalesinvoicesmaster   $condition";
$result = mysqli_query($_SERVER['con'],$sql);
$sno = 0;
$invoiceList=array();
while($rowinv = mysqli_fetch_object($result)){
	$invoiceList[$rowinv->invoicecreateddate]['invoicecreateddate'] = $rowinv->invoicecreateddate;
	$invoiceList[$rowinv->invoicecreateddate]['invoicenumber'] = $rowinv->invoicenumber;
	$invoiceList[$rowinv->invoicecreateddate]['description'] = substr($rowinv->invoicefromdate, 0, 10).'-'.substr($rowinv->invoicetodate, 0, 10);
	$invoiceList[$rowinv->invoicecreateddate]['invoiceamount'] = $rowinv->invoiceamount;
	$invoiceList[$rowinv->invoicecreateddate]['invoiceTotalminutes'] = $rowinv->invoiceTotalminutes;
    $invoiceList[$rowinv->invoicecreateddate]['paiddate'] = $rowinv->paiddate;
	$invoiceList[$rowinv->invoicecreateddate]['paidamount'] = $rowinv->paidamount;
}


$sql = "SELECT * From ws_goodservice_invoice_master   $condition";
$result = mysqli_query($_SERVER['con'],$sql);
$sno = 0;
$goodsinvoiceList=array();
while($rowinv = mysqli_fetch_object($result)){
	$goodsinvoiceList[$rowinv->invoicecreateddate]['invoicecreateddate'] = $rowinv->invoicecreateddate;
	$goodsinvoiceList[$rowinv->invoicecreateddate]['invoicenumber'] = $rowinv->invoicenumber;
	$goodsinvoiceList[$rowinv->invoicecreateddate]['description'] = substr($rowinv->invoicefromdate, 0, 10).'-'.substr($rowinv->invoicetodate, 0, 10);
	$goodsinvoiceList[$rowinv->invoicecreateddate]['invoiceamount'] = $rowinv->invoiceamount;
	$goodsinvoiceList[$rowinv->invoicecreateddate]['invoiceTotalminutes'] = $rowinv->invoiceTotalminutes;
    $goodsinvoiceList[$rowinv->invoicecreateddate]['paiddate'] = $rowinv->paiddate;
	$goodsinvoiceList[$rowinv->invoicecreateddate]['paidamount'] = $rowinv->paidamount;
}

//echo "<pre>"; print_r($invoiceList); echo "</pre>";

 
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">


<?php
include_once("headermenu.php");
?>
<h1> SOA Summary </h1>
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
<form role="form" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">


<div class="row">

<div class="col-md-3">

   <label>Company Name</label>
 
<select  name="company_id">
<option value="">Select Company</option>
<?php
$companyList = array();
  $sql = "SELECT id,nameofcompany FROM company";
 $result = mysqli_query($_SERVER['con'],$sql);
while($row = mysqli_fetch_object($result)){
	$companyList[$row->id] = $row->nameofcompany;
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

<div class="col-md-4">
<label>To Date</label> 
<input type="text" id="to_date" name="to_date"  value="<?php echo $_GET['to_date'];?>" placeholder="Please select to  date" /> 

</div>

<div class="col-md-2">
<input type="submit" name="Go" value="submit" />
</div>

</div>

</form>

<?php 
$ak = '';
$bk = '';

if(sizeof($consumptionList)==0)
$ak = 'display:none';
 

if(sizeof($invoiceList)==0 && sizeof($goodsinvoiceList)==0 )
$bk = 'display:none';
 

?> 


<div class="row"> &nbsp;</div>
<div class="row">
 <div class="table-responsive">       
 
<table class="table">

<tr>

<td  style="<?php echo $ak;?>" >

 

<table class="table">
<tr>
<td style="text-align:center" colspan="8" >
ECS (Our company)  
</td>
</tr>
 
<tr style="text-align:center">
<td>Date &nbsp;</td>
<td>Invoice # </td>
<td>Invoice Period </td>
<td>Minutes</td>
<td>Amount</td>
<td>Paid Date</td>
<td>Paid</td>
<td>Balance</td>
</tr>

 
<?php

$mycompanytotalinvAmount = 0;
$mycompanytotalPaidAmount = 0;

foreach ($consumptionList as $key => $rowinv) {
?>
<tr>
<td> <?php echo  $key;?></td>
<td style="text-align:center"> <?php echo  $consumptionList[$key]['invoicenumber'];?></td>
<td style="text-align:center"> <?php echo  $consumptionList[$key]['description']; ;?></td>
<td> <?php echo  $consumptionList[$key]['invoiceTotalminutes'];?></td>	
<td style="text-align:right"> <?php echo  $consumptionList[$key]['invoiceamount'];?></td>	
<td> <?php if( $consumptionList[$key]['paidamount']>0) echo  $consumptionList[$key]['paiddate'];?></td>	
<td style="text-align:right"> <?php if( $consumptionList[$key]['paidamount']>0) echo  $consumptionList[$key]['paidamount'];?></td>	
<?php
	$mycompanytotalinvAmount = $mycompanytotalinvAmount +  $consumptionList[$key]['invoiceamount'];
	$mycompanytotalPaidAmount = $mycompanytotalPaidAmount +  $consumptionList[$key]['paidamount'];
	$mycompanyBalanceAmount =  $mycompanytotalinvAmount  -  $mycompanytotalPaidAmount;
?>
<td  style="text-align:right"><?php echo $mycompanyBalanceAmount;?></td>
</tr>
<?php
}
?>

<tr>
<td> Totals : </td>  <td> &nbsp; </td> <td> &nbsp; </td>  <td> &nbsp; </td> <td  style="text-align:right"> <?php echo $mycompanytotalinvAmount ;?></td> 
<td> &nbsp; </td> <td  style="text-align:right"> <?php echo $mycompanytotalPaidAmount;?></td>
</tr>

<tr>
<td style="text-align:center" colspan="8">
Balance :  <?php echo $mycompanytotalinvAmount ;?> 
</td>
</tr>

</table>

  
</td>


<td  style="<?php echo $bk;?>">



 

<table class="table">

<tr>
<td style="text-align:center" colspan="8">
<?php
$company_id = $_GET['company_id'];
 echo $companyList[$company_id];
?> 
</td>
</tr>

<tr style="text-align:center">
<td>Date &nbsp;</td>
<td>Invoice # </td>
<td>Invoice Period </td>
<td>Minutes</td>
<td>Amount</td>
<td>Paid Date</td>
<td>Paid</td>
<td>Balance</td>
</tr>

<?php

 
$othercompanytotalinvAmount = 0;
$othercompanytotalPaidAmount  = 0;
$rowbalance = 0;

foreach ($invoiceList as $key => $rowinv) {
?>
<tr>
<td> <?php echo  $key;?></td>
<td style="text-align:center"> <?php echo  $invoiceList[$key]['invoicenumber'];?></td>
<td style="text-align:center"> <?php echo  $invoiceList[$key]['description'];?></td>
<td> <?php echo  $invoiceList[$key]['invoiceTotalminutes'];?></td>	
<td style="text-align:right"> <?php echo  $invoiceList[$key]['invoiceamount'];?></td>	
<td> <?php if( $invoiceList[$key]['paidamount']>0) echo  $invoiceList[$key]['paiddate'];?></td>	
<td style="text-align:right"> <?php if( $invoiceList[$key]['paidamount']>0) echo  $invoiceList[$key]['paidamount'];?></td>	
<?php
 
$othercompanytotalinvAmount = $othercompanytotalinvAmount +  $invoiceList[$key]['invoiceamount'];
$othercompanytotalPaidAmount = $othercompanytotalPaidAmount +  $invoiceList[$key]['paidamount'];
$rowbalance =   $othercompanytotalinvAmount -  $othercompanytotalPaidAmount;
?>
<td  style="text-align:right"><?php echo $rowbalance;?></td>
</tr>

<?php
}


?>

<tr>
<td colspan="8"style="text-align:center"><b>Goods Services Invoices</b></td>
</tr>

<tr style="text-align:center">
<td>Date &nbsp;</td>
<td>Invoice # </td>
<td>Invoice Period </td>
<td>Minutes</td>
<td>Amount</td>
<td>Paid Date</td>
<td>Paid</td>
<td>Balance</td>
</tr>
<?php
foreach ($goodsinvoiceList as $key => $rowinv) {
?>
<tr>
<td> <?php echo  $key;?></td>
<td style="text-align:center"> <?php echo  $goodsinvoiceList[$key]['invoicenumber'];?></td>
<td style="text-align:center"> <?php echo  $goodsinvoiceList[$key]['description'];?></td>
<td> <?php echo  $goodsinvoiceList[$key]['invoiceTotalminutes'];?></td>	
<td style="text-align:right"> <?php echo  $goodsinvoiceList[$key]['invoiceamount'];?></td>	
<td> <?php if( $goodsinvoiceList[$key]['paidamount']>0) echo  $goodsinvoiceList[$key]['paiddate'];?></td>	
<td style="text-align:right"> <?php if( $goodsinvoiceList[$key]['paidamount']>0) echo  $goodsinvoiceList[$key]['paidamount'];?></td>	
<?php
 
$othercompanytotalinvAmount = $othercompanytotalinvAmount +  $goodsinvoiceList[$key]['invoiceamount'];
$othercompanytotalPaidAmount = $othercompanytotalPaidAmount +  $goodsinvoiceList[$key]['paidamount'];
$rowbalance =   $othercompanytotalinvAmount -  $othercompanytotalPaidAmount;
?>
<td  style="text-align:right"><?php echo $rowbalance;?></td>
</tr>

<?php
}


$othercompanyBalanceAmount =  $othercompanytotalinvAmount  -  $othercompanytotalPaidAmount;

?>

<tr>
<td> Totals :&nbsp; </td>  <td> &nbsp; </td> <td> &nbsp; </td> <td> &nbsp; </td> <td style="text-align:right"> <?php echo $othercompanytotalinvAmount ;?> </td>
 <td> &nbsp; </td> <td style="text-align:right"> <?php echo $othercompanytotalPaidAmount;?> </td>
</tr>
 
 <tr>
<td  style="text-align:center" colspan="8">
 Balance :  <?php echo $othercompanyBalanceAmount ;?>&nbsp;
 </td>
 </tr>
 
</table>

 </td>

</tr>


  

 

</table>
</div>
</div>
 

 