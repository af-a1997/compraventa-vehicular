<!DOCTYPE html>

<?php
	include "../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../shared/Constant_Strings[A].php";
	include "../../../../shared/Constant_Strings[G].php";

	$o_rnt = new Rentable();
	$o_art = new Sellable();

	$o_rnt_list = $o_rnt->RNT_ShowAllForList();
	$o_art_list = $o_art->ART_ShowAllForList();
?>

<html lang="es">
	<head>
		<?php include "../../../../shared/html_head_setup.php"; ?>
		
		<title>Panel de administrador - <?php echo a_artman; ?></title>
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
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="/admin/pages/manage/vehicles/"><?php echo a_vehman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_artman; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_artman; ?></h6>
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
			
			<!-- Vehicles that can be sold. -->
			<div class="container-fluid py-4">
				<div class="row">
					<div class="col-12">
						<div class="card my-4">
							<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
								<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
									<h6 class="text-white text-capitalize ps-3"><?php echo a_ss_rentable; ?></h6>
								</div>
							</div>
							<div class="card-body px-0 pb-2">
								<div class="table-responsive p-0">
									<table class="table align-items-center mb-0">
										<thead>
											<tr>
												<th class="text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Vehículo</th>
												<th class="text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Disponibilidad</th>
												<th class="text-uppercase text-white opacity-8 text-xxs font-weight-bolder ps-2">Cuota diaria</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Acciones</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$vfb_str = "";
												$avail = "";

												if($o_rnt_list != null){
													foreach($o_rnt_list as $orl){
														if($orl->vfb == 0) $vfb_str = "Año desc.";
														else $vfb_str = $orl->vfb;
														
														if($orl->disponibilidad == 0) $avail = "<span class=\"badge badge-sm bg-gradient-danger\">Sin stock</span>";
														else if($orl->disponibilidad == 1) $avail = "<span class=\"badge badge-sm bg-gradient-warning\">1 unidad</span>";
														else if($orl->disponibilidad > 1) $avail = "<span class=\"badge badge-sm bg-gradient-success\">".$orl->disponibilidad." unidades</span>";
	
														echo "
															<tr>
																<td>
																	<div class=\"d-flex px-2 py-1\">
																		<div class=\"d-flex flex-column justify-content-center\">
																			<h6 class=\"mb-0 text-sm\">$orl->bno</h6>
																			<p class=\"text-xs text-white opacity-8 mb-0\">$orl->vmo ($vfb_str)</p>
																		</div>
																	</div>
																</td>
																<td class=\"align-middle text-center text-sm\">$avail</td>
																<td class=\"align-middle text-center text-sm\">$orl->valor_diario_alq $orl->cab</td>
																<td class=\"align-middle text-center\">
																	<a href=\"./do/rentable/Details.php?id_rnt=$orl->id_art_alq\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=\"tooltip\" data-original-title=\"Detalles\"><i class=\"material-icons opacity-10\">info</i></a>
																	<a href=\"./do/rentable/Edit.php?id_rnt=$orl->id_art_alq\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=\"tooltip\" data-original-title=\"Editar\"><i class=\"material-icons opacity-10\">edit</i></a>
																	<a href=\"./do/rentable/Delete.php?id_rnt=$orl->id_art_alq\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=\"tooltip\" data-original-title=\"Eliminar\"><i class=\"material-icons opacity-10\">delete</i></a>
																</td>
															</tr>
														";
													}
												}
												else
													echo "<tr><td colspan=4 class=\"align-middle text-center text-sm\">No hay vehículos en venta</td></tr>";
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Vehicls that can be rented. -->
				<div class="row">
					<div class="col-12">
						<div class="card my-4">
							<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
								<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
									<h6 class="text-white text-capitalize ps-3"><?php echo a_ss_sellable; ?></h6>
								</div>
							</div>
							<div class="card-body px-0 pb-2">
								<div class="table-responsive p-0">
									<table class="table align-items-center mb-0">
										<thead>
											<tr>
												<th class="text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Vehículo</th>
												<th class="text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Vendedor</th>
												<th class="text-uppercase text-white opacity-8 text-xxs font-weight-bolder ps-2">Precio venta</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">D/H publicación</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Acciones</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$vfb_str = "";
												$avail = "";

												if($o_art_list != null){
													foreach($o_art_list as $oal){
														if($oal->vfb == 0) $vfb_str = "Año desc.";
														else $vfb_str = $orl->vfb;
	
														echo "
															<tr>
																<td>
																	<div class=\"d-flex px-2 py-1\">
																		<div class=\"d-flex flex-column justify-content-center\">
																			<h6 class=\"mb-0 text-sm\">$oal->bno</h6>
																			<p class=\"text-xs text-white opacity-8 mb-0\">$oal->vmo ($vfb_str)</p>
																		</div>
																	</div>
																</td>
																<td class=\"align-middle text-center text-sm\"><a href=\"/admin/pages/manage/clients/do/Details.php?id_cli=$oal->userid\">$oal->uno</a></td>
																<td class=\"align-middle text-center text-sm\">$oal->valor_venta $oal->cab</td>
																<td></td>
																<td class=\"align-middle text-center\">
																	<a href=\"./do/rentable/Delete.php?id_rnt=$oal->id_art_venta\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=\"tooltip\" data-original-title=\"Detalles\"><i class=\"material-icons opacity-10\">info</i></a>
																	<a href=\"./do/rentable/Delete.php?id_rnt=$oal->id_art_venta\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=\"tooltip\" data-original-title=\"Editar\"><i class=\"material-icons opacity-10\">edit</i></a>
																	<a href=\"./do/rentable/Delete.php?id_rnt=$oal->id_art_venta\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=\"tooltip\" data-original-title=\"Eliminar\"><i class=\"material-icons opacity-10\">delete</i></a>
																</td>
															</tr>
														";
													}
												}
												else
													echo "<tr><td colspan=5 class=\"align-middle text-center text-sm\">No hay vehículos alquilables</td></tr>";
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Vehicls that can be rented. -->
				<div class="row">
					<div class="col-12">
						<div class="card my-4">
							<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
								<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
									<h6 class="text-white text-capitalize ps-3">Añadir...</h6>
								</div>
							</div>
							<div class="card-body px-0 pb-2">
								<button id=id_btn_add_rnt class="btn btn-fill btn-success"><i class="material-icons opacity-10">published_with_changes</i> Vehículo alquilable</button>
								<button id=id_btn_add_art class="btn btn-fill btn-success"><i class="material-icons opacity-10">monetization_on</i> Vehículo vendible</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
	
		<?php include "../../../../shared/Imports.Scripts.php"; ?>

		<script>
			$('#sidebar-choice-4').addClass("active bg-gradient-primary");
		</script>
	</body>
</html>
