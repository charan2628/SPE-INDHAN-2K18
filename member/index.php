<?php
ob_start();
session_start();
include_once '../dbconnect.php';
if (isset($_SESSION['user'])!='' && isset($_SESSION['regID']) && isset($_SESSION['password'])) {
	$regID = $_SESSION['regID'];
	$res=mysqli_query($dbc, "SELECT ID, RegID, email, password, PAID FROM userlogin WHERE regID='$regID'");
	$row=mysqli_fetch_assoc($res);
	$count = mysqli_num_rows($res);
	if( $count == 1 && $row['PAID']=='0' ) {
	echo 'redirect';
	header("Location: ../payment/?product=9");
	exit;
	}
	elseif ( $count == 1 && $row['PAID']=='1') {
		$query = mysqli_query($dbc, "SELECT * FROM usercredentials WHERE regID = '$regID'");
		$row = mysqli_fetch_assoc($query);
		$user = $row['firstName'];
	}
	elseif ( $count == 0 ) {
		header ("Location: ../");
		exit;
	}
}
else {
	header ("Location: ../");
	exit;
}



?>



<!DOCTYPE HTML>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
	
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
	<link rel="stylesheet" type="text/css" href="../css/font.css">
	<link rel="stylesheet" type="text/css" href="../css/loader.css" />
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/index.css">
	<link rel="stylesheet" type="text/css" href="../css/bttn.min.css">
	<link href="https://fonts.googleapis.com/css?family=Molengo|Mukta+Malar:600|PT+Sans:700|Roboto|Source+Sans+Pro" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Daancing+Script" rel="stylesheet">
	<script type="text/javascript" src="../js/modernizr.js"></script>
	<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../js/stretchMenu.js"></script>
	<script type="text/javascript" src="../js/index.js"></script>
	<script src="https://use.fontawesome.com/4326c746fe.js"></script>
	<script type="text/javascript" src="../js/smoothScroll.js"></script>
	<script type="text/javascript" src="../js/close.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/countDown.css">
	<script type="text/javascript" src="../js/countDown.js"></script>
	<title>SPE INDHAN 2K18</title>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-96589286-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-96589286-2');
</script>

</head>
<body class="scrolllock">
	<script type="text/javascript">
		var info = "hii";
		$(document).ready(function() {
		
			setTimeout(function(){
			$('body').removeClass('scrolllock');
			$('#loader-wrapper').fadeOut();
	     	}, 5000);

			$('#menu2').click(function () {
		$path = $('.eventsContainer').offset().top;
		$('html, body').animate({scrollTop:$path}, 1000);
		});
			$('#menu3').click(function () {
		$path = $('.team').offset().top;
		$('html, body').animate({scrollTop:$path}, 1000);
		});
			$('#menu4').click(function () {
		$path = $('.sponsors').offset().top;
		$('html, body').animate({scrollTop:$path}, 1000);
		});
			$('#menu5').click(function () {
		$path = $('footer').offset().top;
		$('html, body').animate({scrollTop:$path}, 1000);
		});

			$('.infobgContainer').click(function() {
				$('.infoContainer').removeClass('infoActive');
				$('.infobgContainer').removeClass('infoActive');
				$(info).removeClass('infoActive');
				$('body').css({
					overflow : 'auto'
				});
			});
		});
			function infoReveal(i) {
			info = i;
			$('.infoContainer').addClass('infoActive');
			$('.infobgContainer').addClass('infoActive');
			$(i).addClass('infoActive');
			$('body').css({
				overflow : 'hidden'
			});
			}
			function infoClose(i) {
			$('.infoContainer').removeClass('infoActive');
			$(i).removeClass('infoActive');
			$('.infobgContainer').removeClass('infoActive');
			$('body').css({
				overflow : 'auto'
			});
			}
	</script>
	<div id="loader-wrapper">
	<div id="loader-container">
	<div id="loader">
	<div id="content"><h1>INDHAN</h1></div>	
	</div>
	</div>
	</div>
	<header class="box">
		<div class="indhanHeroBar" style="width: 100%; height: 50px;">
			<h1 class="font-text">SPE INDHAN 2K18 <span>Hi, <?php echo $user ?> <a href="../logout/"> &nbsp;SIGN OUT</span></h1>
		</div>
<div class="logo"><img src="../images/logos/logos.png"></div>
		<div class="nav-visibler" style="width: 100%; height: 100%;"></div>
		<nav class="stretchy-nav">
			<a class="nav-trigger" href="#">
			<span aria-hidden="true"><i></i></span>
			</a>
	<div class="mobileMenu">
		<ul>
			<li id="menu1">
				<a href="#" class="active"><span class="menulabel" >Home</span><span class="icon" id="home"><i class="fa fa-home" aria-hidden="true"></i>
				</span></a>
			</li>
			<li id="menu2">
				<a href="#events"><span class="menulabel" >Events</span><span class="icon" id="events"><i class="fa fa-tasks" aria-hidden="true"></i>
				</span></a>
			</li>
			<li id="menu3">
				<a href="#team"><span class="menulabel" >Team</span><span class="icon" id="team"><i class="fa fa-users" aria-hidden="true"></i>
				</span></a>
			</li>
			<li id="menu4">
				<a href="#sponsors"><span class="menulabel" >Sponsors</span><span class="icon" id="sponsors" style="right: 26px"><i class="fa fa-handshake-o" aria-hidden="true"></i>
				</span></a>
			</li>
			<li id="menu5">
				<a href="#contact"><span class="menulabel" >Contact</span><span class="icon" id="contact"><i class="fa fa-phone" aria-hidden="true"></i>
				</span></a>
			</li>
		</ul>
	</div>
		<span aria-hidden="true" class="stretchy-nav-bg"></span>
	</nav>
   
    <div id="mainbox">
    	<div id="imgbox">
    		<img class="slide" src="../images/index/index2.jpg" width="100%" height="100%" />
    		<img class="slide" src="../images/index/index4.jpg" width="100%" height="100%" />
    		<img class="slide" src="../images/index/index12.jpg" width="100%" height="100%" />
    		<img class="slide" src="../images/index/index9.jpg" width="100%" height="100%" />
    	</div>
    </div>

	<!--<div class="mainIcons"></div> -->
	<div class="title"><!-- <img src="images/titile.png"> --><h1>SPE INDHAN 2K18</h1></div>
	<div class="timer-wrap">
	<p id="timer"><sup>EVENT STARTS IN &nbsp;</sup><span id="timerSPAN"></span></p>
	</div>
	<div class="registerButton"><a href="../dashboard/"><button class="bttn-jelly bttn-lg bttn-primary">&nbsp; DASHBOARD &nbsp; </button></a></div>
	<div class="aboutContainer">
	<div class="aboutInfo">
		<div class="abouth1">
			<h1>ABOUT</h1></div>
		<div class="aboutp">
		<p class="font-text">A two day National technical symposium organised by the Department of Petroleum and Petrochemical Engineering of JNTUK KAKINADA.</p>
	</div>
	</div>
</div>
</header>
<!-- <div class="aboutHead">
<h1>ABOUT</h1>
<hr>
</div> -->
<!-- <div class="aboutContainer">
	<div class="aboutInfo">
		<div class="abouth1">
			<h1>ABOUT</h1></div>
		<div class="aboutp">
		<p class="font-text">A two day National technical symposium organised by the Department of Petroleum and Petrochemical Engineering of JNTUK KAKINADA.</p>
	</div>
	</div>
</div> -->
<div class="referencePoint"></div>
<section class="content">
	<article>
		<!-- <h1>ABOUT</h1>
		<hr>
		<p>A two day National technical symposium organised by the Department of Petroleum and Petrochemical Engineering of JNTU KAKINADA.</p>
 -->
<!--  EVENTS HTML -->

		<div id="events" class="eventsContainer">
			<h1>EVENTS</h1>
			<hr>
		<div class="events">
		<div class="event workshop-div">
			<i class="workshoplogo"><img src="../images/events/werkstatt.png"> WERKSTATT</i>
			<br>
			<p>Knowledge Sharing Session from experienced industrial experts of upstream and downstream </p>
			<p><button class="bttn-fill bttn-sm bttn-primary" id="eventButton" onclick="infoReveal('#workshopInfoReveal')">More Info</button></p>
			<script type="text/javascript">
			</script>
		</div>


		<div class="event papyrus-div">
			<i class="papyruslogo"><img src="../images/events/exposition.png"> EXPOSITION</i>
		<p>Put your insights on the topics, oratory and presentation skills to test in Exposition. </p>
		<p><button class="bttn-fill bttn-sm bttn-primary" id="eventButton" onclick="infoReveal('#papyrusInfoReveal')">More Info</button></p>
		</div>
		<div class="event exhibito-div">
			<i class="exhibitologo"><img src="../images/events/plakat.png"> PLAKAT</i>
		<p> Exhibit your research and vision on a poster, in an engaging way.
		</p>
		<p><button class="bttn-fill bttn-sm bttn-primary" id="eventButton" onclick="infoReveal('#exhibitoInfoReveal')">More Info</button></p>
		</div>
		<div class="event innovision-div">
			<i class="innovisionlogo"><img src="../images/events/namuna.png"> NAMUNA</i>
		<p> Spark your thoughts, construct your ideas into a model, and exhibit at our NAMUNA.
		</p>
		<p><button class="bttn-fill bttn-sm bttn-primary" id="eventButton" onclick="infoReveal('#innovisionInfoReveal')">More Info</button></p>
		</div>
		<div class="event mindblend-div">
			<i class="mindblendlogo"><img src="../images/events/brainiac.png"> BRAINIAC</i>
		<p> A brain teasing quiz competition
		</p>
		<p><button class="bttn-fill bttn-sm bttn-primary" id="eventButton" onclick="infoReveal('#mindblendInfoReveal')">More Info</button></p>
		</div>
		<div class="event mudmash-div">
			<i class="mudmashlogo"><img src="../images/events/mudmashicon.png"> MUDMASH</i>
		<p>Mud Mash provides a platform to design a suitable mud for a given reservoir properties.</p>
		<p><button class="bttn-fill bttn-sm bttn-primary" id="eventButton" onclick="infoReveal('#mudmashInfoReveal')">More Info</button></p>
		</div>
		<div class="event chemileon-div">
			<i class="chemileonlogo"><img src="../images/events/chemileonicon.png"> CHEMILEON</i>
		<p>Showcase your mastery in reactions by amazing us with scintillating colors produced by chemical reactions</p>
		<p><button class="bttn-fill bttn-sm bttn-primary" id="eventButton" onclick="infoReveal('#chemileonInfoReveal')">More Info</button></p>
		</div>

		<div class="event exegesis-div">
			<i class="exegesislogo"><img src="../images/events/exegesis.png"> EXEGESIS</i>
		<p>Determining petrophysical parameters of the formation.</p>
		<p><button class="bttn-fill bttn-sm bttn-primary" id="eventButton" onclick="infoReveal('#exegesisInfoReveal')">More Info</button></p>
		</div>

		<div class="event aromatisk-div">
			<i class="aromatisklogo"><img src="../images/events/amp.gif"> AROMOULD</i>
		<p>Bring out your ideas on a chemical compound</p>
		<p><button class="bttn-fill bttn-sm bttn-primary" id="eventButton" onclick="infoReveal('#aromatiskInfoReveal')">More Info</button></p>
		</div>

		<div class="event examen-div">
			<i class="examenlogo"><img src="../images/events/casestudy2.png"> EXAMEN</i>
		<p>Case Studies to find solutions for present day industrial problems and issues</p>
		<p><button class="bttn-fill bttn-sm bttn-primary" id="eventButton" onclick="infoReveal('#examenInfoReveal')">More Info</button></p>
		</div>

		<div class="event fielddevelopment-div">
			<i class="fielddevelopmentlogo"><img src="../images/events/fielddevelopmenticon.jpeg"> FIELD DEVELOPMENT</i>
		<p>To analyse economically the developmental activities involved in the field</p>
		<p><button class="bttn-fill bttn-sm bttn-primary" id="eventButton" onclick="infoReveal('#fielddevelopmentInfoReveal')">More Info</button></p>
		</div>

		<div class="event gameofrocks-div">
			<i class="gameofrockslogo"><img src="../images/events/gameofrocks.png"> GAME OF ROCKS</i>
		<p>Identifying rock types and determining their properties</p>
		<p><button class="bttn-fill bttn-sm bttn-primary" id="eventButton" onclick="infoReveal('#gameofrocksInfoReveal')">More Info</button></p>
		</div>

		<div class="event toolpuzzle-div">
			<i class="toolpuzzlelogo"><img src="../images/events/toolspuzzleicon.jpeg"> TOOL PUZZLE</i>
		<p>Identifying hidden pictures and then joining the figure pieces together</p>
		<p><button class="bttn-fill bttn-sm bttn-primary" id="eventButton" onclick="infoReveal('#toolpuzzleInfoReveal')">More Info</button></p>
		</div>

		<div class="event swing-div">
		<i class="swinglogo"><img src="../images/events/cultivo.png"> CULTIVO</i>
		<p> Join Your Steps And Make The Event Colorful.</p>
		<p><button class="bttn-fill bttn-sm bttn-primary" id="eventButton" onclick="infoReveal('#cultivoInfoReveal')">More Info</button></p>
		</div>
		<div style="clear: both"></div>
		</div>
		<!--
                 <h1>ONLINE EVENTS</h1>
		<hr>
		<div class="events">
			<div class="event bidding-div">
			<i class="exegesislogo"><img src="../images/events/bidding.png"> BIDDING</i>
		<p>BID YOUR NUMBER win a prize worth Rs. 5000/-</p>
		<p><button class="bttn-fill bttn-sm bttn-primary" id="eventButton" onclick="infoReveal('#biddingInfoReveal')">More Info</button></p>
		</div>
		<div style="clear: both"></div>
		</div>
		-->
	</div>

			<div id="team" class="team" style="overflow-x: hidden;">
			<h1>MEET OUR TEAM</h1>
			<hr>
			<div class="facultyCoordinators">
				<h1>Faculty Coordinators</h1>
				<div class="container">
					<div class="at-grid" data-column="2">

						<div class="at-column faculty1">
							<div class="at-user">
								<div class="at-user_avatar"><img src="../images/team/saber.jpg" />
								</div>
								<div class="at-user_name">Mr. ##########</div>
								<div class="at-user_title">Coordinator</div>
									<ul class="at-social">
										<li>Mobile: 1234567890</li>
									</ul>
							</div>
						</div>
<!-- Jqeury fires animation on team after crosiing this point -->
<div id="referencePoint2"></div>
<!-- End -->
						<div class="at-column faculty2">
							<div class="at-user">
								<div class="at-user_avatar"><img src="../../images/team/saber.jpg" />
								</div>
								<div class="at-user_name">Mr. ###########</div>
								<div class="at-user_title">Coordinator</div>
									<ul class="at-social">
										<li>Mobile: 1234567890</li>
									</ul>
							</div>
						</div>

					</div> <!--End of at-grid div-->
				</div> <!--End of container div-->
			</div> <!--End of facultyCoordinators div-->

<!-- Student Cordinators -->

			<div class="studentCoordinators">
				<h1>Student Coordinators</h1>
				<div class="container studentsdiv">
					<div class="at-grid" data-column="3">

						<div class="at-column student1">
							<div class="at-user">
								<div class="at-user_avatar"><img src="../images/team/saber.jpg" /></div>
								<div class="at-user_name">#############</div>
								<div class="at-user_title">Petroleum Engineering Coordinator</div>
								<ul class="at-social">
									<li>Mobile: 1234567890</li>
								</ul>
							</div>
						</div>

						<div class="at-column student2">
							<div class="at-user">
								<div class="at-user_avatar"><img src="../images/team/saber.jpg" /></div>
							<div class="at-user_name">Mr.###########</div>
							<div class="at-user_title">Petroleum Engineering Coordinator</div>
							<ul class="at-social">
								<li>Mobile: 1234567890</li>
							</ul>
							</div>
						</div>

						<div class="at-column student3">
							<div class="at-user">
								<div class="at-user_avatar"><img src="../images/team/saber.jpg" />
							</div>
							<div class="at-user_name">Ms.#########</div>
							<div class="at-user_title">Petroleum Engineering Coordinator</div>
								<ul class="at-social">
									<li>Mobile: 1234567890</li>
								</ul>
							</div>
						</div>

						<div class="at-column student4">
							<div class="at-user">
								<div class="at-user_avatar"><img src="../images/team/saber.jpg" /></div>
							<div class="at-user_name">Mr.###############</div>
							<div class="at-user_title">Petrochemical &amp; Chemical Engineering Coordinator</div>
								<ul class="at-social">
									<li>Mobile: 1234567890</li>
								</ul>
							</div>
						</div>

						<div class="at-column student5">
							<div class="at-user">
								<div class="at-user_avatar"><img src="../images/team/saber.jpg" /></div>
								<div class="at-user_name">Mr.#############</div>
								<div class="at-user_title">Petrochemical &amp; Chemical Engineering Coordinator</div>
									<ul class="at-social">
										<li>Mobile: 1234567890</li>
									</ul>
								</div>		
						</div>

						<div class="at-column student6">
							<div class="at-user">
								<div class="at-user_avatar"><img src="../images/team/saber.jpg" /></div>
							<div class="at-user_name">Ms.#############</div>
							<div class="at-user_title">Petrochemical &amp; Chemical Engineering Coordinator</div>
								<ul class="at-social">
									<li>Mobile: 1234567890</li>
								</ul>
							</div>
						</div>

				    	<div class="at-column student7">
							<div class="at-user">
								<div class="at-user_avatar"><img src="../images/team/saber.jpg" /></div>
							<div class="at-user_name">Mr.##########</div>
							<div class="at-user_title">Treasurer</div>
								<ul class="at-social">
									<li>Mobile: 1234567890</li>
								</ul>
							</div>
						</div> 
						 <div class="at-column student8">
								<div class="at-user">
									<div class="at-user_avatar"><img src="../images/team/student.jpg" /></div>
								<div class="at-user_name">Mr.G.Sai Charan Raj</div>
								<div class="at-user_title">Web Coordinator</div>
								<ul class="at-social">
									<li>Mobile: 1234567890</li>
								</ul>
							</div>
						</div>
					
						<div class="at-column student9">
								<div class="at-user">
									<div class="at-user_avatar"><img src="../images/team/saber.jpg" /></div>
									<div class="at-user_name">Mr.##########</div>
									<div class="at-user_title">Web Coordinator</div>
										<ul class="at-social">
											<li>Mobile: 1234567890</li>
										</ul>
								</div>
						</div>

						<div class="at-column student10">
							<div class="at-user">
								<div class="at-user_avatar"><img src="../images/team/saber.jpg" /></div>
							<div class="at-user_name">Mr.##############</div>
							<div class="at-user_title">SPE President</div>
								<ul class="at-social">
									<li>Mobile: 1234567890</li>
								</ul>
							</div>
						</div>

						<div class="at-column student11">
							<div class="at-user">
								<div class="at-user_avatar"><img src="../images/team/saber.jpg" /></div>
							<div class="at-user_name">Mr.###############</div>
							<div class="at-user_title">SPE Secretary</div>
								<ul class="at-social">
									<li>Mobile: 1234567890</li>
								</ul>
							</div>
						</div>

						<div class="at-column student14">
							<div class="at-user">
								<div class="at-user_avatar"><img src="../images/team/saber.jpg" /></div>
							<div class="at-user_name">B.############</div>
							<div class="at-user_title">FIPI President</div>
								<ul class="at-social">
									<li>Mobile: #</li>
								</ul>
							</div>
						</div>

						<div class="at-column student15">
							<div class="at-user">
								<div class="at-user_avatar"><img src="../images/team/saber.jpg" /></div>
								<div class="at-user_name">D.##############</div>
								<div class="at-user_title">FIPI Secretary</div>
									<ul class="at-social">
										<li>Mobile: 1234567890</li>
									</ul>
							</div>
						</div>  	

						<div class="at-column student12">
							<div class="at-user">
								<div class="at-user_avatar"><img src="../images/team/saber.jpg" /></div>
								<div class="at-user_name">Mr.############</div>
								<div class="at-user_title">IE President</div>
									<ul class="at-social">
										<li>Mobile: 1234567890</li>
									</ul>
							</div>
						</div>

						<div class="at-column student13">
							<div class="at-user">
								<div class="at-user_avatar"><img src="../images/team/saber.jpg" /></div>
								<div class="at-user_name">Mr.#############</div>
								<div class="at-user_title">IE Secretary</div>
									<ul class="at-social">
										<li>Mobile: 1234567890</li>
									</ul>
							</div>
						</div>
			  	
			 		</div> <!-- End of at-grid div -->
				</div> <!--End of container studentsdiv div -->
			</div> <!--End of studentCoordinators div -->

		</div> <!-- End of team div -->
	</article>
</section>
<!-- WORKSHOP INFO -->
<div class="infobgContainer">
</div>
<div class="infoContainer">
	<div class="infoBox" id="workshopInfoReveal">
		<h1 class="font-heading">WERKSTATT (WORKSHOP)</h1>
		<hr>
		<ul class="font-text">
           <li>
            <p>Limited registrations (online payers for the Registration are given priority)</p>
                   </li>
                   <li>
                   <p>Way of registration: Online</p>
                   </li>
                   <li>
                   <p>Registration fee: Rs. 300/-</p>
                   </li>
		   <li><p>For Registration please click on dashboard</p></li>
                   <li><p>Last Date for Registration 10 February</p></li>
          </ul>
           <h1 id="lst2" class="font-heading">LIST OF TOPICS</h1>
                 <ul class="font-text">
                   <li>
                   <p>Advances in Petroleum Production Engineering. Time: 18 February 2018 9:00 AM to 1:00 PM</p>
                   </li>
                   <li>
                   <p>Oil and Gas Pipelines. Time: 18 February 2018 9:00 AM to 1:00 PM</p>
                   </li>
                   <li>
                   <p>Advances in Refinery Processes. Time: 17 February 2018 2:00 PM to 5:00 PM</p>
                   </li>
                  </ul>
              <div>
                  <button class="bttn-unite bttn-sm bttn-primary" id="closeInfo" onclick="infoClose('#workshopInfoReveal')">Close</button>
              </div>
			</div>

			<div class="infoBox" id="papyrusInfoReveal">
				<h1 class="font-heading">EXPOSITION (PAPER)</h1>
		<hr>
		<ul class="font-text">
           <li>
				<p>Maximum of 2 members per a team</p>
			</li>
			<li>
				<p>Time allotted (8+2) minutes</p>
			</li>
			<li>
				<p>PPT format should be in .ppt or .pptx</p>
			</li>
			<li>
				<p>Last date for Abstract submission: 10 Feb</p>
			</li>
			<li>
				<p>Maximum words: 200</p>
			</li>
			<li>
				<p>Way of submission: Online</p>
			</li>
			<li>
				<p>Payment should be done after your abstract is selected</p>
			</li>
			<li>
				<p>Registration fee(per team): Rs. 200/-</p>
			</li>
                        <li> <p><a href="https://drive.google.com/open?id=11cCDSogYO2m7TeGYA377l7ry1KRKQfER" target="_blank" style="color:blue">TOPICS(PETROLUEM)</a></p> </li>
			<li> <p><a href="https://drive.google.com/open?id=1U1-D85ugem5X7D65mGGkq704IkGYqdPH" target="_blank" style="color:blue">TOPICS(CHEMICAL)</a></p> </li>
        </ul>
              <div class="select">
                  <button class="bttn-unite bttn-sm bttn-primary" id="closeInfo" onclick="infoClose('#papyrusInfoReveal')">Close</button>
              </div>
			</div>

		<div class="infoBox" id="exhibitoInfoReveal">
				<h1 class="font-heading">PLAKAT (POSTER)</h1>
		<hr>
		<ul class="font-text">
           <li>
			<p>Maximum of 2 members for a team</p>
			</li>
			<li>
			<p>Stipulated Dimensions (4 ft x 3 ft)</p>
			</li>
			<li>
			<p>No other dimensions are allowed</p>
			</li>
			<li>
			<p>Bring your own printed poster</p>
			</li>
			<li>
			<p>Last date for Abstract submission: 10 Feb</p>
			</li>
			<li>
			<p>Way of submission: Click On DASHBOARD</p>
			</li>
			<li>
			<p>First abstract should be submitted through your dashboard</p>
			</li>
			<li>
			<p>Format should be .jpg</p>
			</li>
			<li>
			<p>Payment should be done after your abstract is selected</p>
			</li>
			<li>
			<p>Registration fee(per team): Rs 200/-</p>
			</li>
                        <li> <p><a href="https://drive.google.com/open?id=11cCDSogYO2m7TeGYA377l7ry1KRKQfER" target="_blank" style="color:blue">TOPICS(PETROLUEM)</a></p> </li>
			<li> <p><a href="https://drive.google.com/open?id=1U1-D85ugem5X7D65mGGkq704IkGYqdPH" target="_blank" style="color:blue">TOPICS(CHEMICAL)</a></p> </li>
        </ul>
              <div>
                  <button class="bttn-unite bttn-sm bttn-primary" id="closeInfo" onclick="infoClose('#exhibitoInfoReveal')">Close</button>
              </div>
         </div>
        <div class="infoBox" id="innovisionInfoReveal">
		<h1 class="font-heading">NAMUNA</h1>
		<hr>
		<ul class="font-text">
        <li>
		<p>Maximum of 4 members for a team</p>
		</li>
		<li>
		<p>Preferred model type: Dynamic</p>
		</li>
		<li>
		<p>You will be provided only with suppporting tables and power supply</p>
		</li>
		<li>
		<p>Registration fee(per team): Rs. 400/-</p>
		</li>
		<li>
		<p>For Payment Click on Your DASHBOARD</p>
		</li>
                <li>
                <p>Last Date for Registration 10 February</p>
                </li>
        </ul>
              <div>
                  <button class="bttn-unite bttn-sm bttn-primary" id="closeInfo" onclick="infoClose('#innovisionInfoReveal')">Close</button>
              </div>
			</div>
		<div class="infoBox" id="mindblendInfoReveal">
		<h1 class="font-heading">BRAINIAC</h1>
		<hr>
		<ul class="font-text">
       <li>
		<p>Maximum of 3 members per a team</p>
		</li>
		<li>
		<p>Two rounds: Preliminary and Mains</p>
		</li>
		<li>
		<p>Quiz includes General Awareness, Current Affairs, and Technical Knowledge</p>
		</li>
		<li>
		<p>Registration fee(per team): Rs. 300/-</p>
		</li>
		<li>
		<p>For Payment Click on Your DASHBOARD</p>
		</li>
                <li>
                <p>Last Date for Registration 10 February</p>
                </li>
        </ul>
              <div>
                  <button class="bttn-unite bttn-sm bttn-primary" id="closeInfo" onclick="infoClose('#mindblendInfoReveal')">Close</button>
              </div>
			</div>
			<div class="infoBox" id="mudmashInfoReveal">
		<h1 class="font-heading">MUD MASH</h1>
		<hr>
		<ul class="font-text">
        <li>
		<p>Maximum of 2 members per a team</p>
		</li>
		<!-- <li>
		<p>Two rounds: Preliminary and Mains</p>
		</li> -->
		<li>
		<p>Registration fee: Rs. 100/-</p>
		</li>
		<li>
		<p>For Payment Click on Your DASHBOARD</p>
		</li>
                <li>
                <p>Last Date for Registration 10 February</p>
                </li>
        </ul>
        <h1 class="font-heading">DESCRIPTION</h1>
        <ul class="font-text">
        	<li>Consists of two rounds:</li>
        	<p>1. Screening and</p>
        	<p>2. Mains.</p>
        	<li>In Screening, your knowledge related to drilling fluids will be tested through pen and paper mode.</li>
        	<li>In  Mains, you will be asked to prepare a drilling mud with required properties.</li>
        	<li>The team which prepares the required mud quickly will be selected as the winner.</li>
        </ul>
              <div>
                  <button class="bttn-unite bttn-sm bttn-primary" id="closeInfo" onclick="infoClose('#mudmashInfoReveal')">Close</button>
              </div>
			</div>
			<div class="infoBox" id="chemileonInfoReveal">
		<h1 class="font-heading">CHEMILEON</h1>
		<hr>
		<ul class="font-text">
		<li>
		<p>Registration fee(per team): Rs 200/-</p>
		</li>
		<li>
		<p>Solution has to be submitted online!</p>
		</li>
		<li>
		<p>For Payment Click on Your DASHBOARD</p>
		</li>
                <li>
                <p>Last Date for Registration 10 February</p>
                </li>
        </ul>
        <h2><a href="https://drive.google.com/open?id=1toIHXwwEKnrIJvkDKFR4XM3tODgUcY_7" target="_blank">MORE DETAILS</a></h2>
              <div>
                  <button class="bttn-unite bttn-sm bttn-primary" id="closeInfo" onclick="infoClose('#chemileonInfoReveal')">Close</button>
              </div>
			</div>
			<div class="infoBox" id="exegesisInfoReveal">
		<h1 class="font-heading">EXEGESIS</h1>
		<hr>
		<ul class="font-text">
       <li>
		<p>Maximum of 3 members per a team</p>
		</li>
		<li>
		<p>Registration fee: Rs 150/-</p>
		<p></p>
		</li>
		<li>
		<p>For Payment Click on Your DASHBOARD</p>
		</li>
                <li>
                <p>Last Date for Registration 10 February</p>
                </li>
        </ul>
                        <h1 class="font-heading">DESCRIPTION</h1>
                <ul class="font-text">
                	<li>The Participants are targeted at their knowledge regarding geophysical and well logging concepts.</li>
                	<li>Consits of two rounds:</li>
                	<p>1. Screening and</p><p>2. Mains</p>
                	<li>In Screening basic concepts are tested through pen and paper mode.</li>
                	<li>The mains round consists of interpretation of logging data and the candidates are asked to evaluate various parameters from them</li>
                	<li>The logs will be provided by us.</li>
                </ul>
              <div>
                  <button class="bttn-unite bttn-sm bttn-primary" id="closeInfo" onclick="infoClose('#exegesisInfoReveal')">Close</button>
              </div>
			</div>
			<div class="infoBox" id="aromatiskInfoReveal">
		<h1 class="font-heading">AROMOULD</h1>
		<hr>
		<!-- <h1> WILL BE UPDATED SOON </h1> -->
		<ul class="font-text">
       <li>
		<p>Maximum of 3 members per a team</p>
		</li>
		<li>
		<p>Registration fee(per team): Rs 100/-</p>
		</li>
		<li>
		<p>For Payment Click on Your DASHBOARD</p>
		</li>
                <li>
                <p>Last Date for Registration 10 February</p>
                </li>
        </ul>
        <h2><a href="https://drive.google.com/open?id=1H13HJerv46u501ttSjhyaQK4HYPdlK50" target="_blank">MORE DETAILS</a></h2>
              <div>
                  <button class="bttn-unite bttn-sm bttn-primary" id="closeInfo" onclick="infoClose('#aromatiskInfoReveal')">Close</button>
              </div>
			</div>
			<div class="infoBox" id="examenInfoReveal">
		<h1 class="font-heading">EXAMEN</h1>
		<hr>
		<ul class="font-text">
       <li>
		<p>Maximum of 3 members per a team</p>
		</li>
		<li>
		<p>Registration fee(per team): Rs 200/-</p>
		</li>
		<li>
		<p>For Payment Click on Your DASHBOARD</p>
		</li>
               <li>
                <p>Last Date for Registration 10 February</p>
                </li>
        </ul>
              <div>
                  <button class="bttn-unite bttn-sm bttn-primary" id="closeInfo" onclick="infoClose('#examenInfoReveal')">Close</button>
              </div>
			</div>
			<div class="infoBox" id="gameofrocksInfoReveal">
		<h1 class="font-heading">GAME OF ROCKS</h1>
		<hr>
		<ul class="font-text">
       <li>
		<p>Maximum of 2 members per a team</p>
		</li>
		<li>
		<p>Registration fee(per team): Rs 200/-</p>
		</li>
		<li>
		<p>For Payment Click on Your DASHBOARD</p>
		</li>
                <li>
                <p>Last Date for Registration 10 February</p>
                </li>
        </ul>
        <h1 class="font-heading">DESCRIPTION</h1>
        <ul class="font-text">
        	<li>Consists of two rounds:</li>
        	<p>1. Screening and</p>
        	<p>2. Mains</p>
        	<li>In Screening, the geological knowledge of the teams will be tested through quiz.</li>
        	<li>In Mains, teams will be asked foer rock and mineral identification test practically.</li>
        	<li>Finally the scores are evaluated based on their performance and the winner will be awarded with cash prize.</li>
        </ul>
              <div>
                  <button class="bttn-unite bttn-sm bttn-primary" id="closeInfo" onclick="infoClose('#gameofrocksInfoReveal')">Close</button>
              </div>
			</div>
			<div class="infoBox" id="fielddevelopmentInfoReveal">
		<h1 class="font-heading">FIELD DEVELOPMENT</h1>
		<hr>
		<ul class="font-text">
       <li>
		<p>Maximum of 2 members per a team</p>
		</li>
		<li>
		<p>Registration fee(per team): Rs 200/-</p>
		</li>
		<li>
		<p>For Payment Click on Your DASHBOARD</p>
		</li>
                <li>
                <p>Last Date for Registration 10 February</p>
                </li>
        </ul>
        <h1 class="font-heading">DESCRIPTION</h1>
        <ul class="font-text">
		<li>You will be given:</li>
		<p>1. Production history and properties of a gas reservoir.</p>
		<p>2. Gas Sales Agreement (GSA) requirements.</p>
		<p>3. Gas price, capital expenditures, operating cost etc.</p>
		<li>You have to Original Gas in Place (OGIP) and recovery factor.</li>
		<li>You have to formulate a field development plan.</li>
		<li>Finally you need to work out project economics.</li>        	
        </ul>
              <div>
                  <button class="bttn-unite bttn-sm bttn-primary" id="closeInfo" onclick="infoClose('#fielddevelopmentInfoReveal')">Close</button>
              </div>
			</div>
			<div class="infoBox" id="toolpuzzleInfoReveal">
		<h1 class="font-heading">TOOL PUZZLE</h1>
		<hr>
		<ul class="font-text">
       <li>
		<p>Maximum of 2 members per a team</p>
		</li>
		<li>
		<p>Registration fee(per team): Rs 200/-</p>
		</li>
		<li>
		<p>For Payment Click on Your DASHBOARD</p>
		</li>
                <li>
                <p>Last Date for Registration 10 February</p>
                </li>
        </ul>
        <h1 class="font-heading">DESCRIPTION</h1>
        <ul class="font-text">
        	<li>
        		<p>Consists of two rounds:</p>
        	</li>
        	<p>1. Screening and</p><p>2. Mains</p>
        	<li>
        		<p>In screnning, you have to identify the tools shown. No hints will be given.</p>
        	</li>
        	<li>
        		<p>The tools are from petroleum, petrochemical and chemical industry.</p>
        	</li>
        	<li>
        		<p>In mains, you need to arrange the jumbled parts of the tool's image on cardboard.</p>
        	</li>
        	<li>
        		<p>Hints will be given in Mains</p>
        	</li>
        	<li>
        		<p>Hint will be in the form of jumbled word</p>
        	</li>
        </ul>
              <div>
                  <button class="bttn-unite bttn-sm bttn-primary" id="closeInfo" onclick="infoClose('#toolpuzzleInfoReveal')">Close</button>
              </div>
			</div>
			<div class="infoBox" id="cultivoInfoReveal">
		<h1 class="font-heading">CULTIVO</h1>
		<hr>
		<ul class="font-text">
       <li>
		<p>It is a cultural night.</p>
		</li>
		<li>
		<p>Timings: 6 pm to 12 am, 17 February.</p>
		</li>
        <li>
        <p>Consists of amazing dance performances, hillarious skits, sensational mobs and energetic DJ.</p>
        </li>
        <li>
        	<p>The performances from other college students are also welcome.</p>
        </li>
        <li>
        	<p>The winners will be awarded attractive prizes after the completion of all performances.</p>
        </li>
        </ul>
              <div>
                  <button class="bttn-unite bttn-sm bttn-primary" id="closeInfo" onclick="infoClose('#cultivoInfoReveal')">Close</button>
              </div>
			</div>
<div class="infoBox" id="biddingInfoReveal">
		<h1 class="font-heading">TERMS AND CONDITIONS</h1>
		<hr>
		<ul class="font-text">
       <li>
		<p>The bidding range should be between Rs. 1/- Rs. 1000/- (No Decimal Values).</p>
		</li>
		<li>
		<p>One person - One BID</p>
		</li>
        <li>
        <p>Registration fee for bidding is Rs. 30/-</p>
        </li>
        <li>
        	<p>The "unique and least" bid is selected.</p>
        </li>
        <li>
        	<p>Eg: Bidder-A Rs. 9/- <br> Bidder-B Rs. 7/- <br> Bidder-C Rs. 7/- <br> Bidder-D Rs. 8/- <br>
        	From the above bids, Bidder-D will be selected as the winner.</p>
        </li>
        <li>
        	<p>Rs. 7/- is the least bid but it is not unique so among all the bids, the least and unique bid is Rs. 8/- Hence he will be awarded the prize.</p>
        </li>
        <li> <p>Last Date for Registration 17 February 2018. </p></li>
        </ul>
              <div>
              	  <a href="../bidding/"><button class="bttn-unite bttn-sm bttn-primary">REGISTER</button></a> <br>
                  <button class="bttn-unite bttn-sm bttn-primary" id="closeInfo" onclick="infoClose('#biddingInfoReveal')">Close</button>
              </div>
			</div>

	</div>
</div>
<div id="sponsors" class="sponsors">
	<h1>SPONSORS</h1>
	<hr>
	<div class="sponsorsContainer">
		<div id="sponsor1">
			<img src="../images/sponsors/sponsor9.png">
		</div>
		<div id="sponsor2">
			<img src="../images/sponsors/sponsor6.png">
		</div>
		<div id="sponsor14">
			<img src="../images/sponsors/sponsor13.png">
		</div>
                <div id="sponsor4">
			<img src="../images/sponsors/sponsor16.png">//
		</div>
                <div id="sponsor15">
			<img src="../images/sponsors/sponsor14.jpg">
		</div>
		<div id="sponsor3">
			<img src="../images/sponsors/sponsor12.png">
		</div>
		
		<div id="sponsor16">
			<img src="../images/sponsors/sponsor15.jpg">
		</div>
		<div id="sponsor5">
			<img src="../images/sponsors/sponsor4.png">
		</div>
		<div id="sponsor6">
			<img src="../images/sponsors/sponsor3.jpg">
		</div>
		<div id="sponsor7">
			<img src="../images/sponsors/sponsor1.jpg">
		</div>
		<div id="sponsor9">
			<img src="../images/sponsors/sponsor5.jpg">
		</div>
		<div id="sponsor10">
			<img src="../images/sponsors/sponsor10.jpeg">
		</div>
		<div id="sponsor11">
			<img src="../images/sponsors/sponsor8.gif">
		</div>
		<div id="sponsor12">
			<img src="../images/sponsors/sponsor2.png">
		</div>
		<div id="sponsor13">
			<img src="../images/sponsors/sponsor11.jpg">
		</div>
		<div style="clear: both"></div>
	</div>
</div>
<!-- <div style="height: 2000px">

</div> -->
<footer id="contact">
<div class="footer">
<h1>CONTACT</h1>
<hr>
<div class="contactTable">
<div class="contactInformation">
	<table style="margin-top: 50px;">
		<tr>
			<td>
				<span><img style="width: 40px; height: 30px;" src="../images/contact/gmail1.png"></span>
			</td>
			<td style="vertical-align: middle;">
				<p class="font-text">&nbsp; speindhan2k18@gmail.com &nbsp; <button class="bttn-pill bttn-xs bttn-primary" onclick="copyText('#gmailText')">COPY</button></p>
				<p id="gmailText" style="display: none;">speindhan2k18@gmail.com</p>
			</td>
			<script type="text/javascript">
				function copyText(element) {
				  var $temp = $("<input>");
				  $("body").append($temp);
				  $temp.val($(element).text()).select();
				  document.execCommand("copy");
				  $temp.remove();
				}
			</script>
		</tr>
	</table>

<!-- 	<h2 class="font-heading">Reach Us On</h2> -->
	<table style="margin-top: 30px;">
		<tr>
			<td><a href="https://www.facebook.com/speindhan2k18" target="_blank"><img src="../images/contact/facebook.png" style="width: 50px; height: 50px;"></a></td>
			<td style="vertical-align: middle;"><p class="font-text"> &nbsp; &nbsp;<a href="https://www.facebook.com/speindhan2k18" target="_blank"> <button class="bttn-stretch bttn-md bttn-primary">Like Our Page</button></a></p></td>
		</tr>
		<tr>
			<td><a href="https://www.twitter.com/speindhan_2k18" target="_blank"><img src="../images/contact/twitter.png" style="width: 50px; height: 50px;"></a></td>
			<td style="vertical-align: middle;"><p class="font-text"> &nbsp; &nbsp;<a href="https://www.twitter.com/speindhan_2k18" target="_blank"> <button class="bttn-stretch bttn-md bttn-primary">Follow Us</button></a></p></td>
		</tr>
		<tr>
			<td><a href="https://www.instagram.com/speindhan2k18" target="_blank"><img src="../images/contact/instagram.png" style="width: 50px; height: 50px;"></a></td>
			<td style="vertical-align: middle;"><p class="font-text"> &nbsp; &nbsp;<a href="https://www.instagram.com/speindhan2k18" target="_blank"> <button class="bttn-stretch bttn-md bttn-primary">Follow Us</button></a></p></td>
		</tr>
	</table>
</div>
<div class="address">
	<h2 class="font-heading">Address:</h2>
	<p class="font-text" id="addressText">Department of Petroleum Engineering and Petrochemical Engineering,<br>
Jawaharlal Nehru Technological University,<br>
Jawaharlal Nehru Technological University Road,<br>
Kakinada,<br>
Andhra Pradesh,<br>
533003.</p>
<br>
<p id="mapLocation" style="display: none;">16°58'47.0"N 82°14'32.4"E</p>
<p class="font-text"><button class="bttn-material-flat bttn-sm bttn-primary" onclick="copyText('#addressText')">COPY</button>&nbsp;
<button class="bttn-material-flat bttn-sm bttn-primary" onclick="copyText('#mapLocation')">COORDINATES</button></p>
</div>
<div id="map">
</div>
</div>
<div class="footerBottom">
	<p class="font-text"> &copy; SPE INDHAN 2K18</p>
</div>
<script>
function initMap() {
var jntuk = {
lat: 16.979713,
lng: 82.242290
};
var map = new google.maps.Map(document.getElementById('map'), {
zoom: 12,
center: jntuk
});
var marker = new google.maps.Marker({
position: jntuk,
map: map
});
}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtE-iGxqC8YHEfg9fUoUfd3w1OvA8FWRc&callback=initMap">
</script>
</div>
</footer>
</body>
</html>