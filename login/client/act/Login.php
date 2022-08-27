<?php
	session_start();
	
    include $_SERVER["DOCUMENT_ROOT"]."/client/classes/Utils.CliClassLoader.class.php";

	$credentials = mysqli_connect("localhost","cmman_cli","t@*%k77Sx#!T9t93","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
	
	$o_client = new Client();
	
	$o_client->nombre_usuario = mysqli_real_escape_string($credentials,strip_tags($_POST['fln_cli_un']));
	$o_client->clave = mysqli_real_escape_string($credentials,strip_tags($_POST['fln_cli_pwd']));
	// TODO: enclose password in hash() function to be decided later for an extra layer of security in case of DDBB leak, but passwords need to be turned into hashes first, and hash type needs to be decided first (used across ALL the system).
	
	$r_login_check = $o_client->PUBCLI_LoginDataCheck();
	
	if($r_login_check){
		$_SESSION["client_id"] = $r_login_check->nro_id_u;
		$_SESSION["client_un"] = $r_login_check->nombre_usuario;
		$_SESSION["client_session"] = true;
		
		header("Location:../../../");
	}
	else header("Location:../?msg=err_invalid_credentials");
?>
