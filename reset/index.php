<?php
session_start();
ob_start();
include_once('../dbconnect.php');

if (isset($_POST['btn-reset'])) {
	
	$email = trim($_POST['email']); 
	$email = strip_tags($email);
	$email = htmlspecialchars($email);
	$email = mysqli_real_escape_string($dbc, $email);

	$regID = trim($_POST['regID']);
	$regID = strip_tags($regID);
	$regID = htmlspecialchars($regID);
	$regID = mysqli_real_escape_string($dbc, $regID);

	$password = trim($_POST['password']);
	$password = strip_tags($password);
	$password = htmlspecialchars($password);
	$password = mysqli_real_escape_string($dbc, $password);
	
	$passwordconf = trim($_POST['passwordconf']);
	$passwordconf = strip_tags($passwordconf);
	$passwordconf = htmlspecialchars($passwordconf);
	$passwordconf = mysqli_real_escape_string($dbc, $passwordconf);

	$temp = trim($_SESSION['temp']);
	$temp = strip_tags($temp);
	$temp = htmlspecialchars($temp);
	$temp = mysqli_real_escape_string($dbc, $temp);

	$password = hash('sha256', $password);
	$passwordconf = hash('sha256', $passwordconf);
	if ($password == $passwordconf) {
		$query = mysqli_query($dbc, "SELECT * FROM userlogin WHERE email = '$email' AND password = '$temp' AND RegID = '$regID'");
		$row = mysqli_fetch_assoc($query);
		$count = mysqli_num_rows($query);
		$regID = $row['RegID'];
		$email = $row['email'];
		if ($count == 1 && $row['conform'] == 'temp') {
			$query1 = mysqli_query($dbc, "UPDATE userlogin SET password = '$password' WHERE RegID = '$regID' AND email = '$email' LIMIT 1");
			$query2 = mysqli_query($dbc, "UPDATE userlogin SET conform = '' WHERE RegID = '$regID' AND email = '$email' AND password = '$password' LIMIT 1");
			if ($query1 && $query2) {
				echo "Successfuly changed.";
				session_start();
				unset($_SESSION['user']);
				unset($_SESSION['email']);
				unset($_SESSION['password']);
				unset($_SESSION['temp']);
				unset($_SESSION['regID']);
				session_unset();
				session_destroy();
				header("refresh:5;url=../register-login/");
				exit;
			}
		}
		else {
			die("Something wrong");
			exit;
		}
	}
	else {
		die("Please Enter Same password in both fields");
	}
}

?>
<!DOCTYPE html>
<html >

<!--

 CODEPEN LOGIN/SIGNUP FORM : https://codepen.io/ehermanson/pen/KwKWEv

 -->
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../css/forgot.css">
  <title>SPE INDHAN 2K18</title>
  <link href='//fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
</head>

<body translate="no" >
<div class="wrapper">
<div class="form">
<h1 style="margin-top: 0px;">SPE INDHAN 2K18</h1>
<ul class="tab-group">
 <!--  <li class="tab active"><a href="#signup">FORGOT PASSWORD</a></li> -->
</ul>

<div class="tab-content">
<div id="signup">   


<form action="index" method="post">
<div class="field-wrap">
<label>
EMAIL<span class="req">*</span>
</label>
<input type="email"required autocomplete="on" name="email" />
</div>

<div class="field-wrap">
<label>
REGESTRATION ID<span class="req">*</span>
</label>
<input type="text"required autocomplete="off" name="regID" />
</div>

<div class="field-wrap">
<label>
NEW PASSWORD<span class="req">*</span>
</label>
<input type="password"required autocomplete="on" name="password" />
</div>

<div class="field-wrap">
<label>
CONFIRM PASSWORD<span class="req">*</span>
</label>
<input type="password"required autocomplete="on" name="passwordconf" />
</div>

<input type="hidden" name="purpose" value="resetpassword">
<button type="submit" class="button button-block" name="btn-reset" />CHANGE PASSWORD</button>

</form>

</div>    

</div><!-- tab-content -->
</div> 
<!-- /form -->
<ul class="bg-bubbles">
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
</ul>
  </div>
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script>
    $('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
  var $this = $(this),
      label = $this.prev('label');

	  if (e.type === 'keyup') {
			if ($this.val() === '') {
          label.removeClass('active highlight');
        } else {
          label.addClass('active highlight');
        }
    } else if (e.type === 'blur') {
    	if( $this.val() === '' ) {
    		label.removeClass('active highlight'); 
			} else {
		    label.removeClass('highlight');   
			}   
    } else if (e.type === 'focus') {
      
      if( $this.val() === '' ) {
    		label.removeClass('highlight'); 
			} 
      else if( $this.val() !== '' ) {
		    label.addClass('highlight');
			}
    }

});

$('.tab a').on('click', function (e) {
  
  e.preventDefault();
  
  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');
  
  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(600);
  
});
  </script>
</body>
</html>
 