<?php include("head.php"); ?>
<h1> Manage Admin Login  </h1>
 <div class="container">
 
<form role="form" method="post" action="login.php">
  <div class="form-group">
    <label for="pwd">Password to login:</label>
    <input type="password" name="loginpassword"  class="form-control"   required />
  </div>

  <div class="form-group"> 
	<button type="submit" name="submit" class="btn btn-primary">
	  <i class="icon-user icon-white"></i> Sign in
	</button>
  </div>

 </form>
</div>
</body>
<?php
//print_r($_POST);
if(isset($_POST['submit'])){

	if( $_POST['loginpassword'] == 66878){
		$_SESSION['loginstatus'] = 1;
		$_SESSION['adminlogin'] = 1;
 		header('Location: dashboard.php'); exit(0);
	}
	
	if( $_POST['loginpassword'] == 'staff'){
		$_SESSION['loginstatus'] = 1;
		$_SESSION['adminlogin'] = 0;
 		header('Location: dashboard.php'); exit(0);
	}
	else{
		$_SESSION['loginstatus'] = 0;
		echo "<p style='color:red'>Invalid login details</p>";
	}
	 
}
//print_r($_SESSION); 
?> 
</html>

<?php 
 //print_r($_SESSION);
mysqli_close($_SERVER['con']);
?>
</html>
