<?php

//The Autoloader
require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/misc/twitter/autoload.php");

//Time converter script.
require_once($_SERVER['DOCUMENT_ROOT'] . "/timeconverter.php");

//Load the class
use Abraham\TwitterOAuth\TwitterOAuth;

//Create oauth connection.
$connection = new TwitterOAuth('UnL0JS5RoxOLTAhHfO9DytjXy', 'Kc8nxJghVOn6DHOuxZLhvQ7UNRiGDW6ks4E6lvBf9zkM0kQhP4', '321439929-OzrOegMpqYQFp6JrURvh204XR9u8rENDp3FUbiK3', 'fvjlxnvPxCCrfSMBXLMgPBnJ0DynJoKDMY34jfQbTZ1u8');

//Verify the credentials
$content = $connection->get("account/verify_credentials");

//Get tweets based on name - take only 4
$statuses = $connection->get("statuses/user_timeline", ["screen_name" => "FiveMultiplayer", "count" => 5]);
?>

<div class="index-twitter">
    <div class="tweets">
    <?php
	//Do the foreach stuff here.
    foreach ($statuses as $status){
		$profileimage = preg_replace("/^http:/i", "https:", $status->user->profile_image_url);
		
        echo '<br><a href="//twitter.com/FiveMultiplayer/status/'.$status->id.'" target="_blank" class="tweet-link">';
        echo '<div class="media tweet">';
        echo '<div class="media-left tweet-pic">';
        echo '<img src="'.$profileimage.'"/>';
        echo '</div>';
        echo '<div class="media-body tweet-body">';
        echo '<span class="tweet-info">'.$status->user->name.' - '.timeSince($status->created_at).'</span>';
        echo '<br/>';
        echo $status->text;
        echo '</div>';
        echo '</div>';
        echo '</a>';
    }
    ?>
    </div>
</div>