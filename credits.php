	<?php 
		require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/session.php");
		$_SESSION["page"] = "credits";
		require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/global.php");
	?>
	
	<div class="row">
		<div class="col-sm-9">
			<a href="//davidvkimball.deviantart.com/">David Kimball </a> - Social Images
			<br>
			<a href="//getbootstrap.com/">Bootstrap and its contributors</a> - Front End Framework
			<br>
			<a href="//github.com/">GitHub</a> - Private Repositories
			<br>
			<br>
			<a href="//curl.haxx.se/libcurl/">LibCurl</a> - HTTP Requests
			<br>
			<a href="http://www.jenkinssoftware.com/">RakNet</a> - Networking Framework
			<br>
			<a href="//bitbucket.org/chromiumembedded/cef">Chromium Embedded Framework</a> - Show front-end pages on-screen
			<br>
			<br>
			<a href="/team">Our team</a> - The people that made this modification! :)
			<br>
			<a href="/user/nra4ever">nra4ever</a> - Allowing me to use his dedicated server for the past 4 years. All of this wouldn't exist without his amazing support.
			</div>
		<div class="col-sm-3">
			<img class="img-fluid" style="max-height: 250px;" src="/assets/v1/images/common/pictransweb.PNG">
		</div>
	</div>
	<br><br>
</div>
<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/v1/footer.php");
?>
