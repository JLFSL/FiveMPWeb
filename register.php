<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/session.php"); ?>

<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="registerLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form id="registerform" class="form-register" role="form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="registerLabel">Register</h4>
				</div>
			
				<input class="form-control" type="hidden" value="auth-register" name="auth-type" id="auth-type">
				<div class="modal-body">
					<div id="registermsg"></div>
					<div class="form-group">
						Username
						<input pattern=".{3,24}" title="3 to 24 characters" class="form-control" type="username" placeholder="Username" name="auth-username" id="auth-username" required>
						<p id="usernameHelpBlock" class="form-text text-muted">
							Choose any username with a length of between 3 and 24 characters, no special characters.
						</p>
					</div>
					<div class="form-group">
						Email Address
						<input class="form-control" type="email" placeholder="Email Address" name="auth-email" id="auth-email" required>
						<p id="emailHelpBlock" class="form-text text-muted">
							Enter a valid email address, we only send e-mails for password resets and security issues.
						</p>
					</div><br>
					<div class="form-group">
						Password
						<input pattern=".{3,24}" title="6 to 32 characters" class="form-control" type="password" placeholder="Password" name="auth-password" id="auth-password" required>
						<p id="passwordHelpBlock" class="form-text text-muted">
							Choose a strong password between 6 and 32 characters. Preferably containing characters and numbers.
						</p>
					</div>
					<div class="form-group">
						Confirm Password
						<input pattern=".{3,24}" title="6 to 32 characters" class="form-control" type="password" placeholder="Confirm Password" name="auth-password2" id="auth-password2" required>
						<p id="passwordHelpBlock" class="form-text text-muted">
							Confirm your password by re-entering it again.
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
					<button class="btn btn-primary" type="submit">Register Account</button>
					
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$('#registerform').submit(function(e) {
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
					window.location.href="dashboard";
				} else {
					$('#registermsg').addClass('alert alert-danger').text(response.message);
				}
			}
		});
		e.preventDefault();
	});
</script>