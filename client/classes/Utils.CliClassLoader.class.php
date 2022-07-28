<?php
	spl_autoload_register(function($__class_name) {
		$class_pointer = $_SERVER['DOCUMENT_ROOT']."/client/classes/".$__class_name.".class.php";
		
		if(file_exists($class_pointer)){
			include $class_pointer;
		}
		else echo "<p style=\"background-color: #E6E6AE; border: 1px solid #45450C; color: #45450C;\">Class <span style=\"font-family: monospace; background-color: #D0D079; display: inline-block;\">".$__class_name."</span> was not found in the clients' classes directory, please check the code to ensure you're properly pointing to the file.<br /><br />Class pointer you entered is: <span style=\"font-family: monospace; background-color: #D0D079; display: inline-block;\">".$class_pointer."</span></p>";
	});
?>
