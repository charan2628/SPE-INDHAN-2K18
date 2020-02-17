<?php
ob_start();
session_start();

include_once "../dbconnect.php";
if (isset($_SESSION['user'])!='') {
	$userID = $_SESSION['user'];
	$regID = $_SESSION['regID'];
	$res=mysqli_query($dbc, "SELECT ID, RegID, email, password, PAID FROM userlogin WHERE RegID='$regID'");
	$rowuser=mysqli_fetch_assoc($res);
	$count = mysqli_num_rows($res);
	if( $count == 1 && $rowuser['PAID']=='0' ) {
	echo 'redirect';
	header("Location: ../payment/?product=9");
	exit;
	}
	elseif ( $count == 1 && $rowuser['PAID']=='1') {
		$query = mysqli_query($dbc, "SELECT * FROM usercredentials WHERE RegID = '$regID'");
		$rowuser = mysqli_fetch_assoc($query);
		$user = $rowuser['firstName'];
		$regID = $rowuser['RegID'];
	}
	elseif ( $count == 0 ) {
		die("You are off the radar");
		exit;
	}
}
else {
        echo "session start";
	header ("Location: ../");
	exit;
}

if (isset($_POST['btn-change'])) {
  $size = trim($_POST['size']); 
  $size = strip_tags($size);
  $size = htmlspecialchars($size);
  $size = mysqli_real_escape_string($dbc, $size);

  if (empty($size)) {
			$error = true;
			echo "Please enter your full size.";
			header("refresh:4;url=../register-login/");
			exit;
		} else if (!preg_match("/^[a-zA-Z ]+$/",$size)) {
			$error = true;
			echo "Size must contain alphabets and space.";
			header("refresh:4;url=../register-login/");
			exit;
		}
$query = mysqli_query($dbc, "UPDATE usercredentials SET SIZE = '$size' WHERE firstName = '$user' AND RegID = '$regID'");
if ($query) {
header("Location:../dashboard/");
} else {
die ("Try Again");
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
<div class="field-wrap select">
            <label>T-SHIRT SIZE </label><br>
            <select name="size">
              <option value="S">SMALL</option>
              <option value="M">MEDIUM</option>
              <option value="L">LARGE</option>
              <option value="XL">XTRA LARGE</option>
            </select>
</div>
<button type="submit" class="button button-block" name="btn-change" />CHANGE</button>

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