<?php
	include "../../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../../shared/Constant_Strings[A].php";
	include "../../../../../../shared/utils/Utils.Common_Strings.php";
	
	$o_veh = new Vehicles();
	
	$o_veh->idno = $_POST["fln_veh_id"];

	$o_veh_info = $o_veh->VEH_ShowOne();
	if($o_veh_info->anho_fab == 0)
		$year_fab = "Año desc.";

	else
		$year_fab = $o_veh_info->anho_fab;
	
	$full_model = "$o_veh_info->mno $o_veh_info->modelo ($year_fab)";
	
	$o_veh->modelo = $_POST["fln_veh_model"];
	$o_veh->unidades = $_POST["fln_veh_stock"];
	$o_veh->anho_fab = $_POST["fln_veh_yfab"];	// If it's "0", year is treated as unknown.
	$o_veh->puertas = $_POST["fln_veh_doors"];
	$o_veh->transmision = $_POST["fln_veh_tr"];
	$o_veh->combustible_tipo = $_POST["fln_veh_ft"];
	$o_veh->combustible_capac = $_POST["fln_veh_fc"];
	$o_veh->motor = $_POST["fln_veh_eng"];
	$o_veh->marca = $_POST["fln_veh_brand"];
	$o_veh->categorizacion = $_POST["fln_veh_type"];
	
	$r_add_veh = $o_veh->VEH_UpdateOne();
?>

<html lang=es>
	<head>
		<?php
			include "../../../../../shared/html_head_setup.php";
		?>
		
		<title><?php echo a_dsb; ?> - Editar vehículo</title>
	</head>

	<body class="g-sidenav-show bg-gray-600 dark-version">
		<!-- Sidebar -->
		<?php include "../../../../../shared/Snippets.Sidebar.php"; ?>
		
		<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
			<!-- Top bar conents -->
			<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
				<div class="container-fluid py-1 px-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="/admin/"><?php echo a_dsb; ?></a></li>
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="../"><?php echo a_vehman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page">Editar</li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0">Editar vehículo</h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						<ul class="navbar-nav justify-content-end ms-md-auto pe-md-3 d-flex align-items-center">
							<?php include "../../../../../shared/Snippets.Adm_Logout.php"; ?>
							
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
				if($r_add_veh){
					echo "<p>Vehículo &laquo;".$full_model."&raquo; actualizado, <a href=\"../../\">pincha aquí para volver a la lista</a>.</p>";
				}
				else{
					echo "<p>No se pudo actualizar el vehículo, <a href=\"../../\">pincha aquí para volver a la lista</a>.</p>";
				}
			?>
		</main>
	
		<?php include "../../../../../shared/Imports.Scripts.php"; ?>
		
		<script>
			$('#sidebar-choice-1').addClass("active bg-gradient-primary");
		</script>
	</body>
</html>