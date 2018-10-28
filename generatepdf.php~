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


$sql = "SELECT * FROM company where id=1";
$oldrec = mysqli_query($_SERVER['con'],$sql);
$rowold = mysqli_fetch_object($oldrec);

//define ('PDF_HEADER_LOGO', 'logoVoip.png');
define ('PDF_HEADER_LOGO', 'ECS-Logo.png');


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);


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
$pdf->SetFontSize(10);

$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
 
// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

  
  
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

 // add a page
$pdf->AddPage();

 $sqlold = "SELECT * FROM company where id=1";
$oldrec = mysqli_query($_SERVER['con'],$sqlold);
$rowold = mysqli_fetch_object($oldrec);


  $html = '
<table>
<tr>
<td width="150px"> <img alt="CompanyLogo" src="logouploads/ECS-Logo.png" width="100" heigth="100"/> </td>
<td> <b> '.$rowold->nameofcompany.' </b> <br/> '.$rowold->companyaddress.' <br/> '.$rowold->country.' <br/> '.$rowold->website.' </td>
</tr>
</table>

<hr>
<h4>Contact Information:</h4>


<table border="1" cellspacing="3" cellpadding="4">
 
	<tr>
		<td bgcolor="#cccccc">Company Name </td> <td colspan="3"> '.$rowold->nameofcompany.' </td>
 	</tr>
	<tr>
		<td bgcolor="#cccccc"> Country </td>
 		<td colspan="3"> '.$rowold->country.'</td>
			
	</tr>
	 
	<tr>
		<td  bgcolor="#cccccc">Primary Contact</td>
		<td align="left"> '.$rowold->primarycontact.'  </td>
		<td bgcolor="#cccccc" align="left">Position</td>
		<td> '.$rowold->Position.' </td>
	</tr>

	<tr>
		<td bgcolor="#cccccc">E-mail</td>
		<td> '.$rowold->email.' </td>
		<td bgcolor="#cccccc">Alternative email</td>
		<td> '.$rowold->emailcc.' </td>
	</tr>

	<tr>
		<td  bgcolor="#cccccc">Telephone:</td>
		<td> '.$rowold->telephone.' </td>
		<td bgcolor="#cccccc">Fax</td>
		<td bgcolor=""> '.$rowold->fax.' </td>
	</tr>
	<tr>
		<td bgcolor="#cccccc">Mobile</td>
		<td> '.$rowold->mobile.' </td>

		<td bgcolor="#cccccc"> Skype</td>
		<td> '.$rowold->skype.' </td>	
	</tr>

	<tr>
		<td bgcolor="#cccccc">Working Hours</td>
		<td> '.$rowold->office_hours.' </td>
		<td bgcolor="#cccccc">Website</td>
		<td>'.$rowold->website.' </td>
	</tr>

	</table>
 <h4>Equipment information:</h4>
<br/>
<table border="1" cellspacing="3" cellpadding="4">
 <tr>
<td bgcolor="#cccccc">Manufacturere/Model</td> <td> '.$rowold->Manufaturere_Model.'  </td>
<td bgcolor="#cccccc">IP address</td> <td> '.$rowold->ip_address.'  </td>
</tr>

<tr> 
<td bgcolor="#cccccc">Protocols</td>   <td>  '.$rowold->protocols.' </td>
<td bgcolor="#cccccc">Ports</td>   <td>  '.$rowold->ports.' </td>
</tr>
 


<tr>
<td bgcolor="#cccccc">Calling Number Format </td> <td>  '.$rowold->Calling_Number_Format.' </td>
<td bgcolor="#cccccc">Called Number Format </td> <td> '.$rowold->Called_Number_Format.'  </td>
</tr>

 

<tr>
<td bgcolor="#cccccc">Tech prefix </td> <td>  '.$rowold->tech_prefix.' </td>
<td bgcolor="#cccccc">Codecs Supported</td> <td> '.$rowold->codecs_supported.'  </td>
</tr>

</table>


<h4>Payment Information</h4>
<table border="1" cellspacing="3" cellpadding="4">	
  	<tr>
		<td bgcolor="#cccccc">PayPal</td>
		<td> '.$rowold->paypal.' </td>
		<td bgcolor="#cccccc">Skrill</td>
		<td>'.$rowold->Skrill.' </td>

		<td bgcolor="#cccccc">Western union </td>
		<td> '.$rowold->Western_union.' </td>
	</tr>
 
	<tr>
 		<td bgcolor="#cccccc"> Wire transform </td>
		<td> '.$rowold->wire_transform.' </td>
		<td bgcolor="#cccccc">Local Bank Deposit</td>
		<td>'.$rowold->Local_Bank_Deposit.' </td>
 	</tr>
</table>
 
<h4>Payment Terms</h4>

<table border="1" cellspacing="3" cellpadding="4">	
<tr>
<td bgcolor="#cccccc"> Payment terms </td>  <td> '.$rowold->paymentterms.'  </td>
</tr>
</table>
';

 

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Print some HTML Cells
 
// reset pointer to the last page
$pdf->lastPage();
 
 
// ---------------------------------------------------------
 
// add a page
$pdf->AddPage();

if(isset($_GET['lastInserId']))
	$lastInserId = $_GET['lastInserId'];
else
 	$lastInserId = 1;



$sqlnew = "SELECT * FROM company where id=$lastInserId";
$newrec = mysqli_query($_SERVER['con'],$sqlnew);
$rownew = mysqli_fetch_object($newrec);


// create some HTML content
 
$html = '

<table>
<tr>
<td width="150px"> <img alt="CompanyLogo" src="logouploads/'.$rownew->companylogo.'" width="100" heigth="100"/> </td>
<td> <b> '.$rownew->nameofcompany.' </b> <br/> '.$rownew->companyaddress.' <br/> '.$rownew->country.' <br/> '.$rownew->website.' </td>
</tr>
</table>


<h4>Contact Information:</h4>

<table border="1" cellspacing="3" cellpadding="4">
 
	<tr>
		<td bgcolor="#cccccc">Company Name </td> <td colspan="3"> '.$rownew->nameofcompany.' </td>
 	</tr>
	<tr>
		<td bgcolor="#cccccc"> Country </td>
 		<td colspan="3"> '.$rownew->country.'</td>
			
	</tr>
	 
	<tr>
		<td  bgcolor="#cccccc">Primary Contact</td>
		<td align="left"> '.$rownew->primarycontact.'  </td>
		<td bgcolor="#cccccc" align="left">Position</td>
		<td> '.$rownew->Position.' </td>
	</tr>

	<tr>
		<td bgcolor="#cccccc">E-mail</td>
		<td> '.$rownew->email.' </td>
		<td bgcolor="#cccccc">Alternative email</td>
		<td> '.$rownew->emailcc.' </td>
	</tr>

	<tr>
		<td  bgcolor="#cccccc">Telephone:</td>
		<td> '.$rownew->telephone.' </td>
		<td bgcolor="#cccccc">Fax</td>
		<td bgcolor=""> '.$rownew->fax.' </td>
	</tr>
	<tr>
		<td bgcolor="#cccccc">Mobile</td>
		<td> '.$rownew->mobile.' </td>

		<td bgcolor="#cccccc"> Skype</td>
		<td> '.$rownew->skype.' </td>	
	</tr>

	<tr>
		<td bgcolor="#cccccc">Working Hours</td>
		<td> '.$rownew->office_hours.' </td>
		<td bgcolor="#cccccc">Website</td>
		<td>'.$rownew->website.' </td>
	</tr>

	</table>
 <h4>Equipment information:</h4>
<br/>
<table border="1" cellspacing="3" cellpadding="4">
 <tr>
<td bgcolor="#cccccc">Manufacturere/Model</td> <td> '.$rownew->Manufaturere_Model.'  </td>
<td bgcolor="#cccccc">IP address</td> <td> '.$rownew->ip_address.'  </td>
</tr>

<tr>
<td bgcolor="#cccccc">Protocols</td>   <td>  '.$rownew->protocols.' </td>
<td bgcolor="#cccccc">Ports</td>   <td>  '.$rownew->ports.' </td>


</tr>
 


<tr>
<td bgcolor="#cccccc">Calling Number Format </td> <td>  '.$rownew->Calling_Number_Format.' </td>
<td bgcolor="#cccccc">Called Number Format </td> <td> '.$rownew->Called_Number_Format.'  </td>
</tr>

 

<tr>
<td bgcolor="#cccccc">Tech prefix </td> <td>  '.$rownew->tech_prefix.' </td>
<td bgcolor="#cccccc">Codecs Supported</td> <td> '.$rownew->codecs_supported.'  </td>
</tr>

</table>


<h4>Payment Information</h4>
<table border="1" cellspacing="3" cellpadding="4">	
  	<tr>
		<td bgcolor="#cccccc">PayPal</td>
		<td> '.$rownew->paypal.' </td>
		<td bgcolor="#cccccc">Skrill</td>
		<td>'.$rownew->Skrill.' </td>

		<td bgcolor="#cccccc">Western union </td>
		<td> '.$rownew->Western_union.' </td>
	</tr>
 
	<tr>
 		<td bgcolor="#cccccc"> Wire transform </td>
		<td> '.$rownew->wire_transform.' </td>
		<td bgcolor="#cccccc">Local Bank Deposit</td>
		<td>'.$rownew->Local_Bank_Deposit.' </td>
 	</tr>
</table>
 
<h4>Payment Terms</h4>

<table border="1" cellspacing="3" cellpadding="4">	
<tr>
<td bgcolor="#cccccc"> Payment terms </td>  <td> '.$rownew->paymentterms.'  </td>
</tr>
</table>
';
$Header_logo = '1157692848Untitled-1-04.png';
// set default header data
$pdf->SetHeaderData($Header_logo, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderTemplateAutoreset(true);


// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
// Print some HTML Cells
   
// reset pointer to the last page
$pdf->lastPage();
 
 
// ---------------------------------------------------------
ob_clean();
ob_start();
//Close and output PDF document
$pdfpath = $_SERVER['DOCUMENT_ROOT']."interconnect/pdfs/output-$lastInserId.pdf";
$toEmail='snmurty99@gmail.com'; 
sendEMail($toEmail,$pdfpath);
$pdf->Output($pdfpath, 'F');
$pdf->Output('output.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+
