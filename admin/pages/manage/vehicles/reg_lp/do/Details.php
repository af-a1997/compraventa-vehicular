<!DOCTYPE html>

<?php
	include "../../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../../shared/Constant_Strings[A].php";
	include "../../../../../../shared/utils/Utils.Common_Strings.php";

	include "../../../../../../shared/utils/Utils.Color_Tag.php";
	
	$o_rvi = new Registered_Veh_Info();
	$o_veh = new Vehicles();
	$o_brn = new Brands();
	
	$o_rvi->id_reg = $_GET["id_reg"];
	
	$o_rvi_details = $o_rvi->RVI_ShowOne();

	$o_veh->idno = $o_rvi_details->vehiculo_asociado;

	$o_veh_fetch_data = $o_veh->VEH_ShowOne();
?>

<html lang=es>
	<head>
		<?php include "../../../../../shared/html_head_setup.php"; ?>
		
		<title>Panel de administrador - <?php echo a_regman; ?></title>
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
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="../../"><?php echo a_vehman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page">Detalles</li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0">Detalles del registro</h6>
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
			
			<!-- Table with registered vehicles. -->
			<div class="container-fluid py-4">
				<div class="row">
					<div class="col-12">
						<div class="card my-4">
							<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
								<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
									<h6 class="text-white text-capitalize ps-3">Detalles del registro</h6>
								</div>
							</div>
							<div class="card-body px-0 pb-2">
								<?php
									$yfb_str = "";
									$u_desc = "";
									$distance = "";
									$ct_o = GEN_ColorTag($o_rvi_details->color);

									if($o_rvi_details->usado == null)
										$u_desc = "Se desconoce.";
									else if($o_rvi_details->usado == 0)
										$u_desc = "No.";
									else if($o_rvi_details->usado == 1)
										$u_desc = "Sí.";
									
									if($o_rvi_details->kilometraje_act == null) $distance = "N/A";
									else $distance = $o_rvi_details->kilometraje_act." km.";
									
									if($o_veh_fetch_data->anho_fab == 0) $yfb_str = "Año desconocido";
									else $yfb_str = $o_veh_fetch_data->anho_fab;

									echo "
										<ul class=ul_style_elem_details>
											<li><b>Registro actualizado:</b> $o_rvi_details->ultima_act_info</li>
											<li><b>Color:</b> $ct_o</li>
											<li><b>Matrícula:</b> $o_rvi_details->matricula</li>
											<li><b>Estado:</b> $o_rvi_details->estado_act</li>
											<li><b>Kilometraje:</b> $distance</li>
											<li><b>¿Es usada?:</b> $u_desc</li>
											<li><b>Vehículo asociado:</b> $o_veh_fetch_data->mno $o_veh_fetch_data->modelo ($yfb_str)</li>
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
	
		<?php include "../../../../../shared/Imports.Scripts.php"; ?>

		<script>
			$().ready(function(){
				$('#sidebar-choice-1').addClass("active bg-gradient-primary");
			});
			
			$("#id_btn_head_back").click(function(){
				location.href = "../../";
			});
		</script>
	</body>
</html>