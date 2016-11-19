<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/session.php");
	$_SESSION["page"] = "dashboard";

	if(!isset($_SESSION["auth_logged"]))
	{
		header("Location: /home");
		die();
	}
	
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/global.php");
	
	$claimedservers = $pdo->prepare('SELECT * FROM claimedservers WHERE username = ?');
	$claimedservers->execute([$_SESSION["auth_username"]]);
	$claimedservers_amount = $claimedservers->rowCount();
	
	$userdata = $pdo->prepare('SELECT * FROM users WHERE username = ?');
	$userdata->execute([$_SESSION["auth_username"]]);
	
	while ($row = $userdata->fetch()) {
		$tempauthor = $row["username"];
		$temprank = $row["rank"];
		$tempavatar = $row["avatar"];
		$tempbio = $row["bio"];
		
		$temptwitter = $row["twitter"];
		$tempsteam = $row["steam"];
		$tempyoutube = $row["youtube"];
		$tempvk = $row["vk"];
	}
?>

<div class="row">
	<div class="col-sm-2">
		<!-- Nav tabs -->
		<ul class="nav nav-pills nav-stacked" role="tablist">
			<li class="nav-item"><a class="nav-link disabled">Dashboard</a></li>
			<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home" role="tab">Home</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#myservers" role="tab">My Servers<span class="tag tag-default tag-pill pull-xs-right"><? echo $claimedservers_amount; ?></span></a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#preferences" role="tab">Preferences</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile" role="tab">Profile</a></li>
			
			<form id="logoutform" class="form-signout" role="form">
				<input class="form-control" type="hidden" value="auth-logout" name="auth-type" id="auth-type">
				<li class="nav-item"><a class="nav-link" data-toggle="tab" role="#logout" href="#" onclick="$(this).closest('form').submit()">Sign Out</a></li>
			</form>
		</ul>
	</div>
	<div class="col-sm-7">
		<!-- Tab panes -->
		<div class="tab-content">
			<div id="home" class="tab-pane fade in active">
				<h3>Home</h3>
				<hr>
				<p>Welcome to the FiveMP Dashboard, there's not much here yet, but it's all being worked on!.</p>
			</div>
			<div id="myservers" class="tab-pane fade">
				<h3>My servers</h3>
				<hr>
				<?php
					if($claimedservers_amount > 0) {
						while ($row = $claimedservers->fetch()) {
							$url = 'http://176.31.142.113:7000/servers';
							$array = file_get_contents($url);
							$data = json_decode($array);
								
							foreach($data as $json){
								if($json->id == $row['serverid']) {
								echo "".$json->name."<br>";
								}
							}
						}
					} else {
						echo "<p>You have not claimed any servers yet.</p>";
					}
				?>
			</div>
			<div id="preferences" class="tab-pane fade">
				<h3>Preferences</h3>
				<!--<form id="prefform" class="form-pref" role="form">
				<hr>
				<input class="form-control" type="hidden" value="auth-pref" name="auth-type" id="auth-type">
				<div class="modal-body">
					<div id="prefmessages"></div>
					<div class="form-group">
						Email Address
						<input class="form-control" type="email" placeholder="Email Address" name="auth-pref-email" id="auth-pref-email" required>
						<p id="emailHelpBlock" class="form-text text-muted">
							Enter a valid email address, we only send e-mails for password resets and security issues.
						</p>
					</div><br>
					<div class="form-group">
						Password
						<input pattern=".{3,24}" title="6 to 32 characters" class="form-control" type="password" placeholder="Password" name="auth-pref-password" id="auth-pref-password" required>
						<p id="passwordHelpBlock" class="form-text text-muted">
							Choose a strong password between 6 and 32 characters. Preferably containing characters and numbers.
						</p>
					</div>
					<div class="form-group">
						Confirm Password
						<input pattern=".{3,24}" title="6 to 32 characters" class="form-control" type="password" placeholder="Confirm Password" name="auth-pref-password2" id="auth-pref-password2" required>
						<p id="passwordHelpBlock" class="form-text text-muted">
							Confirm your password by re-entering it again.
						</p>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="submit">Save</button>
					
				</div>
			</form>-->
			Removed until it works. ^Jack
			</div>
			
			<div id="profile" class="tab-pane fade">
				<h3>Profile</h3>
				<form id="profileform" class="form-profile" role="form">
					<input class="form-control" type="hidden" value="auth-profile" name="auth-type" id="auth-type">
					
					<div id="profmessages"></div>
					
					<div class="form-group row">
						<label for="auth-profile-bio" class="col-sm-2 col-form-label">Biography</label>
						<div class="col-sm-10">
							<textarea class="form-control" placeholder="Fill in a biography, this will be visible to the public." rows="5" name="auth-profile-bio" id="auth-profile-bio" required><? echo $tempbio; ?></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label for="auth-profile-title" class="col-sm-2 col-form-label">User Title</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="auth-profile-title" id="auth-profile-title" value="<? echo $temprank; ?>" placeholder="User Title" readonly>
						</div>
						<small class="text-muted">User Title (Staff only)</small>
					</div>
					<br>
					<div class="form-group row">
						<label for="auth-profile-twitter" class="col-sm-2 col-form-label">Twitter</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="auth-profile-twitter" id="auth-profile-twitter" value="<? echo $temptwitter; ?>" placeholder="Twitter Name">
						</div>
						<small class="text-muted">Twitter Name (e.g: <i>FiveMultiplayer</i>)</small>
					</div>
					<div class="form-group row">
						<label for="auth-profile-steam" class="col-sm-2 col-form-label">Steam</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="auth-profile-steam" id="auth-profile-steam" value="<? echo $tempsteam; ?>" placeholder="Steam ID">
						</div>
						<small class="text-muted">Steam ID 64 <a href="https://steamid.io/">(How?)</a></small>
					</div>
					<div class="form-group row">
						<label for="auth-profile-youtube" class="col-sm-2 col-form-label">YouTube</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="auth-profile-youtube" id="auth-profile-youtube" value="<? echo $tempyoutube; ?>" placeholder="YouTube Channel">
						</div>
						<small class="text-muted">Youtube Channel ID <a href="https://www.youtube.com/watch?v=tUhIA3pIHSQ">(How?)</a></small>
					</div>
					<div class="form-group row">
						<label for="auth-profile-vk" class="col-sm-2 col-form-label">VK</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="auth-profile-vk" id="auth-profile-vk" value="<? echo $tempvk; ?>" placeholder="VK Page">
						</div>
						<small class="text-muted">VK Page</small>
					</div>
					
					<br>
					<h6 class="card-subtitle text-muted">Please follow the <a href="#">Community Guidelines</a> before updating your profile.</h6>
					<br>
					<button class="btn btn-primary" type="submit">Save</button>
				</form>
			</div>
			<div id="logout" class="tab-pane fade">
				<div id="logoutmessages"></div>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<h3>Statistics</h3>
		Hello <? echo $_SESSION["auth_username"]; ?>
		<br>
		Admin: <? echo (boolval($_SESSION["auth_admin"]) ? 'true' : 'false'); ?>
		<br>
		Last Login: <? echo time_elapsed_string('@'.$_SESSION["auth_last"]); ?>
		<?php // cloudflare stuff
		/*echo "<br><br><h3>Debug</h3>";
		echo $_SERVER["HTTP_CF_CONNECTING_IP"] . ' IP<br>';
		echo $_SERVER["HTTP_CF_IPCOUNTRY"] . ' Country<br>';
		echo $_SERVER["HTTP_CF_RAY"] . ' Rays<br>';
		echo $_SERVER["HTTP_CF_VISITOR"] . ' Type<br>';*/
		
		?>
	</div>
</div>

<script>
    tinymce.init({ 
		selector:'textarea',
		
		plugins: "link",
		menubar: "insert",
		
		elementpath: false,
		menubar: false,
		setup: function (editor) {
			editor.on('change', function () {
				editor.save();
			});
		}
	});

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
				} else {
					$('#logoutmessages').addClass('alert alert-danger').text(response.message);
				}
			}
		});
		e.preventDefault();
	});
	
	$('#prefform').submit(function(e) {
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
					$('#prefmessages').addClass('alert alert-success').text(response.message);
				} else {
					$('#prefmessages').addClass('alert alert-danger').text(response.message);
				}
			}
		});
		e.preventDefault();
	});
	
	$('#profileform').submit(function(e) {
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
					$('#profmessages').addClass('alert alert-success').text(response.message);
				} else {
					$('#profmessages').addClass('alert alert-danger').text(response.message);
				}
			}
		});
		e.preventDefault();
	});
</script>
					
<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/v1/footer.php");
?>
