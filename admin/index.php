<!DOCTYPE html>

<?php include "./shared/Utils.Admin.SessionCheck.php"; ?>

<html lang=es>
	<head>
		<?php include "./shared/html_head_setup.php"; ?>
		
		<title>Panel de administrador - Inicio</title>
	</head>

	<body class="g-sidenav-show bg-gray-600 dark-version">
		<!-- Constant strings of text -->
		<?php
			include "./shared/Constant_Strings[A].php";
			include "../shared/utils/Utils.Common_Strings.php";
			
			include "./shared/Snippets.Sidebar.php";
		?>

		<main class="main-content border-radius-lg">
			<!-- Top bar conents -->
			<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
				<div class="container-fluid py-1 px-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;"><?php echo a_dsb; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo g_home; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo g_home; ?></h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						<ul class="navbar-nav justify-content-end ms-md-auto pe-md-3 d-flex align-items-center">
							<?php include "./shared/Snippets.Adm_Logout.php"; ?>
							
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
			
			<p>Bienvenido/a al panel de administración.</p>
			
			<p>Administra varias secciones del sitio desde el menú a la izquierda, o toca el menú hamburguesa si estás visitando este sitio desde un teléfono.</p>

			<p>No olvides rellenar todos los campos al añadir/editar entradas de determinadas tablas ya que de otro modo el servidor devolverá una excepción y los cambios no se guardarán en la DDBB &mdash; he estado intentando hacer los campos opcionales, pero hasta ahora no he tenido suerte.</p>
		</main>
		
		<?php include "./shared/Imports.Scripts.php"; ?>

		<script>
			$('#sidebar-choice-0').addClass("active bg-gradient-primary");
		</script>
	</body>
</html>
