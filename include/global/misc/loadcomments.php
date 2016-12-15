<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/global.php");
?>

<div id="correctcomment">

<?php
	$usern = htmlspecialchars($_GET['user'], ENT_QUOTES, "UTF-8");
	$pageid = htmlspecialchars($_GET['pageid'], ENT_QUOTES, "UTF-8");
	$loadmore = htmlspecialchars($_GET['loadmore'], ENT_QUOTES, "UTF-8");
	
	$min = ($pageid * 5);
	$max = ($min + 5);

	$commentdata = $pdo->prepare('SELECT * FROM users_comments WHERE receiver = :rec ORDER BY date DESC LIMIT 5 OFFSET :off');
	$commentdata->execute(array("rec" => $usern, "off" => $min));
	$commentdata_a = $commentdata->rowCount();
	
	if($commentdata_a == 0) {
		if($loadmore != 1) {
			echo "<p>No comments on this page, show some love by posting one.</p>";
		}
	} else {
		while ($row = $commentdata->fetch()) {
			$commentdataavatar = $pdo->prepare('SELECT email FROM users WHERE username = ?');
			$commentdataavatar->execute([$row["author"]]);
			
			while ($row2 = $commentdataavatar->fetch()) {
				$commentdataavatar_res = $row2["email"];
			}
			
			$newcomment = tagExtract($row["message"]);
			
			echo '<div id="cardload" class="card"><div class="card-block"><li class="media">';
				echo '<div class="comment">';
					echo '<div class="media-body">';
						echo '<div class="col-sm-10">';
							echo '<a href="/user/'.$row["author"].'"><strong><font color="e30a15">'.$row["author"].' </font></strong></a>';
						echo '<span class="text-muted">';
							echo '<small class="text-muted"> '.time_elapsed_string('@'.$row["date"]).'</small>';
						echo '</span>';
						//echo '<span class="text-muted pull-right">';
						//	echo '<small class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove</small>';
						//echo '</span>';
						echo '<p>';
							echo $newcomment;
						echo '</p>';
							
						echo '</div><div class="col-sm-2">';
						echo '<a href="/user/'.$row["author"].'"><img src="https://www.gravatar.com/avatar/'. md5(strtolower(trim($commentdataavatar_res))) .'?d='.urlencode("https://www.five-multiplayer.net/assets/v1/images/profile/picback.png").'&s=340" class="img-fluid" style="max-height:340px;" alt="'.$viewuser.'"s avatar"></a>';
					echo '</div></div>';
					echo '<div class="clearfix"></div>';
				echo '</div>';
			echo '</li></div></div><div id="commentmsg"></div>';
		}
	}
?>

</div>