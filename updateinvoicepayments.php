<?php
    include_once("dbconfig.php");    
 
 

    //get search term
//print_r($_POST);

if(isset($_POST['action']) && $_POST['action'] == 'invoicepayments' ){
	
	$invoice_id = $_POST['invoice_id'];
	$paidamount  = $_POST['paidamount'];
	$query = "Update wsalesinvoicesmaster set paidamount = $paidamount WHERE id = $invoice_id ";
	mysqli_query($_SERVER['con'],$query);
}	
 
if(isset($_POST['action']) && $_POST['action'] == 'invoicepaymentdate' ){
	
	$invoice_id = $_POST['invoice_id'];
	$paiddate  = $_POST['paiddate'];
	$query = "Update wsalesinvoicesmaster set paiddate ='$paiddate'  WHERE id = $invoice_id ";
	mysqli_query($_SERVER['con'],$query);
}	
  

?>
