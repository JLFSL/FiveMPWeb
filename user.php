<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/session.php");
	
	$viewuser = htmlspecialchars($_GET['name'], ENT_QUOTES, "UTF-8");
	
	$_SESSION["page"] = "none";
	if($_SESSION["auth_username"] == $viewuser)
		$_SESSION["page"] = "myprofile";
	
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/global.php");
	
	$userdata = $pdo->prepare('SELECT * FROM users WHERE username = ?');
	$userdata->execute([$viewuser]);
	$userdata_a = $userdata->rowCount();
	
	if($userdata_a == 0) {
		echo "This user could not be found<br>";
		die(require_once($_SERVER['DOCUMENT_ROOT'] . "/include/v1/footer.php"));
	}
	
	while ($row = $userdata->fetch()) {
		$tempauthor = $row["username"];
		$tempemail = $row["email"];
		
		$temprank = $row["rank"];
		$tempavatar = $row["avatar"];
		$tempbio = $row["bio"];
		
		$temptwitter = $row["twitter"];
		$tempsteam = $row["steam"];
		$tempyoutube = $row["youtube"];
		$tempvk = $row["vk"];
		
		$tempgithub = $row["github"];
		$tempreddit = $row["reddit"];
		$temptwitch = $row["twitch"];
	}
	
	$commentdata = $pdo->prepare('SELECT * FROM users_comments WHERE receiver = ? ORDER BY date DESC LIMIT 5');
	$commentdata->execute([$viewuser]);
	$commentdata_a = $commentdata->rowCount();
?>
	<div class="row">
		<div class="col-sm-4">
			<div class="card">
				<div class="card-block">
					<h4 class="card-title"><font class="username"><b><? echo $tempauthor ?></b></font></h4>
					<h6 class="card-subtitle text-muted"><? echo $temprank; ?></h6>
				</div>
				<!--<center><img src="<? //echo $tempavatar; ?>" class="img-fluid" style="max-height:340px;" alt="<? //echo $viewuser; ?>'s avatar"></center>-->
				<center><img src="https://www.gravatar.com/avatar/<? echo md5(strtolower(trim($tempemail))); ?>?d=<? echo urlencode("https://www.five-multiplayer.net/assets/v1/images/profile/picback.png"); ?>&s=500" class="img-fluid" style="max-height:500px;" alt="<? echo $viewuser; ?>'s avatar"></center>
				<div class="card-footer text-muted">
					<center>
					<?php 
						if(!empty($tempsteam)) {
							echo '<a href="//steamcommunity.com/profiles/'.$tempsteam.'"><img src="/assets/v1/images/social/steam.png" class="img-responsive" style="max-height:64px;"></a>&nbsp;';
						}
						if(!empty($temptwitter)) {
							echo '<a href="//twitter.com/'.$temptwitter.'"><img src="/assets/v1/images/social/twitter.png" class="img-responsive" style="max-height:64px;"></a>&nbsp;';
						}
						if(!empty($tempyoutube)) {
							echo '<a href="//youtube.com/channel/'.$tempyoutube.'"><img src="/assets/v1/images/social/youtube.png" class="img-responsive float-xs-right" style="max-height:64px;"></a>&nbsp;';
						}
						if(!empty($tempvk)) {
							echo '<a href="//vk.com/'.$tempvk.'"><img src="/assets/v1/images/social/vk.png" class="img-responsive float-xs-right" style="max-height:64px;"></a>&nbsp;';
						}
						
						if(!empty($tempgithub)) {
							echo '<a href="//github.com/'.$tempgithub.'"><img src="/assets/v1/images/social/github.png" class="img-responsive float-xs-right" style="max-height:64px;"></a>&nbsp;';
						}
						if(!empty($tempreddit)) {
							echo '<a href="//reddit.com/u/'.$tempreddit.'"><img src="/assets/v1/images/social/reddit.png" class="img-responsive float-xs-right" style="max-height:64px;"></a>&nbsp;';
						}
						if(!empty($temptwitch)) {
							echo '<a href="//twitch.tv/'.$temptwitch.'"><img src="/assets/v1/images/social/twitch.png" class="img-responsive float-xs-right" style="max-height:64px;"></a>&nbsp;';
						}
					?>
					</center>
				</div>
				<div class="card-block">
						<p class="card-text">
							<?php
								// tags separated by vertical bar
								$strip_tags = "p";
								$clean_html = preg_replace("#<\s*\/?(".$strip_tags.")\s*[^>]*?>#im", '', htmlspecialchars_decode($tempbio));
								
								echo $clean_html;
							?>
						</p>
				</div>
				
			</div>
		</div>
		<div class="col-sm-8">
			<div class="card">
				<div class="card-block">
					<h4 class="card-title">Comments</h4>
					<h6 class="card-subtitle text-muted">New to old</h6><br>
					<!--<a href="javascript:pageChange(1)">Previous page</a> <span id="curcommentpage"></span> <a href="javascript:pageChange(0)"><span  class="text-xs-right">Next page</span></a>-->
					<ul class="media-list">
						<div id="commentlist_ajax"></div>
					</ul>
					
					<div class="row">
							<div class="col-sm-12">
								<button id="nextpage" class="btn btn-primary btn-block">Load More</button>
							</div>
						</div>
					
					<br>
					
					<form id="postcommentform" class="form-postcomment" role="form">
						<input class="form-control" type="hidden" value="auth-postcomment" name="auth-type" id="auth-type">
						<input class="form-control" type="hidden" value="<? echo $viewuser; ?>" name="auth-postcomment-receiver" id="auth-postcomment-receiver">
						
						<textarea class="form-control" placeholder="Write your comment" rows="5" name="auth-postcomment-message" id="auth-postcomment-message" required></textarea>
						<br>
						<h6 class="card-subtitle text-muted">Please follow the <a href="#">Community Guidelines</a> before posting a comment.</h6>
						<br>
						<button class="btn btn-primary" type="submit">Post</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<div id="hiddenamount">
	<?php 
		//echo getCommentAmount($viewuser); 
	?>
</div>

<script>
	$('a').click(function () {
		this.blur(); // or $(this).blur();
	});
	var pid = 0;

	$.get('/include/global/misc/loadcomments.php?user=<? echo $viewuser; ?>&pageid=' + pid + '&loadmore=0',function(data) {
			var posts = $(data).find('#correctcomment');
			//$('#commentlist_ajax').append(posts);
			$(posts).hide().appendTo("#commentlist_ajax").slideDown(0);
		});
	
	$('#curcommentpage').append(pid);
			
	$( "#nextpage" ).click(function() {
		pid = pid + 1;
		
		$.get('/include/global/misc/loadcomments.php?user=<? echo $viewuser; ?>&pageid=' + pid + '&loadmore=1',function(data) {
			var posts = $(data).find('#correctcomment');
			//$('#commentlist_ajax').append(posts).fadeIn(1000);
			$(posts).hide().appendTo("#correctcomment").slideDown(1000);
		});
		
		$('#curcommentpage').empty();
		$('#curcommentpage').append(pid);
		
	});
	
	$('#postcommentform').submit(function(e) {
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
					$('#commentmsg').addClass('alert alert-success').text(response.message);
					location.reload();
				} else {
					$('#commentmsg').addClass('alert alert-danger').text(response.message);
				}
			}
		});
		e.preventDefault();
	});
</script>

<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/v1/footer.php");
?>
