	<?php 
		require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/session.php");
		
		$article = htmlspecialchars($_GET['id'], ENT_QUOTES, "UTF-8");
		
		$_SESSION["page"] = "news";
		
		require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/global.php");
		
		$newsarticle = $pdo->prepare('SELECT * FROM blogposts WHERE id = ?');
		$newsarticle->execute([$article]);
		$newsarticle_a = $newsarticle->rowCount();
		
		if($newsarticle_a == 0) {
			echo "This article could not be found<br>";
			die(require_once($_SERVER['DOCUMENT_ROOT'] . "/include/v1/footer.php"));
		}
		
		while ($row = $newsarticle->fetch()) {
			echo '
			<br>
				<h1><b>' . $row["title"] . '</b></h1>
				<p>Posted ' . time_elapsed_string('@'.$row["date"]) . ' by <a class="deco-none" href="/user/' . $row["author"] . '">' . $row["author"] . '</a></p>
				<div class="page">
					<section id="content">
						<center><img class="img-fluid" src="' . $row["image"] . '"></center><br>
						' . $row["text"] . '
						<br>
					</section>
				</div>';
		}
	?>

	<br>

	<div class="page">
		<section id="content">
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
					
					<form id="postblogcommentform" class="form-postblogcomment" role="form"> 
						<input class="form-control" type="hidden" value="auth-postblogcomment" name="auth-type" id="auth-type">
						<input class="form-control" type="hidden" value="<? echo $article; ?>" name="auth-postblogcomment-receiver" id="auth-postblogcomment-receiver">
						
						<textarea class="form-control" placeholder="Write your comment" rows="5" name="auth-postblogcomment-message" id="auth-postblogcomment-message" required></textarea>
						<br>
						<h6 class="card-subtitle text-muted">Please follow the <a href="#">Community Guidelines</a> before posting a comment.</h6>
						<br>
						<button class="btn btn-primary" type="submit">Post</button>
					</form>
				</div>
			</div>
			<br>
		</section>
	</div>
</div>

<script>
	$('a').click(function () {
		this.blur(); // or $(this).blur();
	});
	var pid = 0;

	$.get('/include/global/misc/loadblogcomments.php?user=<? echo $article; ?>&pageid=' + pid + '&loadmore=0',function(data) {
			var posts = $(data).find('#correctcomment');
			//$('#commentlist_ajax').append(posts);
			$(posts).hide().appendTo("#commentlist_ajax").slideDown(0);
		});
	
	$('#curcommentpage').append(pid);
			
	$( "#nextpage" ).click(function() {
		pid = pid + 1;
		
		$.get('/include/global/misc/loadblogcomments.php?user=<? echo $article; ?>&pageid=' + pid + '&loadmore=1',function(data) {
			var posts = $(data).find('#correctcomment');
			//$('#commentlist_ajax').append(posts).fadeIn(1000);
			$(posts).hide().appendTo("#correctcomment").slideDown(1000);
		});
		
		$('#curcommentpage').empty();
		$('#curcommentpage').append(pid);
		
	});
	
	$('#postblogcommentform').submit(function(e) {
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
