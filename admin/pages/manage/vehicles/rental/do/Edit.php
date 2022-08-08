<!DOCTYPE html>

<?php
	include "../../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../../shared/Constant_Strings[A].php";
	include "../../../../../../shared/utils/Utils.Common_Strings.php";
	
	$o_rhi = new Rented();
	$o_rhi->id_hst_alq = $_GET["id_rhi"];
	
	$o_users = new Users();
	$o_rnt = new Rentable();
	
	$o_rhi_data_in = $o_rhi->RHI_ShowOne();
	$o_users_list = $o_users->CLI_ShowAllForDD();
	
	$o_rnt->id_art_alq = $o_rhi->id_veh_alquilado;
	$o_rnt_list = $o_rnt->RNT_ShowAllForDD();
?>

<html lang=es>
	<head>
		<?php
			include "../../../../../shared/html_head_setup.php";
			include "../../../../../shared/Imports.jQuery_UI.php";
		?>
		
		<link rel=stylesheet href="/admin/res/extras/jquery/ui.dtpick/jquery.datetimepicker.min.css" />
		
		<title><?php echo a_dsb; ?> - <?php echo a_vehman; ?></title>
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
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="/admin/pages/manage/vehicles/"><?php echo a_vehman; ?></a></li>
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="/admin/pages/manage/vehicles/rental/"><?php echo a_hvman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page">Editar</li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0">Editar vehículo</h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						</div>
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
			
			<form method=POST action="./act/SubmitAct.Edit.Rent.php">
				<input type=hidden name=fln_rent_id value=<?php echo "\"$o_rhi_data_in->id_hst_alq\""; ?> />
				
				<div class="input-group input-group-outline">
					<label class=form-label>Inicio del alquiler <?php echo g_snp_reqf ?></label>
					<input class=form-control name=fln_rent_start id=id_field_rent_start value=<?php echo "\"$o_rhi_data_in->momento_alquilado\""; ?> style=<?php echo g_snp_cal; ?> />
				</div>
				
				<div class="input-group input-group-outline">
					<label class=form-label>Fin del alquiler <?php echo g_snp_reqf ?></label>
					<input class=form-control name=fln_rent_end id=id_field_rent_end value=<?php echo "\"$o_rhi_data_in->momento_devolucion\""; ?> style=<?php echo g_snp_cal; ?> />
				</div>
			
				<p>Estado de alquiler<?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<select class=form-control name=fln_rent_status>
						<?php
							include "../../../../../../shared/utils/Utils.Veh_Statuses.php";
							
							while($x < $em){
								if($o_rhi_data_in->estado_alquiler == $x)
									echo "<option value=$x selected>$e[$x]</option>";
								
								else
									echo "<option value=$x>$e[$x]</option>";
								
								$x++;
							}
						?>
					</select>
				</div>
			
				<p>Vehiculo rentado<?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					
					<select class=form-control name=fln_rent_veh>
						<?php
							foreach($o_rnt_list as $rntl){
								$opt = 0;
								
								// We need to check if there are any available vehicles, if not, only returns the vehicle this contract is associated to.
								
								if($rntl->id_art_alq == $o_rhi_data_in->id_veh_alquilado){
									echo "<option value='$rntl->id_art_alq' selected>$rntl->bno $rntl->vmo (Matrícula: $rntl->rlp)</option>";
									$opt++;
								}
								
								if(($rntl->id_art_alq != $o_rhi_data_in->id_veh_alquilado) && $rntl->disponibilidad > 0){
									echo "<option value='$rntl->id_art_alq'>$rntl->vmo $rntl->bno (Matrícula: $rntl->rlp)</option>";
									$opt++;
								}
							}
						?>
					</select>
				</div>
			
				<p>Usuario que alquiló<?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<select class=form-control name=fln_rent_cli>
						<?php
							foreach($o_users_list as $ul){
								if($ul->nro_id_u == $o_rhi_data_in->no_cli)
									echo "<option value='$ul->nro_id_u' selected>$ul->nombre_usuario ($ul->nombre $ul->apellidos)</option>";
								
								else
									echo "<option value='$ul->nro_id_u'>$ul->nombre_usuario ($ul->nombre $ul->apellidos)</option>";
							}
						?>
					</select>
				</div>
				
				<br />
				
				<button class="btn btn-success" type=submit><i class="material-icons opacity-10">autorenew</i> Actualizar registro</button>
			</form>
		</main>
	
		<?php include "../../../../../shared/Imports.Scripts.php"; ?>

		<script src="/shared/extras/jquery/ui/jquery-ui.min.js"></script>
		<script src="/shared/extras/jquery/ui.dtpick/jquery.datetimepicker.full.min.js"></script>

		<script>
			$('#sidebar-choice-5').addClass("active bg-gradient-primary");
			
			$('#id_field_rent_start').datetimepicker({
                changeYear: true,
				format: "Y-m-d H:i:s",
				mask: true,
				scrollTime: true,
				theme: "dark",
				todayButton: true,
				yearRange: "c-100:c+100"
			});
			$('#id_field_rent_end').datetimepicker({
                changeYear: true,
				format: "Y-m-d H:i:s",
				mask: true,
				scrollTime: true,
				theme: "dark",
				todayButton: true,
				yearRange: "c-100:c+100"
			});
		</script>
	</body>
</html>
