<?php
ob_start();
session_start();
include_once '../dbconnect.php';
if (isset($_SESSION['user'])!='' && isset($_SESSION['regID']) && isset($_SESSION['password'])) {
	if (!preg_match("/^\w{6}\d{1}\w{1}\d{2}-\d{5}$/", $_SESSION['regID']) ) {
		die ("Something Wrong with session variables please logoout and try again");
	}
	$regID = mysqli_real_escape_string($dbc,$_SESSION['regID']);
	$id = mysqli_real_escape_string($dbc, $_SESSION['user']);
	$password = mysqli_real_escape_string($dbc, $_SESSION['password']);
	$res=mysqli_query($dbc, "SELECT * FROM userlogin WHERE RegID='$regID' AND ID = '$id' AND password = '$password'");
	$row=mysqli_fetch_assoc($res);
	$count = mysqli_num_rows($res);
	if( $count == 1 && $row['PAID']=='1' ) {
	header("Location: ../member/");
	exit;
	}
	elseif ( $count == 1 && $row['PAID']=='0') {
		$_SESSION['user'] = $row['ID'];
		$_SESSION['regID'] = $row['RegID'];
		$_SESSION['password'] = $row['password'];
		$_SESSION['table'] = 'REGISTRATION';
		header("Location:../payment/?product=9");
		exit;
	}
	else {
		die("You are not Supposed To be Here");
	}
}
$error = false;


if( isset($_POST['btn-login']) ) {	
		
		// prevent sql injections/ clear user invalid inputs
		$email = trim($_POST['email']); 
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		$email = mysqli_real_escape_string($dbc, $email);
		
		$password = trim($_POST['password']);
		$password = strip_tags($password);
		$password = htmlspecialchars($password);
		$password = mysqli_real_escape_string($dbc, $password);
		
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
		
		if(empty($password)){
			$error = true;
			echo "Please enter your password.";
			header("refresh:3;url=../register-login/");
			exit;
		}
		if (!$error) {
			//echo " In ";
			$password = hash('sha256', $password); // password hashing using SHA256
		
			$res=mysqli_query($dbc, "SELECT * FROM userlogin WHERE email='$email'");
			$row=mysqli_fetch_assoc($res);
			$count = mysqli_num_rows($res);
			if( $count == 1 && $row['password']==$password ) {
				if ($row['conform'] == 'temp') {
					//echo $password;
					$_SESSION['temp'] = $row['password'];
					header("Location: ../reset/");
					exit;
				}
				if ($row['PAID'] == '1') {
					$_SESSION['user'] = $row['ID'];
					$_SESSION['regID'] = $row['RegID'];
					$_SESSION['password'] = $row['password'];
					if (isset($_SESSION['page'])) {
					   $page = $_SESSION['page'];
					   header("Location: ../$page/");
					   exit;
					}
					header ("Location: ../member/");
					exit;
				}
				else {
					$_SESSION['user'] = $row['ID'];
					$_SESSION['regID'] = $row['RegID'];
					$_SESSION['password'] = $row['password'];
					echo "You hadn't made the payment we are redirecting you to payment site  in 5 seconds";
					header("refresh:5;url=../payment/?product=9");
					exit;
				}
			}
			else {
			echo $email;
			echo "<br>";
			echo $password."<br>";
				echo "We hadn't found you on our database Please Register";
				header ("refresh:5;url=../");
			}
		}
}
ob_end_flush();

			
			
			
			
			
			
			
			