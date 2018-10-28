<?php
//print_r($_SESSION);

if(isset($_SESSION['loginstatus']) && $_SESSION['loginstatus'] == 1)
{
?>
<p style="text-align:right">
<a href="logincheck.php?logout=1"> <span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> Log out &nbsp;&nbsp;&nbsp; </a> 
</p> 
<?php
}
else
{
?>
<p> You need to login to accesss these pages <a href="login.php"> Click here to continue.. </a>  </p>
<?php

	exit;
}



if(isset($_GET['logout']) && $_GET['logout'] == 1 ){
	unset($_SESSION['loginstatus']);
	session_destroy();
	header('Location: login.php'); exit;
	 
 }

?>
