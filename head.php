<?php
ob_start();
session_start();
include_once('smtp.php');
include_once("dbconfig.php");
?>
<!DOCTYPE html>
<html>
<head>
   <title>ECS-NET FZE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
 
        <style type="text/css">
       
        .notice {
                font-family: verdana;
                font-size: 14px;
                color: 000;
                padding: 3px 0 8px 5px;
        }
        .error {
                font-family: verdana;
                font-size: 14px;
                color: red;
                padding: 3px 0 8px 5px;
        }
     
     </style>
 
  
</head>
<body>
<center><img src="images/ECS-Logo111.png" width="300"  height="100"></center>
