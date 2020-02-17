<?php
ob_start();
session_start();

include_once "../dbconnect.php";
if (isset($_POST['btn-forgot']) && isset($_POST['email']) && isset($_POST['purpose']) && isset($_POST['regID'])) {
  $email = trim($_POST['email']); 
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  $email = mysqli_real_escape_string($dbc, $email);

  $regID = trim($_POST['regID']);
  $regID = strip_tags($regID);
  $regID = htmlspecialchars($regID);
  $regID = mysqli_real_escape_string($dbc, $regID);

  if (!preg_match("/^\w{6}\d{1}\w{1}\d{2}-\d{5}$/", $regID)) {
    echo "Please Enter valid REGISTRATION ID";
    header("refresh:3;url=../register-login/");
    exit;
  }

  if(empty($email)){
      $error = true;
      echo "Please enter your email address.";
      header("refresh:3;url=../register-login/");
      exit;
    } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
      $error = true;
      echo "Please enter valid email address.";
      header("refresh:3;url=../register-login/");
      exit;
    }

    $temp = 'Indhan'.rand(10000,99999);
    
    $htemp = hash('sha256', $temp);

    $query1 = mysqli_query($dbc,"UPDATE userlogin SET password = '$htemp' WHERE RegID = '$regID' AND email = '$email' LIMIT 1");
    $query2 = mysqli_query($dbc,"UPDATE userlogin SET conform = 'temp' WHERE RegID = '$regID' AND email = '$email' AND password = '$htemp' LIMIT 1");
    if ($query1 && $query2) {
      $from = 'admin@speindhan2k18.org';
      $subject = 'SPE INDHAN 2K18';
      $message = '
          <!DOCTYPE html>
         <html>
          <head>
            <title>SPE INDHAN 2K18</title>
          </head>
          <body style="font-family: Verdana, Geneva, sans-serif; background-color: #fffffc; width: 100%; height: 100%">
            <h1 style="text-align: center; font-weight: 600;">SPE INDHAN 2K18</h1>
            <br>
            <h1>Your temporary password: </h1>
            <p>&nbsp;'.$temp.'</p>
            <p>Please login with this password and set your new password. Click the link below to visit the site</p>
            <br>
            <a href="https://www.speindhan2k18.org" style="text-align: center; border-radius: 4px; display: inline-block; font-weight: bold; line-height: 22px; padding: 10px 20px; text-decoration: none; background-color: blue; font-family: Avenor, sans-serif; color: white; margin-left: 10px;">LINK</a>
          </body>
          </html>';
          $headers = "From: $from\n";
          $headers .= "MIME-Version: 1.0\n";
          $headers .= "Content-type: text/html; charset=UTF-8\n";
          if(mail($email,$subject,$message,$headers)) {
          echo 'Email has sent successfully with temporary password. Please Check <br> Redirected to main page in 5 seconds';
          header("refresh:5;url=../");
          exit;
           }
            else {
          echo 'Email sending fail.'; 
          header("refresh:5;url=../");
          exit;
          }
          }
          else {
            die("Database error contact site administrator");
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
<meta name="viewport" content="width=device-width">
<link rel="apple-touch-icon" sizes="57x57" href="../images/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="../images/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="../images/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="../images/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="../images/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="../images/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="../images/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="../images/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="../images/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="../images/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="../images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="../images/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="../images/favicon/favicon-16x16.png">
<link rel="manifest" href="../images/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="../images/favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" type="text/css" href="../css/forgot.css">
  <title>FORGOT PASSWORD</title>
  <link href='//fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-96589286-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-96589286-2');
</script>

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


<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
<div class="field-wrap">
<label>
EMAIL<span class="req">*</span>
</label>
<input type="email"required autocomplete="on" name="email" />
</div>
<div class="field-wrap">
<label>
REGISTRATION ID<span class="req">*</span>
</label>
<input type="text"required autocomplete="on" name="regID" />
</div>
<input type="hidden" name="purpose" value="forgotpassword">
<button type="submit" class="button button-block" name="btn-forgot" />FORGOT PASSWORD</button>

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
<?php ob_end_flush(); ?>