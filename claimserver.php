<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/session.php"); ?>

<div class="modal fade" id="claimserver" tabindex="-1" role="dialog" aria-labelledby="claimserverLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="claimserverform" class="form-claimserver" role="form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="claimserverLabel">Claim Server</h4>
				</div>
			
				<input class="form-control" type="hidden" value="auth-claimserver" name="auth-type" id="auth-type">
				<input class="form-control" type="hidden" value="" name="auth-claimserver-id" id="auth-claimserver-id">
				<input class="form-control" type="hidden" value="<? echo $_SESSION["auth_username"]; ?>" name="auth-claimserver-username" id="auth-claimserver-username">
				
				<div class="modal-body">
					<div id="claimservermsg"></div>
					<b>To claim a server, be sure to follow these steps:</b><br>
					1) Sign in to your account on the website.<br>
					<? if(isset($_SESSION["auth_logged"])) { ?>
						2) Change your server-name to:<br><code id="reqname"></code><br>
						3) Click "Claim"<br>
						4) Change your server-name back to what it was before</br>
						5) Finished, you should see your claimed servers on your dashboard under the 'servers' tab.<br>
					<? } 
					if(!isset($_SESSION["auth_logged"])) { ?>
						<p class="form-text text-muted">The rest of the steps do not show up unless you sign in to your account.</p>
					<? } ?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button class="btn btn-primary" type="submit">Claim</button>
					
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$('#claimserver').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget)
		var serverid = button.data('server-id')
		var serverusername = '<?php echo $_SESSION["auth_username"]; ?>';
		
		var modal = $(this)
		modal.find('.modal-title').text('Claim Server (ID: ' + serverid + ')')
		$('#auth-claimserver-id').val(serverid);
		$('#reqname').text("Claiming Server " + serverid + " by " + serverusername);
		
		$('#claimservermsg').empty();
	})

	$('#claimserverform').submit(function(e) {
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
					$('#claimservermsg').addClass('alert alert-success').text(response.message);
				} else {
					$('#claimservermsg').addClass('alert alert-danger').text(response.message);
				}
			}
		});
		e.preventDefault();
	});
</script>