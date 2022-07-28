<!DOCTYPE html>

<?php
	include "../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../shared/Constant_Strings[A].php";
	include "../../../../../shared/utils/Utils.Common_Strings.php";
?>

<html lang=es>
	<head>
		<?php
			include "../../../../shared/html_head_setup.php";
			include "../../../../shared/Imports.jQuery_UI.php";
		?>
		
		<title>Panel de administrador - <?php echo a_n_cli; ?></title>
	</head>

	<body class="g-sidenav-show bg-gray-600 dark-version">
		<!-- Sidebar -->
		<?php include "../../../../shared/Snippets.Sidebar.php"; ?>
		
		<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
			<!-- Top bar conents -->
			<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
				<div class="container-fluid py-1 px-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="/admin/"><?php echo a_dsb; ?></a></li>
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="/admin/pages/manage/clients/"><?php echo a_climan; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_n_cli; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_n_cli; ?></h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						<ul class="navbar-nav justify-content-end ms-md-auto pe-md-3 d-flex align-items-center">
							<?php include "../../../../shared/Snippets.Adm_Logout.php"; ?>
							
							<!-- Hamburger menu that shows the navigation menu from the left in wide screens, when the display width is not big enough (most notably on phone screens). -->
							
							<li class="nav-item d-xl-none ps-3 d-flex align-items-center">
								<a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
									<div class="sidenav-toggler-inner">
										<i class="sidenav-toggler-line"></i>
										<i class="sidenav-toggler-line"></i>
										<i class="sidenav-toggler-line"></i>
									</div>
								</a>
							</li>
							
							<!-- End of hamburger menu container. -->
						</ul>
					</div>
				</div>
			</nav>
			
			<br />
			
			<?php
				if(isset($_GET['msg']) && ($_GET['msg']) == "username_taken"){
					echo "
						<div class=\"alert alert-danger\" role=alert>El nombre de usuario ya fue tomado, vuelve a intentarlo.</div>
					";
				}
			?>
			
			<p>En esta página podrás registrar nuevos clientes.</p>
			
			<p><?php echo g_snp_reqf ?> = Campos obligatorios.</p>
			
			<form id=id_form_user_reg method=POST action="./SubmitAct.New.Client.php">
				<div class="input-group input-group-outline">
					<label class=form-label>Nombre(s) <?php echo g_snp_reqf ?></label>
					<input class=form-control name=fln_user_name />
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Apellido(s) <?php echo g_snp_reqf ?></label>
					<input class=form-control name=fln_user_surname />
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Nombre de usuario <?php echo g_snp_reqf ?></label>
					<input class=form-control name=fln_user_un />
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Clave <?php echo g_snp_reqf ?></label>
					<input type=password class=form-control name=fln_user_pwd />
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>C. I. <?php echo g_snp_reqf ?></label>
					<input class=form-control name=fln_user_uyid />
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Correo electrónico</label>
					<input class=form-control name=fln_user_emailaddr />
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Dirección de residencia</label>
					<input class=form-control name=fln_user_houseloc />
				</div>
				<p>Teléfono celular:</p>
				<div class="input-group input-group-outline">
					<input class=form-control name=fln_user_phone_cel id=validate_format_phone_cel />
				</div>
				<p>Teléfono fijo:</p>
				<div class="input-group input-group-outline">
					<input class=form-control name=fln_user_phone_home id=validate_format_phone_home />
				</div>
				
				<br />
				
				<button class="btn btn-success" type=submit><i class="material-icons opacity-10">person_add</i> Registrar usuario</button>
			</form>
		</main>
	
		<?php include "../../../../shared/Imports.Scripts.php"; ?>

		<script src="../../../../res/extras/jquery/mask/jquery.mask.min.js"></script>
		<script src="../../../../res/extras/jquery/validation/jquery.validate.min.js"></script>
		
		<script>
			$('#sidebar-choice-2').addClass("active bg-gradient-primary");
			
			$().ready(function(){
				// Masks
				$("#validate_format_phone_cel").mask("000 000 000",{
					placeholder: "09X XXX XXX"
				});
				$("#validate_format_phone_home").mask("0000 0000",{
					placeholder: "XXXX XXXX"
				});
				
				// Validation
				
				$("#id_form_user_reg").validate({
					rules:{
						fln_user_name: {
							required: true
						},
						fln_user_surname: {
							required: true
						},
						fln_user_un: {
							required: true
						},
						fln_user_pwd: {
							required: true
						},
						fln_user_uyid: {
							required: true
						},
						fln_user_email: {
							email: true
						}
					},
					messages:{
						fln_user_name: "Nombre(s) requerido(s).",
						fln_user_surname: "Apellido(s) requerido(s).",
						fln_user_un: "Nombre de usuario requerido.",
						fln_user_pwd: "Clave requerida.",
						fln_user_uyid: "Cédula de Identidad requerida."
					}
				});
			});
		</script>
	</body>
</html>
