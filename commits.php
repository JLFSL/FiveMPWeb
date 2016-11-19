<?php
	require_once 'include/lib/Github/Autoloader.php';
    Github_Autoloader::register();

	$github = new Github_Client();
	
	$user = $github->getUserApi()->show('FiveMP');
	echo $user;
	/*$github->authenticate("FiveMP", $secret, $method);
	
	$commits = $github->getCommitApi()->getBranchCommits('JLFSL', 'FiveMP', 'dev');
	echo $commits;
	
	$github->deAuthenticate();*/
?>