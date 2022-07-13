<?php
	$a_db_credentials = mysqli_connect("localhost","cmman_admin","#V!c2bMr69xo!8%A","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
	
	$a_root_dir = $_SERVER['DOCUMENT_ROOT']."/admin";
?>