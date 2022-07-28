<!DOCTYPE html>

<?php
	include "../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../shared/Constant_Strings[A].php";
	include "../../../../../shared/utils/Utils.Common_Strings.php";
	
	$o_user = new Users();
	
	$o_user->nro_id_u = $_GET["id_cli"];
	
	$o_user_details = $o_user->CLI_ShowOne();
?>

<html lang=es>
	<head>
		<?php include "../../../../shared/html_head_setup.php"; ?>
		
		<title>Panel de administrador - <?php echo a_vehman; ?></title>
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
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="../"><?php echo a_climan; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page">Detalles</li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0">Detalles del cliente</h6>
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
			
			<!-- Table with registered vehicles. -->
			<div class="container-fluid py-4">
				<div class="row">
					<div class="col-12">
						<div class="card my-4">
							<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
								<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
									<h6 class="text-white text-capitalize ps-3">Detalles del usuario</h6>
								</div>
							</div>
							<div class="card-body px-0 pb-2">
								<?php
									echo "
										<ul class=ul_style_elem_details>
											<li><b>Nombre(s):</b> $o_user_details->nombre</li>
											<li><b>Apellido(s):</b> $o_user_details->apellidos</li>
											<li><b>Nombre de usuario:</b> $o_user_details->nombre_usuario</li>
											<li><b>Clave:</b> <span class=hidden_pwd>$o_user_details->clave</span></li>
											<li><b>C. I.:</b> $o_user_details->cedula_identidad</li>
											<li><b>Correo electrónico:</b> $o_user_details->email</li>
											<li><b>Dirección de residencia:</b> $o_user_details->residencia_actual</li>
											<li><b>Teléfono celular:</b> $o_user_details->tel_cel</li>
											<li><b>Teléfono fijo:</b> $o_user_details->tel_fijo</li>
											<li><b>Fecha de registro:</b> $o_user_details->momento_registro</li>
										</ul>
									";
								?>
							</div>
			
							<button id=id_btn_head_back class="btn btn-success"><i class="material-icons opacity-10">arrow_back</i> Volver a la lista</button>
						</div>
					</div>
				</div>
			</div>
		</main>
	
		<?php include "../../../../shared/Imports.Scripts.php"; ?>

		<script>
			$().ready(function(){
				$('#sidebar-choice-2').addClass("active bg-gradient-primary");
			});
			
			$("#id_btn_head_back").click(function(){
				location.href = "../";
			});
		</script>
	</body>
</html>