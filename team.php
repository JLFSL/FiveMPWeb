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
				$temprank = $row["rank"];
				$tempavatar = $row["avatar"];
				$tempbio = $row["bio"];
				
				$temptwitter = $row["twitter"];
				$tempsteam = $row["steam"];
				$tempyoutube = $row["youtube"];
				$tempvk = $row["vk"];
				
				// tags separated by vertical bar
				$strip_tags = "p";
				$clean_html = preg_replace("#<\s*\/?(".$strip_tags.")\s*[^>]*?>#im", '', htmlspecialchars_decode($tempbio));
				
				echo "
					<div class='col-sm-3'>
						<div class='card'>
							<div class='card-block'>
								<h4 class='card-title'><a href='/user/".$tempauthor."'>$tempauthor</a></h4>
								<h6 class='card-subtitle text-muted'>$temprank</h6>
							</div>
							<center><img src='$tempavatar' class='img-fluid' style='max-height:340px;' alt='$viewuser's avatar'></center>
							<div class='card-footer text-muted'>";
								if(!empty($tempsteam)) {
									echo '<a href="//steamcommunity.com/profiles/'.$tempsteam.'"><img src="/assets/v1/images/social/steam.png" class="img-responsive" style="max-height:32px;"></a>&nbsp;';
								}
								if(!empty($temptwitter)) {
									echo '<a href="//twitter.com/'.$temptwitter.'"><img src="/assets/v1/images/social/twitter.png" class="img-responsive" style="max-height:32px;"></a>&nbsp;';
								}
								if(!empty($tempyoutube)) {
									echo '<a href="//youtube.com/channel/'.$tempyoutube.'"><img src="/assets/v1/images/social/youtube.png" class="img-responsive float-xs-right" style="max-height:32px;"></a>&nbsp;';
								}
								if(!empty($tempvk)) {
									echo '<a href="//vk.com/'.$tempvk.'"><img src="/assets/v1/images/social/vk.png" class="img-responsive float-xs-right" style="max-height:32px;"></a>';
								}  
							echo "
							</div>
							<div class='card-block'>
									<p class='card-text'>
										".$clean_html."
									</p>
							</div>
							
						</div>
					</div>";
				}
			
			echo '</div><br><br>';
			
			echo '<h3>Development</h3><div class="row">';
		
				while ($row = $staff2->fetch()) {
				$tempauthor = $row["username"];
				$temprank = $row["rank"];
				$tempavatar = $row["avatar"];
				$tempbio = $row["bio"];
				
				$temptwitter = $row["twitter"];
				$tempsteam = $row["steam"];
				$tempyoutube = $row["youtube"];
				$tempvk = $row["vk"];
				
				// tags separated by vertical bar
				$strip_tags = "p";
				$clean_html = preg_replace("#<\s*\/?(".$strip_tags.")\s*[^>]*?>#im", '', htmlspecialchars_decode($tempbio));
				
				echo "
					<div class='col-sm-3'>
						<div class='card'>
							<div class='card-block'>
								<h4 class='card-title'><a href='/user/".$tempauthor."'>$tempauthor</a></h4>
								<h6 class='card-subtitle text-muted'>$temprank</h6>
							</div>
							<center><img src='$tempavatar' class='img-fluid' style='max-height:340px;' alt='$viewuser's avatar'></center>
							<div class='card-footer text-muted'>";
								if(!empty($tempsteam)) {
									echo '<a href="//steamcommunity.com/profiles/'.$tempsteam.'"><img src="/assets/v1/images/social/steam.png" class="img-responsive" style="max-height:32px;"></a>&nbsp;';
								}
								if(!empty($temptwitter)) {
									echo '<a href="//twitter.com/'.$temptwitter.'"><img src="/assets/v1/images/social/twitter.png" class="img-responsive" style="max-height:32px;"></a>&nbsp;';
								}
								if(!empty($tempyoutube)) {
									echo '<a href="//youtube.com/channel/'.$tempyoutube.'"><img src="/assets/v1/images/social/youtube.png" class="img-responsive float-xs-right" style="max-height:32px;"></a>&nbsp;';
								}
								if(!empty($tempvk)) {
									echo '<a href="//vk.com/'.$tempvk.'"><img src="/assets/v1/images/social/vk.png" class="img-responsive float-xs-right" style="max-height:32px;"></a>';
								}  
							echo "
							</div>
							<div class='card-block'>
									<p class='card-text'>
										".$clean_html."
									</p>
							</div>
							
						</div>
					</div>";
				}
			
			echo '</div><br><br>';
			
			echo '<h3>Miscellaneous</h3><div class="row">';
		
				while ($row = $staff1->fetch()) {
				$tempauthor = $row["username"];
				$temprank = $row["rank"];
				$tempavatar = $row["avatar"];
				$tempbio = $row["bio"];
				
				$temptwitter = $row["twitter"];
				$tempsteam = $row["steam"];
				$tempyoutube = $row["youtube"];
				$tempvk = $row["vk"];
				
				// tags separated by vertical bar
				$strip_tags = "p";
				$clean_html = preg_replace("#<\s*\/?(".$strip_tags.")\s*[^>]*?>#im", '', htmlspecialchars_decode($tempbio));
				
				echo "
					<div class='col-sm-3'>
						<div class='card'>
							<div class='card-block'>
								<h4 class='card-title'><a href='/user/".$tempauthor."'>$tempauthor</a></h4>
								<h6 class='card-subtitle text-muted'>$temprank</h6>
							</div>
							<center><img src='$tempavatar' class='img-fluid' style='max-height:340px;' alt='$viewuser's avatar'></center>
							<div class='card-footer text-muted'>";
								if(!empty($tempsteam)) {
									echo '<a href="//steamcommunity.com/profiles/'.$tempsteam.'"><img src="/assets/v1/images/social/steam.png" class="img-responsive" style="max-height:32px;"></a>&nbsp;';
								}
								if(!empty($temptwitter)) {
									echo '<a href="//twitter.com/'.$temptwitter.'"><img src="/assets/v1/images/social/twitter.png" class="img-responsive" style="max-height:32px;"></a>&nbsp;';
								}
								if(!empty($tempyoutube)) {
									echo '<a href="//youtube.com/channel/'.$tempyoutube.'"><img src="/assets/v1/images/social/youtube.png" class="img-responsive float-xs-right" style="max-height:32px;"></a>&nbsp;';
								}
								if(!empty($tempvk)) {
									echo '<a href="//vk.com/'.$tempvk.'"><img src="/assets/v1/images/social/vk.png" class="img-responsive float-xs-right" style="max-height:32px;"></a>';
								}  
							echo "
							</div>
							<div class='card-block'>
									<p class='card-text'>
										".$clean_html."
									</p>
							</div>
							
						</div>
					</div>";
				}
			
			echo '</div>';
			?>
	</div>
</div>
</div>

<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/v1/footer.php");
?>
