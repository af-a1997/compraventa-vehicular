<?php
	include "../../../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../../../shared/Constant_Strings[A].php";
	include "../../../../../../shared/Constant_Strings[G].php";
	
	$o_rhi = new Rented();
	
	$o_rhi->id_hst_alq = $_POST["fln_rent_id"];
	$o_rhi->momento_alquilado = $_POST["fln_rent_start"];
	$o_rhi->momento_devolucion = $_POST["fln_rent_end"];
	$o_rhi->estado_alquiler = $_POST["fln_rent_status"];
	$o_rhi->id_veh_alquilado = $_POST["fln_rent_veh"];
	$o_rhi->no_cli = $_POST["fln_rent_cli"];
	
	$r_add_rhi = $o_rhi->RHI_UpdateOne();
?>

<html lang=es>
	<head>
		<?php
			include "../../../../../../shared/html_head_setup.php";
			include "../../../../../../shared/Imports.jQuery_UI.php";
		?>
		
		<title>Panel de administrador - Editar vehículo</title>
	</head>

	<body class="g-sidenav-show bg-gray-600 dark-version">
		<!-- Sidebar -->
		<?php include "../../../../../../shared/Snippets.Sidebar.php"; ?>
		
		<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
			<!-- Top bar conents -->
			<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
				<div class="container-fluid py-1 px-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="/admin/"><?php echo a_dsb; ?></a></li>
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="../../../"><?php echo a_vehman; ?></a></li>
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="../../"><?php echo a_hvman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page">Editar</li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0">Editar vehículo</h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						<ul class="navbar-nav justify-content-end ms-md-auto pe-md-3 d-flex align-items-center">
							<li class="nav-item d-flex align-items-center">
								<a href="/login/admin/act/Logout.php" class="nav-link text-body font-weight-bold px-0">
									<i class="fa fa-user me-sm-1"></i>

									<span class="d-sm-inline d-none"><?php echo g_logout; ?></span>
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
			
			<br />
			
			<?php
				if($r_add_rhi){
					echo "<p>Registro actualizado, <a href=\"../../\">pincha aquí para volver a la lista</a>.</p>";
				}
				else{
					echo "<p>No se pudo actualizar el registro, <a href=\"../../\">pincha aquí para volver a la lista</a>.</p>";
				}
			?>
		</main>
	
		<?php include "../../../../../../shared/Imports.Scripts.php"; ?>
		
		<script>
			$('#sidebar-choice-6').addClass("active bg-gradient-primary");
		</script>
	</body>
</html>