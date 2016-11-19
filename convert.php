<?php

    $xml = simplexml_load_file('convert.xml');
	//foreach
    echo $xml->SpoonerPlacements['Placement'][1]['ModelHash'];

?>