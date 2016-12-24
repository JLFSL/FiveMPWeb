<?php
	if(isset($_POST['submit'])) {
		echo "Hash: 0x" . hash("joaat", ($_POST['needshash'])) . "<br />\n";
	}
?>

<form method="post">
   <p>Input: <input type="text" name="needshash" /></p>
   <input type="submit" name="submit" value="Submit" />
</form>