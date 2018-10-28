<?php
include_once('smtp.php');
include_once("dbconfig.php");
require_once('tcpdf_config_alt.php');
require_once("tcpdf.php");

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



$prefixmasterList = array();
$sqlp = "SELECT * FROM prefixmaster  ";
$resultp = mysqli_query($_SERVER['con'],$sqlp);
while($rowp = mysqli_fetch_object($resultp)){
 $prefixmasterList[$rowp->prefix] = $rowp->description;
}

$currentid = $_GET['id'];

$sqlinv = "SELECT * FROM  wsalesconsumptionmaster where id=$currentid";
$recinv = mysqli_query($_SERVER['con'],$sqlinv);
$rowinv = mysqli_fetch_object($recinv);
$invmasterId = $rowinv->id;


$invoiceName = $rowinv->invoicenumber;
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
$pdf->SetFont('times', '', 13, '', 'false');
$pdf->SetFontSize(13);
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
  
  
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

 // add a page
$pdf->AddPage();
//$pdf->Image('paper.gif', 0, 0, 1000, 1000);
$company_id = $rowinv->company_id;
$sqlold = "SELECT * FROM company where id=$company_id";
$oldrec = mysqli_query($_SERVER['con'],$sqlold);
$rownewcompany = mysqli_fetch_object($oldrec);

 $Condition='';
 
 
$currentDate = date("Ymd");
$createdDate = date("d/m/Y");
$dueDate =  date('d/m/Y', strtotime($createdDate. ' + 3 day'));
$invNo = $currentDate;

$totalchargedamount = 0;
$totalbiledduration=0;
	
  
  $html = '
 <body>
  <table border="0" cellpadding="2" cellspacing="2">
 
<tr>
<td>
From: <br>
'.$rownewcompany->nameofcompany.'<br>
'.$rownewcompany->companyaddress.'<br>
'.$rownewcompany->country.'<br>
'.$rownewcompany->mobile.'<br>
'.$rownewcompany->email.'<br>
</td>
 
<td  style="font-size:200%;color:#ff0000;"> INVOICE </td>
<td width="150px" style="text-align:right"> <img alt="CompanyLogo" src="logouploads/ECS-Logo.png" width="150px" height="100px" /> </td>
</tr>
</table>

<table>
<tr>
<td>&nbsp;</td>
<td width="35%">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>Inv#.</td>
<td style="text-align:right">'.$rowinv->invoicenumber.' </td>
<td>&nbsp;</td>
</tr>


<tr>
<td>&nbsp;</td> 
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>Create Date</td>
<td style="text-align:right">'.date("d/m/Y",strtotime($rowinv->invoicecreateddate)).' </td> 
<td>&nbsp;</td>
</tr>

<tr> 
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>Payment Mode </td>
<td style="text-align:right">'.$rowinv->paymentmode.'</td>
<td>&nbsp;</td>
</tr>

</table>

<p> <br> </p>
<table>

  <tr style="background-color:#000000;color:#FFFFFF;text-align:center;">
		    
		    <td style="border-bottom:solid 5px #ff0000;height:20px;">Prefix</td>
		    <td style="border-bottom:solid 5px #ff0000;" width="35%">Description</td>
		    <td style="border-bottom:solid 5px #ff0000;">Quantity</td>
			<td style="border-bottom:solid 5px #ff0000;">Price</td>
		    <td style="border-bottom:solid 5px #ff0000;">Amount</td>
			<td border="0" style="border-right:1px solid #FFFFFF;background-color:#FFFFFF;">&nbsp;</td>
			

 </tr> 
   ';


 	 $htmlsub='';
	
 $sqlchild = "SELECT * from wsalesconsumptionchild WHERE invmasterid = $invmasterId";
 	 
 $getTotalTime = 0; 
 $totalchargedamount=0;
 $totalbiledduration =0;
 $resultChild = mysqli_query($_SERVER['con'],$sqlchild);
 $rk=0;
while($rowChild = mysqli_fetch_object($resultChild)){
	//print_r($row);

	 if ($rk%2==0)
		$rdt = '<tr style="background-color:#CCC;">';
	 else
		$rdt = '<tr style="background-color:#FFF;">';
	$rk = $rk + 1 ;
 $htmlsubtxt = $rdt.'
    <td style="text-align:center">'.$rowChild->prefix.'</td>			
	<td>'.$rowChild->Description.'</td>
	<td style="text-align:right">'.$rowChild->Duration_min.'.</td>
	<td style="text-align:right">'.$rowChild->price_per_1_min.'</td>
	<td style="text-align:right">'.$rowChild->Charged_Amount.'  </td>  
	<td style="background-color:#FFFFFF;border-right:1px solid #FFFFFF;color:red;text-align:left;"> USD</td>  
	</tr>';
	 $htmlsub =  $htmlsub.$htmlsubtxt;  

	// $getTotalTime +=  addDurationAsSeconds($rowChild->Duration_min);
	 //	 $totalchargedamount = $totalchargedamount + $rowChild->Charged_Amount;
	  
	  $fromDate = date("d-m-Y",strtotime($rowChild->fromdate));
	   $toDate = date("d-m-Y",strtotime($rowChild->todate));
	  	 
		 
	}
	
	
	
	 


$html = $html.$htmlsub;

$html = $html. '
<tr>
	
	<td style="border-bottom:2px solid #FF0000;" width="35%">&nbsp;</td>
	<td style="border-bottom:2px solid #FF0000;"> &nbsp;</td>	 
	<td style="border-bottom:2px solid #FF0000;">&nbsp;</td>	 
	<td style="border-bottom:2px solid #FF0000;">&nbsp;</td>
	
	<td>&nbsp; </td>
 </tr>
 
 </table>
 <p> <br> </p>
 
 <table>
 <tr>
	<td width="35%">&nbsp;</td>
	<td>Total Minutes:</td>	 
	<td><span style="text-align:right"> '.$rowinv->invoiceTotalminutes.'  </span> </td>
	<td style="text-align:right">  Total : </td>
	<td><span style="text-align:right">'.$rowinv->invoiceamount.'</span> </td>
	<td> <span style="color:red">USD </span>  </td>
 </tr>
 
 <tr>
	<td width="35%">&nbsp;</td>
	<td> &nbsp; </td>
	<td> &nbsp; </td>
	<td style="text-align:right"> Outstanding : </td>
	<td  style="text-align:right">0.00</td>
	<td> <span style="color:red">USD </span>  </td>
 </tr>
 
 <tr>
	<td width="35%">&nbsp;</td>
	<td>&nbsp;</td>	 
	<td>&nbsp;</td>	 
	<td style="text-align:right"> Subtotal : </td>
	<td style="text-align:right">'.$rowinv->invoicesubtotal.'</td>
	<td> <span style="color:red">USD </span>  </td>
 </tr>
 
 </table>
 <p> <br> </p>
 

 <table Style="background-color:#FFFFFF;border-top:1px solid; border-bottom:2px solid">
 <tr>
  <td> This invoice is for the period of '.$rowinv->invoicefromdate.' to '.$rowinv->invoicetodate.'. </td>
 </tr>
 
 <tr>
 <td> '.$rowinv->invoicebilleddesc.' </td>
 </tr>
 
 <tr>
 <td> '.$rowinv->invoicedisputeemail.' </td>
 </tr>
 
 <tr>
 <td> !!!!!!!!!!!!!Thank you for your business!!!!!!!!!!!!!!  </td>
 </tr>
</table>

 </body>

 
';

 //echo $html;

 
 
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
$pdfpath = $_SERVER['DOCUMENT_ROOT']."interconnect/consumptionpdfs/".$rowinv->pdffilename;
$toEmail='snmurty99@gmail.com'; 
//sendEMail($toEmail,$pdfpath);
$pdf->Output($pdfpath, 'F');
$pdf->Output($rowinv->pdffilename, 'I');
//============================================================+
// END OF FILE
//============================================================+
?>
