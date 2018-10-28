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

  
 

//require_once('header_logged_in.php');
 ?>
  
 <div class="container">

<h1>Invoice History </h1>


<form role="form" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<div class="row">

 <div class="col-md-3">

  <label>Wholeseller</label>
 
<select  name="wholeseller_id" required >
<option value="">Select Wholeseller</option>
<?php

//  $sql = "SELECT id,accountname FROM accountusers Where accountgroup_id=62";

  $sql = "SELECT distinct account_id from  wholesaleinvoicebasedata";
 $result = mysqli_query($_SERVER['con'],$sql);
while($row = mysqli_fetch_object($result)){
?>
<option value="<?php echo $row->account_id;?>" <?php if(isset($_GET['wholeseller_id']) && $_GET['wholeseller_id'] == $row->account_id) echo 'selected=selected';?> ><?php echo $row->account_id;?></option>
<?php  
} 

?> 
</select> 
</div>

  
<div class="col-md-4">
<label>From Date</label> 
<input type="text" id="from_date"   name="from_date"  value="<?php echo $_GET['from_date'];?>" placeholder="Please select from  date"   /> 
</div>

<div class="col-md-5">
<label>To Date</label> 
<input type="text" id="to_date" name="to_date"  value="<?php echo $_GET['to_date'];?>" placeholder="Please select to  date"   /> 

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
	if( isset($_GET['wholeseller_id']) )
	{	
		$wholeseller_id = $_GET['wholeseller_id'];
		$Condition = " AND account_id like '$wholeseller_id' ";
	}

	if( isset($_GET['from_date']) && strlen($_GET['from_date'])>0 )
	{	
		$fromDate = $_GET['from_date'];
		$Condition  = $Condition." AND date(fromdate) = '$fromDate' ";
	}

	if( isset($_GET['to_date']) && strlen($_GET['to_date'])>0 )
	{	
		$todate = $_GET['to_date'];
		$Condition  = $Condition." AND date(todate) = '$todate' ";
	}

 		 	$sql = "SELECT * from wholesaleinvoicebasedata WHERE 1= 1 $Condition";
 	 
 
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
	<td> <input type="submit" value="Generate Payment request" name="generatepaymentrequest" /> </td> 
	</tr>
<?php
	}
?>
 <tr> <td colspan='6'> <input type="submit" value="Generate Payment request" name="generatepaymentrequest" /> </td> </tr>
 

 </table>
</div>
</div>
