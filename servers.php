<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/session.php");
	$_SESSION["page"] = "servers";
	
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/global.php");
?>
	<script>
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
	
	If the serverlist is empty then it means the masterserver is offline.
	
	<?php
		$url = 'http://176.31.142.113:7000/servers';
		$array = file_get_contents($url);
		$count = 0;
		$count2 = 0;
		
		$data = json_decode($array);

		echo 
			"<table class='hidden-sm-up table table-sm table-hover'><thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Players (max)</th>
				</tr></thead><tbody>";
				
		foreach($data as $json){
			echo 
			"<tr>
				<td	scope='row'>$count</td>
				<td>".strip_tags($json->name)."</td>
				<td>$json->players ($json->maxclients)</td>
			</tr>";
			$count++;
		}
		echo "</tbody></table>";

		echo 
			"<table class='hidden-sm-down table table-sm table-hover'><thead>
				<tr>
					<th>#</th>
					<th>IP Address (Port)</th>
					<th>Name</th>
					<th>Players (max)</th>
					<th>Version</th>
					<th>Author</th>
				</tr></thead><tbody>";
				
		foreach($data as $json){
			$serverauthor = $pdo->prepare('SELECT * FROM claimedservers WHERE serverid = ?');
			$serverauthor->execute([$json->id]);
			$serverauthor_a = $serverauthor->rowCount();
			
			while ($row = $serverauthor->fetch()) {
				$tempauthor = $row["username"];
			}
				
			echo "<tr>";
			echo "	<td scope='row'>$count2</td>";
			echo "	<td>$json->ip ($json->port)</td>";
			echo "	<td>".strip_tags($json->name)."</td>";
			echo "	<td>$json->players ($json->maxclients)</td>";
			echo "	<td><a href='".$json->version->link."'>".$json->version->self."</a></td>";
			if($serverauthor_a != 0) {
				echo "	<td><a href='user/".$tempauthor."'>".$tempauthor."</a></td>";
			} else {
				echo "	<td><a href='#' data-server-id='".$json->id."' data-toggle='modal' data-yourParameter='test1235' data-target='#claimserver'>Claim</a></td>";
			}
			echo "</tr>";
			$count2++;
		}
		echo "</tbody></table>";
	?>
					
<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/v1/footer.php");
?>
