<?php
	function lang($phrase){
    static $lang = array(
		// Downloads Page
        'PAGE_NOT_OPTIMIZED' => 'This page is not optimized for mobile due to FiveMP executables working only on Windows and Linux environments.',
        'DOWNLOADS' => 'Downloads',
        'DOWNLOAD' => 'Download',
        'CHANGELOG' => 'Changelog',
        'OFFICIAL_MIRROR' => 'Official Mirror',
        'INS_INSTRUC' => 'Installation Instructions',
		'VERSION' => 'Version',
		
		'CLAIM_SERVER' 	=> 'Claim Server',
		'TO_CLAIM_SERVER_' => 'To claim a server, be sure to follow these steps:',
		'TO_CLAIM_SERVER_1' => '1) Sign in to your account on the website.',
		'TO_CLAIM_SERVER_2' => 'ClaimServer',
		'TO_CLAIM_SERVER_3' => 'ClaimServer',
		'TO_CLAIM_SERVER_4' => 'ClaimServer',
		'TO_CLAIM_SERVER_5' => 'ClaimServer'
    );
    return $lang[$phrase];
}
?>

