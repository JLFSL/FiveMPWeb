<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/session.php");
	$_SESSION["page"] = "index";
	
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/global.php");
	
	
	$articles = $pdo->prepare('SELECT * FROM blogposts ORDER BY date DESC');
	$articles->execute();
	$articles_a = $articles->rowCount();
	
	while ($row = $articles->fetch()) {
		echo '
		<br>
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<h1><a class="deco-none" href="/article/' . $row["id"] . '/' . $row["title"] . '"><b>' . $row["title"] . '</b></a></h1>
				<p>Posted ' . time_elapsed_string('@'.$row["date"]) . ' by <a class="deco-none" href="/user/' . $row["author"] . '">' . $row["author"] . '</a></p>
				<div class="page">
					<section id="content">
						<img class="img-fluid" src="' . $row["image"] . '"><br>
					</section>
				</div>
				<br>
				<a href="/article/' . $row["id"] . '/' . $row["title"] . '"><button type="button" class="btn btn-danger btn-sm pull-xs-right red-div">Read More</button></a>
			</div>
		</div>
		<br>
		<br>';
	}
?>
			
<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/v1/footer.php");
?>
