<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/session.php"); ?>

<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="loginform" class="form-signin" role="form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="loginLabel">Sign In</h4>
				</div>
			
				<input class="form-control" type="hidden" value="auth-login" name="auth-type" id="auth-type">
				<div class="modal-body">
					<div id="loginmsg"></div>
					<div class="form-group">
						<label for="username">Username</label>
						<input class="form-control" type="username" placeholder="Username" name="auth-username" id="auth-username" required>
						<p id="usernameHelpBlock" class="form-text text-muted">
							This is the username you filled in when registering your account, you can also use your e-mail.
						</p>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input class="form-control" type="password" placeholder="Password" name="auth-password" id="auth-password" required>
						<p id="passwordHelpBlock" class="form-text text-muted">
							This is the password you filled in when registering your account, passwords are case-sensitive.
						</p>
					</div>
					
					<!--<div class="checkbox">
						<label>
						<input type="checkbox" value="remember-me"> Remember me
						</label>
					</div>-->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button class="btn btn-primary" type="submit">Sign In</button>
					
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$('#loginform').submit(function(e) {
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

				if(response.type == 'success') {
					window.location.href="/dashboard";
				} else {
					$('#loginmsg').addClass('alert alert-danger').text(response.message);
				}
			}
		});
		e.preventDefault();
	});
</script>