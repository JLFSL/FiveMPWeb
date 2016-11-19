<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/session.php");
	$_SESSION["page"] = "download";
	
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/global.php");
?>

<div class="alert alert-danger hidden-sm-up" role="alert">
	<? echo lang("PAGE_NOT_OPTIMIZED"); ?>
</div>

<strong><h2><? echo lang("DOWNLOADS"); ?></h2></strong>

<table class='table'>
	<thead>
		<tr>
			<th><? echo lang("VERSION"); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
			$listnames = array();
			$stmt = $pdo->query("SELECT list_name FROM api ORDER BY list_name DESC;");
			foreach ($stmt as $row) {
				if (!(in_array($row["list_name"], $listnames))) { // Prevents multiple lists per list_name (shitty way to do it, but only way I got it working)
					array_push($listnames, $row["list_name"]); // commet this line if you don't know what I'm talking about
					echo "<tr><td id=\"function-list\"><span class=\"api-clickable\">".$row["list_name"]."</span>\n";
					echo "	<ul class=\"api-sub-list\"><table class='table'><thead><tr><th>".lang("VERSION")."</th><th>".lang("DOWNLOAD")."</th><th>".lang("CHANGELOG")."</th></tr></thead><tbody>\n";
					
					$stmt = $pdo->prepare("SELECT * FROM api WHERE list_name = ? ORDER BY id DESC;");
					$stmt->execute([$row["list_name"]]);
					
					
					foreach ($stmt as $row) {
						if($row["sublist_code"] == "#") { 
							echo "<tr>
							<td id=\"function-sublist\">".$row["list_name"] . " " . $row["sublist_name"]."
								<td id=\"function-sublist\">
									N/A
								</td>
								<td id=\"function-sublist\">
								<span class=\"api-clickable\">
									<a href='#'>".lang("CHANGELOG")."</a>
								</span>\n
								<div class=\"api-description\">
									<hr>\n
									<p>".$row["sublist_desc"]."</p>\n
									<hr>\n
								</div>
							</td>\n";
						} else {
							echo "<tr>
							<td id=\"function-sublist\">".$row["list_name"] . " " . $row["sublist_name"]."
								<td id=\"function-sublist\">
									<span class=\"api-clickable\">
										<a href='#'>".lang("DOWNLOAD")."</a>
									</span>
									<div class=\"api-description\">
										<hr>\n
										<h4>".lang("DOWNLOADS")."</h4>
										<p><a href=".$row["sublist_code"].">".lang("OFFICIAL_MIRROR")." #1</a></p>\n\n
										
										<h4>".lang("INS_INSTRUC")."</h4>
										TBA
										<hr>\n
									</div>
								</td>
								<td id=\"function-sublist\">
								<span class=\"api-clickable\">
									<a href='#'>".lang("CHANGELOG")."</a>
								</span>\n
								<div class=\"api-description\">
									<hr>\n
									<p>".$row["sublist_desc"]."</p>\n
									<hr>\n
								</div>
							</td>\n";
						}
					}
					echo "</tbody></table></ul>";
					echo "</td>\n";
					echo "</tr>\n";
				}
			}
		?>
	</tbody>
</table>

<script>
	$('td#function-list').click(function() {
		$(this).children('ul').slideToggle();
	});

	// change to td to fix
	$("td#function-sublist").click(function(event) {
		event.stopPropagation();
	});

	// change to td to fix
	$('td#function-sublist').click(function() {
		$(this).children('div.api-description').slideToggle();
	});
</script>

<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/v1/footer.php");
?>
