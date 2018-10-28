<?php
include_once("dbconfig.php");
 
 
 
$sql = "SELECT * FROM company where id=1";
$oldrec = mysqli_query($_SERVER['con'],$sql);
$rowold = mysqli_fetch_object($oldrec);

$sqlold = "SELECT * FROM company where id=1";
$oldrec = mysqli_query($_SERVER['con'],$sqlold);
$rowold = mysqli_fetch_object($oldrec);


 $html = '<h4>Contact Information:</h4>
<div class="table-responsive">
<table class="table" border="1">
 
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
		<td align="left"> '.$rowold->Position.'  </td>
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
<table class="table"  border="1">
 <tr>
<td bgcolor="#cccccc">Manufacturere/Model</td> <td> '.$rowold->Manufaturere_Model.'  </td>
<td bgcolor="#cccccc">IP address</td> <td> '.$rowold->ip_address.'  </td>
</tr>

<tr>
<td bgcolor="#cccccc">Protocols</td> <td>  '.$rowold->protocols.'</td>
<td bgcolor="#cccccc">Ports</td> <td>  '.$rowold->ports.' </td>

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
<table  class="table"  border="1" >	
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

<table class="table"  border="1">	
<tr>
<td bgcolor="#cccccc"> Payment terms </td>  <td> '.$rowold->paymentterms.'  </td>
</tr>
</table>
</div>
';

 
echo $html;

?>