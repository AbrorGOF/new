<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
<title>HAMSHIRALIK ISHI FAOLIYATI</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Medicate Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme -->
<script type="text/javascript" src="{{asset('js/welcome/jquery-1.11.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/welcome/bootstrap.js')}}"></script>
<!-- stylesheet -->
<link href="{{ asset('css/welcome/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
<link href="{{ asset('css/welcome/easy-responsive-tabs.css') }}" rel='stylesheet' type='text/css'/>
<link href="{{ asset('css/welcome/style.css') }}" rel="stylesheet" type="text/css" media="all" />
<link href="{{ asset('css/welcome/gallery.css') }}" rel="stylesheet" type="text/css" media="all" /> <!-- gallery css -->
<!-- //stylesheet -->
<!-- online fonts -->
<link href="//fonts.googleapis.com/css?family=Titillium+Web:200,200i,300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
<!-- //online fonts -->
<!-- font-awesome-icons -->
<link href="{{ asset('css/welcome/font-awesome.css')}}" type="text/css" rel="stylesheet"> 
<!-- //font-awesome-icons -->
<script src="{{asset('js/welcome/modernizr.custom.js')}}"></script>
<script type="text/javascript" src="{{asset('js/welcome/modernizr.custom.79639.js')}}"></script>		
<link rel="stylesheet" type="text/css" href="{{asset('css/welcome/custom.css')}}" />	
<!-- for smooth scrolling -->
<script type="text/javascript" src="{{asset('js/welcome/move-top.js')}}"></script>
<script type="text/javascript" src="{{asset('js/welcome/easing.js')}}"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$(".scroll").click(function(event){		
		event.preventDefault();
		$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
	});
});
window.addEventListener ("touchmove", function (event) { event.preventDefault (); }, {passive: false});
</script>
<!-- //for smooth scrolling -->
</head>
<body>
<div class="agileits_main">
    <!-- header -->
	<div class="container">
		<div class="w3_agile_logo">
			<h1><a href="/welcome"><i class="agileits-logo fa fa-plus" aria-hidden="true"></i>Imedic</a></h1>
		</div>
		<div class="agileits_w3layouts_nav">
			<div id="toggle_m_nav">
				<div id="m_nav_menu" class="m_nav">
					<div class="m_nav_ham w3_agileits_ham" id="m_ham_1"></div>
					<div class="m_nav_ham" id="m_ham_2"></div>
					<div class="m_nav_ham" id="m_ham_3"></div>
				</div>
			</div>
			<div id="m_nav_container" class="m_nav wthree_bg">
				<nav class="menu menu--sebastian">
					<ul id="m_nav_list" class="m_nav menu__list">
						<li class="m_nav_item menu__item menu__item--current" id="m_nav_item_1"> <a href="/welcome" class="menu__link"><i class="menu-icon fa fa-home" aria-hidden="true"></i> Bosh sahifa </a></li>
						<li class="m_nav_item menu__item" id="moble_nav_item_2"> <a href="{{ route('login') }}" class="menu__link"><i class="menu-icon fa fa-sign-in" aria-hidden="true"></i>Kirish </a> </li>
						<li class="m_nav_item menu__item" id="moble_nav_item_3"> <a href="{{ route('register') }}" class="menu__link"><i class="menu-icon fas fa-registered" aria-hidden="true"></i>Registratsiya</a> </li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
	<!-- menu -->
	<script type="text/javascript" src="{{asset('js/welcome/main.js')}}"></script>
	<!-- //menu -->
	<!--// header -->
	<!-- banner -->
	<div class="w3_banner">
	    <div class="container">
		    <div class="slider">
			    <div class="callbacks_container">
				   <ul class="rslides callbacks callbacks1" id="slider4">
                        <li>							
							<div class="banner_text_w3layouts">
								<h3>Asosiy vazifamiz – tibbiyot sohasini yuqori samara bilan ishlaydigan, chinakam xalqchil tizimga aylantirishdan iborat.</h3>
								<p>Shavkat Mirziyoyev</p>
							</div>
					    </li>
                        <li>	
							<div class="banner_text_w3layouts">
								<h3>Inson salomatligi jamiyatning bebaho boyligi, shifokorlar esa ana shu boylikning fidoyi posbonlaridir</h3>
								<p>Shavkat Mirziyoyev</p>
							</div>
						</li>
					    <li>	
						    <div class="banner_text_w3layouts">
								<h3>Odamlar dardiga darmon bo‘lmoq-ezgulik va olijanoblikning yuksak namunasidir</h3>
								<p>Abu Ali Ibn Sino</p>
						    </div>
					    </li>
			    	</ul>
				</div>
			  <script src="{{asset('js/welcome/responsiveslides.js')}}"></script>
			  <script>
				// You can also use "$(window).load(function() {"
				$(function () {
				  // Slideshow 4
				  $("#slider4").responsiveSlides({
					auto: false,
					pager:true,
					nav:true,
					speed: 500,
					namespace: "callbacks",
					before: function () {
					  $('.events').append("<li>before event fired.</li>");
					},
					after: function () {
					  $('.events').append("<li>after event fired.</li>");
					}
				  });
			
				});
			 </script>
		   </div>
		</div>   
	</div>	
</div>
<!-- //banner -->
<!-- about -->
<!-- <div class="jarallax w3ls-about w3ls-section " id="about">
	<div class="container">
		<h3 class="h3-w3l">about us</h3>
		<div class="about-head text-center">
			<div class="col-md-4 col-sm-4 col-xs-6 wthree-s1 " >
				 <span class="fa fa-medkit sicon" aria-hidden="true"></span>
				 <h4>transplants</h4>
				 <p>Praesent imperdiet mollis odio,eget sodales tortor porttitor.Vac turpis egestas tortor.eget sodales tortor porttitor</p>
				 <div class="w3-button">
					<a href="#" data-toggle="modal" data-target="#myModal">Read More</a>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-6 wthree-s1  s1  s1-active">
				 <span class="fa fa-user-md sicon" aria-hidden="true"></span>
				 <h4>critical care</h4>
				 <p>Praesent imperdiet mollis odio,eget sodales tortor porttitor.Vac turpis egestas tortor.eget sodales tortor porttitor</p>
				 <div class="w3-button">
					<a href="#" data-toggle="modal" data-target="#myModal">Read More</a>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-6 wthree-s1">
				 <span class="fa fa-ambulance sicon" aria-hidden="true"></span>
				 <h4>Emergency</h4>
				 <p>Praesent imperdiet mollis odio,eget sodales tortor porttitor.Vac turpis egestas tortor.eget sodales tortor porttitor</p>
				 <div class="w3-button">
					<a href="#" data-toggle="modal" data-target="#myModal">Read More</a>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>		
	</div>
</div>	 -->
<!-- //about -->
<!-- Tooltip -->
<!-- <div class="tooltip-content">
	<div class="modal fade features-modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title text-center">medicate</h4>
				</div>
				<div class="modal-body">
					<img src="images/1.jpg" class="img-responsive" alt="image">
					<p>Fusce et congue nibh, ut ullamcorper magna. Donec ac massa tincidunt, fringilla sapien vel, tempus massa. Vestibulum felis leo, tincidunt sit amet tristique accumsan. In vitae dapibus metus. Donec nec massa non nulla mattis aliquam egestas et mi.</p>
				</div>
			</div>
		</div>
	</div>
</div> -->
<!-- //Tooltip -->
<!-- <div class="jarallax w3ls-services w3ls-section" id="services">
	<div class="container">
		<h3 class="h3-w3l">services</h3>
		<div class="services-head text-center">
			<h4>the skill to heal.the spirit to care</h4>
			<p>Fusce et congue nibh, ut ullamcorper magna. Donec ac massa tincidunt, fringilla sapien vel, tempus massa. Vestibulum felis leo, tincidunt sit amet tristique accumsan. In vitae dapibus metus. Donec nec massa non nulla mattis aliquam egestas et mi.</p>
		</div>
		<div class="services-bg">
			<h6>Hope lives here</h6>
			<a href="#" data-toggle="modal" data-target="#myModal">Read More</a>
		</div>
	</div>	
	<div class="wthree-services-bottom">
		<div class="container">
			<div class="col-md-3 col-sm-3 col-xs-6 wthree-sb1 " >
				 <span class="fa fa-certificate sicon" aria-hidden="true"></span>
				 <span class="num">01</span><h4>service1</h4>
				 <p>Praesent imperdiet mollis odio, eget sodales tortor porttitor.Vac turpis egestas tortor.</p>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6 wthree-sb1  sb1">
				 <span class="fa fa-heartbeat sicon" aria-hidden="true"></span>
				 <span class="num">02</span><h4>service2</h4>
				 <p>Praesent imperdiet mollis odio, eget sodales tortor porttitor.Vac turpis egestas tortor.</p>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6 wthree-sb1 sb2">
				 <span class="fa fa-star-o sicon" aria-hidden="true"></span>
				 <span class="num">03</span><h4>service3</h4>
				 <p>Praesent imperdiet mollis odio, eget sodales tortor porttitor.Vac turpis egestas tortor.</p>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6 wthree-sb1">
				 <span class="fa fa-plus-circle sicon" aria-hidden="true"></span>
				 <span class="num">04</span><h4>service4</h4>
				 <p>Praesent imperdiet mollis odio, eget sodales tortor porttitor.Vac turpis egestas tortor.</p>
			</div>
			<div class="clearfix"></div>
		</div>	
	</div>
</div>	 -->
<!-- footer-->	
<div class="agileits_w3layouts-footer">
	<div class="copy-right text-center">
		<span class="agileits-copy fa fa-plus" aria-hidden="true"></span>
		<p>&copy; 2017 ROOSUPPORT. All rights reserved</p>
	</div>	
</div>	
<!-- footer-->	
<script src="{{asset('js/welcome/jarallax.js')}}"></script>
<script src="{{asset('js/welcome/SmoothScroll.min.js')}}"></script>
<script type="text/javascript">
	/* init Jarallax */
	$('.jarallax').jarallax({
		speed: 0.5,
		imgWidth: 1366,
		imgHeight: 768
	})
</script>
<!-- here starts scrolling icon -->
		<!-- start-smoth-scrolling -->
		<script type="text/javascript" src="{{asset('js/welcome/move-top.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/welcome/easing.js')}}"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
		</script>
		<!-- /ends-smoth-scrolling -->
	<!-- //here ends scrolling icon -->
	<!--start-date-piker-->
		<link rel="stylesheet" href="{{asset('css/welcome/jquery-ui.css')}}" />
		<script src="{{asset('js/welcome/jquery-ui.js')}}"></script>
			<script>
				$(function() {
				$( "#datepicker,#datepicker1" ).datepicker();
				});
			</script>
<!-- //End-date-piker -->	
<!-- here starts scrolling icon -->
		<script type="text/javascript">
			$(document).ready(function() {
				/*
					var defaults = {
					containerID: 'toTop', // fading element id
					containerHoverID: 'toTopHover', // fading element hover id
					scrollSpeed: 1200,
					easingType: 'linear' 
					};
				*/
										
				$().UItoTop({ easingType: 'easeOutQuart' });
									
				});
		</script>
<!--tabs-->
		<script src="{{asset('js/welcome/easy-responsive-tabs.js')}}"></script>
		<script>
		$(document).ready(function () {
		$('#horizontalTab').easyResponsiveTabs({
		type: 'default', //Types: default, vertical, accordion           
		width: 'auto', //auto or any width like 600px
		fit: true,   // 100% fit in a container
		closed: 'accordion', // Start closed if in accordion view
		activate: function(event) { // Callback function if tab is switched
		var $tab = $(this);
		var $info = $('#tabInfo');
		var $name = $('span', $info);
		$name.text($tab.text());
		$info.show();
		}
		});
		$('#verticalTab').easyResponsiveTabs({
		type: 'vertical',
		width: 'auto',
		fit: true
		});
		});
		</script>
<!--//tabs-->
</body>
</html>
