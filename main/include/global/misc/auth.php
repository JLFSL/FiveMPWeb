<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/session.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/db.php");

	ini_set('display_errors', true);
			ini_set('display_startup_errors', true);
			error_reporting(true);

	if($_POST["auth-type"] == "auth-login") { // Handles login authentication.
		$success = false;
		$error = "";

		$username = htmlspecialchars($_POST["auth-username"], ENT_QUOTES, "UTF-8");
		$password = hash('whirlpool', htmlspecialchars($_POST["auth-password"]));

		if($username != "" && $password != "") {
			$loginuser = $pdo->prepare('SELECT * FROM users WHERE username = ?');
			$loginuser->execute([$username]);
			
			while ($row = $loginuser->fetch()) {
				if($row['password'] == $password) {
					$success = true;
					
					$_SESSION["auth_id"] = $row['id'];
					$_SESSION["auth_username"] = $row['username'];
					$_SESSION["auth_admin"] = $row['admin'];
					$_SESSION["auth_logged"] = true;
					$_SESSION["auth_last"] = $row['lastlogin'];
					
					$updatelastlogin = $pdo->prepare("UPDATE users SET lastlogin = :lastlog WHERE id = :authid");                                
					$updatelastlogin->execute(array(':lastlog' => time(), ':authid' => $row['id']));
				}
			}
			if(!$succes) 
				$error = "An invalid username or password was filled in";
		} else {
			$error = "No username or password was filled in!";
		}

		if($success == true) {
			$output = json_encode(array('type'=>'success', 'message' => 'Successfully logged in!'));
		} else {
			$output = json_encode(array('type'=>'error', 'message' => 'Error: ' . $error));
		}

		die($output);
	}
	
	if($_POST["auth-type"] == "auth-register") { // Handles register authentication.
		$success = false;
		$error = "";

		$username = htmlspecialchars($_POST["auth-username"], ENT_QUOTES, "UTF-8");
		$email = htmlspecialchars($_POST["auth-email"]);
		$password = hash('whirlpool', htmlspecialchars($_POST["auth-password"]));
		$password2 = hash('whirlpool', htmlspecialchars($_POST["auth-password2"]));

		if($username != "" && $email != "" && $password != "" && $password2 != "") {
			if($password == $password2) {
				$checkusername_taken = $pdo->prepare('SELECT * FROM users WHERE username = ?');
				$checkusername_taken->execute([$username]);
				$checkusername_taken_a = $checkusername_taken->rowCount();
				
				$checkemail_taken = $pdo->prepare('SELECT * FROM users WHERE email = ?');
				$checkemail_taken->execute([$email]);
				$checkemail_taken_a = $checkemail_taken->rowCount();
				
				if($checkusername_taken_a == 0) {
					if($checkemail_taken_a == 0) {
						$register_user = $pdo->prepare("INSERT INTO users(username, email, password, lastlogin) VALUES(:urname, :urmail, :urpass, :urtime)");
						$register_user->execute(array("urname" => $username, "urmail" => $email, "urpass" => $password, "urtime" => time()));
						
						$login_register = $pdo->prepare('SELECT * FROM users WHERE username = ?');
						$login_register->execute([$username]);
			
						while ($row = $login_register->fetch()) {
							$_SESSION["auth_id"] = $row['id'];
							$_SESSION["auth_username"] = $row['username'];
							$_SESSION["auth_admin"] = $row['admin'];
							$_SESSION["auth_logged"] = true;
							$_SESSION["auth_last"] = $row['lastlogin'];
						}
						
						$success = true;
					} else {
						$error = "This email has already been used for another account.";
					}
				} else {
					$error = "This username is already taken.";
				}
			} else {
				$error = "Passwords do not match!";
			}
		} else {
			$error = "No username or password was filled in!";
		}

		if($success == true) {
			$output = json_encode(array('type'=>'success', 'message' => 'Successfully logged in!'));
		} else {
			$output = json_encode(array('type'=>'error', 'message' => 'Error: ' . $error));
		}

		die($output);
	}

	if($_POST["auth-type"] == "auth-logout") { // Handles logout request
		$success = false;
		$error = "";

		if(isset($_SESSION["auth_logged"]) && $_SESSION["auth_logged"] == true) {
		unset($_SESSION["auth_id"]);
		unset($_SESSION["auth_username"]);
		unset($_SESSION["auth_admin"]);
		unset($_SESSION["auth_logged"]);
		unset($_SESSION["auth_last"]);
		$success = true;
		} else {
			$error = "You were either not logged in or there is an issue within your PHP sessions.";
		}

		if($success == true) {
			$output = json_encode(array('type'=>'success', 'message' => 'Successfully logged out!'));
		} else {
			$output = json_encode(array('type'=>'error', 'message' => 'Error: ' . $error));
		}

		die($output);
	}

	if($_POST["auth-type"] == "auth-pref") { // Handles preference update
		$success = false;
		$error = "";

		$email = htmlspecialchars($_POST["auth-pref-email"]);
		$password = hash('whirlpool', htmlspecialchars($_POST["auth-pref-password"]));
		$password2 = hash('whirlpool', htmlspecialchars($_POST["auth-pref-password2"]));

		if($email != "" && $password != "" && $password2 != "") {
			if($password == $password2) {
				$checkemail_taken = $pdo->prepare('SELECT * FROM users WHERE email = ?');
				$checkemail_taken->execute([$email]);
				$checkemail_taken_a = $checkemail_taken->rowCount();
				
					if($checkemail_taken_a == 0) {
						/*$register_user = $pdo->prepare("INSERT INTO users(username, email, password, lastlogin) VALUES(:urname, :urmail, :urpass, :urtime)");
						$register_user->execute(array("urname" => $username, "urmail" => $email, "urpass" => $password, "urtime" => time()));
						
						$login_register = $pdo->prepare('SELECT * FROM users WHERE username = ?');
						$login_register->execute([$username]);
			
						while ($row = $login_register->fetch()) {
							$_SESSION["auth_id"] = $row['id'];
							$_SESSION["auth_username"] = $row['username'];
							$_SESSION["auth_admin"] = $row['admin'];
							$_SESSION["auth_logged"] = true;
							$_SESSION["auth_last"] = $row['lastlogin'];
						}
						*/
						$success = true;
					} else {
						$error = "This email has already been used for another account.";
					}
			} else {
				$error = "Passwords do not match!";
			}
		} else {
			$error = "No email or password was filled in!";
		}

		if($success == true) {
			$output = json_encode(array('type'=>'success', 'message' => 'Successfully logged in!'));
		} else {
			$output = json_encode(array('type'=>'error', 'message' => 'Error: ' . $error));
		}

		die($output);
	}
	
	if($_POST["auth-type"] == "auth-claimserver") { // Handles serverclaim request
		if(isset($_SESSION["auth_logged"])) {
			$serverid = $_POST["auth-claimserver-id"];
			$serverusername = $_SESSION["auth_username"];
			
			$url = 'http://176.31.142.113:7001/v2/servers';
			$array = file_get_contents($url);
			$data = json_decode($array);
			
			$success = false;
			
			$name = "Claiming Server " . $serverid . " by " . $serverusername;
			
			$error = "";
			
			foreach($data->servers as $json){
				if($json->name == $name) {
					$check_claimed = $pdo->prepare('SELECT * FROM claimedservers WHERE serverid = ?');
					$check_claimed->execute([$serverid]);
					$check_claimed_a = $check_claimed->rowCount();
					
					if($check_claimed_a == 0) {
						$register_claim = $pdo->prepare("INSERT INTO claimedservers(serverid, username) VALUES(:sid, :uname)");
						$register_claim->execute(array("sid" => $serverid, "uname" => $_POST["auth-claimserver-username"]));
						
						$success = true;
					} else {
						$error = "This server has already been claimed by another user.";
						$success = false;
					}
				} else {
					$error = $json->name . " Name not set, set the name to '" . $name . "' without the quotes.";
					$success = false;
				}
			}

			if($success == true) {
				$output = json_encode(array('type'=>'success', 'message' => 'Successfully claimed ID '.$serverid));
			} else {
				$output = json_encode(array('type'=>'error', 'message' => 'Error: ' . $error));
			}

			die($output);
		} else {
			$error = "Only signed in users can access this feature.";
			$output = json_encode(array('type'=>'error', 'message' => 'Error: ' . $error));
			die($output);
		}
	}
	if($_POST["auth-type"] == "auth-postcomment") { // Handles profile comment posting
		if(isset($_SESSION["auth_logged"])) {
			$commentmessage = htmlspecialchars($_POST["auth-postcomment-message"]);
			$commentauthor = $_SESSION["auth_username"];
			$commentreceiver = $_POST["auth-postcomment-receiver"];
			
			$success = false;
			
			$error = "";
			
			$comment_post = $pdo->prepare("INSERT INTO users_comments(receiver, author, message, date) VALUES(:rec, :aut, :mes, :dat)");
			$comment_post->execute(array("rec" => $commentreceiver, "aut" => $commentauthor, "mes" => $commentmessage, "dat" => time()));
			
			$success = true;
		
			if($success == true) {
				$output = json_encode(array('type'=>'success', 'message' => 'Successfully posted comment'));
			} else {
				$output = json_encode(array('type'=>'error', 'message' => 'Error: ' . $error));
			}

			die($output);
		} else {
			$error = "Only signed in users can access this feature.";
			$output = json_encode(array('type'=>'error', 'message' => 'Error: ' . $error));
			die($output);
		}
	}
	if($_POST["auth-type"] == "auth-profile") { // Handles profile updates
		if(isset($_SESSION["auth_logged"])) {
			$success = false;
			$error = "";
			
			$bio = htmlspecialchars($_POST["auth-profile-bio"]);
			$title = htmlspecialchars($_POST["auth-profile-title"]);
			$twitter = htmlspecialchars($_POST["auth-profile-twitter"]);
			$steam = htmlspecialchars($_POST["auth-profile-steam"]);
			$youtube = htmlspecialchars($_POST["auth-profile-youtube"]);
			$vk = htmlspecialchars($_POST["auth-profile-vk"]);
			
			$reddit = htmlspecialchars($_POST["auth-profile-reddit"]);
			$twitch = htmlspecialchars($_POST["auth-profile-twitch"]);
			$github = htmlspecialchars($_POST["auth-profile-github"]);

			if($bio != "") {
				$updateprofile = $pdo->prepare("UPDATE users SET bio = :pbio, twitter = :ptwitter, steam = :psteam, youtube = :pyoutube, vk = :pvk, reddit = :preddit, twitch = :ptwitch, github = :pgithub WHERE username = :authid");                                
				$updateprofile->execute(array(
				':pbio' => $bio,
				':ptwitter' => $twitter,
				':psteam' => $steam,
				':pyoutube' => $youtube,
				':pvk' => $vk,
				':preddit' => $reddit,
				':ptwitch' => $twitch,
				':pgithub' => $github,
				':authid' => $_SESSION["auth_username"]));
				
				$success = true;
			} else {
				$error = "No biography filled in!";
			}

			if($success == true) {
				$output = json_encode(array('type'=>'success', 'message' => 'Successfully updated profile!'));
			} else {
				$output = json_encode(array('type'=>'error', 'message' => 'Error: ' . $error));
			}

			die($output);
		} else {
			$error = "Only signed in users can access this feature.";
			$output = json_encode(array('type'=>'error', 'message' => 'Error: ' . $error));
			die($output);
		}
	}
	if($_POST["auth-type"] == "auth-changelog") { // Handles changelog insertion
		if(isset($_SESSION["auth_logged"])) {
			if($_SESSION["auth_admin"] == true) {
				$success = false;
				$error = "";
				
				$module = htmlspecialchars($_POST["auth-changelog-module"]);
				$version = htmlspecialchars($_POST["auth-changelog-version"]);
				$change = htmlspecialchars($_POST["auth-changelog-type"]);
				$description = htmlspecialchars($_POST["auth-changelog-description"]);
				
				if($module != "" && $version != "" && $change != "" && $description != "") {	
					$changelog_add = $pdo->prepare("INSERT INTO changelog(module, version, `change`, description, date) VALUES(?, ?, ?, ?, ?)");
					$changelog_add->execute(array($module, $version, $change, $description, time()));
					
					$success = true;
				} else {
					$error = "One of the values was not filled in!";
				}

				if($success == true) {
					$output = json_encode(array('type'=>'success', 'message' => 'Successfully added changelog item!'));
				} else {
					$output = json_encode(array('type'=>'error', 'message' => 'Error: ' . $error));
				}

				die($output);
			}
		}
	}
	if($_POST["auth-type"] == "auth-blog") { // Handles blogpost insertion
		if(isset($_SESSION["auth_logged"])) {
			if($_SESSION["auth_admin"] == true) {
				$success = false;
				$error = "";
				
				$text = $_POST["auth-blog-text"];
				$title = htmlspecialchars($_POST["auth-blog-title"]);
				$image = htmlspecialchars($_POST["auth-blog-image"]);
				
				if($text != "" && $title != "" && $image != "") {	
					$blogpost_add = $pdo->prepare("INSERT INTO blogposts(author, title, text, image, date, status) VALUES(?, ?, ?, ?, ?, ?)");
					$blogpost_add->execute(array($_SESSION["auth_username"], $title, $text, $image, time(), 1));
					
					$success = true;
				} else {
					$error = "One of the values was not filled in!";
				}

				if($success == true) {
					$output = json_encode(array('type'=>'success', 'message' => 'Successfully added blogpost!'));
				} else {
					$output = json_encode(array('type'=>'error', 'message' => 'Error: ' . $error));
				}

				die($output);
			}
		}
	}
	if($_POST["auth-type"] == "auth-postblogcomment") { // Handles blog comment posting
		if(isset($_SESSION["auth_logged"])) {
			$commentmessage = htmlspecialchars($_POST["auth-postblogcomment-message"]);
			$commentauthor = $_SESSION["auth_username"];
			$commentreceiver = $_POST["auth-postblogcomment-receiver"];
			
			$success = false;
			
			$error = "";
			
			$comment_post = $pdo->prepare("INSERT INTO blogcomments(blogid, author, text, date) VALUES(:rec, :aut, :mes, :dat)");
			$comment_post->execute(array("rec" => $commentreceiver, "aut" => $commentauthor, "mes" => $commentmessage, "dat" => time()));
			
			$success = true;
		
			if($success == true) {
				$output = json_encode(array('type'=>'success', 'message' => 'Successfully posted comment'));
			} else {
				$output = json_encode(array('type'=>'error', 'message' => 'Error: ' . $error));
			}

			die($output);
		} else {
			$error = "Only signed in users can access this feature.";
			$output = json_encode(array('type'=>'error', 'message' => 'Error: ' . $error));
			die($output);
		}
	}