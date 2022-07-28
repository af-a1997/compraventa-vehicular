<?php
	if(isset($_SESSION['admin_session'])){
		header("Location:../../admin/");
	}
	
	include "../../admin/shared/Constant_Strings[A].php";
	include "../../shared/utils/Utils.Common_Strings.php";
?>

<!DOCTYPE html>

<html lang=es>
	<head>
		<?php
			include "../../admin/shared/html_head_setup.php";
			include "../../admin/shared/Imports.jQuery_UI.php";
		?>
		
		<title>Panel de administrador - <?php echo g_login; ?></title>
	</head>

	<body class="g-sidenav-show bg-gray-600 dark-version">
		<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
			<?php
				if(isset($_GET['msg']) && ($_GET['msg']) == "invalid_credentials"){
					echo "
						<div class=\"alert alert-danger\" role=alert>Credenciales inválidas, asegúrate que has ingresado tu nombre de usuario y clave correctamente.</div>
					";
				}
			?>
			
			<p><?php echo g_login; ?> para acceder al panel de administración.</p>
			
			<form id=id_form_adm_login method=POST action="./act/Login.php">
				<div class="input-group input-group-outline">
					<label class=form-label>Usuario</label>
					<input class=form-control name=fln_adm_un />
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Clave</label>
					<input type=password class=form-control name=fln_adm_pwd />
				</div>
				
				<br />
				
				<button class="btn btn-success" type=submit><?php echo g_login; ?></button> o <a href="/">volver al inicio</a>
			</form>
		</main>
	
		<?php include "../../admin/shared/Imports.Scripts.php"; ?>
		
		<script src="/shared/extras/jquery/validation/jquery.validate.min.js"></script>
		<script>
			$().ready(function(){
				$("#id_form_adm_login").validate({
					rules:{
						fln_adm_un: {
							required: true
						},
						fln_adm_pwd: {
							required: true
						}
					},
					messages:{
						fln_adm_un: "Ingresa tu nombre de usuario.",
						fln_adm_pwd: "Ingresa tu clave."
					}
				});
			});
		</script>
	</body>
</html>
