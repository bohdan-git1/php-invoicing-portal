<?php 
//error_reporting(E_ALL);

// Same as error_reporting(E_ALL);
//ini_set("error_reporting", E_ALL);

// Report all errors except E_NOTICE
//error_reporting(E_ALL & ~E_NOTICE);
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '@!murty999';
$dbName = "sippydatabase";

$_SERVER['xmlRpcUrl']  = "https://217.182.228.235/xmlapi/xmlapi"; 
$_SERVER['xmlUser'] = "Mobi";
$_SERVER['xmlPass'] = "jaihind999";



$con = mysqli_connect($dbhost, $dbuser, $dbpass);
$_SERVER['con'] = $con;
// Check connection
if (!$con) {
    die("database Connection failed: " . mysqli_connect_error());
}
mysqli_select_db($con,$dbName);
?>
