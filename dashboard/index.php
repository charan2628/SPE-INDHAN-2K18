<?php
ob_start();
session_start();
include_once '../dbconnect.php';
$row = array("werkstatt", "exposition", "plakat", "namuna", "brainiac", "mudmash", "chemileon", "exegesis", "registration", "accommodation", "aromould", "fielddevelopment", "gameofrocks", "toolpuzzle", "examen", "food");
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
        //echo "session start";
       $pagedata = pathinfo($_SERVER['REQUEST_URI']);
       $_SESSION['page'] = $pagedata['basename'];
	header ("Location: ../register-login/");
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>DASHBOARD</title>
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
	<link rel="stylesheet" type="text/css" href="../css/dashboard.css">
	<script type="text/javascript" src="../js/modernizr.js"></script>
	<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../css/dashboard.js"></script>
	<script src="https://use.fontawesome.com/4326c746fe.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-96589286-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-96589286-2');
</script>
<script>
function _(e1) {
	return document.getElementById(e1);
}
function uploadFileExposition() {
	var file = _("FileInputExposition").files[0];
	var formdata = new FormData();
	formdata.append("FileInputExposition", file);
	formdata.append("event", "exposition");
	var ajax = new XMLHttpRequest ();
	ajax.upload.addEventListener("progress", progressHandlerExposition, false);
	ajax.addEventListener("load", completeHandlerExposition, false);
	ajax.addEventListener("error", errorHandlerExposition, false);
	ajax.addEventListener("abort", abortHandlerExposition, false);
	ajax.open("POST", "../upload/index.php", true);
	ajax.send(formdata);

}
function progressHandlerExposition (event) {
	var percent = (event.loaded / event.total) * 100;
	_("progressBarExposition").value = Math.round(percent);
	_("statusExposition").innerHTML = Math.round(percent) + "% uploaded... please wait";
	console.log(percent);

}

function completeHandlerExposition (event) {
	_("statusExposition").innerHTML = event.target.responseText;
	_("progressBarExposition").value = 0;
	setTimeout(function() {
	location.reload();
	}, 4500);
	
}
function abortHandlerExposition (event) {
	_("statusExposition").innerHTML = "Upload Aborted";
	
}
function errorHandlerExposition (event) {
	_("statusExposition").innerHTML = "Upload Failed";
}
</script>
<script>
function _(e1) {
	return document.getElementById(e1);
}
function uploadFilePlakat() {
	var file = _("FileInputPlakat").files[0];
	var formdata = new FormData();
	formdata.append("FileInputPlakat", file);
	formdata.append("event", "plakat");
	var ajax = new XMLHttpRequest ();
	ajax.upload.addEventListener("progress", progressHandlerPlakat, false);
	ajax.addEventListener("load", completeHandlerPlakat, false);
	ajax.addEventListener("error", errorHandlerPlakat, false);
	ajax.addEventListener("abort", abortHandlerPlakat, false);
	ajax.open("POST", "../upload/index.php", true);
	ajax.send(formdata);

}
function progressHandlerPlakat (event) {
	var percent = (event.loaded / event.total) * 100;
	_("progressBarPlakat").value = Math.round(percent);
	_("statusPlakat").innerHTML = Math.round(percent) + "% uploaded... please wait";
	console.log(percent);

}

function completeHandlerPlakat (event) {
	_("statusPlakat").innerHTML = event.target.responseText;
	_("progressBarPlakat").value = 0;
	setTimeout(function() {
	location.reload();
	}, 4500);
	
}
function abortHandlerPlakat (event) {
	_("statusPlakat").innerHTML = "Upload Aborted";
	
}
function errorHandlerPlakat (event) {
	_("statusPlakat").innerHTML = "Upload Failed";
}
</script>
</head>
<body>
	<div class="wrapper">
  <div class="wrapper_container">
  <!-- start content -->
    <div class="site-wrapper active" id="target">
      <div class="site-wrapper_left-col">
        <a href="../member/" class="logo">SPE INDHAN 2K18</a>
        <div class="left-nav">
          <a href="../member/"><i class="fa fa-home"></i>Home</a>
          <a href="../member/" class="active"><i class="fa fa-pie-chart"></i>Dashboard</a>
        </div>
      </div>
      <div class="site-wrapper_top-bar">
      	<a href="../member/"><i class="fa fa-home"></i></a>
        <h1>HI, <?php echo $user; ?></h1>
      </div>
      <!-- inner content -->
	  <table>
		<tr>
      		<th>ACCOMMODATION</th>
      		<td></td>
      		<td><?php 
				$query = mysqli_query($dbc, "SELECT * FROM $row[9] WHERE RegID = '$regID'");
				$rowCurrent = mysqli_fetch_assoc($query);
				$link = '<a href="../payment/?product=10">MAKE PAYMENT</a>';
				if ($rowCurrent['PAID'] == '1') echo "REGISTERD";
				else echo $link; ?></td>
      	</tr>
		<tr>
      		<th>FOOD</th>
      		<td></td>
      		<td><?php 
				$query = mysqli_query($dbc, "SELECT * FROM $row[15] WHERE RegID = '$regID'");
				$rowCurrent = mysqli_fetch_assoc($query);
				$link = '<a href="../payment/?product=16">MAKE PAYMENT</a>';
				if ($rowCurrent['PAID'] == '1') echo "REGISTERD";
				else echo $link; ?></td>
      	</tr>
      	
      	</tr>
		<tr>
      		<th>T-SHIRT SIZE</th>
      		<td><a href="../tshirt/">CHANGE</a> &nbsp; &nbsp; <a href="https://drive.google.com/open?id=1Fl7Dbtf-IgGAXwDFm14oAuVUjW9Cociq" target="_blank" >SIZE CHART</a></td>
      		<td><?php 
				$query = mysqli_query($dbc, "SELECT * FROM usercredentials WHERE RegID = '$regID'");
				$rowCurrent = mysqli_fetch_assoc($query);
				$link = '<a href="../payment/?product=16">MAKE PAYMENT</a>';
				if ($rowCurrent['SIZE'] == '') echo "";
				else echo $rowCurrent['SIZE']; ?></td>
      	</tr>
	  </table>
	  <h1 style="text-align: center;">EVENTS</h1>
      <table>

      	<tr>
      		<th>WERKSTATT</th>
      		<td><?php
      			$query = mysqli_query($dbc, "SELECT * FROM $row[0] WHERE RegID = '$regID'");
				$rowCurrent = mysqli_fetch_assoc($query);
				if ($rowCurrent['PAID'] == '1' && $rowCurrent['workshop'] == '') {
					$link = '<a href="../workshop/">WORKSHOP</a>';
					echo $link;
				} 
      		?>
      		</td>
      		<td><?php
      			$query = mysqli_query($dbc, "SELECT * FROM $row[0] WHERE RegID = '$regID'");
				$rowCurrent = mysqli_fetch_assoc($query);
				if ($rowCurrent['PAID'] == '1' ) {
				 if ($rowCurrent['workshop'] == '') echo "REGISTERD"; 
				}
			?>
			</td>
      	</tr>

      	<tr>
      		<td colspan="2"><?php
      			$query = mysqli_query($dbc, "SELECT * FROM $row[0] WHERE RegID = '$regID'");
			$rowCurrent = mysqli_fetch_assoc($query);
      			if ($rowCurrent['PAID'] == '1') {
      				if ($rowCurrent['workshop'] == '') {}
      				else {
      					echo "Advances in Petroleum Production Engineering(appe)";
      				}
      			} else echo "Advances in Petroleum Production Engineering(appe)";
      		?>	
      		</td>
      		<td>
      			<?php
      			$query = mysqli_query($dbc, "SELECT * FROM $row[0] WHERE RegID = '$regID'");
				$rowCurrent = mysqli_fetch_assoc($query);
      			$query = mysqli_query($dbc, "SELECT * FROM appe_workshop WHERE RegID = '$regID'");
      			$rowCurrentWorkshop = mysqli_fetch_assoc($query);
      			$link = '<a href="../payment/?product=17">MAKE PAYMENT</a>';
      			if ($rowCurrent['PAID'] == '1') {
      				if ($rowCurrent['workshop'] == '') {}
      				else {
      					if ($rowCurrentWorkshop['PAID'] == '1') echo "REGISTERD";
      					else {
      					if ($rowCurrent['attending'] == '2') {}
      					else echo $link;
      					}
      				}
      			} else echo $link;
      			?>
      		</td>
      	</tr>

      	<tr>
      		<td colspan="2"><?php
      			$query = mysqli_query($dbc, "SELECT * FROM $row[0] WHERE RegID = '$regID'");
				$rowCurrent = mysqli_fetch_assoc($query);
      			if ($rowCurrent['PAID'] == '1') {
      				if ($rowCurrent['workshop'] == '') {}
      				else {
      					echo "Advances in Refinery Process Technologies(arpt)";
      				}
      			} else echo "Advances in Refinery Process Technologies(arpt)";
      		?>	
      		</td>
      		<td>
      			<?php
      			$query = mysqli_query($dbc, "SELECT * FROM $row[0] WHERE RegID = '$regID'");
				$rowCurrent = mysqli_fetch_assoc($query);
      			$query = mysqli_query($dbc, "SELECT * FROM arpt_workshop WHERE RegID = '$regID'");
      			$rowCurrentWorkshop = mysqli_fetch_assoc($query);
      			$link = '<a href="../payment/?product=18">MAKE PAYMENT</a>';
      			if ($rowCurrent['PAID'] == '1') {
      				if ($rowCurrent['workshop'] == '') {}
      				else {
      					if ($rowCurrentWorkshop['PAID'] == '1') echo "REGISTERD";
      					else {
      					if ($rowCurrent['attending'] == '2') {}
      					else echo $link;
      					}
      				}
      			} else echo $link;
      			?>
      		</td>
      	</tr>

      	<tr>
      		<td colspan="2"><?php
      			$query = mysqli_query($dbc, "SELECT * FROM $row[0] WHERE RegID = '$regID'");
				$rowCurrent = mysqli_fetch_assoc($query);
      			if ($rowCurrent['PAID'] == '1') {
      				if ($rowCurrent['workshop'] == '') {}
      				else {
      					echo "Oil and Gas Pipelines(ogp)";
      				}
      			} else echo "Oil and Gas Pipelines(ogp)";
      		?>	
      		</td>
      		<td>
      			<?php
      			$query = mysqli_query($dbc, "SELECT * FROM $row[0] WHERE RegID = '$regID'");
				$rowCurrent = mysqli_fetch_assoc($query);
      			$query = mysqli_query($dbc, "SELECT * FROM ogp_workshop WHERE RegID = '$regID'");
      			$rowCurrentWorkshop = mysqli_fetch_assoc($query);
      			$link = '<a href="../payment/?product=19">MAKE PAYMENT</a>';
      			if ($rowCurrent['PAID'] == '1') {
      				if ($rowCurrent['workshop'] == '') {}
      				else {
      					if ($rowCurrentWorkshop['PAID'] == '1') echo "REGISTERD";
      					else {
      					if ($rowCurrent['attending'] == '2') {}
      					else echo $link;
      					}
      				}
      			} else echo $link;
      			?>
      		</td>
      	</tr>

      	<tr>
      		<th>EXPOSITION</th>
      		<td><?php
				$query = mysqli_query($dbc, "SELECT * FROM $row[1] WHERE RegID = '$regID'");
				$rowCurrent = mysqli_fetch_assoc($query);
				if ($rowCurrent['file'] == '') echo '<form enctype="multipart/form-data" method="post">
	<input type="file" name="FileInput" id="FileInputExposition"><br>
	<input type="button" value="upload" onclick="uploadFileExposition()"><br>
	<progress id="progressBarExposition" value="0" max="100"></progress><br>
	<p id="statusExposition" style="margin:0px;"></p><br>
	<input type="hidden" id="event" name="event" value="exposition">
</form>';
				elseif ($rowCurrent['file'] != '') echo $rowCurrent['status'];
				?></td>
      		<td><?php
				$link = '<a href="../payment/?product=2">MAKE PAYMENT</a>';
				if ($rowCurrent['status'] == 'ACCEPTED' & $rowCurrent['PAID'] == '' || $rowCurrent['PAID'] == '0') echo $link;
				elseif ($rowCurrent['status'] == 'ACCEPTED' & $rowCurrent['PAID'] == '1') echo "REGISTERD"; ?>
			</td>
      	</tr>
      	<tr>
      		<th>PLAKAT</th>
      		<td><?php
				$query = mysqli_query($dbc, "SELECT * FROM $row[2] WHERE RegID = '$regID'");
				$rowCurrent = mysqli_fetch_assoc($query);
				if ($rowCurrent['file'] == '') echo '<form enctype="multipart/form-data" method="post">
	<input type="file" name="FileInput" id="FileInputPlakat"><br>
	<input type="button" value="upload" onclick="uploadFilePlakat()"><br>
	<progress id="progressBarPlakat" value="0" max="100"></progress><br>
	<p id="statusPlakat" style="margin:0px;"></p><br>
	<input type="hidden" id="event" name="event" value="plakat">
</form>';
				elseif ($rowCurrent['file'] != '') echo $rowCurrent['status'];
				?></td>
      		<td><?php
				$link = '<a href="../payment/?product=3">MAKE PAYMENT</a>';
				if ($rowCurrent['status'] == 'ACCEPTED' & $rowCurrent['PAID'] == '' || $rowCurrent['PAID'] == '0') echo $link;
				elseif ($rowCurrent['status'] == 'ACCEPTED' & $rowCurrent['PAID'] == '1') echo "REGISTERD"; ?></td>
      	</tr>
      	<tr>
      		<th>NAMUNA</th>
      		<td></td>
      		<td><?php 
				$query = mysqli_query($dbc, "SELECT * FROM $row[3] WHERE RegID = '$regID'");
				$rowCurrent = mysqli_fetch_assoc($query);
				$link = '<a href="../payment/?product=4">MAKE PAYMENT</a>';
				if ($rowCurrent['PAID'] == '1') echo "REGISTERD";
				else echo $link; ?></td>
      	</tr>
      	<tr>
      		<th>BRAINIAC</th>
      		<td></td>
      		<td><?php 
				$query = mysqli_query($dbc, "SELECT * FROM $row[4] WHERE RegID = '$regID'");
				$rowCurrent = mysqli_fetch_assoc($query);
				$link = '<a href="../payment/?product=5">MAKE PAYMENT</a>';
				if ($rowCurrent['PAID'] == '1') echo "REGISTERD";
				else echo $link; ?></td>
      	</tr>
      	<tr>
      		<th>MUDMASH</th>
      		<td></td>
      		<td><?php 
				$query = mysqli_query($dbc, "SELECT * FROM $row[5] WHERE RegID = '$regID'");
				$rowCurrent = mysqli_fetch_assoc($query);
				$link = '<a href="../payment/?product=6">MAKE PAYMENT</a>';
				if ($rowCurrent['PAID'] == '1') echo "REGISTERD";
				else echo $link; ?></td>
      	</tr>
      	<tr>
      		<th>CHEMILEON</th>
      		<td></td>
      		<td><?php 
				$query = mysqli_query($dbc, "SELECT * FROM $row[6] WHERE RegID = '$regID'");
				$rowCurrent = mysqli_fetch_assoc($query);
				$link = '<a href="../payment/?product=7">MAKE PAYMENT</a>';
				if ($rowCurrent['PAID'] == '1') echo "REGISTERD";
				else echo $link; ?></td>
      	</tr>
      	<tr>
      		<th>EXEGESIS</th>
      		<td></td>
      		<td><?php 
				$query = mysqli_query($dbc, "SELECT * FROM $row[7] WHERE RegID = '$regID'");
				$rowCurrent = mysqli_fetch_assoc($query);
				$link = '<a href="../payment/?product=8">MAKE PAYMENT</a>';
				if ($rowCurrent['PAID'] == '1') echo "REGISTERD";
				else echo $link; ?></td>
      	</tr>
		<tr>
      		<th>AROMOULD</th>
      		<td></td>
      		<td><?php 
				$query = mysqli_query($dbc, "SELECT * FROM $row[10] WHERE RegID = '$regID'");
				$rowCurrent = mysqli_fetch_assoc($query);
				$link = '<a href="../payment/?product=11">MAKE PAYMENT</a>';
				if ($rowCurrent['PAID'] == '1') echo "REGISTERD";
				else echo $link; ?></td>
      	</tr>
		<tr>
      		<th>FIELD DEVELOPMENT</th>
      		<td></td>
      		<td><?php 
				$query = mysqli_query($dbc, "SELECT * FROM $row[11] WHERE RegID = '$regID'");
				$rowCurrent = mysqli_fetch_assoc($query);
				$link = '<a href="../payment/?product=12">MAKE PAYMENT</a>';
				if ($rowCurrent['PAID'] == '1') echo "REGISTERD";
				else echo $link; ?></td>
      	</tr>
		<tr>
      		<th>GAME OF ROCKS</th>
      		<td></td>
      		<td><?php 
				$query = mysqli_query($dbc, "SELECT * FROM $row[12] WHERE RegID = '$regID'");
				$rowCurrent = mysqli_fetch_assoc($query);
				$link = '<a href="../payment/?product=13">MAKE PAYMENT</a>';
				if ($rowCurrent['PAID'] == '1') echo "REGISTERD";
				else echo $link; ?></td>
      	</tr>
		<tr>
      		<th>TOOL PUZZLE</th>
      		<td></td>
      		<td><?php 
				$query = mysqli_query($dbc, "SELECT * FROM $row[13] WHERE RegID = '$regID'");
				$rowCurrent = mysqli_fetch_assoc($query);
				$link = '<a href="../payment/?product=14">MAKE PAYMENT</a>';
				if ($rowCurrent['PAID'] == '1') echo "REGISTERD";
				else echo $link; ?></td>
      	</tr>
		<tr>
      		<th>EXAMEN</th>
      		<td></td>
      		<td><?php 
				$query = mysqli_query($dbc, "SELECT * FROM $row[14] WHERE RegID = '$regID'");
				$rowCurrent = mysqli_fetch_assoc($query);
				$link = '<a href="../payment/?product=15">MAKE PAYMENT</a>';
				if ($rowCurrent['PAID'] == '1') echo "REGISTERD";
				else echo $link; ?></td>
      	</tr>
      </table>
      <!-- end inner content -->
    </div>  
  <!-- end content -->
  </div>
</div>
</body>
</html>