<?php
	if(isset($_SESSION['client_session'])){
		header("Location:../../");
	}
	
	include $_SERVER["DOCUMENT_ROOT"]."/shared/utils/Utils.Common_Strings.php";
?>

<!DOCTYPE html>

<html lang=es>
	<head>
        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Head_Data_Setup.php"; ?>
		
		<title><?php echo g_sn." - ".g_login; ?></title>
	</head>

	<body>
		<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
			<?php
				if(isset($_GET['msg']) && ($_GET['msg']) == "err_invalid_credentials"){
					echo "
						<div class=\"alert alert-danger\" role=alert>Credenciales inválidas, asegúrate que has ingresado tu nombre de usuario y clave correctamente.</div>
					";
				}

				include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Header_Contents.php";
				include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Top_Links.php";

				outTopHeader(5);
			?>
			
			<div class="container-fluid pt-5">
				<form id=id_form_cli_login method=POST action="./act/Login.php">
                    <div class="control-group col-md-6">
						<label for=fln_cli_un class=form-label>Usuario</label>
						<input class=form-control name=fln_cli_un />
					</div>
					<br />
                    <div class="control-group col-md-6">
						<label for=fln_cli_pwd class=form-label>Clave</label>
						<input type=password class=form-control name=fln_cli_pwd />
					</div>
					
					<br />
					
					<button class="btn btn-success py-2 px-4" type=submit><i class="fas fa-arrow-right-to-bracket"></i> <?php echo g_login; ?></button>
                    <a class="btn btn-danger py-2 px-4" href="/"><i class="fas fa-xmark"></i> Cancelar</a>
				</form>
			</div>
		</main>

		<?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Footer.php"; ?>

		<!-- Back to top -->
		<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
	
		<?php include "../../admin/shared/Imports.Scripts.php"; ?>
		
		<script src="/shared/extras/jquery/validation/jquery.validate.min.js"></script>
		<script>
			$().ready(function(){
				$("#id_form_cli_login").validate({
					rules:{
						fln_cli_un: "required",
						fln_cli_pwd: "required"
					},
					messages:{
						fln_cli_un: "Ingresa tu nombre de usuario.",
						fln_cli_pwd: "Ingresa tu clave."
					}
				});
			});
		</script>
	</body>
</html>
