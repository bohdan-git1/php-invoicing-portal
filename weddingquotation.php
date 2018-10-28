<<<<<<< HEAD
<!DOCTYPE html>
<html>
<head>
   <title>Shilstone</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head> 
<body>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<div ng-app="myApp" class="container" ng-controller="weddingCtrl">
<script>
var app = angular.module('myApp', []);
app.controller('weddingCtrl', function($scope) {
    $scope.firstName = "John";
    $scope.lastName = "Doe";
    $scope.fullName = function() {
        return $scope.firstName + " " + $scope.lastName;
    };
});
</script>
<div class="row" style="text-align:center">
<img src="wedlogo.png"/>
<h4> Wedding Quotation Form for Shilstone </h4>
<h4> &#10048;&#10048;&#10048;&#10048; and &#10048;&#10048;&#10048;&#10048; </h4>
<h4>Saturday in September 2017 </h4>
</div>

<div class="row">
<table class="table">
<tr>
  <td>Expected number of guests : </td>   <td> <input type="text" ng-model="no_guests" name="no_guests" style="text-align:right" value="" size="8" />  </td><td> &nbsp; </td> <td> &nbsp; </td> 
</tr>

<tr>
<td> Adults : </td> <td> <input style="text-align:right" type="text" ng-model="adults" name="adults" size="8" value=""/>  </td><td> &nbsp; </td> <td> &nbsp; </td> 
</tr>

<tr>
<td>Chldren : </td> <td> <input style="text-align:right" type="text"  ng-model="child" name="child" value="" size="8" />  </td><td> &nbsp; </td> <td> &nbsp; </td> 
</tr>
  
  <tr>
  <td> Wedding Venue Hire: </td> <td> &nbsp; </td>  <td> &nbsp; </td> <td> &pound; <input  style="text-align:right"type="text" ng-model="wed_venu_hire" name="wed_venu_hire"  value=""/></td>
</tr>

<tr>
<td> Civil Ceremony Fee: </td>  <td> &nbsp; </td>  <td> &nbsp; </td> <td> &pound; <input  style="text-align:right" ng-model="civil_ceremony" name="civil_ceremony"  type="text" value=""/></td>
</tr>

 <tr> 
 <td colspan="4" ><b>Place setting and service fees for wedding breakfast. </b> </td>
 </tr>
 

 <tr style="text-align:left">
<td> &nbsp; </td> <td>Number of Guests </td> <td>&nbsp;&nbsp; Per head </td>  <td> &nbsp; </td> 
</tr>
 
<tr>
<td> Shilstone Canapes: </tds> <td><input type="text" size="8" style="text-align:right" value="" ng-model="shilstone_canapes" name="shilstone_canapes"  /> </td> <td> &pound; <input type="text" value=""  style="text-align:right" /> </td> <td> &pound;  <input style="text-align:right" type="text" value=""/></td>   
</tr>

<tr>
<td>Standard Drinks Package: </td><td>
<input type="text" size="8" value="" style="text-align:right"                             ng-model="standard_drinks_package"   name="standard_drinks_package" /> </td> <td> &pound;  
<input  style="text-align:right" type="text" value="" /> </td> <td> &pound;  <input style="text-align:right" type="text" value=""/></td>   
</tr>


<tr>
<td> Shilstone Rustic Menu: </td><td><input type="text" size="8" value=""  style="text-align:right" /></td><td>&pound;  <input type="text" style="text-align:right" value=""/> </td><td> &pound;  <input style="text-align:right" type="text" value=""/></td>   
</tr>


<tr>
<td> Childrens Menu: </td><td><input type="text" value="" size="8" style="text-align:right" /></td><td> &pound; <input type="text" style="text-align:right" value=""/></td><td> &pound;  <input type="text" style="text-align:right" value=""/></td>   
</tr>


<tr>
<td> Evening Food: </td><td><input type="text" value=""  size="8" style="text-align:right" /> </td><td> &pound;  <input type="text" style="text-align:right" value=""/> </td><td>&pound;  <input style="text-align:right" type="text" value=""/></td>   
</tr>


<tr>
 <td> &nbsp; </td>    <td colspan="2"> Cost excluding VAT (vat will be charged at current rate) </td> <td> &pound; <input type="text" style="text-align:right"  value=""/> </td>
</tr>


<tr>
<td> VAT at 20% = </td><td>&pound; <input type="text" value=""/> </td>  <td> Grand Total Inculding. VAT  </td><td> &pound; <input style="text-align:right" type="text" value=""/> </td>
</tr>


</table>
</div>

<div class="row">
<table class="table">
<tr> <td> <b> Wedding Venue Hire To include: </b> </td> <td>&nbsp;</td><td>&nbsp;</td> </tr>
<tr> <td>East courtyard</td> </tr>
<tr> <td>East and West halls within the Georgian country house</td>  <td>&nbsp;</td><td>&nbsp;</td> </tr>
<tr> <td>Grand passage<br>
Dining room <br>
West gardens and South facing lawn
</td> <td> <span style="font-size: 350%;"> &#10101; </span></td><td style="vertical-align: middle;">   During the drinks & canapé reception </td>  </tr>
 
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

</div>
</body>
</html>
=======
<!DOCTYPE html>
<html>
<head>
   <title>Shilstone</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head> 
<body>

<div class="container">

<div class="row" style="text-align:center">
 
<img src="wedlogo.png"/>
<h4> Wedding Quotation Form for Shilstone </h4>
<h4> &#10048;&#10048;&#10048;&#10048; and &#10048;&#10048;&#10048;&#10048; </h4>
<h4>Saturday in September 2017 </h4>
</div>

<div class="row">
<table class="table">
<tr>
  <td>Expected number of guests : </td>   <td> <input style="text-align:right" type="text" value="" size="8"/>  </td><td> &nbsp; </td> <td> &nbsp; </td> 
</tr>

<tr>
<td> Adults : </td> <td> <input style="text-align:right" type="text" size="8" value=""/>  </td><td> &nbsp; </td> <td> &nbsp; </td> 
</tr>

<tr>
<td>Chldren : </td> <td> <input style="text-align:right" type="text" value="" size="8" />  </td><td> &nbsp; </td> <td> &nbsp; </td> 
</tr>
  
  <tr>
  <td> Wedding Venue Hire: </td> <td> &nbsp; </td>  <td> &nbsp; </td> <td> &pound; <input  style="text-align:right"type="text" value=""/></td>
</tr>

<tr>
<td> Civil Ceremony Fee: </td>  <td> &nbsp; </td>  <td> &nbsp; </td> <td> &pound; <input  style="text-align:right" type="text" value=""/></td>
</tr>

 <tr> 
 <td colspan="4" ><b>Place setting and service fees for wedding breakfast. </b> </td>
 </tr>
 

 <tr style="text-align:center">
<td> &nbsp; </td> <td>Number of Guests: </td> <td> Per head </td>  <td> &nbsp; </td> 
</tr>
 
<tr>
<td> Shilstone Canapes: </td> <td><input type="text" size="8" style="text-align:right" value=""/> </td> <td> &pound; <input type="text" value=""  style="text-align:right" /> </td> <td> &pound;  <input style="text-align:right" type="text" value=""/></td>   
</tr>

<tr>
<td>Standard Drinks Package: </td><td><input type="text" size="8" value="" style="text-align:right"  /> </td> <td> &pound;  <input  style="text-align:right" type="text" value=""/> </td> <td> &pound;  <input style="text-align:right" type="text" value=""/></td>   
</tr>


<tr>
<td> Shilstone Rustic Menu: </td><td><input type="text" size="8" value=""  style="text-align:right" /></td><td>&pound;  <input type="text" style="text-align:right" value=""/> </td><td> &pound;  <input style="text-align:right" type="text" value=""/></td>   
</tr>


<tr>
<td> Childrens Menu: </td><td><input type="text" value="" size="8" style="text-align:right" /></td><td> &pound; <input type="text" style="text-align:right" value=""/></td><td> &pound;  <input type="text" style="text-align:right" value=""/></td>   
</tr>


<tr>
<td> Evening Food: </td><td><input type="text" value=""  size="8" style="text-align:right" /> </td><td> &pound;  <input type="text" style="text-align:right" value=""/> </td><td>&pound;  <input style="text-align:right" type="text" value=""/></td>   
</tr>


<tr>
 <td> &nbsp; </td>    <td colspan="2"> Cost excluding VAT (vat will be charged at current rate) </td> <td> &pound; <input type="text" style="text-align:right"  value=""/> </td>
</tr>


<tr>
<td> VAT at 20% = </td><td>&pound; <input type="text" value=""/> </td>  <td> Grand Total Inculding. VAT  </td><td> &pound; <input style="text-align:right" type="text" value=""/> </td>
</tr>


</table>
</div>

<div class="row">
<table class="table">
<tr> <td> <b> Wedding Venue Hire To include: </b> </td> </tr>
<tr> <td>East courtyard</td> </tr>
<tr> <td>East and West halls within the Georgian country house</td> </tr>
<tr> <td>Grand passage<br>
Dining room <br>
West gardens and South facing lawn
</td> <td> <span style="font-size: 350%;"> &#10101; </span></td><td style="vertical-align: middle;">   During the drinks & canapé reception </td>  </tr>
 
<tr> <td>Shilstone Mughal marquee <br>
Walled garden <br>
Orangery & Orchard
</td> <td> <span style="font-size: 350%;"> &#10101; </span></td>  <td style="vertical-align: middle;">  For the wedding breakfast and evening reception </td>
</tr>
 
<tr> <td><b>Place setting to include:</b></td></tr>
<tr> <td>Tables, cutlery, plates, glasses, plain white china, linen tablecloths and napkins</td></tr>
<tr> <td>Shilstone ‘Phantom’ chairs </td></tr>
<tr> <td>Cake table</td></tr>
<tr> <td>Wedding cake service</td></tr>
<tr> <td>Stands for table names </td></tr>
<tr> <td>Buffet table if required</td></tr>
<tr> <td>2 x Seating plan easels</td></tr>
<tr> <td><b>Service fee to include:</b></td></tr>
<tr> <td>Provision of all ground staff, including car parking stewards</td></tr>
<tr> <td>Departure management and liaison</td></tr>
<tr> <td>House manager</td></tr>
<tr> <td>All necessary glasses & jugs</td></tr>
<tr> <td>The Shilstone pay-bar </td></tr>
<tr> <td>Lighting equipment within marquee and walled garden</td></tr>
</table>

</div>
</body>
</html>
>>>>>>> bac5e582c4ea9ddf7eafa88f2472a7cf8ff6390b
