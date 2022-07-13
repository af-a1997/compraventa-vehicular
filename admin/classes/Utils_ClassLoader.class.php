<?php
	// In the course I did during 2017-2018, our teacher suggested we use __autoload() and this code to make it easier and automatic to import classes in the same folder, however, I've come to find recently that __autoload() was deprecated, so I had to replace this part with the new function to register autoloads, documented here: https://www.php.net/manual/en/language.oop5.autoload.php
	
	/*
	function __autoload($class_file) {
		$dir = str_replace("\\","/",dirname(__FILE__));
		
		if(file_exists($dir."/".$class_file.".class.php")) {
			include($dir."/".$class_file.".class.php");
		}
	}
	
	*/
	
	// Old code is above, new one below:
	
	spl_autoload_register(function($__class_name) {
		$class_pointer = $_SERVER['DOCUMENT_ROOT']."/admin/classes/".$__class_name.".class.php";
		
		if(file_exists($class_pointer)){
			include $class_pointer;
		}
		else echo "<p style=\"background-color: #E6E6AE; border: 1px solid #45450C; color: #45450C;\">Class <span style=\"font-family: monospace; background-color: #D0D079; display: inline-block;\">".$__class_name."</span> was not found in the classes directory, please check the code to ensure you're properly pointing to the file.<br /><br />Class pointer is: <span style=\"font-family: monospace; background-color: #D0D079; display: inline-block;\">".$class_pointer."</span></p>";
	});
?>
