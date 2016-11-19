<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/session.php");
	$_SESSION["page"] = "index";
	
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/global.php");
?>

<div class="row">
	<div class="col-sm-7">
		<h3>Latest Updates</h3>
		<div class="alert alert-danger" role="alert">
			<h4 class="alert-danger">Player Amounts on the server list.</h4>
			<p>There are a few servers with an incorrect player value, this is fixed in RC4-1, we kindly ask every server owner to update their server(s) to the latest version.</p>
			<p class="m-b-0">Thanks,<br>FiveMP Team.</p>
		</div>
		<div class="alert alert-success" role="alert">
			<h4 class="alert-success">New Release Candidate!</h4>
			<p>FiveMP 0.1b RC4-1 has been released. - For the full changelog and download links, please click <a href="/download">here</a> - Enjoy!</p>
			<p class="m-b-0">Thanks,<br>FiveMP Team.</p>
		</div><br><br>
		<h3>Welcome!</h3>
		<p>Hi there and welcome to the new website for Five Multiplayer. It has come with an updated design using Bootstrap and some small features.<br><br><b>Authentication</b><br>We have made it possible to register and login on the website, these account details are required to be used in-game in the <i>future</i> when we're introducing <a href="https://en.wikipedia.org/wiki/Chromium_Embedded_Framework">CEF</a>, which allows us (and server owners) to show webpages in-game with Five Multiplayer.<br>
		</div>
	<div class="col-sm-5 twitter">
		<? require_once($_SERVER['DOCUMENT_ROOT'] . "/twitter.php"); ?>
	</div>
</div>

<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/v1/footer.php");
?>