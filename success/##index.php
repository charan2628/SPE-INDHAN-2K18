<?php
ob_start();
session_start();
include_once '../dbconnect.php';
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="DsSYDIKU0I";
$payumoneyID = $_POST['payuMoneyId'];
If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
	else {	  

        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 $hash = hash("sha512", $retHashSeq);
		 
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   }
	   else {
           	if (isset($_SESSION['user']) && isset($_SESSION['regID']) && isset($_SESSION['password'])) {
				$id = $_SESSION['user'];
				$regID = $_SESSION['regID'];
				$password = $_SESSION['password'];
				$query = mysqli_query($dbc, "SELECT * FROM userlogin WHERE ID = '$id' AND RegID = '$regID' AND password = '$password'");
				$row = mysqli_fetch_assoc($query);
				$count = mysqli_num_rows($query);
				$regID = $row['RegID'];
			if ($count == 1) {
				if (strtoupper($productinfo) == 'REGISTRATION') {
				$ql1 = "UPDATE userlogin SET PAID = '1' WHERE email = '$email' LIMIT 1";
				$ql2 = "UPDATE usercredentials SET PAID = '1' WHERE email = '$email' LIMIT 1";
				$ql3 = "UPDATE userlogin SET txnid = '$payumoneyID' WHERE email = '$email' LIMIT 1";
				$query1 = mysqli_query($dbc, $ql1);
				$query2 = mysqli_query($dbc, $ql2);
				$query3 = mysqli_query($dbc, $ql3);
					if ($query1 & $query2 & $query3) {
						$query = mysqli_query($dbc, "SELECT * FROM usercredentials WHERE RegID = '$regID' AND email = '$email'");
						$rowuser = mysqli_fetch_assoc($query);
						$name = $rowuser['firstName'];
						echo "Successfully Registerd a mail will be sent with registration ID and Transaction ID please check";
						$from = 'admin@speindhan2k18.org';
						$subject = 'Sucessfuly Registerd';
						$message = '
				  <!DOCTYPE html>
				 <html>
					<head>
						<title>SPE INDHAN 2K18</title>
					</head>
					<body style="font-family: Verdana, Geneva, sans-serif; background-color: #fffffc; width: 100%; height: 100%">
						<h1 style="text-align: center; font-weight: 600;">SPE INDHAN 2K18</h1>
						<br>
						<h2>Dear '.$name.'</h2>
						<h1>Thank You for registering to SPE INDHAN 2K18</h1>
						<h2>Your Registration ID </h2>
						<p>&nbsp;'.$regID.'</p>
						<h2>Your Transaction ID</h2>
						<p>&nbsp;'.$payumoneyID.'</p>
						<p>Please keep these details with you. Check Out the events by visiting the site. Click the link below to visit the site</p>
						<br>
						<a href="https://www.speindhan2k18.org" style="text-align: center; border-radius: 4px; display: inline-block; font-weight: bold; line-height: 22px; padding: 10px 20px; text-decoration: none; background-color: blue; font-family: Avenor, sans-serif; color: white; margin-left: 10px;">LINK</a>
					</body>
					</html>';
					$headers = "From: $from\n";
					$headers .= "MIME-Version: 1.0\n";
					$headers .= "Content-type: text/html; charset=UTF-8\n";
					if(mail($email,$subject,$message,$headers)) {
					echo 'Email has sent successfully. Please Check <br> Redirected to main page in 5 seconds';
					header("refresh:5;url=../member/");
					 }
				    else {
					echo 'Email sending fail.'; 
					header("refresh:5;url=../member/");
					exit;
					}
					}
				}
				else {
				if (strtoupper($productinfo) == 'EXPOSITION' || strtoupper($productinfo) == 'PLAKAT') {
				$query = mysqli_query($dbc, "UPDATE $productinfo SET PAID = '1', txnid = '$payumoneyID' WHERE RegID = '$regID'");
				$query = mysqli_query($dbc, "SELECT * FROM $productinfo WHERE RegID = '$regID'");
				$eventRow = mysqli_fetch_assoc($query);
$query = mysqli_query($dbc, "SELECT * FROM usercredentials WHERE RegID = '$regID' AND email = '$email'");
						$rowuser = mysqli_fetch_assoc($query);
						$name = $rowuser['firstName'];
				if ($eventRow['PAID'] == '1') {
					$from = 'admin@speindhan2k18.org';
						$subject = 'Sucessfuly Registerd';
						$message = '
					<!DOCTYPE html>
					<html>
					<head>
						<title>SPE INDHAN 2K18</title>
					</head>
					<body style="font-family: Verdana, Geneva, sans-serif; background-color: #fffffc; width: 100%; height: 100%">
						<h1 style="text-align: center; font-weight: 600;">SPE INDHAN 2K18</h1>
						<br>
						<h2>Dear '.$name.'</h2>
						<h1>Thank You for registering to '.$productinfo.'</h1>
						<h2>Your Registration ID </h2>
						<p>&nbsp;'.$regID.'</p>
						<h2>Your Transaction ID</h2>
						<p>&nbsp;'.$payumoneyID.'</p>
						<p>Please keep these details with you. Check Out the events by visiting the site. Click the link below to visit the site</p>
						<br>
						<a href="https://www.speindhan2k18.org" style="text-align: center; border-radius: 4px; display: inline-block; font-weight: bold; line-height: 22px; padding: 10px 20px; text-decoration: none; background-color: blue; font-family: Avenor, sans-serif; color: white; margin-left: 10px;">LINK</a>
					</body>
					</html>';
					$headers = "From: $from\n";
					$headers .= "MIME-Version: 1.0\n";
					$headers .= "Content-type: text/html; charset=UTF-8\n";
					if(mail($email,$subject,$message,$headers)) {
					echo "Successfully registerd to $table. Details will be sent through Mail. Redirected to your DASHBOARD in 5 seconds";
					header("refresh:5;url=../dashboard/");
					exit;
					}
				    else {
					echo 'Email sending fail.'; 
					header("refresh:5;url=../dashboard/");
					exit;
					}
				}
				else {
					die("Not Registerd to event");
				}
				}
				else {
					$query = mysqli_query($dbc, "INSERT INTO $productinfo(RegID, txnid, PAID) VALUES('$regID', '$payumoneyID', '1')");
					$query = mysqli_query($dbc, "SELECT * FROM $productinfo WHERE RegID = '$regID'");
					$eventRow = mysqli_fetch_assoc($query);
$query = mysqli_query($dbc, "SELECT * FROM usercredentials WHERE RegID = '$regID' AND email = '$email'");
						$rowuser = mysqli_fetch_assoc($query);
						$name = $rowuser['firstName'];
					if ($eventRow['PAID'] == '1') {
						$from = 'admin@speindhan2k18.org';
						$subject = 'Sucessfuly Registerd';
						$message = '
					<!DOCTYPE html>
					<html>
					<head>
						<title>SPE INDHAN 2K18</title>
					</head>
					<body style="font-family: Verdana, Geneva, sans-serif; background-color: #fffffc; width: 100%; height: 100%">
						<h1 style="text-align: center; font-weight: 600;">SPE INDHAN 2K18</h1>
						<br>
						<h2>Dear '.$name.'</h2>
						<h1>Thank You for registering to '.$productinfo.'</h1>
						<h2>Your Registration ID </h2>
						<p>&nbsp;'.$regID.'</p>
						<h2>Your Transaction ID</h2>
						<p>&nbsp;'.$payumoneyID.'</p>
						<p>Please keep these details with you. Check Out the events by visiting the site. Click the link below to visit the site</p>
						<br>
						<a href="www.speindhan2k18.org" style="text-align: center; border-radius: 4px; display: inline-block; font-weight: bold; line-height: 22px; padding: 10px 20px; text-decoration: none; background-color: blue; font-family: Avenor, sans-serif; color: white; margin-left: 10px;">LINK</a>
					</body>
					</html>';
					$headers = "From: $from\n";
					$headers .= "MIME-Version: 1.0\n";
					$headers .= "Content-type: text/html; charset=UTF-8\n";
					if(mail($email,$subject,$message,$headers)) {
					echo "Successfully registerd to $table. Details will be sent through Mail. Redirected to your DASHBOARD in 5 seconds";
					header("refresh:5;url=../dashboard/");
					exit;
					}
				    else {
					echo 'Email sending fail.'; 
					header("refresh:5;url=../dashboard/");
					exit;
					}
					}
				}
          echo "<h3>Thank You. Your order status is ". $status .".</h3>";
          echo "<h4>Your Transaction ID for this transaction is ".$payumoneyID.".</h4>";
          echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
           
		   }  
			}
	   }
	   else {
			echo "<h1> Something wrong with your session variable please note these details and mail us</h1>";
			echo "<h3>Thank You. Your order status is ". $status .".</h3>";
			echo "<h4>Your Transaction ID for this transaction is ".$payumoneyID.".</h4>";
			echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";  
	   }
	   }	   
?>	