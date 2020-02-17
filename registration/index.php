<?php
ob_start();
session_start();
echo "Registrations are closed now you can still participate in events by paying on spot";
//header("Location: ../payment/?product=9");
exit;
	include_once '../dbconnect.php';
	$error = false;
	//echo "$_POST['phone']";
	if ( isset($_POST['btn-signup']) ) {
			// clean user inputs to prevent sql injections
		$fname = trim($_POST['firstName']);
		$fname = strip_tags($fname);
		$fname = htmlspecialchars($fname);
		$fname = mysqli_real_escape_string($dbc, $fname);
		
		$lname = trim($_POST['lastName']);
		$lname = strip_tags($lname);
		$lname = htmlspecialchars($lname);
		$lname = mysqli_real_escape_string($dbc, $lname);
		
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		
		$phone = trim($_POST['phone']);
		$phone = strip_tags($phone);
		$phone = htmlspecialchars($phone);
		$phone = mysqli_real_escape_string($dbc, $phone);
		
		$college = trim($_POST['college']);
		$college = strip_tags($college);
		$college = htmlspecialchars($college);
		$college = mysqli_real_escape_string($dbc, $college);
                 
		
		$gender = trim($_POST['gender']);
		$gender = strip_tags($gender);
		$gender = htmlspecialchars($gender);
                $gender = mysqli_real_escape_string($dbc, $gender);		

		$branch = trim($_POST['branch']);
		$branch = strip_tags($branch);
		$branch = htmlspecialchars($branch);
		$branch = mysqli_real_escape_string($dbc, $branch);
		
		$degree = trim($_POST['degree']);
		$degree = strip_tags($degree);
		$degree = htmlspecialchars($degree);
                $degree = mysqli_real_escape_string($dbc, $degree);		

		$year = trim($_POST['year']);
		$year = strip_tags($year);
		$year = htmlspecialchars($year);
                $year = mysqli_real_escape_string($dbc, $year);
		
		$size = trim($_POST['size']);
		$size = strip_tags($size);
		$size = htmlspecialchars($size);
                $size = mysqli_real_escape_string($dbc, $size);
		
		$password = trim($_POST['password']);
		$password = strip_tags($password);
		$password = htmlspecialchars($password);
		$password = mysqli_real_escape_string($dbc, $password);
		
		$passwordconf = trim($_POST['passwordconf']);
		$passwordconf = strip_tags($passwordconf);
		$passwordconf = htmlspecialchars($passwordconf);
		$passwordconf = mysqli_real_escape_string($dbc, $passwordconf);
		
		// basic name validation
		if (empty($fname)) {
			$error = true;
			echo "Please enter your full name.";
			header("refresh:4;url=../register-login/");
			exit;
		} else if (strlen($fname) < 3) {
			$error = true;
			echo "Name must have atleat 3 characters.";
			header("refresh:4;url=../register-login/");
			exit;
		} else if (!preg_match("/^[a-zA-Z ]+$/",$fname)) {
			$error = true;
			echo "Name must contain alphabets and space.";
			header("refresh:4;url=../register-login/");
			exit;
		}
		if (empty($lname)) {
			$error = true;
			echo "Please enter your full name.";
			header("refresh:4;url=../register-login/");
			exit;
		} else if (strlen($lname) < 3) {
			$error = true;
			echo "Name must have atleat 3 characters.";
			header("refresh:4;url=../register-login/");
			exit;
		} else if (!preg_match("/^[a-zA-Z ]+$/",$lname)) {
			$error = true;
			echo "Name must contain alphabets and space.";
			header("refresh:4;url=../register-login/");
			exit;
		}
		
		//basic email validation
		if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			echo "Please enter valid email address.";
			header("refresh:4;url=../register-login/");
			exit;
		} else {
			// check email exist or not
			$query = "SELECT email FROM userlogin WHERE email='$email'";
			$result = mysqli_query($dbc, $query);
			$count = mysqli_num_rows($result);
			if($count!=0){
				$error = true;
				echo "Provided Email is already in use. Please try login.";
				header("refresh:4;url=../register-login/");
				exit;
			}
		}
		
		if (empty($password)){
			$error = true;
			echo "Please enter password.";
			header("refresh:4;url=../register-login/");
			exit;
		} else if(strlen($password) < 6) {
			$error = true;
			echo "Password must have atleast 6 characters.";
			header("refresh:4;url=../register-login/");
			exit;
		} else if($password != $passwordconf) {
			echo "Please enter same password in both fields";
			header("refresh:4;url=../register-login/");
			exit;
		}
		
		if (empty($phone)){
			$error = true;
			echo "Please enter phone number.";
			header("refresh:4;url=../register-login/");
			exit;
		} else if(strlen($phone) < 10) {
			$error = true;
			echo "Please enter valid mobile adress.";
			header("refresh:4;url=../register-login/");
			exit;
		} else if (!preg_match("/^[0-9]+$/", $phone)) {
			echo "Please enter a valid phone number";
			header("refresh:4;url=../register-login/");
			exit;
		}
		
		if (empty($branch)) {
			$error = true;
			echo "Please enter your College Name.";
			header("refresh:4;url=../register-login/");
			exit;
		} else if (strlen($branch) < 3) {
			$error = true;
			echo "Branch Name must have atleat 3 characters.";
			header("refresh:4;url=../register-login/");
			exit;
		} else if (!preg_match("/^[a-zA-Z ]+$/",$branch)) {
			$error = true;
			echo "Branch Name must contain alphabets and space.";
		}
		if (empty($college)) {
			$error = true;
			echo "Please enter your College Name.";
		} else if (strlen($college) < 3) {
			$error = true;
			echo "College Name must have atleat 3 characters.";
			header("refresh:4;url=../register-login/");
			exit;
		} else if (!preg_match("/^[a-zA-Z ]+$/",$college)) {
			$error = true;
			echo "College Name must contain alphabets and space.";
			header("refresh:4;url=../register-login/");
			exit;
		}
		$regID = '';
		function Randomstr($dbc) {
		global $regID; 
		$regID = 'Indhan2k18-'.rand(10000,99999);
		$chkID = "SELECT RegID FROM userlogin WHERE RegID = '$regID'";
		$query = mysqli_query($dbc, $chkID);
		$check = mysqli_num_rows($query);
		if ($check > 0) {
			Randomstr($dbc);
		}
		}
		$password = hash('sha256', $password);
		Randomstr($dbc);
		if( !$error ) {
			if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
			}

		// then use the date functions, not the other way around
		$date = date("d/m/Y H:i a");
			$query = "INSERT INTO userlogin (RegID, email, password, PAID) VALUES('$regID','$email','$password','0')";
			$res = mysqli_query($dbc, $query);
			$query2 = "INSERT INTO usercredentials (firstName, lastName, email, phone, gender, college, PAID, RegID, branch, degree, year, lastlogin,  SIZE ) VALUES('$fname','$lname','$email','$phone','$gender','$college','0','$regID', '$branch', '$degree', '$year', '$date', '$size')";
			$res2 = mysqli_query($dbc, $query2);
			if ($res && $res2) {
				$errTyp = "success";
				$res = "SELECT ID, RegID, email FROM userlogin WHERE email='$email'";
				$query = mysqli_query($dbc, $res);
				$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
				$count = mysqli_num_rows($query);
				if ($count == 1) {
					$_SESSION['user'] = $row['ID'];
					$_SESSION['password'] = $password;
					$_SESSION['regID'] = $regID;
					echo "Registrations are closed now you can still participate in events by paying on spot";
					//header("Location: ../payment/?product=9");
					exit;
				}
				
			} else {
				$errTyp = "danger";
				die("Something went wrong with database, try again later...");	
			}	
				
		}
	}
	else {
		echo "You are not supposed to be here";
		header("Location: ../");
		exit;
	}
	ob_end_flush();
?>