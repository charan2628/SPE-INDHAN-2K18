$(document).ready(function() {
			// $('html').smoothscroll();

// 			$("#papyrusInfoReveal").bind( "clickoutside", function(event){
// $(this).hide();
// });

$('.nav-visibler').hide();
$('.indhanHeroBar').hide();
var lastWidth = $(window).width();
function mobileMenu() {
	$('.stretchy-nav ul li:nth-child(1) i').removeClass('fa-home');
	$('.stretchy-nav ul li:nth-child(2) i').removeClass('fa-tasks');
	$('.stretchy-nav ul li:nth-child(3) i').removeClass('fa-users');
	$('.stretchy-nav ul li:nth-child(4) i').removeClass('fa-handshake-o');
	$('.stretchy-nav ul li:nth-child(5) i').removeClass('fa-phone');
	$('.stretchy-nav .nav-trigger i').addClass('fa');
	$('.stretchy-nav .nav-trigger i').addClass('fa-bars fa-2x');
	$('.stretchy-nav .nav-trigger i').click(function() {
		$('.stretchy-nav .nav-trigger i').toggleClass('fa-bars fa-2x');
		$('.stretchy-nav .nav-trigger i').toggleClass('fa-times fa-2x');
		$('.mobileMenu').toggleClass('activeMobile');
	});
	$('.stretchy-nav .mobileMenu a').click(function() {
		$('.stretchy-nav .nav-trigger i').toggleClass('fa-bars fa-2x');
		$('.stretchy-nav .nav-trigger i').toggleClass('fa-times fa-2x');
		$('.mobileMenu').toggleClass('activeMobile');
	});
};
if ($(window).width() < 800) {
	mobileMenu();
}
$(window).resize(function() {
	if ($(window).width() != lastWidth) {
		if ($(window).width() < 800) {
		// mobileMenu();
	}
	else if ($(window).width() > 850) {

	$('.stretchy-nav ul li:nth-child(1) i').addClass('fa-home');
	$('.stretchy-nav ul li:nth-child(2) i').addClass('fa-tasks');
	$('.stretchy-nav ul li:nth-child(3) i').addClass('fa-users');
	$('.stretchy-nav ul li:nth-child(4) i').addClass('fa-handshake-o');
	$('.stretchy-nav ul li:nth-child(5) i').addClass('fa-phone');
	}
	lastWidth = $(window).width();
	}

});
var currwScroll = 0;
$(window).scroll(function() {
	var wScroll = $(this).scrollTop();
	if ( wScroll  > $('.aboutContainer').offset().top) {
		$('.logo').hide();
	}
	else {
		$('.logo').show();
	}
	if ( wScroll > $('.referencePoint').offset().top) {
		// $('nav-trigger').click(function() {
		// 	alert('hii');
		// 	$('nav-visibler').toggle();
		// });
		// $('.logo').hide();
		if ( wScroll > currwScroll & currwScroll != 0) {
		  $('.stretchy-nav').hide(1000);
		  $('.indhanHeroBar').show();
		}
		else {
			$('.stretchy-nav').show(500);
			$('.indhanHeroBar').hide();
		}
		currwScroll = wScroll;
	}
	else {
		// $('.logo').show();
	}
if ($(window).width() > 800) {
	if (wScroll > $('.referencePoint').offset().top) {
		$('#events.eventsContainer .events div').each(function(i){
			setTimeout(function() {
			$('#events.eventsContainer .events div').eq(i).addClass('is-showing-event');
		},(700 * (Math.exp(i * 0.14))) - 700);
		});
	}
	// if ( wScroll > $('.referencePoint').offset().top) {
	// 	$('.workshop-div').addClass('isShowingX');
	// 	$('.papyrus-div').addClass('isShowingY');
	// 	$('.exhibito-div').addClass('isShowingX');
	// }
	// if (wScroll > $('.eventsContainer h1').offset().top) {
	// 	$('.mindblend-div').addClass('isShowingY');
	// 	$('.innovision-div').addClass('isShowingX');
	// 	$('.mudmash-div').addClass('isShowingX');
	// }
	// if (wScroll > $('.papyrus-div').offset().top) {
	// 	$('.exegesis-div').addClass('isShowingY');
	// 	$('.chemileon-div').addClass('isShowingX');
	// 	$('.aromatisk-div').addClass('isShowingX');
	// }
	// if (wScroll > $('.mindblend-div').offset().top) {
	// 	$('.fielddevelopment-div').addClass('isShowingY');
	// 	$('.examen-div').addClass('isShowingX');
	// 	$('.gameofrocks-div').addClass('isShowingX');
	// }
	// if (wScroll > $('.exegesis-div').offset().top) {
	// 	$('.toolpuzzle-div').addClass('isShowingX');
	// }
	if (wScroll > $('.team h1').offset().top) {
		$('.at-column.faculty1').addClass('landingRight');
		$('.at-column.faculty2').addClass('landingRight');
	}
	if (wScroll > $('#referencePoint2').offset().top) {
		$('.at-column.student1').addClass('landingRight');
		$('.at-column.student2').addClass('landingOpacity');
		$('.at-column.student3').addClass('landingRight');
	}
	if (wScroll > $('.studentCoordinators h1').offset().top) {
		$('.at-column.student4').addClass('landingRight');
		$('.at-column.student5').addClass('landingOpacity');
		$('.at-column.student6').addClass('landingRight');
	}
	if (wScroll > $('.at-column.student1').offset().top) {
		$('.at-column.student7').addClass('landingRight');
		$('.at-column.student8').addClass('landingOpacity');
		$('.at-column.student9').addClass('landingRight');
	}
	if (wScroll > $('.sponsors').offset().top) {
		$('.sponsors .sponsorsContainer img').each(function(i){
			setTimeout(function() {
			$('.sponsors .sponsorsContainer div img').eq(i).addClass('is-showing-img');
		},(700 * (Math.exp(i * 0.14))) - 700);
		});
	}
}
if ($(window).width() < 800) {
	if ( wScroll > $('.referencePoint').offset().top) {
		$('.workshop-div').addClass('isShowingX');
		$('.papyrus-div').addClass('isShowingX');
	}
	if ( wScroll > $('.eventsContainer h1').offset().top) {
		$('.exhibito-div').addClass('isShowingX');
		$('.innovision-div').addClass('isShowingX');
	}
	if ( wScroll > $('.workshop-div').offset().top) {
		$('.mindblend-div').addClass('isShowingX');
		$('.mudmash-div').addClass('isShowingX');
	}
	if ( wScroll > $('.exhibito-div').offset().top) {
		$('.chemileon-div').addClass('isShowingX');
		$('.exegesis-div').addClass('isShowingX');
	}
	if ( wScroll > $('.mindblend-div').offset().top) {
		$('.aromatisk-div').addClass('isShowingX');
		$('.examen-div').addClass('isShowingX');
	}
	if ( wScroll > $('.chemileon-div').offset().top) {
		$('.fielddevelopment-div').addClass('isShowingX');
		$('.gameofrocks-div').addClass('isShowingX');
	}
	if ( wScroll > $('.aromatisk-div').offset().top) {
		$('.toolpuzzle-div').addClass('isShowingX');
	}
	if (wScroll > $('.team h1').offset().top) {
		$('.at-column.faculty1').addClass('landingRight');
		$('.at-column.faculty2').addClass('landingRight');
	}
	if (wScroll > $('#referencePoint2').offset().top) {
		$('.at-column.student1').addClass('landingRight');
		$('.at-column.student2').addClass('landingOpacity');
		$('.at-column.student3').addClass('landingRight');
	}
	if (wScroll > $('.at-column.student2').offset().top) {
		$('.at-column.student4').addClass('landingRight');
		$('.at-column.student5').addClass('landingOpacity');
		$('.at-column.student6').addClass('landingRight');
	}
	if (wScroll > $('.at-column.student5').offset().top) {
		$('.at-column.student7').addClass('landingRight');
		$('.at-column.student8').addClass('landingOpacity');
		$('.at-column.student9').addClass('landingRight');
	}
	if (wScroll > $('.sponsors').offset().top) {
		$('.sponsors .sponsorsContainer img').each(function(i){
			setTimeout(function() {
			$('.sponsors .sponsorsContainer div img').eq(i).addClass('is-showing-img');
		},(700 * (Math.exp(i * 0.14))) - 700);
		});
	}
}
});
		});