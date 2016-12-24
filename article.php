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
			</div>
		</div>';
	}
?>
	

<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/v1/footer.php");
?>
