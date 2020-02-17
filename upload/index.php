<?php 
include_once("../dbconnect.php");
ob_start();
session_start();
if (isset($_SESSION['user'])!='') {
	$regID = $_SESSION['regID'];
	$res=mysqli_query($dbc, "SELECT ID, RegID, email, password, PAID FROM userlogin WHERE RegID='$regID'");
	$rowuser=mysqli_fetch_assoc($res);
	$count = mysqli_num_rows($res);
	$event = $_POST['event'];
	if( $count == 1 && $rowuser['PAID']=='0' ) {
	echo 'redirect';
	header("Location: ../payment/?product=9");
	exit;
	}
	elseif ( $count == 1 && $rowuser['PAID']=='1' && $event == 'exposition') {
		$query = mysqli_query($dbc, "SELECT * FROM usercredentials WHERE RegID = '$regID'");
		$rowuser = mysqli_fetch_assoc($query);
		$regID = $rowuser['RegID'];
		//echo $regID;
		//$query = mysqli_query($dbc, "SELECT * FROM $event WHERE RegID = '$regID'");
		//$rowcheck = mysqli_fetch_assoc($query);
		//echo "PAID ".$rowcheck['RegID'];
		if(isset($_FILES['FileInputExposition']['name'])) {
			$UploadDirectory	= '../uploads/'.$_POST['event'].'/';
			if ($_FILES["FileInputExposition"]["size"] > 20042880) {
			die("File size is too big!");
			}
			$fileType = strtolower(pathinfo($_FILES['FileInputExposition']['name'],PATHINFO_EXTENSION));
			if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
				&& $fileType != "gif" && $fileType != "pdf" && $fileType != "ppt" && $fileType != "pptx") {
			echo "Sorry, we don't support these format. <br> Supported Formats: jpeg, gif, pdf, ppt, pptx ";
			exit;
			}
			$File_Name = strtolower($_FILES['FileInputExposition']['name']);
			$File_Ext = substr($File_Name, strrpos($File_Name, '.')); 
			$Random_Number = '-'.rand(10000, 99999);
			$NewFileName = $regID.$Random_Number.$File_Ext; 
			if(move_uploaded_file($_FILES['FileInputExposition']['tmp_name'], $UploadDirectory.$NewFileName )) {
				if ($rowcheck['file'] != '') {
					$file = "../uploads/".$event."/".$rowcheck['file'];
					unlink($file);
				}
				$query = mysqli_query($dbc, "INSERT INTO $event(file, status, RegID) VALUES('$NewFileName','PENDING...','$regID')");
				if ($query) {
					echo "Successfully Uploaded";
					header("refresh:3;url=../dashboard/");
					exit;
				}
				else {
					echo "Something Wrong DATABASE";
				}
			}
		}
		else {
			echo "Something Wrong FILE INPUT";
		}
		
	}
	
	
	elseif ( $count == 1 && $rowuser['PAID']=='1' && $event == 'plakat') {
		$query = mysqli_query($dbc, "SELECT * FROM usercredentials WHERE RegID = '$regID'");
		$rowuser = mysqli_fetch_assoc($query);
		$regID = $rowuser['RegID'];
		//echo $regID;
		//$query = mysqli_query($dbc, "SELECT * FROM $event WHERE RegID = '$regID'");
		//$rowcheck = mysqli_fetch_assoc($query);
		//echo "PAID ".$rowcheck['RegID'];
		if(isset($_FILES['FileInputPlakat']['name'])) {
			$UploadDirectory	= '../uploads/'.$_POST['event'].'/';
			if ($_FILES["FileInputPlakat"]["size"] > 20042880) {
			die("File size is too big!");
			}
			$fileType = strtolower(pathinfo($_FILES['FileInputPlakat']['name'],PATHINFO_EXTENSION));
			if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
				&& $fileType != "gif" && $fileType != "pdf" && $fileType != "ppt" && $fileType != "pptx") {
			echo "Sorry, we don't support these format. <br> Supported Formats: jpeg, gif, pdf, ppt, pptx ";
			exit;
			}
			$File_Name = strtolower($_FILES['FileInputPlakat']['name']);
			$File_Ext = substr($File_Name, strrpos($File_Name, '.')); 
			$Random_Number = '-'.rand(10000, 99999);
			$NewFileName = $regID.$Random_Number.$File_Ext; 
			if(move_uploaded_file($_FILES['FileInputPlakat']['tmp_name'], $UploadDirectory.$NewFileName )) {
				if ($rowcheck['file'] != '') {
					$file = "../uploads/".$event."/".$rowcheck['file'];
					unlink($file);
				}
				$query = mysqli_query($dbc, "INSERT INTO $event(file, status, RegID) VALUES('$NewFileName','PENDING...','$regID')");
				if ($query) {
					echo "Successfully Uploaded";
					header("refresh:3;url=../dashboard/");
					exit;
				}
				else {
					echo "Something Wrong DATABASE";
				}
			}
		}
		else {
			echo "Something Wrong FILE INPUT";
		}
		
	}
	
	
	
	elseif ( $count == 0 ) {
		echo  "1111";
		//header ("Location: indexExp1.html");
		exit;
	}
}
else {
	echo "222";
	//header ("Location: indexExp1.html");
	exit;
}
?>