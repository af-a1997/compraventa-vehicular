<?php
	session_start();
	
	include "../../../admin/classes/Utils_ClassLoader.class.php";

	$credentials = mysqli_connect("localhost","cmman_admin","#V!c2bMr69xo!8%A","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
	
	$o_users = new Users();
	
	// Fetches user name and password while sanitizing contents to prevent injection attacks.
	$o_users->nombre_usuario = mysqli_real_escape_string($credentials,strip_tags($_POST['fln_adm_un']));
	$o_users->clave = mysqli_real_escape_string($credentials,strip_tags($_POST['fln_adm_pwd']));
	// TODO: enclose password in hash() function to be decided later for an extra layer of security in case of DDBB leak, but passwords need to be turned into hashes first, and hash type needs to be decided first (used across ALL the system).
	
	$r_login_check = $o_users->ADM_Login_Check();
	
	if($r_login_check){
		$_SESSION["admin_id"] = $r_login_check->nro_id_u;
		$_SESSION["admin_un"] = $r_login_check->nombre_usuario;
		$_SESSION["admin_session"] = true;
		
		header("Location:../../../admin/");
	}
	else{
		header("Location:../?msg=invalid_credentials");
	}
?>