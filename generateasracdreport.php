<?php
require_once('head.php');
include_once("dbconfig.php");
echo $sqlo="INSERT INTO asracd_origination (
fromdate,
todate, 
`caller` ,
`numberofcalls` ,
`billablecalls` ,
`billedduration` ,
`acdms` ,
`asr_per` ,
`avg_pdd_sec` ,
`revenue`
)
  SELECT  fromdate,todate, caller_first, numberofcalls, billablecalls,
   billedduration, acdms, asr_per, avg_pdd_sec, revenue
  FROM  temp_asracd_origination";
 mysqli_query($_SERVER['con'],$sqlo);
 
 
 echo $sqlt="INSERT INTO asracd_termination (
fromdate,
todate, 
`vendor_connection` ,
`numberofcalls` ,
`billablecalls` ,
`billedduration` ,
`acdms` ,
`asr_per` ,
`avg_pdd_sec` ,
`cost`
)
  SELECT  fromdate,todate, vendor_connection_first, numberofcalls, billablecalls,
   billedduration, acdms, asr_per, avg_pdd_sec, cost
  FROM   temp_asracd_termination";
 mysqli_query($_SERVER['con'],$sqlt);
 
  $mydelsql = "TRUNCATE TABLE temp_asracd_origination";
  mysqli_query($_SERVER['con'],$mydelsql);
 
  $mydelsql = "TRUNCATE TABLE temp_asracd_termination";
  mysqli_query($_SERVER['con'],$mydelsql);

 header("Location: showasracdreport.php");	
 exit(0);
 
?>
