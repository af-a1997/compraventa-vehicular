<?php
	include "../../../../shared/Utils.Admin.SessionCheck.php";
	include "../../../../shared/Utils.Admin.Time.php";

	include "../../../../shared/Constant_Strings[A].php";
	include "../../../../../shared/utils/Utils.Common_Strings.php";
	include "../../../../../shared/utils/Utils.TxcCon_StatusBdg.php";
	
	include "../../../../classes/Utils_ClassLoader.class.php";

	$o_con = new Taxicab_Contracts();

	$o_con_all = $o_con->CON_ShowAllForList();
?>
<!DOCTYPE html>

<html lang=es>
	<head>
		<?php include "../../../../shared/html_head_setup.php"; ?>
		
		<title><?php echo a_dsb." - ".a_txc_con; ?></title>
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
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_txc_con; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_txc_con; ?></h6>
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
			
			<!-- Table listing vehicles obtained by the company. -->
			<div class="container-fluid py-4">
				<div class="row">
					<div class="col-12">
						<div class="card my-4">
							<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
								<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
									<h6 class="text-white text-capitalize ps-3"><?php echo a_txc_con; ?></h6>
								</div>
							</div>
							<div class="card-body px-0 pb-2">
								<div class="table-responsive p-0">
									<table class="table align-items-center mb-0">
										<thead>
											<tr>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Remisero</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Contratador</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Id. registro vehículo</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Inicio</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Estado/Fin</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Acciones</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$active_contracts_count = 0;

												if($o_con_all != null){
													$action_stop = "";

													foreach($o_con_all as $atc){
														$bdg_con_status = UTC_GenStBadge($atc->tiempo_fin,$cdt);

														// Stop contract action only available if the contract is active (i.e: doesn't have end timestamp).
														if($atc->tiempo_fin == null)
															$action_stop = "<a href=\"./do/Finish.php?id_con=$atc->id_entrada_reg\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=tooltip data-original-title=\"Finalizar contrato\"><i class=\"material-icons opacity-10\">stop</i></a>";
														else
															$action_stop = "";

														echo "
															<tr>
																<td>
																	<p class=\"text-xs font-weight-bold mb-0\"><a href=\"../do/Details.php?id_txc=$atc->remisero\">$atc->tna $atc->tsn</a></p>
																	<p class=\"text-xs text-white opacity-8 mb-0\">$atc->reg_lp</p>
																</td>
																<td class=\"align-middle text-center text-sm\"><a href=\"../../clients/do/Details.php?id_cli=$atc->contratador\">$atc->uun</a></td>
																<td class=\"align-middle text-center text-sm\"><a href=\"../../vehicles/reg_lp/do/Details.php?id_reg=$atc->rid\">$atc->rid</a></td>
																<td class=\"align-middle text-center text-sm\">$atc->tiempo_inicio</td>
																<td>
																	<p class=\"text-xs font-weight-bold mb-0\">$bdg_con_status</p>
																	<p class=\"text-xs text-white opacity-8 mb-0\">$atc->tiempo_fin</p>
																</td>
																<td>
																	<a href=\"./do/Details.php?id_con=$atc->id_entrada_reg\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=tooltip data-original-title=\"Detalles del contrato\"><i class=\"material-icons opacity-10\">info</i></a>
																	$action_stop
																</td>
															</tr>
														";

														if($atc->tiempo_fin == null)
															$active_contracts_count++;
													}
												}
												else echo "<tr><td class=\"align-middle text-center text-sm\" colspan=6><i class=\"material-icons opacity-10\">disabled_by_default</i> No hay contratos con remises registrados</td></tr>";
											?>
										</tbody>
									</table>
								</div>
							</div>
							
							<?php
								$active_contracts_count_flavor_text = "";

								// Only show the danger area with the contract deletion button IF there's at least one expired contract.
								if($active_contracts_count > 0){
									if($active_contracts_count == 1)
										$active_contracts_count_flavor_text = "un contrato inactivo";
									else
										$active_contracts_count_flavor_text = $active_contracts_count." contratos inactivos";

									echo "
										<div class=danger_area>
											<div class=danger_area_title>Zona de peligro</div>

											<p>Acciones que causan cambios irreversibles y/o importantes sobre el historial de contrato de remises.</p>

											<button id=id_btn_rmv_final_con class=\"btn btn-warning\"><i class=\"material-icons opacity-10\">delete_forever</i> Quitar ".$active_contracts_count_flavor_text."</button>
										</div>
									";
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</main>
	
		<?php include "../../../../shared/Imports.Scripts.php"; ?>

		<script>
			$('#sidebar-choice-7').addClass("active bg-gradient-primary");
			
			$("#id_btn_rmv_final_con").click(function(){
				location.href = "./do/Clear_Inactive_CON.php";
			});
		</script>
	</body>
</html>
