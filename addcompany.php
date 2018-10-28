<?php
include_once("head.php"); 
//include_once("logincheck.php");
?>
<link href="css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="js/bootstrap-toggle.min.js"></script>
 
<script type="text/javascript" src="jquery.timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.timepicker.css" />
 
  
<div class="container">

 
                
            

           


  <center><h2>VOIP Interconnect Form</h2></center>

<h5> Our Company information </h5>
<?php
 include_once("ourcompanyinfo.php");
?>
 
 
<h5> Please fill your company information bellow form and click on submit </h5>

       <form method="post"  role="form"   action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" >
 
  <div class="panel-group">
 
    <div class="panel panel-primary">
      <div class="panel-heading">Company Contact information </div>
      <div class="panel-body">

		<div class="row">
                     <div class="col-md-6 col-sm-12 col-ls-6">
			     <label>     company name  </label>   
  
			    <input name="nameofcompany"  class="form-control"   type="text"   placeholder="Enter company name"  required> 
	    	    </div>
			

			  <div class="col-md-6 col-sm-12 col-ls-6">
  			 <label> 	  Country   </label>   

			    
<select name="country" class="form-control" required >
<option value="">Country...</option>
<option value="Afganistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bonaire">Bonaire</option>
<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
<option value="Brunei">Brunei</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Canary Islands">Canary Islands</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Channel Islands">Channel Islands</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos Island">Cocos Island</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cote DIvoire">Cote D'Ivoire</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Curaco">Curacao</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="East Timor">East Timor</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands">Falkland Islands</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Ter">French Southern Ter</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Great Britain">Great Britain</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Hawaii">Hawaii</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Isle of Man">Isle of Man</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Korea North">Korea North</option>
<option value="Korea Sout">Korea South</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Laos">Laos</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libya">Libya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macau">Macau</option>
<option value="Macedonia">Macedonia</option>
<option value="Madagascar">Madagascar</option>
<option value="Malaysia">Malaysia</option>
<option value="Malawi">Malawi</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Midway Islands">Midway Islands</option>
<option value="Moldova">Moldova</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Nambia">Nambia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherland Antilles">Netherland Antilles</option>
<option value="Netherlands">Netherlands (Holland, Europe)</option>
<option value="Nevis">Nevis</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau Island">Palau Island</option>
<option value="Palestine">Palestine</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Phillipines">Philippines</option>
<option value="Pitcairn Island">Pitcairn Island</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Republic of Montenegro">Republic of Montenegro</option>
<option value="Republic of Serbia">Republic of Serbia</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russia">Russia</option>
<option value="Rwanda">Rwanda</option>
<option value="St Barthelemy">St Barthelemy</option>
<option value="St Eustatius">St Eustatius</option>
<option value="St Helena">St Helena</option>
<option value="St Kitts-Nevis">St Kitts-Nevis</option>
<option value="St Lucia">St Lucia</option>
<option value="St Maarten">St Maarten</option>
<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
<option value="Saipan">Saipan</option>
<option value="Samoa">Samoa</option>
<option value="Samoa American">Samoa American</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Serbia">Serbia</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syria</option>
<option value="Tahiti">Tahiti</option>
<option value="Taiwan">Taiwan</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania</option>
<option value="Thailand">Thailand</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Erimates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States of America">United States of America</option>
<option value="Uraguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Vatican City State">Vatican City State</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Vietnam</option>
<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
<option value="Wake Island">Wake Island</option>
<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
<option value="Yemen">Yemen</option>
<option value="Zaire">Zaire</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
</select>

	    		</div>
			
		</div>

	<div class="row">

 			  <div class="col-md-6 col-sm-12 col-ls-6">
 			    <label>      Primary contact Person    </label>   
		    <input name="primarycontact"  type="text"  class="form-control" required  placeholder="Enter primary contact" />  
	    	 	</div>
			

 			  <div class="col-md-6 col-sm-12 col-ls-6">
 			    <label>   Telephone    </label>   
			    <input name="telephone"  type="text"  class="form-control" required  placeholder="Enter telephone" />  
	    	 	</div>

	</div>

	<div class="row">

 			  <div class="col-md-6 col-sm-12 col-ls-6">
 			    <label>      Primary contact  person Position    </label>   
		    <input name="position"  type="text"  class="form-control" required  placeholder="Enter primary contact position" />  
	    	 	</div>
			
 			 <div class="col-md-6 col-sm-12 col-ls-6">
 			    <label>   Company address    </label>   
			    <input name="companyaddress"  type="text"  class="form-control" required  placeholder="Enter company address" />  
	    	 	</div>


 			 

	</div>




	<div class="row">
 			  <div class="col-md-6 col-sm-12 col-ls-6">
 			    <label>     Mobile Number  </label>   
			    <input name="mobile"  type="text"  class="form-control" required  placeholder="Enter mobile number" />  
	    	 	</div>
  			  <div class="col-md-6 col-sm-12 col-ls-6">
 			    <label>     Email    </label>   
			    <input name="email"  type="email"  class="form-control" required  placeholder="Enter email" />  
	    	 	</div>
	</div>

	<div class="row">

 			
			 <div class="col-md-6 col-sm-12 col-ls-6">
 			    <label>     Alternative email    </label>   
			    <input name="emailcc"  type="email"  class="form-control"    placeholder="Enter email cc contact" />  
	    	 	</div>
 			
		  <div class="col-md-6 col-sm-12 col-ls-6">
			    <label>    Skype    </label>   
		   <input name="skype"  type="text"  class="form-control"    placeholder="Enter skype details" />  
	    	 	</div>

	
 

	</div>

	<div class="row">
 			  <div class="col-md-6 col-sm-12 col-ls-6">
 			    <label>     Website    </label>   
			    <input name="website"  type="text"  class="form-control"    placeholder="Enter Website" />  
	    	 	</div>
			
			 <div class="col-md-6 col-sm-12 col-ls-6">
 			    <label>      Fax    </label>   
			    <input name="fax"  type="text"  class="form-control"    placeholder="Enter Fax"/>  
	    	 	</div>


 			
	</div>

	<div class="row">
 		  <div class="col-md-6 col-sm-12 col-ls-6">
 			    <label>     Working Hours    </label>   <br/>
			   	From <input id="timeformatExample1" name="office_hours_from" type="text" class="time" required /> 
				To <input id="timeformatExample2" name="office_hours_to" type="text" class="time" required  />

	    	  </div>

		  <div class="col-md-6 col-sm-12 col-ls-6">
			<label>Please Upload Your Company Logo: </label>
			<input class="form-control" type="file" name="companylogo" required />
		   </div>



 	 </div>


	</div>  </div> <!-- panelclose -->
   

    <div class="panel panel-success">
      <div class="panel-heading">Equiment information</div>
      <div class="panel-body">

		<div class="row">

		 <div class="col-md-6 col-sm-12 col-ls-6">
		    <label>     Manufaturere/Model   </label>   
 	    <input name="Manufaturere_Model" type="text" class="form-control" required placeholder="Enter Manufaturere/Model" />       	 
		</div>

		 <div class="col-md-6 col-sm-12 col-ls-6">
		    <label>      IP address    </label>   
		    <input name="ip_address"  type="text"  class="form-control" required  placeholder="Enter IP address" />  
    	 	</div>
	</div>

 <div class="row">
			<div class="col-md-6 col-sm-12 col-ls-6">
			    <label>    Protocols </label>   
		     
			 <select  name="protocols"  class="form-control" required >
				<option value="">Select Protocol</option> 
 				 <option value="H323">H323</option> 
				 <option value="SIP" selected >SIP</option>
				  <option value="IAX">IAX</option>
			   
			 </select>  
	    	 	</div>


 			<div class="col-md-6 col-sm-12 col-ls-6">

 			    <label>    Ports  </label>   
			    <input name="ports"  type="text"  class="form-control"  value="5060"   placeholder="Ports required" />  
	    	 	</div>

</div>

<div class="row">

 			<div class="col-md-6 col-sm-12 col-ls-6">
 			    <label>     Tech prefix   </label>   
			    <input name="tech_prefix"  type="text"  class="form-control"    placeholder="Enter tech prefix" />  
	    	 	</div>

			
			<div class="col-md-6 col-sm-12 col-ls-6">
			    <label>     Codecs supported  </label>   
			  <br>

 			 <input type="checkbox" name="codecs_supported[]" value="G723" checked> G723<br>
  			 <input type="checkbox" name="codecs_supported[]" value="G729" > G729<br> 
 			 <input type="checkbox" name="codecs_supported[]" value="G711a" > G711a<br>
  			 <input type="checkbox" name="codecs_supported[]" value="G711u" > G711u<br> 
 			 <input type="checkbox" name="codecs_supported[]" value="GSM" > GSM<br> 




	    	 	</div>



</div>

<div class="row">

			 <div class="col-md-6 col-sm-12 col-ls-6">
 			    <label>      Calling Number Format    </label>   
			    <input name="Calling_Number_Format"  type="text"  class="form-control"    placeholder="Enter  Calling Number Format" />  
	    	 	</div>
	
			 <div class="col-md-6 col-sm-12 col-ls-6">
 			    <label>     Called Number Format    </label>   
			    <input name="Called_Number_Format"  type="text"  class="form-control"    placeholder="Enter Called Number Format"/>  
	    	 	</div>

</div>

		
   </div>  </div> <!-- panelclose -->

    <div class="panel panel-info">
      <div class="panel-heading">Payment Information</div>
      <div class="panel-body">  

		
	<div class="row">
			
		<p> * Click on Yes/No to change </p>
			<script>
				
                $(function() {
                    $('#timeformatExample1').timepicker({ 'timeFormat': 'h:i:A' });
                    $('#timeformatExample2').timepicker({ 'timeFormat': 'h:i A' });
                });

			  $(function() {
			    $('#paypal').bootstrapToggle({
			      on: 'Yes',
			      off: 'No'
			    });
			  })

			$(function() {
			    $('#Skrill').bootstrapToggle({
			      on: 'Yes',
			      off: 'No'
			    });
			  })


		$(function() {
			    $('#Western_union').bootstrapToggle({
			      on: 'Yes',
			      off: 'No'
			    });
			  })

		$(function() {
			    $('#wire_transform').bootstrapToggle({
			      on: 'Yes',
			      off: 'No'
			    });
			  })


		$(function() {
			    $('#Local_Bank_Deposit').bootstrapToggle({
			      on: 'Yes',
			      off: 'No'
			    });
			  })





			</script>


			<div class="col-md-4 col-sm-12 col-ls-4">
  			   
			<input id="paypal" name="paypal" value="yes" type="checkbox"/>
			 <label>     Paypal  </label>   
 	    	 	</div>


 			<div class="col-md-4 col-sm-12 col-ls-4">
 			    	<input id="Skrill" name="Skrill"  value="yes" type="checkbox"/>
				<label>   Skrill  </label>   
 			</div>

			 <div class="col-md-4 col-sm-12 col-ls-4">
 			     <input id="Western_union" name="Western_union"  value="yes" type="checkbox"/>
			    <label>      Western union    </label>   
 			</div>
	</div>
	
	<div class="row">

			 <div class="col-md-4 col-sm-12 col-ls-4">
 			    <input id="wire_transform" name="wire_transform" value="yes" type="checkbox">
			  <label>      Wire transform    </label>   
  	    	 	</div>

			 <div class="col-md-4 col-sm-12 col-ls-4">
 			     <input id="Local_Bank_Deposit" name="Local_Bank_Deposit" value="yes" type="checkbox">
			    <label>      Local Bank Deposit    </label>    
	    	 	</div>
	</div>
	

	
      

	 </div> </div> <!-- panel close -->

    <div class="panel panel-warning">
      <div class="panel-heading">Payment Terms</div>
      <div class="panel-body"> 
<div class="row">
 <label> Choose your payment terms:  </label>
<select name="paymentterms">
  <option value="prepayment only"> Prepayment only </option>
  <option value="Credit facility">Credit facility </option>
</select> 
 
</div>
	
	  </div>   </div> <!-- panel close -->
   </div>

 
<div class="row" style="text-align:center">
   <input id="task" name="task" type="submit"  class="btn btn-info"  value="Submit" />
</div>
                  

 </form>


<?php
 

 function rechargeVoucher() {
 	$secret = $_POST['secret'];
	$sql = "SELECT * FROM sippyreseller where phonenumber=$secret";
	$oldrec = mysqli_query($_SERVER['con'],$sql);
	$rowold = mysqli_fetch_object($oldrec);
	
	$rowold->api_password = base64_decode($rowold->api_password);
	
 		 if(!isset($rowold->email)){
			$rowold->email = "";
			$rowold->batchtag="";
			$rowold->i_billing_plan = 0;
			$rowold->api_access ="";
			$rowold->api_password = ""; 
  
  		}

	    $_SESSION['rowold'] = $rowold;

		$_POST['email'] = $rowold->email;
		$_POST['reseller_id'] = $rowold->id;
 		
	    $params = array(new xmlrpcval(array("username" => new xmlrpcval($_POST['username'], "string"),
                                    "voucher_id"     	=> new xmlrpcval($_POST['voucher_id'], "string"),

                                     ), 'struct'));
    $msg = new xmlrpcmsg('rechargeVoucher', $params);
// echo "<pre>"; print_r($msg); echo "</pre>";
    /* replace here URL  and credentials to access to the API */
    $cli = new xmlrpc_client($_SERVER['xmlRpcUrl']);
    $cli->setSSLVerifyPeer(false);
    $cli->setSSLVerifyHost(false);
    $cli->setCredentials($rowold->api_access,$rowold->api_password, CURLAUTH_DIGEST);
 

   $r = $cli->send($msg, 20);       /* 20 seconds timeout */
   return $r;

}
 
  

function sendEMail($a) {

  $rowold = $_SESSION['rowold'];

    $body = " 
<table>
<tr><td> Welcome to Mob-Voip </td></tr>
<tr><td> Please keep this email for your records. Your recharge information is as follows:</td> </tr>
<tr><td> &nbsp; </td></tr>
<tr><td>      username : ${a['username']}   </td> </tr>	
<tr><td>      Vocher id : ${a['voucher_id']}   </td> </tr>
<tr><td>         Amount : ${a['payer_amount']}  ${a['voucher_currency']}  </td> </tr>
         
<tr><td> <tr><td> &nbsp; </td> </tr>
<tr><td> &nbsp; </td> </tr>
<tr><td> Mobile App #1 </td> </tr>
<tr><td> Operator code 654321 </td></tr>
<tr><td> Android: <a href='https://play.google.com/store/apps/details?id=com.telepacket.TpSmart&hl=en'> Click Here </a>   </td> </tr>
<tr><td> Apple IOS: <a href='https://itunes.apple.com/us/app/tp-smart/id1039627255?ls=1&mt=8'> Click Here </a>    </td> </tr>
<tr><td> &nbsp; </td> </tr>
<tr><td> Mobile App #2 </td> </tr>
<tr><td> Operator code 70085 </td></tr>
<tr><td> Android: <a href='https://play.google.com/store/apps/details?id=com.freedialer.dialer&hl=en'> Click Here </a> </td> </tr>
<tr><td> &nbsp; </td> </tr>
<tr><td> Please feel free to contact us in case of any assiatnce, we are available on skype id 'mob-voip' </td> </tr>
<tr><td> Whatsapp # +16473602360  </td> </tr>
<tr><td> &nbsp;  </td> </tr>
<tr><td> Thank you for Business! </td> </tr>
<tr><td> &nbsp; </td> </tr>
<tr><td>   Mob-Voip  Team. </td> </tr>
</table>";
 
#$bcc = "mail@mob-voip.net";
$to = $_POST['email'];
$subject = 'Top Up Voucher Confirmation -'.$rowold->api_access;
		$from ='info@mob-voip.net'; 
        $headers  = "From: " . $from . "\r\n";
		$headers .= "Reply-To: ". $from . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

 
	externalmail($to,$subject,$body);



	 



}


function saveMail($frm)
{

 
	$text = "--------------------------- \n";
	foreach ($frm as $key=>$value) 
	{
		$text .= "$key=$value, \n";
	}
	$log_file = 'sms_log.txt';
	$fp=fopen($log_file,'a');
	fwrite($fp, $text . "\n\n");
	fwrite($fp, $sql . "\n\n");
	fclose($fp);  // close fil


}

function savedb(){
/// echo "<pre>";	print_r($_POST);
	$nameofcompany =  mysqli_escape_string($_SERVER['con'],$_POST['nameofcompany']); 
	$country =  mysqli_escape_string($_SERVER['con'],$_POST['country']);
	$primarycontact = mysqli_escape_string($_SERVER['con'], $_POST['primarycontact']);
	$telephone  = mysqli_escape_string($_SERVER['con'], $_POST['telephone']);
	$companyaddress= mysqli_escape_string( $_SERVER['con'],$_POST['companyaddress']);
	$position = mysqli_escape_string( $_SERVER['con'],$_POST['position']);
	$mobile =  mysqli_escape_string($_SERVER['con'],$_POST['mobile']);
	$email = mysqli_escape_string($_SERVER['con'], $_POST['email']);
	$office_hours_from = mysqli_escape_string($_SERVER['con'], $_POST['office_hours_from']);
	$office_hours_to = mysqli_escape_string( $_SERVER['con'],$_POST['office_hours_to']);
	$office_hours =  $office_hours_from .' till '.$office_hours_to;


	$Called_Number_Format  = mysqli_escape_string($_SERVER['con'],$_POST['Called_Number_Format']);
	$Calling_Number_Format  = mysqli_escape_string( $_SERVER['con'],$_POST['Calling_Number_Format']);
 	$codecs_supported = $_POST['codecs_supported'];
	//print_r($codecs_supported);
 	$codecs_supported = implode(",",$codecs_supported);
 
	$website = mysqli_escape_string($_SERVER['con'],$_POST['website']);
	
	$protocols = mysqli_escape_string($_SERVER['con'], $_POST['protocols']);
	$ports = mysqli_escape_string( $_SERVER['con'],$_POST['ports']);


	$ip_address = mysqli_escape_string($_SERVER['con'],$_POST['ip_address']);

	$Manufaturere_Model = mysqli_escape_string($_SERVER['con'], $_POST['Manufaturere_Model']);
	$emailcc = mysqli_escape_string($_SERVER['con'],$_POST['emailcc']);
 	$skype = mysqli_escape_string($_SERVER['con'],$_POST['skype']);

	 
	
if(isset($_POST['paypal']))
 	$paypal  = $_POST['paypal'];
else
	$paypal  = 'No';


if(isset($_POST['Skrill']))
 	$Skrill  = $_POST['Skrill'];
else
	$Skrill  = 'No';



if(isset($_POST['Local_Bank_Deposit']))
 	$Local_Bank_Deposit  = $_POST['Local_Bank_Deposit'];
else
	$Local_Bank_Deposit  = 'No';




if(isset($_POST['wire_transform']))
 	$wire_transform   = $_POST['wire_transform'];
else
	$wire_transform   = 'No';




 
if(isset($_POST['Western_union']))
 	$Western_union   = $_POST['Western_union'];
else
	$Western_union   = 'No';

	$target_dir = $_SERVER['DOCUMENT_ROOT']."/interconnect/logouploads/";
	$temp_file_name = mt_rand().basename($_FILES["companylogo"]["name"]);
	$target_file = $target_dir.$temp_file_name;
	$companylogo = $temp_file_name;
 
	// Check if image file is a actual image or fake image
       if(isset($_POST['task']) &&  $_FILES["companylogo"]["error"]!=4 ) {
       
	    if (@move_uploaded_file($_FILES["companylogo"]["tmp_name"], $target_file)) 
        	echo "The file ". basename( $_FILES["companylogo"]["name"]). " has been uploaded.";
   
	}
	 



	$website = $_POST['website'];
 	$fax = $_POST['fax'];
  	$paymentterms = $_POST['paymentterms'];
	$tech_prefix = $_POST['tech_prefix'];
	$visitor_ip = $_SERVER['REMOTE_ADDR'];
		 
  	   $sqlupdt =  "INSERT INTO company (`nameofcompany`, `country`, `primarycontact`, companylogo,`telephone`,position ,companyaddress, `mobile`, `email`, `office_hours`, `skype`, `website`, `fax`, `emailcc`, `Manufaturere_Model`, `ip_address`, `protocols`,`ports`, `codecs_supported`, `tech_prefix`, `Called_Number_Format`, `Calling_Number_Format`, `paypal`, `Skrill`, `Western_union`, `wire_transform`, `Local_Bank_Deposit`,  `paymentterms`,  `visitor_ip`)
		 VALUES ('$nameofcompany', '$country', '$primarycontact','$companylogo',  '$telephone', '$position', '$companyaddress', '$mobile', '$email', '$office_hours',
 		'$skype','$website','$fax','$emailcc','$Manufaturere_Model','$ip_address','$protocols','$ports','$codecs_supported',
		'$tech_prefix','$Called_Number_Format', '$Calling_Number_Format','$paypal', '$Skrill', '$Western_union', '$wire_transform', '$Local_Bank_Deposit', '$paymentterms','$visitor_ip')";

		 mysqli_query($_SERVER['con'],$sqlupdt); 
		sleep(5);
	 	$lastInserId =	 mysqli_insert_id($_SERVER['con']);
	 	mysqli_close($_SERVER['con']);
	 	header("Location:generatepdf.php?lastInserId=".$lastInserId);
	 	exit(0);
	
  
}
if(isset($_POST['task']))
	savedb();

?>


</div>

<body>
<html>
