<? require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/session.php"); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Five-Multiplayer - GTA V Multiplayer Modification</title>

		<!-- Javascript -->
		<script src="//code.jquery.com/jquery-3.0.0.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.0.0/ekko-lightbox.min.js"></script>
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
		
		<!-- Stylesheets -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/v1/css/style.css">
        <link rel="stylesheet" href="/assets/v1/css/twitter.css">
        <link rel='stylesheet' href='/assets/v1/font/typicons.min.css' />
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/css/tether.min.css">
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.0.0/ekko-lightbox.min.css">
		
		<meta property="og:url" content="https://www.five-multiplayer.net">
		<meta property="og:site_name" content="FiveMP">
		<meta property="og:type" content="article">
		<meta property="og:title" content="Five Multiplayer">
		<meta property="og:description" content="Five-Multiplayer is a multiplayer modification for the game called 'Grand Theft Auto V'">
		<meta property="og:image" content="https://five-multiplayer.net/assets/v1/images/common/pictrans128.png">
		 
		<meta name="twitter:card" content="summary">
		<meta name="twitter:site" content="@fivemultiplayer">
		<meta name="twitter:title" content="Frontpage">
		<meta name="twitter:description" content="Five-Multiplayer is a multiplayer modification for the game called 'Grand Theft Auto V'">
		<meta name="twitter:image" content="https://five-multiplayer.net/assets/v1/images/common/pictrans128.png">
		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    </head>
    <body>
		<script>
			$(function() {

				
				//load content for first tab and initialize  
				$('#discord').click(function(e) {
				   e.preventDefault();
				$('#discordap').load('discord.php');
				});
			});
		</script>
		<div id="header">	
			<nav class="navbar navbar-full navbar-fixed-top navbar-dark bg-faded">
				<button class="navbar-toggler navbar-dark hidden-sm-up" type="button" data-toggle="collapse" data-target="#collapsenavbar" aria-controls="collapsenavbar" aria-expanded="false" aria-label="Toggle navigation">
					<font color="white">&#9776;</font>
				</button>
				<!--<a class="navbar-brand hidden-sm-down" href="home">
					<img class="hidden-sm-down" src="/assets/v1/images/common/logo.png" style="height:3rem">
				</a>-->
				<div class="collapse navbar-toggleable-xs headermore" id="collapsenavbar">
					<a class="navbar-brand" href="#">
				<img class="hidden-sm-down" src="/assets/v1/images/common/pictransweb.PNG" style="height:30px">
				</a>
					<ul class="nav navbar-nav">
						<li class='nav-item <? if ($_SESSION["page"] == "index") echo "active"; ?>'><a class='nav-link' href='/home'>Home</a></li>
						<li class='nav-item <? if ($_SESSION["page"] == "servers") echo "active"; ?>'><a class='nav-link' href='/servers'>Servers</a></li>
						<li class='nav-item'><a class='nav-link' href='//forums.five-multiplayer.net'>Forum</a></li>
						<li class='nav-item dropdown'>
							<a class="nav-link dropdown-toggle" id="discord" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">Discord</a>
							<!--<a class='nav-link' href='https://discord.gg/0zRk4CXZ1j2K6wZb'>Discord</a>-->
							<div id="discordap" class="dropdown-menu">
								
							</div>
						</li>
						<li class='nav-item <? if ($_SESSION["page"] == "download") echo "active"; ?>'><a class='nav-link' href='/download'>Download</a></li>
						<li class='nav-item <? if ($_SESSION["page"] == "wiki") echo "active"; ?>'><a class='nav-link' href='https://wiki.five-multiplayer.net'>Documentation</a></li>
					</ul>
					<ul class="nav navbar-nav pull-xs-right">
						<? if(!isset($_SESSION["auth_logged"])) { ?>
						<li class='nav-item <? if ($_SESSION["page"] == "login") echo "active"; ?>'><a class='nav-link' href='login' data-toggle="modal" data-target="#login">Sign In</a></li>
						<li class='nav-item <? if ($_SESSION["page"] == "register") echo "active"; ?>'><a class='nav-link' href='register' data-toggle="modal" data-target="#register">Register</a></li>
						<? } else { ?>
						<li class='nav-item <? if ($_SESSION["page"] == "myprofile") echo "active"; ?>'><a class='nav-link' href='/user/<? echo $_SESSION["auth_username"]; ?>'>Profile</a></li>
						<li class='nav-item <? if ($_SESSION["page"] == "dashboard") echo "active"; ?>'><a class='nav-link' href='/dashboard'>Dashboard</a></li>
						<? } ?>
					</ul>
				</div>
			</nav>
		</div>
		<?php 
			require_once($_SERVER['DOCUMENT_ROOT'] . "/login.php"); // Load Login Modal
			require_once($_SERVER['DOCUMENT_ROOT'] . "/register.php"); // Load Claim Server Modal
			require_once($_SERVER['DOCUMENT_ROOT'] . "/claimserver.php"); // Load Claim Server Modal
		?>
		<br>
        <div class="containermore">
			<?php
			if ($_SESSION["page"] != "index" && $_SESSION["page"] != "news") 
				echo '<div class="page"><section id="content">'; 
			?>
			<div class="alert alert-danger" role="alert">
				<h4 class="alert-danger">Website update</h4>
				<p>We're currently updating the website with a darker theme and different features, it may take a while to see all changes in effect.</p>
			</div>
						