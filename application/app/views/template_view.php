
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<title>Grains Team</title>
		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
		<link href="http://fonts.googleapis.com/css?family=Kreon" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="/css/style.css" />
		<link rel="stylesheet" type="text/css" href="js/slider/css/slider.css" />
                <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
                <link rel="stylesheet" type="text/css" href="/css/bootstrap-theme.min.css" />
		<script src="/js/jquery-2.2.2.js" type="text/javascript"></script> 
                <script src="/js/bootstrap.js" type="text/javascript"></script> 
                <script src="/js/signup.js" type="text/javascript"></script> 
		<script src="/js/slider/js/slider.js" type="text/javascript"></script> 
		<script type="text/javascript">
		// return a random integer between 0 and number
		function random(number) {
			
			return Math.floor( Math.random()*(number+1) );
		};
		
		// show random quote
		$(document).ready(function() { 

			var quotes = $('.quote');
			quotes.hide();
			
			var qlen = quotes.length; //document.write( random(qlen-1) );
			$( '.quote:eq(' + random(qlen-1) + ')' ).show(); //tag:eq(1)
		});
		</script>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<div id="logo">
					<a href="/">ПРОСТОЙ</span> <span class="cms">БЛОГ</span></a>
				</div>
				<div id="menu">
					<ul>
						<li class="first active"><a href="/main">Список записей</a></li>
 
					</ul>
					<br class="clearfix" />
				</div>
			</div>
			<div id="page">
				<div id="sidebar">
					<div class="side-box">
						<h3>Основное меню</h3>
						<ul class="list">
							<li class="first "><a href="/main">Список записей</a></li>
							
						</ul>
					</div>
				</div>
				<div id="content">
					<div class="box">
						<?php include 'application/app/views/'.$content_view; ?>
					</div>
					<br class="clearfix" />
				</div>
				<br class="clearfix" />
			</div>
			<div id="page-bottom">
			    <div id="page-bottom-sidebar"></div>
			    <div id="page-bottom-content"></div>
			    <br class="clearfix" />
			</div>
		   </div>
                <script src="/js/bootstrap.js" type="text/javascript"></script> 
                <script src="/js/signup.js" type="text/javascript"></script> 
		<div id="footer"></div>
	</body>
</html>