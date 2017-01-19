<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/session.php");
	
	$_SESSION["page"] = "staff";
	
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/global.php");
	
	$staff3 = $pdo->prepare('SELECT * FROM users WHERE admin = ?');
	$staff3->execute([3]);
	
	$staff2 = $pdo->prepare('SELECT * FROM users WHERE admin = ?');
	$staff2->execute([2]);
	
	$staff1 = $pdo->prepare('SELECT * FROM users WHERE admin = ?');
	$staff1->execute([1]);
?>
		<?php
			echo '<h3>Management</h3><div class="row">';
		
				while ($row = $staff3->fetch()) {
				$tempauthor = $row["username"];
				$tempemail = $row["email"];
				
				$temprank = $row["rank"];
				$tempavatar = $row["avatar"];
				$tempbio = $row["bio"];
				
				$temptwitter = $row["twitter"];
				$tempsteam = $row["steam"];
				$tempyoutube = $row["youtube"];
				$tempvk = $row["vk"];
				
				echo '
						<div class="card">
							<div class="row">
								<div class="col-md-10">
									<div class="card-block">
										<h4 class="card-title"><a href="/user/'.$tempauthor.'">'.$tempauthor.'</a></h4>
										<h6 class="card-subtitle text-muted">'.$temprank.'</h6>
									</div>
								</div>
								<div class="col-md-2">
									<img src="https://www.gravatar.com/avatar/'.md5(strtolower(trim($tempemail))).'?d='. urlencode("https://www.five-multiplayer.net/assets/v1/images/profile/picback.png") .'&s=125" class="img-fluid" style="max-height:125px;" alt="'.$tempauthor.'&rsquo;s avatar">
								</div>
							</div>
						</div>
					';
				}
			
			echo '</div><br><br>';
			
			echo '<h3>Development</h3><div class="row">';
		
				while ($row = $staff2->fetch()) {
				$tempauthor = $row["username"];
				$tempemail = $row["email"];
				
				$temprank = $row["rank"];
				$tempavatar = $row["avatar"];
				$tempbio = $row["bio"];
				
				$temptwitter = $row["twitter"];
				$tempsteam = $row["steam"];
				$tempyoutube = $row["youtube"];
				$tempvk = $row["vk"];
				
				echo '
						<div class="card">
							<div class="row">
								<div class="col-md-10">
									<div class="card-block">
										<h4 class="card-title"><a href="/user/'.$tempauthor.'">'.$tempauthor.'</a></h4>
										<h6 class="card-subtitle text-muted">'.$temprank.'</h6>
									</div>
								</div>
								<div class="col-md-2">
									<img src="https://www.gravatar.com/avatar/'.md5(strtolower(trim($tempemail))).'?d='. urlencode("https://www.five-multiplayer.net/assets/v1/images/profile/picback.png") .'&s=125" class="img-fluid" style="max-height:125px;" alt="'.$tempauthor.'&rsquo;s avatar">
								</div>
							</div>
						</div>
					';
				}
			
			echo '</div><br><br>';
			
			echo '<h3>Miscellaneous</h3><div class="row">';
		
				while ($row = $staff1->fetch()) {
				$tempauthor = $row["username"];
				$tempemail = $row["email"];
				
				$temprank = $row["rank"];
				$tempavatar = $row["avatar"];
				$tempbio = $row["bio"];
				
				$temptwitter = $row["twitter"];
				$tempsteam = $row["steam"];
				$tempyoutube = $row["youtube"];
				$tempvk = $row["vk"];
				
				echo '
						<div class="card">
							<div class="row">
								<div class="col-md-10">
									<div class="card-block">
										<h4 class="card-title"><a href="/user/'.$tempauthor.'">'.$tempauthor.'</a></h4>
										<h6 class="card-subtitle text-muted">'.$temprank.'</h6>
									</div>
								</div>
								<div class="col-md-2">
									<img src="https://www.gravatar.com/avatar/'.md5(strtolower(trim($tempemail))).'?d='. urlencode("https://www.five-multiplayer.net/assets/v1/images/profile/picback.png") .'&s=125" class="img-fluid" style="max-height:125px;" alt="'.$tempauthor.'&rsquo;s avatar">
								</div>
							</div>
						</div>
					';
				}
			
			echo '</div>';
			?>
	</div>
</div>
</div>

<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/v1/footer.php");
?>
