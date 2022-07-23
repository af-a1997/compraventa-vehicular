<!DOCTYPE html>

<!-- Constant strings of text -->
<?php
	include "../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../shared/Constant_Strings[A].php";
	include "../../../shared/Constant_Strings[G].php";
	
	$o_veh = new Vehicles();
	
	$o_veh_list = $o_veh->VEH_ShowAllForList();
?>

<html lang="es">
	<head>
		<?php include "../../../shared/html_head_setup.php"; ?>
		
		<title>Panel de administrador - <?php echo a_vehman; ?></title>
	</head>

	<body class="g-sidenav-show bg-gray-600 dark-version">
		<!-- Sidebar -->
		<?php include "../../../shared/Snippets.Sidebar.php"; ?>
		
		<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
			<!-- Top bar conents -->
			<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
				<div class="container-fluid py-1 px-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="/admin/"><?php echo a_dsb; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_vehman; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_vehman; ?></h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						<ul class="navbar-nav justify-content-end">
							<li class="nav-item d-flex align-items-center">
								<a href="../../../../login/admin/Logout.php" class="nav-link text-body font-weight-bold px-0">
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
			
			<!-- Table with registered vehicles. -->
			<div class="container-fluid py-4">
				<div class="row">
					<div class="col-12">
						<div class="card my-4">
							<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
								<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
									<h6 class="text-white text-capitalize ps-3"><?php echo a_vehman; ?></h6>
								</div>
							</div>
							<div class="card-body px-0 pb-2">
								<div class="table-responsive p-0">
									<table class="table align-items-center mb-0">
										<thead>
											<tr>
												<th class="text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Vehículo</th>
												<th class="text-uppercase text-white opacity-8 text-xxs font-weight-bolder ps-2">Disponibilidad</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Acciones</th>
											</tr>
										</thead>
										<tbody>
											<?php
												foreach($o_veh_list as $vl){
													$units_text = "";
													$veh_year = "";
													
													if($vl->unidades == 0) $units_text = "<span class=\"badge badge-sm bg-gradient-danger\">Sin stock</span>";
													else if($vl->unidades == 1) $units_text = "<span class=\"badge badge-sm bg-gradient-warning\">1 unidad</span>";
													else if($vl->unidades > 1) $units_text = "<span class=\"badge badge-sm bg-gradient-success\">".$vl->unidades." unidades</span>";
													
													if($vl->anho_fab == 0) $veh_year = "Año desc.";
													else $veh_year = $vl->anho_fab;
													
													
													echo "
														<tr>
															<td>
																<div class=\"d-flex px-2 py-1\">
																	<div class=\"d-flex flex-column justify-content-center\">
																		<h6 class=\"mb-0 text-sm\">$vl->mno</h6>
																		<p class=\"text-xs text-white opacity-8 mb-0\">$vl->modelo ($veh_year)</p>
																	</div>
																</div>
															</td>
															<td class=\"align-middle text-center text-sm\">$units_text</td>
															<td class=\"align-middle text-center\">
																<a href=\"./do/Details.php?id_veh=$vl->idno\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=tooltip data-original-title=\"Detalles\"><i class=\"material-icons opacity-10\">info</i></a>
																<a href=\"./do/Edit.php?id_veh=$vl->idno\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=tooltip data-original-title=\"Editar\"><i class=\"material-icons opacity-10\">edit</i></a>
																<a href=\"./do/Delete.php?id_veh=$vl->idno\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=tooltip data-original-title=\"Eliminar\"><i class=\"material-icons opacity-10\">delete</i></a>
															</td>
														</tr>
													";
												}
											?>
										</tbody>
									</table>
								</div>
							</div>
			
							<button id=id_btn_new_veh class="btn btn-success"><i class="material-icons opacity-10">commute</i> Nuevo vehículo</button>
						</div>
					</div>
				</div>
			</div>
		</main>
	
		<?php include "../../../shared/Imports.Scripts.php"; ?>

		<script>
			$().ready(function(){
				$('#sidebar-choice-1').addClass("active bg-gradient-primary");
			});
			
			$("#id_btn_new_veh").click(function(){
				location.href = "./new";
			});
		</script>
	</body>
</html>
