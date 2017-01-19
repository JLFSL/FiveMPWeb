<?php
	include("inc/app.php");
	require_once("inc/menu.php");

	$changes = $pdo->prepare("SELECT * FROM changelog ORDER BY `date` DESC");
	$changes->execute();

	function showTypeFormatted($type) {
		switch ($type) {
			case 'Added':
				return 'table-success';
			case 'Changed':
				return 'table-warning';
			case 'Fixed':
				return 'table-info';
		}
	}
	
	function time_elapsed_string($datetime, $full = false) {
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
	
	$count = 0;
?>

<div class="container">
	<div class="content">
		<p>Below shows every change since the last public version. We try to keep this list updated but excuse us if there are any missing changes!</p>

		<table class="table table-hover table-sm">
			<thead>
				<tr>
					<th>#</th>
					<th>Module</th>
					<th>Type</th>
					<th>Description</th>
					<th>Version</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
				<?php
					while ($change = $changes->fetch()) {
						echo "<tr class=" . showTypeFormatted($change["change"]) . ">";
							echo "<td>" . $count . "</td>";
							echo "<td>" . $change["module"] . "</td>";
							echo "<td>" . $change["change"] . "</td>";
							echo "<td>" . $change["description"] . "</td>";
							echo "<td>" . $change["version"] . "</td>";
							echo "<td>" . time_elapsed_string('@'.$change["date"]) . "</td>";
						echo "</tr>";
						$count++;
					}
				?>
			</tbody>
		</table>
		<br>
	</div>
</div>

<?php
	require_once("inc/footer.php");
?>