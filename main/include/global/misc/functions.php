<?php
	function getCommentAmount($user)
	{
		$commentdata = $pdo->prepare('SELECT * FROM users_comments WHERE receiver = :rec');
		$commentdata->execute(array("rec" => $user));
		$commentdata_a = $commentdata->rowCount();
	
		return $commentdata_a;
	}

	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
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
	
	function tagExtract($str ,$outputType = null) 
	{ 

		/** 
		* @var hashtagsArray[] 
		* An array of string objects for storing hashtags inside it. 
		*/ 
		$hashtagsArray = array(); 

		/** 
		*
		* @var strArray[] 
		* An array of string objects that will save the words of the string argument.  
		*
		*/  
		$strArray = explode(" ",$str);

		/** 
		*
		* @var string $pattern
		* regular expression pattern for notes  
		* don't scare! it works! even with unicode characters!
		*/  
		$pattern = '%(\A@(\w|(\p{L}\p{M}?)|-)+\b)|((?<=\s)@(\w|(\p{L}\p{M}?)|-)+\b)|((?<=\[)@.+?(?=\]))%u'; 

		 
		foreach ($strArray as $b) 
		{  
			  // match the word with our hashtag pattern
			  preg_match_all($pattern, ($b), $matches);
			  
			  /** 
			   *
			   * @var hashtag[] 
			   * An array of string objects that will save the hashtags.
			   *
			   */ 
			  $hashtag	= implode(', ', $matches[0]);   
			  
			  // add to array if hashtag is not empty
			  if (!empty($hashtag) or $hashtag != "")
				array_push($hashtagsArray, $hashtag); 
		}

		// now we have found all hashtags in the string
		// so we have to replace them and built a new string :
		foreach ($hashtagsArray as $c)
		{
			/** 
			*
			* @var string $hashtagTitle
			* container for the exported hashtags without @ sign (to insert to db or etc) 
			*/ 
			$hashtagTitle = ltrim($c,"@");
			
			//create links for hashtags
			$str = str_replace($c,'<a href="/user/'.$hashtagTitle.'">@'.$hashtagTitle.'</a>',$str);
			
			// uncomment the below line to see the functionality.
			// echo "$hashtagTitle <br>";
		} 

		// return fulltext with linked hashtags OR return just the hashtags (with @ sign)
		if ($outputType == "tagsOnly") 
			return $listOfHashtags = implode(" ",$hashtagsArray);  
		else
			return $str;  
	}
?>