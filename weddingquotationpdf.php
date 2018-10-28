<?php
include_once('smtp.php');
include_once("dbconfig.php");
require_once('tcpdf_config_alt.php');
require_once("tcpdf.php");
 
 
 

$invoiceName = '12334';
define ('PDF_HEADER_LOGO', 'logoVoip.png');


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set document information
$pdf->SetCreator(PDF_CREATOR);

if(isset($_GET['lastInserId']))
	$lastInserId = $_GET['lastInserId'];
else
 	$lastInserId = 1;

 

$Header_logo = 'ECS-Logo.png';

 
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
$pdf->SetFont('times', '', 12, '', 'false');
$pdf->SetFontSize(12);
  
  
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
	
 $html =  '
 
 <table  border="1" width="100%" >
 <tr>
 <td  width="60%">
<table border="1" width="100%" cellspacing="2" cellpadding="2">
 <tr> <td colspan="4" width="100%" > Wedding Quotation Form for Shilston </td> </tr>
 <tr> <td colspan="4" width="100%" > ***** and ***** </td> </tr>
 <tr> <td colspan="4" width="100%" > Saturday in September 2017 </td> </tr>
 
<tr> 
<td colspan="4" width="100%">
  Expected number of guests: 25 adults and 20 chldren 5 for wedding reception and evening party.
  </td>
 </tr>
 
 <tr>
<td width="55%"> Chldren : </td> <td width="15%"> 4 </td><td width="15%"> &nbsp; </td> <td width="15%"> &nbsp; </td> 
</tr>
 
 <tr>
  <td width="55%"> Additional Evening Guests : </td>   <td width="15%"> 6  </td><td width="15%"> &nbsp; </td> <td width="15%"> &nbsp; </td> 
</tr>
  
  <tr>
  <td width="55%"> Wedding Venue Hire: </td> <td width="15%"> &nbsp; </td>  <td width="15%"> &nbsp; </td> <td width="15%" style="text-align:right"> &pound; 54  </td>
</tr>

<tr>
<td width="55%"> Civil Ceremony : </td>  <td width="15%"> &nbsp; </td>  <td  width="15%"> &nbsp; </td> <td  width="15%" style="text-align:right">  &pound; 35  </td>
</tr>
 
 
 
 <tr> 
 <td colspan="4" width="100%"> <b>Place setting and service fees for wedding breakfast. </b> </td>
 </tr>
 
 

 <tr style="text-align:left">
<td width="55%"> &nbsp; </td> <td  width="15%"> Number of Guests </td> <td  width="15%">&nbsp; Per head </td>  <td  width="15%"> &nbsp; </td> 
</tr>
 

 
 
 <tr>
<td width="55%"> Shilstone Canapes: </td> <td width="15%" style="text-align:right" > &pound; 22 </td> <td width="15%"  style="text-align:right"> &pound;   </td> <td width="15%"> &pound;  22 </td>
</tr>

<tr>
<td width="55%"> Standard Drinks Package: </td>
<td width="15%">65 </td> <td width="15%"  style="text-align:right"> &pound;  45 </td> 
<td width="15%"  style="text-align:right"> &pound;  56 </td>   
</tr>


<tr>
<td width="55%"> Shilstone Rustic Menu: </td><td width="15%"  style="text-align:right"> &pound; 24 </td><td width="15%"  style="text-align:right">&pound; 34 </td><td width="15%" style="text-align:right"> &pound; 35 </td>   
</tr>


<tr>
<td width="55%"> Childrens Menu: </td><td width="15%" style="text-align:right">&pound; 35 </td><td width="15%"  style="text-align:right"> &pound; 35 </td><td width="15%"  style="text-align:right"> &pound; 35 </td>   
</tr>


<tr>
<td width="55%"> Evening Food: </td><td width="15%" style="text-align:right"> &pound; 35 </td><td width="15%"  style="text-align:right"> &pound; 46  </td><td width="15%"  style="text-align:right" > &pound; 57 </td>   
</tr>
 
 
 <tr>
  <td colspan="3" width="80%"> Cost excluding VAT (vat will be charged at current rate) </td> <td width="15%"  style="text-align:right"> &pound; 35  </td>
</tr>


<tr>
<td width="35%"> VAT at 20% = </td><td width="15%" style="text-align:right"	>&pound; 35 </td>  <td width="30%"> Grand Total Inculding. VAT  </td><td width="15%"  style="text-align:right"> &pound; 37 </td>
</tr> 
 
 

 </table>
 </td>
 
 <td  width="40%">
 
 <table  border="1" width="100%" style="font-size: small;" cellspacing="2" cellpadding="2">
 
<tr> <td width="50%" > <b> Wedding Venue Hire To include: </b> </td> <td width="15%">&nbsp;</td><td width="30%" >&nbsp;</td> </tr>
<tr> <td>East courtyard</td> </tr>
<tr> <td>East and West halls within the Georgian country house</td>  <td width="15%">&nbsp;</td><td>&nbsp;</td> </tr>
<tr> <td>Grand passage<br>
Dining room <br>
West gardens and South facing lawn
</td> <td width="15%"> <span style="font-size: 350%;"> &#10101; </span></td><td style="vertical-align: middle;">   During the drinks & canapé reception </td>  </tr>
 
<tr> <td>Shilstone Mughal marquee <br>
Walled garden <br>
Orangery & Orchard
</td> <td> <span style="font-size: 350%;"> &#10101; </span></td>  <td style="vertical-align: middle;">  For the wedding breakfast and evening reception </td>
</tr>
 
<tr> <td><b>Place setting to include:</b></td>  <td>&nbsp;</td><td>&nbsp;</td> </tr>
<tr> <td>Tables, cutlery, plates, glasses, plain white china, linen tablecloths and napkins</td> <td>&nbsp;</td><td>&nbsp;</td> </tr>
<tr> <td>Shilstone ‘Phantom’ chairs </td>  <td>&nbsp;</td><td>&nbsp;</td>  </tr>
<tr> <td>Cake table</td>  <td>&nbsp;</td><td>&nbsp;</td>  </tr>
<tr> <td>Wedding cake service</td>  <td>&nbsp;</td><td>&nbsp;</td>  </tr>
<tr> <td>Stands for table names </td>  <td>&nbsp;</td><td>&nbsp;</td>  </tr>
<tr> <td>Buffet table if required</td>  <td>&nbsp;</td><td>&nbsp;</td> </tr>
<tr> <td>2 x Seating plan easels</td>  <td>&nbsp;</td><td>&nbsp;</td> </tr>
<tr> <td><b>Service fee to include:</b></td>  <td>&nbsp;</td><td>&nbsp;</td> </tr>
<tr> <td>Provision of all ground staff, including car parking stewards</td>  <td>&nbsp;</td><td>&nbsp;</td> </tr>
<tr> <td>Departure management and liaison</td>  <td>&nbsp;</td><td>&nbsp;</td> </tr>
<tr> <td>House manager</td>  <td>&nbsp;</td><td>&nbsp;</td> </tr>
<tr> <td>All necessary glasses & jugs</td>  <td>&nbsp;</td><td>&nbsp;</td> </tr>
<tr> <td>The Shilstone pay-bar </td> <td>&nbsp;</td><td>&nbsp;</td> </tr>
<tr> <td>Lighting equipment within marquee and walled garden</td> <td>&nbsp;</td><td>&nbsp;</td> </tr>
</table> 

 </td>
 </tr>
 </table>';
  
 
  
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
mysqli_close($_SERVER['con']);
ob_clean();
ob_start();
//Close and output PDF document
$pdfpath = $_SERVER['DOCUMENT_ROOT']."/interconnect/weddingquote.pdf";
 
//sendEMail($toEmail,$pdfpath);
$pdf->Output($pdfpath, 'F');
$pdf->Output('weddingquote.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+
?>