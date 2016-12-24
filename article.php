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
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<h1><b>' . $row["title"] . '</b></h1>
				<p>Posted ' . time_elapsed_string('@'.$row["date"]) . ' by <a class="deco-none" href="/user/' . $row["author"] . '">' . $row["author"] . '</a></p>
				<div class="page">
					<section id="content">
						<img class="img-fluid" src="' . $row["image"] . '"><br>
						<p>' . $row["text"] . '</p>
						<br>
					</section>
				</div>
			</div>
		</div>
		<br>
		<br>';
	}
?>
	

<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/v1/footer.php");
?>
