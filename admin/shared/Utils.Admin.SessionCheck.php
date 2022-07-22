<?php
	session_start();
	
	if(!isset($_SESSION['admin_session'])){
		header("Location:/login/admin");
	}
?>