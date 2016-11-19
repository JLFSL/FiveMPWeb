<?php
	###### Five-Multiplayer.net - Global.php ######
		
		### Configuration ###
			
			# Error Handling
			$er_showerrors 		= false;
			$er_debugmode		= false;
			
			ini_set('display_errors', $er_showerrors);
			ini_set('display_startup_errors', $er_showerrors);
			error_reporting($er_showerrors);
			
			# Website Maintenance
			$m_maintenance 		= false;
			$m_maint_msg		= "None set";
			
			# Authentication
			$a_registration 	= false;
			$a_login			= true;
			
			# Website Style
			$s_version			= "v1";
			$s_lang				= "EN";
			
		### End of Configuration ###
		
		### Session Processing ###
		
			# User Sessions
			//session_start(); - removed because its handled in session.php now
		
		### End of Session Processing ###
		
		### Including ###
			
			# MySQL
			require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/db.php");
			
			# Functions
			require_once($_SERVER['DOCUMENT_ROOT'] . "/include/global/misc/functions.php");
			
			# Page
			require_once($_SERVER['DOCUMENT_ROOT'] . "/include/v1/top.php");
			
			# Language Files
			require_once($_SERVER['DOCUMENT_ROOT'] . "/include/lang/".$s_lang.".php");
			
			
		### End of Including ###
		
	###### Five-Multiplayer.net - Global.php ######
?>	