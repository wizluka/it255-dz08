<?php
session_start();
include_once 'dbconnect.php';

if(isset($_SESSION['userSession'])!="")
{
 header("Location: home.php");
 exit;
}

if(isset($_POST['btn-login']))
{
 $email = $MySQLi_CON->real_escape_string(trim($_POST['user_email']));
 $upass = $MySQLi_CON->real_escape_string(trim($_POST['password']));
 
 $query = $MySQLi_CON->query("SELECT * FROM users WHERE email='$email'");
 $row=$query->fetch_array();
 
 if(password_verify($upass, $row['password']))
 {
  $_SESSION['userSession'] = $row['user_id'];
  header("Location: home.php");
 }
 else
 {
  $msg = "
        email or password does not exists !
    ";
 }
 
 $MySQLi_CON->close();
 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<style>

body{
	
	
	
	background: url(http://www.globalhotel.com/images/img-home.jpg);
	
	
}

</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Coding Cage - Login & Registration System</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

<div class="signin-form">

 <div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Sign In.</h2><hr />
        
        <?php
  if(isset($msg)){
   echo $msg;
  }
  ?>
        
        <div class="form-group">
        <input type="email" class="form-control" placeholder="Email address" name="user_email" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password" required />
        </div>
       
      <hr />
        
        <div class="form-group">
            <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
      <span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In
   </button> 
            
            <a href="register.php" class="btn btn-default" style="float:right;">Sign UP Here</a>
            
        </div>  
      </form>
    </div>
	

	
</div>


	

</body>




</html>