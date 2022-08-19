<!DOCTYPE html>

<?php
    if(!isset($_GET["id_brn"])){
        header("Location:../../");
    }

	include "../../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../../shared/Constant_Strings[A].php";
	include "../../../../../../shared/utils/Utils.Common_Strings.php";
	
	include "../../../../../classes/Utils_ClassLoader.class.php";

    $o_brn = new Brands();
	$o_veh = new Vehicles();

    $o_brn->idno = $_GET["id_brn"];

    $o_brn_info = $o_brn->BRAND_ShowOne();
	$o_veh_list = $o_veh->VEH_ShowAllByBrand($_GET["id_brn"]);
?>

<html lang="es">
	<head>
		<?php include "../../../../../shared/html_head_setup.php"; ?>
		
		<title><?php echo a_dsb." - ".a_l_vbb_one.$o_brn_info->nombre; ?></title>
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
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;"><?php echo a_dsb; ?></a></li>
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="/admin/pages/manage/other"><?php echo a_oman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_l_vbb_all; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_l_vbb_all; ?></h6>
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

			<!-- Table containing list of vehicles per brand -->
			<div class="container-fluid py-4">
				<div class="row">
					<div class="col-12">
						<div class="card my-4">
							<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
								<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
									<h6 class="text-white text-capitalize ps-3"><?php echo a_l_vbb_one.$o_brn_info->nombre; ?></h6>
								</div>
							</div>
							<div class="card-body px-0 pb-2">
								<div class="table-responsive p-0">
									<table class="table align-items-center mb-0">
										<thead>
											<tr>
												<th class="text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Modelo</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder" style="width: 150px;">Acciones</th>
											</tr>
										</thead>
										<tbody>
											<?php
												if($o_veh_list != null){
													$fab_year = "";

													foreach($o_veh_list as $ove){
														if($ove->anho_fab == 0) $fab_year = "Año desc.";
														else $fab_year = $ove->anho_fab;

														echo "
															<tr>
																<td>
																	<div class=\"d-flex px-2 py-1\">
																		<div class=\"d-flex flex-column justify-content-center\">
																			<h6 class=\"mb-0 text-sm\">$o_brn_info->nombre</h6>
																			<p class=\"text-xs text-white opacity-8 mb-0\">$ove->modelo ($fab_year)</p>
																		</div>
																	</div>
																</td>
																<td class=\"align-middle text-center\">
																    <a href=\"/admin/pages/manage/vehicles/do/Details.php?id_veh=$ove->idno\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=\"tooltip\" data-original-title=\"Detalles\"><i class=\"material-icons opacity-10\">info</i></a>
																	<a href=\"/admin/pages/manage/vehicles/do/Edit.php?id_veh=$ove->idno\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=\"tooltip\" data-original-title=\"Editar\"><i class=\"material-icons opacity-10\">edit</i></a>
																	<a href=\"/admin/pages/manage/vehicles/do/Delete.php?id_veh=$ove->idno\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=\"tooltip\" data-original-title=\"Eliminar\"><i class=\"material-icons opacity-10\">delete</i></a>
																</td>
															</tr>
														";
													}
												}
												else echo "<tr><td class=\"align-middle text-center text-sm\" colspan=2><i class=\"material-icons opacity-10\">disabled_by_default</i> No se registraron vehículos por $o_brn_info->nombre</td></tr>";
											?>
										</tbody>
									</table>
								</div>
							</div>
			
                            <button id=id_btn_head_back class="btn btn-success"><i class="material-icons opacity-10">arrow_back</i> Volver a la lista</button>
						</div>
					</div>
				</div>
			</div>
		</main>
	
		<?php include "../../../../../shared/Imports.Scripts.php"; ?>

		<script>
			$('#sidebar-choice-8').addClass("active bg-gradient-primary");
			
			$("#id_btn_head_back").click(function(){
				location.href = "../../";
			});
		</script>
	</body>
</html>