<!DOCTYPE html>

<?php
	include "../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../shared/Constant_Strings[A].php";
	include "../../../../../shared/utils/Utils.Common_Strings.php";
	include "../../../../../shared/utils/Utils.RHI_VehSt.php";
	
	$o_rent = new Rented();
	
	$o_rent_list = $o_rent->RHI_ShowAllForList();
?>

<html lang=es>
	<head>
		<?php include "../../../../shared/html_head_setup.php"; ?>
		
		<title><?php echo a_dsb." - ".a_hvman; ?></title>
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
			
			<?php
				if(isset($_GET['msg']) && ($_GET['msg']) == "err_rental_active"){
					echo "
						<div class=\"alert alert-danger\" role=alert>No es posible eliminar una instancia de alquiler activa.</div>
					";
				}
			?>

			<div class="alert alert-warning" role=alert style="margin: 15px;">Nótese que no se pueden eliminar entradas del historial que tengan instancias de alquiler activas.<br/><br/>Esto implica, cualquier vehículo alquilado que esté en uno de los siguientes estados:
				<ul>
					<?php
						$c_index = 0;
						foreach($e as $statuses){
							if($c_index < 4)
								echo "<li>".$statuses."</li>";

							$c_index++;
						}
					?>
				</ul>
			</div>
			
			<!-- Table with rental history entries. -->
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
												<th class="text-uppercase text-white opacity-8 text-xxs font-weight-bolder ps-2">Arrendador</th>
												<th class="text-uppercase text-white opacity-8 text-xxs font-weight-bolder ps-2">Alquilado el</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Devuelto el</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Cuota diaria</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder" style="width: 150px;">Acciones</th>
											</tr>
										</thead>
										<tbody>
											<?php
												if($o_rent_list == null)
													echo "<tr><td class=\"align-middle text-center text-sm\" colspan=7><i class=\"material-icons opacity-10\">disabled_by_default</i> No hay alquileres registrados</td></tr>";
												else{
													foreach($o_rent_list as $orl){
														
														$rent_status = URV_GenStBadge($orl->estado_alquiler);
														$veh_year = "";
														$deletable = "";
														
														if($orl->veh_yfb == 0) $veh_year = "Año desc.";
														else $veh_year = $orl->veh_yfb;
														
														// To prevent deleting active rental instances.
														if($orl->estado_alquiler <= 3) $deletable = null;
														else $deletable = "<a href=\"./do/Delete.php?id_rhi=$orl->id_hst_alq\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=\"tooltip\" data-original-title=\"Eliminar\"><i class=\"material-icons opacity-10\">delete</i></a>";
														
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
																	<a href=\"./do/Edit.php?id_rhi=$orl->id_hst_alq\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=\"tooltip\" data-original-title=\"Editar\"><i class=\"material-icons opacity-10\">edit</i></a>
																	$deletable
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

							<?php
								if($o_rent_list != null)
									echo "
										<div class=danger_area>
											<div class=danger_area_title>Zona de peligro</div>

											<p>Acciones que causan cambios irreversibles y/o importantes sobre el historial de vehículos alquilados.</p>
										
											<button class=\"btn btn-danger\" id=nuke_tbl_contents><i class=\"material-icons opacity-10\">delete_sweep</i> Borrar todo</button>
										</div>
									";
								// ---
							?>
						</div>
					</div>
				</div>
			</div>
		</main>
	
		<?php include "../../../../shared/Imports.Scripts.php"; ?>

		<script>
			$('#sidebar-choice-5').addClass("active bg-gradient-primary");

			$("#new_rental_veh").click(function(){
				location.href = "./new";
			});
			$("#nuke_tbl_contents").click(function(){
				location.href = "./do/Delete_All.php";
			});
		</script>
	</body>
</html>
