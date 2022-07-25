<!DOCTYPE html>

<?php
	include "../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../shared/Constant_Strings[A].php";
	include "../../../../shared/Constant_Strings[G].php";
	
	$o_rent = new Rented();
	
	$o_rent_list = $o_rent->RHI_ShowAllForList();
?>

<html lang=es>
	<head>
		<?php include "../../../../shared/html_head_setup.php"; ?>
		
		<title>Panel de administrador - <?php echo a_hvman; ?></title>
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
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_hvman; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_hvman; ?></h6>
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
			
			<!-- Table with registered vehicles. -->
			<div class="container-fluid py-4">
				<div class="row">
					<div class="col-12">
						<div class="card my-4">
							<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
								<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
									<h6 class="text-white text-capitalize ps-3"><?php echo a_hvman; ?></h6>
								</div>
							</div>
							<div class="card-body px-0 pb-2">
								<div class="table-responsive p-0">
									<table class="table align-items-center mb-0">
										<thead>
											<tr>
												<th class="text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Vehículo</th>
												<th class="text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Estado</th>
												<th class="text-uppercase text-white opacity-8 text-xxs font-weight-bolder ps-2">Alquilado por</th>
												<th class="text-uppercase text-white opacity-8 text-xxs font-weight-bolder ps-2">Alquilado el</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Devuelto el</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Cuota diaria</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Acciones</th>
											</tr>
										</thead>
										<tbody>
											<?php
												include "../../../../../shared/utils/Utils.Veh_Statuses.php";
							
												if($o_rent_list == null){
													echo "<tr><td class=\"align-middle text-center text-sm\" colspan=7>No hay alquileres registrados.</td></tr>";
												}
												else{
													foreach($o_rent_list as $orl){
														$act_stop = "";

														if($orl->estado_alquiler == 0)
															$act_stop = null;
														else if($orl->estado_alquiler > 0)
															$act_stop = "<a href=\"./do/Stop.php?id_rhi=$orl->id_hst_alq\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=\"tooltip\" data-original-title=\"Abortar alquiler\"><i class=\"material-icons opacity-10\">stop</i></a>";
														
														$rent_status = UVS_BuildBadge($orl->estado_alquiler);
														$veh_year = "";
														
														if($orl->veh_yfb == 0) $veh_year = "Año desc.";
														else $veh_year = $orl->veh_yfb;
														
														echo "
															<tr>
																<td>
																	<div class=\"d-flex px-2 py-1\">
																		<div class=\"d-flex flex-column justify-content-center\">
																			<h6 class=\"mb-0 text-sm\">$orl->bnd_name</h6>
																			<p class=\"text-xs text-white opacity-8 mb-0\">$orl->veh_mod ($veh_year)</p>
																		</div>
																	</div>
																</td>
																<td class=\"align-middle text-center text-sm\">$rent_status</td>
																<td class=\"align-middle text-center text-sm\"><a href=\"../../clients/do/Details.php?id_cli=$orl->uid\">$orl->uun</a></td>
																<td class=\"align-middle text-center text-sm\">$orl->momento_alquilado</td>
																<td class=\"align-middle text-center text-sm\">$orl->momento_devolucion</td>
																<td class=\"align-middle text-center text-sm\">$orl->ren_cost $orl->coin</td>
																<td class=\"align-middle text-center\">
																	<a href=\"./do/Details.php?id_rhi=$orl->id_hst_alq\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=\"tooltip\" data-original-title=\"Detalles\"><i class=\"material-icons opacity-10\">info</i></a>
																	$act_stop
																	<a href=\"./do/Edit.php?id_rhi=$orl->id_hst_alq\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=\"tooltip\" data-original-title=\"Editar\"><i class=\"material-icons opacity-10\">edit</i></a>
																	<a href=\"./do/Delete.php?id_rhi=$orl->id_hst_alq\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=\"tooltip\" data-original-title=\"Eliminar\"><i class=\"material-icons opacity-10\">delete</i></a>
																</td>
															</tr>
														";
													}
												}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
	
		<?php include "../../../../shared/Imports.Scripts.php"; ?>

		<script>
			$('#sidebar-choice-5').addClass("active bg-gradient-primary");
		</script>
	</body>
</html>
