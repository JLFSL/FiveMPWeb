<?php
	function lang($phrase){
    static $lang = array(
        'PAGE_NOT_OPTIMIZED' => 'Deze pagina is niet volledig geoptimalizeert vanwege het feit dat FiveMP alleen werkt op Windows en Linux.',
        'DOWNLOADS' => 'Downloads',
        'DOWNLOAD' => 'Download',
        'CHANGELOG' => 'Changelog',
        'OFFICIAL_MIRROR' => 'Officiele Mirror',
        'INS_INSTRUC' => 'Installatie Instructies',
		'VERSION' => 'Versie'
    );
    return $lang[$phrase];
}
?>