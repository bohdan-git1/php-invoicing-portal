<?php
include_once('smtp.php');
include_once("dbconfig.php");
require_once('tcpdf_config_alt.php');
require_once("tcpdf.php");
 
 
 
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
	$consumptionList[$v]['description'] = 'Invoice Period '.date('d M Y',strtotime($rowinv->invoicefromdate)).' - '. date('d M Y',strtotime($rowinv->invoicetodate));
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


$sqlv = "SELECT * From ws_goodservice_vendorinvoice_master $condition order by invoicecreateddate";
$resultv = mysqli_query($_SERVER['con'],$sqlv);



while($rowinv = mysqli_fetch_object($resultv)){
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
	$invoiceList[$p]['description'] =  'Invoice Period '.date('d M Y',strtotime($rowinv->invoicefromdate)).' - '. date('d M Y',strtotime($rowinv->invoicetodate));	
	$invoiceList[$p]['invoiceamount'] = $rowinv->invoiceamount;
	$invoiceList[$p]['invoiceTotalminutes'] = $rowinv->invoiceTotalminutes;
	$dateList[$rowinv->invoicecreateddate] =  $rowinv->invoicecreateddate;
 if($rowinv->paidamount>0){
		$invoicePaidList[$p]['paiddate'] = $rowinv->paiddate;
		$invoicePaidList[$p]['paidamount'] = round($rowinv->paidamount,2);
		$invoicePaidList[$p]['invoicecomments'] = $rowinv->invoicecomments;
		$dateList[$rowinv->paiddate] =  $rowinv->paiddate;
 }	
	$p = $p + 1;	

}



$sql = "SELECT * From ws_goodservice_clientinvoice_master   $condition order by invoicecreateddate";
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


  
 

<?php 
$ak = '';
$bk = '';

$companyList = array();
  $sql = "SELECT id,nameofcompany FROM company";
 $result = mysqli_query($_SERVER['con'],$sql);
while($row = mysqli_fetch_object($result)){
	$companyList[$row->id] = $row->nameofcompany;
}	

if(sizeof($commonconsumptionList)==0)
$ak = 'display:none';
 

if(sizeof($commonInvoiceList)==0)
$bk = 'display:none';
 


$invoiceName = '12334';
//define ('PDF_HEADER_LOGO', 'logoVoip.png');
define ('PDF_HEADER_LOGO', 'ECS-Logo.png');


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);

if(isset($_GET['lastInserId']))
	$lastInserId = $_GET['lastInserId'];
else
 	$lastInserId = 1;

//$pdf->SetAuthor('ECS-NET');
//$pdf->SetTitle('ECS-NET FZE');
//$pdf->SetSubject('ECS-NET FZE INTER CONNECT');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');


$Header_logo = 'ECS-Logo.png';

// set default header data
//$pdf->SetHeaderData($Header_logo, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}
 
 
// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 8, '', 'false');
$pdf->SetFontSize(8);
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
  
  
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

 // add a page
$pdf->AddPage('L');

$sqlold = "SELECT * FROM company where id=1";
$oldrec = mysqli_query($_SERVER['con'],$sqlold);
$rowold = mysqli_fetch_object($oldrec);

 $Condition='';
 
 
$currentDate = date("Ymd");
$createdDate = date("d/m/Y");
$dueDate =  date('d/m/Y', strtotime($createdDate. ' + 3 day'));
$invNo = $currentDate;

$totalchargedamount = 0;
$totalbiledduration=0;



$fromsql = "SELECT * FROM company where id=1";
$fromoldrec = mysqli_query($_SERVER['con'],$fromsql);
$fromrowoldcomp = mysqli_fetch_object($fromoldrec);

  
  $html = '
   
  <table border="0" cellpadding="2" cellspacing="2">
 
 
<tr>
<td>
 From: <br>
'.$fromrowoldcomp->nameofcompany.'<br>
'.$fromrowoldcomp->companyaddress.'<br>
'.$fromrowoldcomp->country.'<br>
Tel #: '.$fromrowoldcomp->telephone.'<br>
'.$fromrowoldcomp->email.'<br>
</td>

 
<td><h3>Statement of Accounts </h3> </td>
<td   style="text-align:left"> <img alt="CompanyLogo" src="logouploads/ECS-Logo.png" width="150px" height="70px" /> </td>
</tr>
</table>


 <table border="1" width="100%">

<tr>

<td width="50%"  style="'.$ak.'">

 

<table border="1" width="100%">
<tr>
<td style="text-align:center" colspan="6" >';

$company_id = $_GET["company_id"];
if($company_id>0)
echo

$html = $html.$companyList[$company_id];
else
$html = $html.'ECS (Our company)';

 
 
$html = $html.'</td>
</tr>
 
<tr style="text-align:center;color: #000022;background-color:#aaaaaa;">
<td width="15%" style="text-align:center">Date &nbsp;</td>
<td  width="35%" style="text-align:center">Description </td>
<td  width="15%" style="text-align:center">Invoice No </td>
<td  width="10%" style="text-align:center">Amount</td>
<td width="15%"  style="text-align:center">Paid amount </td>
<td width="10%" style="text-align:center">Balance</td>
</tr>';

 

 
$rowbalance = 0;

foreach($dateConsumpList as $datekey => $rowdate){
foreach ($newConsumptionObjectData[$datekey] as  $rowinv) {
if(isset($rowinv['invoiceamount'])){
 
$html = $html . '<tr>
<td  style="text-align:center"> '.date("d-M-Y",strtotime($datekey)).'</td>
<td style="text-align:center"> '. $rowinv["description"].'</td>
<td  style="text-align:center" >'.$rowinv["invoicenumber"].'</td>
<td style="text-align:center"> '.$rowinv["invoiceamount"].'</td>	
<td  style="text-align:center"> &nbsp;</td>';

$rowbalance = $rowbalance +  $rowinv['invoiceamount'];
$html = $html . '<td  style="text-align:center">'.$rowbalance.'</td>
</tr>';

}
if(isset($rowinv['paiddate'])){

$html = $html .'<tr>
<td width="15%"> '.date("d-M-Y",strtotime($datekey)).'</td>
<td width="35%"  style="text-align:center">  Payment - '.$rowinv["invoicecomments"].'  </td>	
<td width="15%"> &nbsp;</td>
<td width="10%"> &nbsp;</td>
<td width="15%" style="text-align:center">'.$rowinv["paidamount"].'</td>';


 $rowbalance = $rowbalance -  $rowinv['paidamount']; 
$html = $html .'<td   width="10%" style="text-align:center">'.$rowbalance.'</td>
</tr>';
 }
 }
 }

$html = $html .'</table>
 
 
   
</td>


<td width="50%"  style="'.$bk.'">

 
 

<table  border="1" width="100%"  >

<tr>
<td style="text-align:center" colspan="6">';

$company_id = $_GET['company_id'];
 $othercompanyName =  $companyList[$company_id];
$html = $html .$othercompanyName.'</td></tr>
<tr style="text-align:center;;color:#000022;background-color:#aaaaaa;">
<td width="15%"   style="text-align:center">Date &nbsp;</td>
<td width="35%"  style="text-align:center">Description </td>
<td  width="15%" style="text-align:center">Invoice No </td>
<td  width="10%" style="text-align:center">Amount</td>
<td  width="15%" style="text-align:center">Paid amount </td>
<td  width="10%"  style="text-align:center">Balance</td>
</tr>';

 

 
$rowbalance = 0;

foreach($dateList as $datekey => $rowdate){

foreach ($newinvoiceObjectData[$datekey] as  $rowinv) {
if(isset($rowinv['invoiceamount'])){

$html = $html .'<tr>
<td style="text-align:center">'.date("d-M-Y",strtotime($datekey)).'</td>
<td style="text-align:center">'.$rowinv["description"].'</td>
<td style="text-align:center">'.$rowinv["invoicenumber"].'</td>
<td style="text-align:center"> '.$rowinv["invoiceamount"].'</td>	
<td style="text-align:center" > &nbsp;</td>';
 
$rowbalance = $rowbalance +  $rowinv['invoiceamount'];

$html = $html .' 
<td  style="text-align:center">'.$rowbalance.'</td>
</tr>';

}
 
if(isset($rowinv['paiddate'])){
 
 $html = $html .'<tr>
<td width="15%" style="text-align:center">'. date("d-M-Y",strtotime($datekey)).'</td>
<td width="35%" style="text-align:center"> Payment - '.$rowinv["invoicecomments"].' </td>	
<td width="15%"> &nbsp;</td>
<td width="10%"> &nbsp;</td>
<td width="15%"  style="text-align:center">'.$rowinv["paidamount"].'</td>	';

  $rowbalance = $rowbalance -  $rowinv['paidamount']; 
$html = $html .'<td   width="10%" style="text-align:center">'.$rowbalance.'</td>
</tr>';

 }
 }
 }


 

$html = $html .'</table>
 
 </td>
 </tr>
 
 </table>


';
  

  
// ---------------------------------------------------------
 $Header_logo = '1157692848Untitled-1-04.png';
// set default header data
$pdf->SetHeaderData($Header_logo, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderTemplateAutoreset(true);
$pdf->SetAutoPageBreak(false, 0);
//$img_file = 'invbg.jpg';
//$pdf->Image($img_file, 0, 0, 1000, 1000, '', '', '', false, 1000, '', false, false, 0);

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
// Print some HTML Cells
   
// reset pointer to the last page
$pdf->lastPage();
 
 
// ---------------------------------------------------------
ob_clean();
ob_start();
//Close and output PDF document
$pdfpath = $_SERVER['DOCUMENT_ROOT']."interconnect/invoicepdfs/soasummary.pdf";
$toEmail='snmurty99@gmail.com'; 
//sendEMail($toEmail,$pdfpath);
$pdf->Output($pdfpath, 'F');
$pdf->Output('soasummary.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+
?>

