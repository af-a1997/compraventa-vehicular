<!DOCTYPE html>

<!-- Constant strings of text -->
<?php
	include "../../shared/Constant_Strings[A].php";
	include "../../../shared/utils/Utils.Common_Strings.php";
?>

<html lang="es">
	<head>
		<?php include "../../shared/html_head_setup.php"; ?>
		
		<title>Panel de administrador - <?php echo a_credits; ?></title>
	</head>

	<body class="g-sidenav-show bg-gray-600 dark-version">
		<!-- Sidebar -->
		<?php include "../../shared/Snippets.Sidebar.php"; ?>

		<main class="main-content border-radius-lg">
			<!-- Top bar conents -->
			<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
				<div class="container-fluid py-1 px-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;"><?php echo a_dsb; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_credits; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_credits; ?></h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						<ul class="navbar-nav justify-content-end ms-md-auto pe-md-3 d-flex align-items-center">
							<li class="nav-item d-flex align-items-center">
								<a href="./pages/sign-in.html" class="nav-link text-body font-weight-bold px-0">
									<i class="fa fa-user me-sm-1"></i>

									<span class="d-sm-inline d-none"><?php echo g_login; ?></span>
								</a>
							</li>
							
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
			
			<div class="container-fluid py-4">
				<ul>
					<li>Plantilla de Bootstrap &laquo;<a href="https://www.creative-tim.com/product/material-dashboard" target=_blank>Material Dashboard</a>&raquo; por Creative Tim.</li>
					<li>Tipografías &laquo;Roboto&raquo; y &laquo;Material Icons&raquo; de Google Fonts, son utilizadas por la plantilla pero como estaban siendo importadas de un CDN, hice una copia auto hospedada para uso sin conexión.</li>
					<li>Tipografía de íconos &laquo;Font Awesome&raquo; versión 6.1.1, también utilizada en la plantilla y auto hospedada.</li>
				</ul>
			</div>
		</main>
	
		<?php include "../../shared/Imports.Scripts.php"; ?>

		<script>
			$('#sidebar-choice-9').addClass("active bg-gradient-primary");
		</script>
	</body>
</html>