<<<<<<< HEAD
<?php
require_once('head.php');
$linkurl  = '?Go=submit';
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

 
	$linkurl  = $linkurl."&from_date=$from_date "; 

	}

	if (strlen(trim($_GET['to_date']))>0 && isset($_GET['to_date'])){

		$to_date = $_GET['to_date'];
		$condition = $condition." AND DATE(invoicecreateddate)<='$to_date' ";

		$linkurl  = $linkurl."&to_date=$to_date "; 


		$to_date = $_GET['to_date'];
	}
	
	if (strlen(trim($_GET['sortfield']))>0 && isset($_GET['sortfield'])){

		$sortfield = $_GET['sortfield'];
		//$sortByData =  " order by $sortfield ";
		
	}


}

 

session_start();
  $sql = "SELECT * From wsalesconsumptionmaster $condition order by invoicecreateddate";
$result = mysqli_query($_SERVER['con'],$sql);
$sno = 0;
$v=0;
$consumptionList = array();
$consumptionPaidList = array();
$dateConsumpList = array();
while($rowinv = mysqli_fetch_object($result)){
	$consumptionList[$v]['invoicecreateddate'] = $rowinv->invoicecreateddate;
	$consumptionList[$v]['invoicenumber'] = $rowinv->invoicenumber;
	$consumptionList[$v]['description'] =  'Invoice (Usage Period '.date('d M Y',strtotime($rowinv->invoicefromdate)).' - '. date('d M Y',strtotime($rowinv->invoicetodate)).')';
	$consumptionList[$v]['invoiceamount'] = $rowinv->invoiceamount;
	$consumptionList[$v]['invoiceTotalminutes'] = $rowinv->invoiceTotalminutes;
	$dateConsumpList[$rowinv->invoicecreateddate] =  $rowinv->invoicecreateddate;
	if($rowinv->paidamount>0){
		$consumptionPaidList[$v]['paiddate'] = $rowinv->paiddate;
		$consumptionPaidList[$v]['paidamount'] = $rowinv->paidamount;
		$consumptionPaidList[$v]['invoicecomments'] = $rowinv->invoicecomments;

		$dateConsumpList[$rowinv->paiddate] =  $rowinv->paiddate;
	}
	$v = $v + 1;
}

$commonconsumptionList = array();
$commonconsumptionList = array_merge($consumptionList, $consumptionPaidList);
//print_r($commonInvoiceList); 
$newConsumptionObjectData = array();
foreach($dateConsumpList as  $rowdate){
foreach ($commonconsumptionList as $rowinv) {

if(isset($rowinv['invoicecreateddate']) && $rowdate == $rowinv['invoicecreateddate'])
	$newConsumptionObjectData[$rowdate][] = $rowinv;
	
if(isset($rowinv['paiddate']) && $rowdate == $rowinv['paiddate'])
	$newConsumptionObjectData[$rowdate][] = $rowinv;	
 
}
}

	



$sql = "SELECT * From wsalesinvoicesmaster   $condition order by invoicecreateddate";
$result = mysqli_query($_SERVER['con'],$sql);
$sno = 0;
$dateList = array();
$invoiceList=array();
$invoicePaidList = array();
$p=0;
while($rowinv = mysqli_fetch_object($result)){
	$invoiceList[$p]['invoicecreateddate'] = $rowinv->invoicecreateddate;
	$invoiceList[$p]['invoicenumber'] = $rowinv->invoicenumber;
	$invoiceList[$p]['description'] = 'Invoice (Usage Period '.date('d M Y',strtotime($rowinv->invoicefromdate)).' - '. date('d M Y',strtotime($rowinv->invoicetodate)).')';
	$invoiceList[$p]['invoiceamount'] = $rowinv->invoiceamount;
	$invoiceList[$p]['invoiceTotalminutes'] = $rowinv->invoiceTotalminutes;
	$dateList[$rowinv->invoicecreateddate] =  $rowinv->invoicecreateddate;
 if($rowinv->paidamount>0){
		$invoicePaidList[$p]['paiddate'] = $rowinv->paiddate;
		$invoicePaidList[$p]['paidamount'] = $rowinv->paidamount;
		$invoicePaidList[$p]['invoicecomments'] = $rowinv->invoicecomments;

		$dateList[$rowinv->paiddate] =  $rowinv->paiddate;
 }	
	$p = $p + 1;	

}



$sql = "SELECT * From ws_goodservice_invoice_master   $condition order by invoicecreateddate";
$result = mysqli_query($_SERVER['con'],$sql);
$sno = 0;
 
while($rowinv = mysqli_fetch_object($result)){
	$invoiceList[$p]['invoicecreateddate'] = $rowinv->invoicecreateddate;
	$invoiceList[$p]['invoicenumber'] = $rowinv->invoicenumber;
	$invoiceList[$p]['description'] =  'Invoice (Usage Period '.date('d M Y',strtotime($rowinv->invoicefromdate)).' - '. date('d M Y',strtotime($rowinv->invoicetodate)).')';
	$invoiceList[$p]['invoiceamount'] = $rowinv->invoiceamount;
	$invoiceList[$p]['invoiceTotalminutes'] = $rowinv->invoiceTotalminutes;
	$dateList[$rowinv->invoicecreateddate] =  $rowinv->invoicecreateddate;
   	if($rowinv->paidamount>0){
		$invoicePaidList[$p]['paiddate'] = $rowinv->paiddate;
		$invoicePaidList[$p]['paidamount'] = $rowinv->paidamount;
		$invoicePaidList[$p]['invoicecomments'] = $rowinv->invoicecomments;

		$dateList[$rowinv->paiddate] =  $rowinv->paiddate;
    }	
 
	$p = $p + 1;	
}



 

//print_r($invoiceList);
//print_r($invoicePaidList);

$commonInvoiceList = array();
$commonInvoiceList = array_merge($invoiceList, $invoicePaidList);


//print_r($commonInvoiceList); 

	$newinvoiceObjectData = array();
	foreach($dateList as  $rowdate){
	foreach ($commonInvoiceList as $rowinv) {

	if(isset($rowinv['invoicecreateddate']) && $rowdate == $rowinv['invoicecreateddate'])
		$newinvoiceObjectData[$rowdate][] = $rowinv;
		
	if(isset($rowinv['paiddate']) && $rowdate == $rowinv['paiddate'])
		$newinvoiceObjectData[$rowdate][] = $rowinv;	
	 
	}
	}

//print_r($newObjectData);
//exit;
 


//echo "<pre>"; print_r($invoiceList); echo "</pre>";

 
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">


<?php
include_once("headermenu.php");
?>
<div class="container">
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

 <a href="<?php echo 'soasummarypdf.php'.$linkurl;?>"> <img src="geneatepdf.png" width="20" height="20"   title="Generater Pdf"/> </a> &nbsp;
 
</div>

</div>

</form>

<?php 
$ak = '';
$bk = '';

if(sizeof($commonconsumptionList)==0)
$ak = 'display:none';
 

if(sizeof($commonInvoiceList)==0)
$bk = 'display:none';
 

?> 


<div class="row"> &nbsp;</div>
<div class="row">
 <div class="table-responsive">       
 
 
 <table border="1" class="table">

<tr>

<td style="<?php echo $ak;?>">

 

<table border="1" class="table">
<tr>
<td style="text-align:center" colspan="6" >
<?php
$company_id = $_GET['company_id'];
if($company_id>0)
echo $companyList[$company_id];
else
echo "ECS (Our company)";
?> 

</td>
</tr>
 
<tr style="text-align:center">
<td style="text-align:center">Date &nbsp;</td>
<td style="text-align:center">Description </td>
<td style="text-align:center">Invoice No </td>
<td style="text-align:center">Amount</td>
<td style="text-align:center">Paid amount </td>
<td style="text-align:center">Balance</td>
</tr>

<?php

 
$rowbalance = 0;

foreach($dateConsumpList as $datekey => $rowdate){
foreach ($newConsumptionObjectData[$datekey] as  $rowinv) {
if(isset($rowinv['invoiceamount'])){
?>
<tr>
<td  style="text-align:center"> <?php echo  date("d-M-Y",strtotime($datekey));?></td>
<td style="text-align:center"> <?php echo $rowinv['description'];?></td>
<td  style="text-align:center" ><?php echo $rowinv['invoicenumber'];?> </td>
<td style="text-align:center"> <?php echo  $rowinv['invoiceamount'];?></td>	
<td  style="text-align:center"> &nbsp;</td>
<?php
$rowbalance = $rowbalance +  $rowinv['invoiceamount'];
?>
<td  style="text-align:center"><?php echo $rowbalance;?></td>
</tr>
<?php
}
?>
<?php
if(isset($rowinv['paiddate'])){
?>
<tr>
<td> <?php echo  date("d-M-Y",strtotime($datekey)); ?></td>
<td style="text-align:center"> Payment - <?php echo $rowinv['invoicecomments']; ?> </td>	
<td> &nbsp;</td>
<td> &nbsp;</td>
<td style="text-align:center"><?php echo  $rowinv['paidamount'];?></td>	
<?php $rowbalance = $rowbalance -  $rowinv['paidamount']; ?>

<td  style="text-align:center"><?php echo $rowbalance;?></td>
</tr>
<?php

 }
 }
 }


?>

 
</table>
 
 
   
</td>


<td  style="<?php echo $bk;?>">

 
 

<table  border="1" class="table">

<tr>
<td style="text-align:center" colspan="6">
<?php
$company_id = $_GET['company_id'];
 echo $companyList[$company_id];
?> 
</td>
</tr>

<tr style="text-align:center">
<td  style="text-align:center">Date &nbsp;</td>
<td  style="text-align:center">Description </td>
<td  style="text-align:center">Invoice No </td>
<td  style="text-align:center">Amount</td>
<td  style="text-align:center">Paid amount </td>
<td  style="text-align:center">Balance</td>
</tr>

<?php

 
$rowbalance = 0;

foreach($dateList as $datekey => $rowdate){

foreach ($newinvoiceObjectData[$datekey] as  $rowinv) {
if(isset($rowinv['invoiceamount'])){
?>
<tr>
<td style="text-align:center"> <?php  echo  date("d-M-Y",strtotime($datekey)); ?></td>
<td style="text-align:center"> <?php echo $rowinv['description'];?></td>
<td style="text-align:center"><?php echo $rowinv['invoicenumber'];?> </td>
<td style="text-align:center"> <?php echo  $rowinv['invoiceamount'];?></td>	
<td style="text-align:center" > &nbsp;</td>
<?php
$rowbalance = $rowbalance +  $rowinv['invoiceamount'];
?>
<td  style="text-align:center"><?php echo $rowbalance;?></td>
</tr>
<?php
}
?>
<?php
if(isset($rowinv['paiddate'])){
?>
<tr>
<td style="text-align:center"> <?php  echo  date("d-M-Y",strtotime($datekey));  ?></td>
<td style="text-align:center">  Payment - <?php echo $rowinv['invoicecomments']; ?>  </td>	
<td> &nbsp;</td>
<td> &nbsp;</td>
<td style="text-align:center"><?php echo  $rowinv['paidamount'];?></td>	
<?php $rowbalance = $rowbalance -  $rowinv['paidamount']; ?>

<td  style="text-align:center"><?php echo $rowbalance;?></td>
</tr>
<?php

 }
 }
 }


?>

 
</table>
 
 </td>
 </tr>
 
 </table>
 
</div>
</div>
</div>
=======
<?php
require_once('head.php');
$linkurl  = '?Go=submit';
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

 
	$linkurl  = $linkurl."&from_date=$from_date "; 

	}

	if (strlen(trim($_GET['to_date']))>0 && isset($_GET['to_date'])){

		$to_date = $_GET['to_date'];
		$condition = $condition." AND DATE(invoicecreateddate)<='$to_date' ";

		$linkurl  = $linkurl."&to_date=$to_date "; 


		$to_date = $_GET['to_date'];
	}
	
	if (strlen(trim($_GET['sortfield']))>0 && isset($_GET['sortfield'])){

		$sortfield = $_GET['sortfield'];
		//$sortByData =  " order by $sortfield ";
		
	}


}

 

session_start();
  $sql = "SELECT * From wsalesconsumptionmaster $condition order by invoicecreateddate";
$result = mysqli_query($_SERVER['con'],$sql);
$sno = 0;
$v=0;
$consumptionList = array();
$consumptionPaidList = array();
$dateConsumpList = array();
while($rowinv = mysqli_fetch_object($result)){
	$consumptionList[$v]['invoicecreateddate'] = $rowinv->invoicecreateddate;
	$consumptionList[$v]['invoicenumber'] = $rowinv->invoicenumber;
	$consumptionList[$v]['description'] =  'Invoice (Usage Period '.date('d M Y',strtotime($rowinv->invoicefromdate)).' - '. date('d M Y',strtotime($rowinv->invoicetodate)).')';
	$consumptionList[$v]['invoiceamount'] = $rowinv->invoiceamount;
	$consumptionList[$v]['invoiceTotalminutes'] = $rowinv->invoiceTotalminutes;
	$dateConsumpList[$rowinv->invoicecreateddate] =  $rowinv->invoicecreateddate;
	if($rowinv->paidamount>0){
		$consumptionPaidList[$v]['paiddate'] = $rowinv->paiddate;
		$consumptionPaidList[$v]['paidamount'] = $rowinv->paidamount;
		$consumptionPaidList[$v]['invoicecomments'] = $rowinv->invoicecomments;

		$dateConsumpList[$rowinv->paiddate] =  $rowinv->paiddate;
	}
	$v = $v + 1;
}

$commonconsumptionList = array();
$commonconsumptionList = array_merge($consumptionList, $consumptionPaidList);
//print_r($commonInvoiceList); 
$newConsumptionObjectData = array();
foreach($dateConsumpList as  $rowdate){
foreach ($commonconsumptionList as $rowinv) {

if(isset($rowinv['invoicecreateddate']) && $rowdate == $rowinv['invoicecreateddate'])
	$newConsumptionObjectData[$rowdate][] = $rowinv;
	
if(isset($rowinv['paiddate']) && $rowdate == $rowinv['paiddate'])
	$newConsumptionObjectData[$rowdate][] = $rowinv;	
 
}
}

	



$sql = "SELECT * From wsalesinvoicesmaster   $condition order by invoicecreateddate";
$result = mysqli_query($_SERVER['con'],$sql);
$sno = 0;
$dateList = array();
$invoiceList=array();
$invoicePaidList = array();
$p=0;
while($rowinv = mysqli_fetch_object($result)){
	$invoiceList[$p]['invoicecreateddate'] = $rowinv->invoicecreateddate;
	$invoiceList[$p]['invoicenumber'] = $rowinv->invoicenumber;
	$invoiceList[$p]['description'] = 'Invoice (Usage Period '.date('d M Y',strtotime($rowinv->invoicefromdate)).' - '. date('d M Y',strtotime($rowinv->invoicetodate)).')';
	$invoiceList[$p]['invoiceamount'] = $rowinv->invoiceamount;
	$invoiceList[$p]['invoiceTotalminutes'] = $rowinv->invoiceTotalminutes;
	$dateList[$rowinv->invoicecreateddate] =  $rowinv->invoicecreateddate;
 if($rowinv->paidamount>0){
		$invoicePaidList[$p]['paiddate'] = $rowinv->paiddate;
		$invoicePaidList[$p]['paidamount'] = $rowinv->paidamount;
		$invoicePaidList[$p]['invoicecomments'] = $rowinv->invoicecomments;

		$dateList[$rowinv->paiddate] =  $rowinv->paiddate;
 }	
	$p = $p + 1;	

}



$sql = "SELECT * From ws_goodservice_invoice_master   $condition order by invoicecreateddate";
$result = mysqli_query($_SERVER['con'],$sql);
$sno = 0;
 
while($rowinv = mysqli_fetch_object($result)){
	$invoiceList[$p]['invoicecreateddate'] = $rowinv->invoicecreateddate;
	$invoiceList[$p]['invoicenumber'] = $rowinv->invoicenumber;
	$invoiceList[$p]['description'] =  'Invoice (Usage Period '.date('d M Y',strtotime($rowinv->invoicefromdate)).' - '. date('d M Y',strtotime($rowinv->invoicetodate)).')';
	$invoiceList[$p]['invoiceamount'] = $rowinv->invoiceamount;
	$invoiceList[$p]['invoiceTotalminutes'] = $rowinv->invoiceTotalminutes;
	$dateList[$rowinv->invoicecreateddate] =  $rowinv->invoicecreateddate;
   	if($rowinv->paidamount>0){
		$invoicePaidList[$p]['paiddate'] = $rowinv->paiddate;
		$invoicePaidList[$p]['paidamount'] = $rowinv->paidamount;
		$invoicePaidList[$p]['invoicecomments'] = $rowinv->invoicecomments;

		$dateList[$rowinv->paiddate] =  $rowinv->paiddate;
    }	
 
	$p = $p + 1;	
}



 

//print_r($invoiceList);
//print_r($invoicePaidList);

$commonInvoiceList = array();
$commonInvoiceList = array_merge($invoiceList, $invoicePaidList);


//print_r($commonInvoiceList); 

	$newinvoiceObjectData = array();
	foreach($dateList as  $rowdate){
	foreach ($commonInvoiceList as $rowinv) {

	if(isset($rowinv['invoicecreateddate']) && $rowdate == $rowinv['invoicecreateddate'])
		$newinvoiceObjectData[$rowdate][] = $rowinv;
		
	if(isset($rowinv['paiddate']) && $rowdate == $rowinv['paiddate'])
		$newinvoiceObjectData[$rowdate][] = $rowinv;	
	 
	}
	}

//print_r($newObjectData);
//exit;
 


//echo "<pre>"; print_r($invoiceList); echo "</pre>";

 
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">


<?php
include_once("headermenu.php");
?>
<div class="container">
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

 <a href="<?php echo 'soasummarypdf.php'.$linkurl;?>"> <img src="geneatepdf.png" width="20" height="20"   title="Generater Pdf"/> </a> &nbsp;
 
</div>

</div>

</form>

<?php 
$ak = '';
$bk = '';

if(sizeof($commonconsumptionList)==0)
$ak = 'display:none';
 

if(sizeof($commonInvoiceList)==0)
$bk = 'display:none';
 

?> 


<div class="row"> &nbsp;</div>
<div class="row">
 <div class="table-responsive">       
 
 
 <table border="1" class="table">

<tr>

<td style="<?php echo $ak;?>">

 

<table border="1" class="table">
<tr>
<td style="text-align:center" colspan="6" >
<?php
$company_id = $_GET['company_id'];
if($company_id>0)
echo $companyList[$company_id];
else
echo "ECS (Our company)";
?> 

</td>
</tr>
 
<tr style="text-align:center">
<td style="text-align:center">Date &nbsp;</td>
<td style="text-align:center">Description </td>
<td style="text-align:center">Invoice No </td>
<td style="text-align:center">Amount</td>
<td style="text-align:center">Paid amount </td>
<td style="text-align:center">Balance</td>
</tr>

<?php

 
$rowbalance = 0;

foreach($dateConsumpList as $datekey => $rowdate){
foreach ($newConsumptionObjectData[$datekey] as  $rowinv) {
if(isset($rowinv['invoiceamount'])){
?>
<tr>
<td  style="text-align:center"> <?php echo  date("d-M-Y",strtotime($datekey));?></td>
<td style="text-align:center"> <?php echo $rowinv['description'];?></td>
<td  style="text-align:center" ><?php echo $rowinv['invoicenumber'];?> </td>
<td style="text-align:center"> <?php echo  $rowinv['invoiceamount'];?></td>	
<td  style="text-align:center"> &nbsp;</td>
<?php
$rowbalance = $rowbalance +  $rowinv['invoiceamount'];
?>
<td  style="text-align:center"><?php echo $rowbalance;?></td>
</tr>
<?php
}
?>
<?php
if(isset($rowinv['paiddate'])){
?>
<tr>
<td> <?php echo  date("d-M-Y",strtotime($datekey)); ?></td>
<td style="text-align:center"> Payment - <?php echo $rowinv['invoicecomments']; ?> </td>	
<td> &nbsp;</td>
<td> &nbsp;</td>
<td style="text-align:center"><?php echo  $rowinv['paidamount'];?></td>	
<?php $rowbalance = $rowbalance -  $rowinv['paidamount']; ?>

<td  style="text-align:center"><?php echo $rowbalance;?></td>
</tr>
<?php

 }
 }
 }


?>

 
</table>
 
 
   
</td>


<td  style="<?php echo $bk;?>">

 
 

<table  border="1" class="table">

<tr>
<td style="text-align:center" colspan="6">
<?php
$company_id = $_GET['company_id'];
 echo $companyList[$company_id];
?> 
</td>
</tr>

<tr style="text-align:center">
<td  style="text-align:center">Date &nbsp;</td>
<td  style="text-align:center">Description </td>
<td  style="text-align:center">Invoice No </td>
<td  style="text-align:center">Amount</td>
<td  style="text-align:center">Paid amount </td>
<td  style="text-align:center">Balance</td>
</tr>

<?php

 
$rowbalance = 0;

foreach($dateList as $datekey => $rowdate){

foreach ($newinvoiceObjectData[$datekey] as  $rowinv) {
if(isset($rowinv['invoiceamount'])){
?>
<tr>
<td style="text-align:center"> <?php  echo  date("d-M-Y",strtotime($datekey)); ?></td>
<td style="text-align:center"> <?php echo $rowinv['description'];?></td>
<td style="text-align:center"><?php echo $rowinv['invoicenumber'];?> </td>
<td style="text-align:center"> <?php echo  $rowinv['invoiceamount'];?></td>	
<td style="text-align:center" > &nbsp;</td>
<?php
$rowbalance = $rowbalance +  $rowinv['invoiceamount'];
?>
<td  style="text-align:center"><?php echo $rowbalance;?></td>
</tr>
<?php
}
?>
<?php
if(isset($rowinv['paiddate'])){
?>
<tr>
<td style="text-align:center"> <?php  echo  date("d-M-Y",strtotime($datekey));  ?></td>
<td style="text-align:center">  Payment - <?php echo $rowinv['invoicecomments']; ?>  </td>	
<td> &nbsp;</td>
<td> &nbsp;</td>
<td style="text-align:center"><?php echo  $rowinv['paidamount'];?></td>	
<?php $rowbalance = $rowbalance -  $rowinv['paidamount']; ?>

<td  style="text-align:center"><?php echo $rowbalance;?></td>
</tr>
<?php

 }
 }
 }


?>

 
</table>
 
 </td>
 </tr>
 
 </table>
 
</div>
</div>
</div>
>>>>>>> 635553fc367f69842ceb5b22f8e2540c730c23fa
