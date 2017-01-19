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
				<h3>Features 0.2a</h3>
				<div class="row">
					<div class="card">
						<div class="row">
							<div class="col-md-10">
								<div class="card-block">
									<h4 class="card-title">Application Programming Interface (API)</h4>
									<h6 class="card-subtitle text-muted"><b>Note:</b> The API is written in C++.<br><br>This will allow you to program plugins for FiveMP.<br>You'll be able to add: functions, new languages and new callbacks.</h6>
								</div>
							</div>
							<div class="col-md-2">
								<img src="/assets/v1/images/features/api.png" class="img-fluid" style="max-height:250px;" alt="alt">
							</div>
						</div>
					</div>
					<div class="card">
						<div class="row">
							<div class="col-md-10">
								<div class="card-block">
									<h4 class="card-title">Improved Masterlist</h4>
									<h6 class="card-subtitle text-muted"><b>Note:</b> This has already been implemented in 0.1b for testing purposes.<br><br>It'll come with improved features, such as: player information, server information and version information.<br>Server IDs are also now permanent, this means that you'll no longer have to reclaim your server each time you restart it.
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<br>
				<br>
		</div>
	</div>
</div>

<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/v1/footer.php");
?>
