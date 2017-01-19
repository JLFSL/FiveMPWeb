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
		<div id="header">
			<nav class="navbar navbar-full navbar-fixed-top navbar-dark bg-faded">
				<button class="navbar-toggler navbar-dark hidden-sm-up" type="button" data-toggle="collapse" data-target="#collapsenavbar" aria-controls="collapsenavbar" aria-expanded="false" aria-label="Toggle navigation">
					<font color="white">&#9776;</font>
				</button>
				<!--<a class="navbar-brand hidden-sm-down" href="home">
					<img class="hidden-sm-down" src="/assets/v1/images/common/logo.png" style="height:3rem">
				</a>-->
				<div class="collapse navbar-toggleable-xs headermore" id="collapsenavbar">
					<a class="navbar-brand" href="/home"> <img class="hidden-sm-down" src="/assets/v1/images/common/pictransweb.PNG" style="height:30px"></a>
					<ul class="nav navbar-nav">
						<li class='nav-item <? if ($_SESSION["page"] == "index") echo "active"; ?>'><a class='nav-link' href='/home'>Home</a></li>
						<li class='nav-item dropdown'>
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">Community</a>
							<div class="dropdown-menu">
								<a class='dropdown-item  <? if ($_SESSION["page"] == "forums") echo "active"; ?>' href='//forums.five-multiplayer.net'>Forum</a>
								<a class='dropdown-item  <? if ($_SESSION["page"] == "twitter") echo "active"; ?>' href='//twitter.com/fivemultiplayer'>Twitter</a>
								<a class='dropdown-item  <? if ($_SESSION["page"] == "twitter") echo "active"; ?>' href='//discord.gg/0zRk4CXZ1j2K6wZb'>Discord</a>
							</div>
						</li>
						<li class='nav-item dropdown'>
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">Modification</a>
							<div class="dropdown-menu">
								<a class='dropdown-item  <? if ($_SESSION["page"] == "servers") echo "active"; ?>' href='/servers'>Servers</a>
								<a class='dropdown-item  <? if ($_SESSION["page"] == "download") echo "active"; ?>' href='/download'>Download</a>
							</div>
						</li>
						<li class='nav-item dropdown'>
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">Developers</a>
							<div class="dropdown-menu">
								<a class='dropdown-item  <? if ($_SESSION["page"] == "forums") echo "active"; ?>' href='//wiki.five-multiplayer.net'>Documentation</a>
								<a class='dropdown-item  <? if ($_SESSION["page"] == "twitter") echo "active"; ?>' href='//changelog.five-multiplayer.net'>Changelog</a>
							</div>
						</li>
					</ul>
					<ul class="nav navbar-nav pull-xs-right">
						<? if(!isset($_SESSION["auth_logged"])) { ?>
						<li class='nav-item <? if ($_SESSION["page"] == "login") echo "active"; ?>'><a class='nav-link' href='login' data-toggle="modal" data-target="#login">Sign In</a></li>
						<li class='nav-item <? if ($_SESSION["page"] == "register") echo "active"; ?>'><a class='nav-link' href='register' data-toggle="modal" data-target="#register">Register</a></li>
						<? } else { ?>
							<li class='nav-item dropdown'>
								<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false"><? echo $_SESSION["auth_username"]; ?></a>
								<div class="dropdown-menu">
									<a class='dropdown-item  <? if ($_SESSION["page"] == "myprofile") echo "active"; ?>' href='/user/<? echo $_SESSION["auth_username"]; ?>'>Profile</a>
									<a class='dropdown-item  <? if ($_SESSION["page"] == "dashboard") echo "active"; ?>' href='/dashboard'>Dashboard</a>
									<form id="logoutform" class="form-signout" role="form">
										<input class="form-control" type="hidden" value="auth-logout" name="auth-type" id="auth-type">
										<a class='dropdown-item' href='#' onclick="$(this).closest('form').submit()">Logout</a>
									</form>
								</div>
							</li>
						<? } ?>
					</ul>
				</div>
			</nav>
		</div>
		<script>
			$('#logoutform').submit(function(e) {
				var form = $(this);
				var formdata = false;
				if(window.FormData){
					formdata = new FormData(form[0]);
				}

				var formAction = form.attr('action');

				$.ajax({
					type        : 'POST',
					url         : '/include/global/misc/auth.php',
					cache       : false,
					data        : formdata ? formdata : form.serialize(),
					contentType : false,
					processData : false,
					dataType: 'json',

					success: function(response) {
						console.log(response.message);
						//TARGET THE MESSAGES DIV IN THE MODAL
						if(response.type == 'success') {
							window.location.href="home";
						}
					}
				});
				e.preventDefault();
			});
		</script>
		<?php
			if(!isset($_SESSION["auth_logged"])) {
				require_once($_SERVER['DOCUMENT_ROOT'] . "/login.php"); // Load Login Modal
				require_once($_SERVER['DOCUMENT_ROOT'] . "/register.php"); // Load Claim Server Modal
			}

			if ($_SESSION["page"] == "servers") {
				require_once($_SERVER['DOCUMENT_ROOT'] . "/claimserver.php"); // Load Claim Server Modal
			}
		?>
		<br>
        <div class="containermore">
			<?php
			if ($_SESSION["page"] != "index" && $_SESSION["page"] != "news" && $_SESSION["page"] != "documentation")
				echo '<div class="page"><section id="content">';
			?>
