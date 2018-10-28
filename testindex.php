<?php
include_once("head.php"); 
//include_once("logincheck.php");
include_once("dbconfig.php");

if(!isset($_GET['items_per_page']))
$_GET['items_per_page'] = 25;
$reseller_id = $_SESSION['reseller_id'];
$usedvoucher = array('0'=>'No','1'=>'Yes');
?>
<div class="container">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
   $(function() {
    $( "#assigned_date" ).datepicker({
      showOn: "button",
      buttonImage: "images/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select assign date",
      dateFormat: "yy-m-d"

    });
	 

  });
  </script>
   
  
<h1> Manage Vouchers  </h1>

<script>
function checkdelte(id){
//alert(id);
 
if (confirm('Are you sure you want to Remove ?')) {
    window.location.href = "managevouchers.php?action=delete&id="+id;
    // Save it!
} 

}
</script>

<form role="form" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div class="row">
<?php
 if(isset($_SESSION['SuccessMsg'])){
?>
<div class="alert alert-success">
  <strong><?php echo $_SESSION['SuccessMsg']; ?> !</strong> 
</div>
<?php 
unset($_SESSION['SuccessMsg']);
}
?>
</div>
 

<div class="row">

<?php

$reseller_id = $_SESSION['reseller_id'];
 
$totalvouchers=0;
$sqlav = "SELECT count(id) as totalvouchers FROM mastervouchers WHERE   voucher_assigned = 1 AND reseller_id = $reseller_id";
$oldrecav = mysqli_query($_SERVER['con'],$sqlav);
$rowoldav = mysqli_fetch_object($oldrecav);
$totalvouchers = $rowoldav->totalvouchers;

$Rechargesdone=0;
$sqlrd= "SELECT count(id) as Rechargesdone FROM mastervouchers WHERE    voucher_assigned = 1 AND voucher_status=1 AND reseller_id = $reseller_id";
$oldrecrd = mysqli_query($_SERVER['con'],$sqlrd);
$rowoldrd = mysqli_fetch_object($oldrecrd);
$Rechargesdone = $rowoldrd->Rechargesdone;
 
$RemainingVouchers = $totalvouchers - $Rechargesdone;

?>


<div class="col-md-2">
 Total Vouchers : <?php echo $totalvouchers;?>
</div>

<div class="col-md-2">
Recharges done  : <?php echo $Rechargesdone; ?>
</div>

<div class="col-md-4">
Available Vouchers : <?php echo $RemainingVouchers; ?>
</div>
 <div class="col-md-2"> 
   <a href="index.php"> Back to home Page </a> 
</div>

</div>



<div class="row"> &nbsp;</div>

<div class="row">
 
 

<div class="col-md-2">
<label>Book Value </label>
<select class="form-control" name="book_value" >
<option value="">Select Book Value</option>
<?php
 $sql = "SELECT distinct book_value from mastervouchers ";
 $result = mysqli_query($_SERVER['con'],$sql);
while($row = mysqli_fetch_object($result)){
?>
<option value="<?php echo $row->book_value;?>" <?php if(isset($_GET['book_value']) && strlen(trim($_GET['book_value']))>0 && $_GET['book_value'] == $row->book_value) echo 'selected=selected';?> ><?php echo $row->book_value;?></option>
<?php  
} 

?> 
</select> 

</div>
 

<div class="col-md-2">
<label>Voucher Status</label>
<select class="form-control" name="voucher_status">
<option value="">Select Voucher Status</option>
<option value="0" <?php if(isset($_GET['voucher_status']) && strlen(trim($_GET['voucher_status']))>0  && $_GET['voucher_status'] == 0) echo 'selected=selected';?> >Un Used </option>
<option value="1" <?php if(isset($_GET['voucher_status']) && strlen(trim($_GET['voucher_status']))>0  && $_GET['voucher_status'] == 1) echo 'selected=selected';?> >Used</option>
 
</select> 
 
</div>

<div class="col-md-2">
<label>Assigned Date</label>
<input type="text" id="assigned_date" name="assigned_date"  placeholder="Please select assign date"> 
</div>


<div class="col-md-2">
<label>Voucher Number</label>
<input type="text" id="voucher_id" name="voucher_id"  placeholder="Please Voucher no"> 
</div>


<br/>

<input type="submit" name="Go" value="submit" />

</div> 

<div class="row"> &nbsp;</div>

<div class="row">
<div class="table-responsive">
   
<?php  
 $_PHP_SELF = $_SERVER['PHP_SELF'];
 
//echo "<pre>"; print_r($_GET); 


$sqlRedeemed= "SELECT id,description FROM accountusers   ORDER BY createddate ";  
$rs_resultRedeemed = mysqli_query($_SERVER['con'],$sqlRedeemed);  


$RedeemedusersList = array();
$sql = "SELECT id,description  from accountusers";
$result = mysqli_query($_SERVER['con'],$sql);
while($row = mysqli_fetch_object($result)){
$RedeemedusersList[$row->id] = $row->description;
}


$condition = array();
$condition = " WHERE  1=1 AND voucher_assigned = 1 AND  reseller_id = $reseller_id ";
$linkurl = "";

if (isset($_GET['Go'])){
 

	$linkurl  = $linkurl."&Go=submit"; 



	 

	if (strlen(trim($_GET['book_value']))>0 && isset($_GET['book_value'])){
	$book_value = $_GET['book_value'];
	$condition = $condition." AND book_value = $book_value";
	$linkurl  = $linkurl."&book_value=$book_value"; 
	}	

 

	if (strlen(trim($_GET['assigned_date']))>0 && isset($_GET['assigned_date'])){
	$assigned_date = $_GET['assigned_date'];
	$condition = $condition." AND DATE(assigned_date)='$assigned_date' ";
	$linkurl  = $linkurl."&assigned_date=". urlencode($assigned_date);
	}

	if (strlen($_GET['items_per_page'])>0 && isset($_GET['items_per_page'])){
	 $items_per_page = $_GET['items_per_page'];
	 $linkurl  = $linkurl."&items_per_page=".$items_per_page;
	}


	if (strlen($_GET['voucher_status'])>0 && isset($_GET['voucher_status']) ){
		$voucher_status = $_GET['voucher_status'];
		$condition = $condition." AND voucher_status = $voucher_status";
		$linkurl  = $linkurl."&voucher_status=".$voucher_status; 
	}


	if (strlen(trim($_GET['voucher_id']))>0 && isset($_GET['voucher_id'])){
	$voucher_id = $_GET['voucher_id'];
	$condition = $condition." AND voucher_id = $voucher_id ";
	$linkurl  = $linkurl."&&voucher_id=$voucher_id";
	
 	}
 

//echo $linkurl;

}

 if(isset($_GET['items_per_page']) && $_GET['items_per_page']>0 )
	$limit = $_GET['items_per_page']; 
else
	$limit = 25; 


if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
$sql = "SELECT * FROM mastervouchers  $condition ORDER BY assigned_date,voucher_id DESC LIMIT $start_from, $limit ";  
$rs_result = mysqli_query($_SERVER['con'],$sql);  
?>  
<table class="table table-bordered table-striped" border="1">  
<thead>  
<tr>   
<th>S.No</th>
<th>Voucher Number</th>
<th>Book Value</th>
<th>AssignedDate</th>
<th>Used</th>
<th>Redemption date</th>		
<th>Redeemed to</th>		
<th> &nbsp;</th>
<th> &nbsp; </th>
</tr>   
<thead>  
<tbody>  
<?php  
$k=1;
while ($row = mysqli_fetch_object($rs_result)) {  
?>  
<tr>
<td><?php echo $k;?></td>
<td><?php echo $row->voucher_id;?></td>
<td><?php echo $row->book_value;?></td>
<td><?php echo $row->assigned_date;?></td>
<td><?php echo $usedvoucher[$row->voucher_status];?></td>
<td><?php echo $row->redemption_date;?></td> 
<td><?php echo $RedeemedusersList[$row->redeemed_to];?></td>


</tr>
 
<?php
$k = $k + 1;
}
?>  
</tbody>  
</table> 

<div class="row">


<div class="col-md-6">

<?php  
  $sql = "SELECT COUNT(id) FROM mastervouchers $condition ";  
$rs_result = mysqli_query($_SERVER['con'],$sql);  
$row = mysqli_fetch_row($rs_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit);  
$pagLink = "<nav>  <ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {  
		if($i==$_GET['page'])
		$scls='active';
		else
		$scls='disabled';
           
			 
		 	 $newlinkurl  = $_PHP_SELF."?page=$i".$linkurl;
  
		 	
			
			 
			 $pagLink .= " <li class='".$scls."'> <a href='".$newlinkurl."'>".$i."</a> </li>";
			 
};  
echo $pagLink . "</ul> </nav>";  

?> 
 
</div>


<div class="col-md-2">
<label>Total Records </label> : <?php echo $total_records; ?> 
</div>
 

<div class="col-md-2">
<label>Items Per Page</label>
<select   name="items_per_page">
<option value="">Select Items per Page</option>
<option value="25" <?php if(isset($_GET['items_per_page']) && $_GET['items_per_page'] == 25) echo 'selected=selected';?> >25</option>
<option value="100" <?php if(isset($_GET['items_per_page']) && $_GET['items_per_page'] == 100) echo 'selected=selected';?> >100</option>
<option value="200" <?php if(isset($_GET['items_per_page']) && $_GET['items_per_page'] == 200) echo 'selected=selected';?> >200</option>
<option value="500" <?php if(isset($_GET['items_per_page']) && $_GET['items_per_page'] == 500) echo 'selected=selected';?> >500</option>
</select> 
</div>

<div class="col-md-2">
<input type="submit" name="Go" value="submit" />
</div>


</div>
</div>
</div> 
</form>
<?php
mysqli_close($_SERVER['con']);
?>                    
<body>