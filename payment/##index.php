<?php
ob_start();
session_start();
/**********

********************************
*							   *
*  PAYMENT TRANSACTION DETAILS *
*							   *
********************************

**********/

// Merchant key here as provided by Payu
$MERCHANT_KEY = "QCzSGIif";

// Merchant Salt as provided by Payu
$SALT = "DsSYDIKU0I";

// End point - change to https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://secure.payu.in/";

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}



include_once '../dbconnect.php';
if (isset($_SESSION['user'])!='' & isset($_GET['product']) & isset($_SESSION['regID']) & isset($_SESSION['password'])) {
	if (!preg_match("/^\w{6}\d{1}\w{1}\d{2}-\d{5}$/", $_SESSION['regID']) || !preg_match("/^\d{1}(\d{1})?$/", $_GET['product']) || !preg_match("/^\d{1}(\d{1})?$/", $_SESSION['user']) ) {
		die ("Something Wrong with session variables please logoout and try again");
	}
	$alert = '';
	$id = mysqli_real_escape_string($dbc, $_SESSION['user']);
	$regID = mysqli_real_escape_string($dbc, $_SESSION['regID']);
	$password = mysqli_real_escape_string($dbc, $_SESSION['password']);
	$product = mysqli_real_escape_string($dbc, $_GET['product']);
	$price;
	$productName;
	$res=mysqli_query($dbc, "SELECT * FROM userlogin WHERE RegID='$regID' AND password='$password' AND ID = '$id'");
	$rowuser=mysqli_fetch_assoc($res);
	$count = mysqli_num_rows($res);
	$res2 = mysqli_query($dbc, "SELECT * FROM usercredentials WHERE RegID='$regID'");
	$userdata = mysqli_fetch_assoc($res2);
	$row = array();
	for ($i = 1; $i <= 16; $i++) {
	$query = mysqli_query($dbc, "SELECT * FROM pricetable WHERE ID = $i");
	$row[$i] = mysqli_fetch_assoc($query);
	}
	if( $count == 1 && $rowuser['PAID']=='0' ) {
	$_SESSION['table'] = $row[9]['productName'];
	$productName = $row[9]['productName'];
	$price = $row[9]['price'];
	$alert = 'A T-SHIRT WILL BE PROVIDED FOR FREE ON COMPLETING BASIC REGISTRATION';
	}
	elseif ($count == 1 && $rowuser['PAID']=='1') {
	if ($product == 2 || $product == 3) {
		$productName = $row[$product]['productName'];
		$query = mysqli_query($dbc, "SELECT * FROM $productName WHERE RegID = '$regID'");
		$rowCurr = mysqli_fetch_assoc($query);
		if ($rowCurr['status'] == 'ACCEPTED') {
			$_SESSION['table'] = $row[$product]['productName'];
			$productName = $row[$product]['productName'];
			$price = $row[$product]['price'];
		}
		else {
			header("Location: ../dashboard/");
			exit;
		}
	}
	else {
	$_SESSION['table'] = $row[$product]['productName'];
	$productName = $row[$product]['productName'];
	$price = $row[$product]['price'];
	}
	}
	else {
		die("we can't find you");
	}
}
else {
	header ("Location: ../register-login/");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>INDHAN PAYMENTS PAGE</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="description" content="SPE INDHAN 2K18 is a two day National technical symposium organised by the Departmment of Petroleum and Petrochemical Engineering of JNTU KAKINADA.">
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
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/bttn.min.css">
	<link rel="stylesheet" type="text/css" href="../css/payment.css">
	<script type="text/javascript" src="../js/modernizr.js"></script>
	<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../js/payment.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-96589286-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-96589286-2');
</script>

	<script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  	</script>
</head>
<body onload="submitPayuForm()">

<header>
<nav>
<div class="logo"><img src="../images/logos/logos.png"></div><h1><a href="index.php">SPE INDHAN 2K18</a></h1>

</nav>
</header>
<section>
	<table>
		<tr style="background-color: #00D1FF; color:white;"">
			<th colspan="3"><h1>Payment Details</h1></th>
		</tr>
		<tr>
			<td><p><?php echo strtoupper($productName) ?></p></td>
			<td><p>Rs: <?php echo $price ?></p></td>
			<td><a href="../member/"><p>DETAILS</p></a></td>
		</tr>
		<tr>
			<th colspan="3">
	<form action="<?php echo $action; ?>" method="post" name="payuForm">
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
      <input type="hidden" name="amount" value="<?php echo $price ?>" />
      <input type="hidden" name="firstname" id="firstname" value="<?php echo $userdata['firstName']; ?>" />
      <input type="hidden" name="email" id="email" value="<?php echo $userdata['email'];?>" />
      <input type="hidden" name="phone" value="<?php echo $userdata['phone'] ?>" />
	  <input type="hidden" name="productinfo" value="<?php echo $productName ?>" />
      <input type="hidden" name="surl" value="https://www.speindhan2k18.org/success/" />
      <input type="hidden" name="furl" value="https://www.speindhan2k18.org/failure/"/>
	  <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
          <?php if(!$hash) { ?>
          	<button type="submit" class="bttn-pill bttn-md bttn-primary" name="Submit" />MAKE PAYMENT</button>
          <?php } ?>
    </form>
	
			</th>
		</tr>
	</table>
	<script>
	alert('<?php echo $alert; ?>');
	</script>
</section>
</body>
</html>
<?php ob_end_flush(); ?>
