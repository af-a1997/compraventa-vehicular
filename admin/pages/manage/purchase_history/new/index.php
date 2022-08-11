<!DOCTYPE html>

<?php
	include "../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../shared/Constant_Strings[A].php";
	include "../../../../../shared/utils/Utils.Common_Strings.php";
	
	include "../../../../classes/Utils_ClassLoader.class.php";
	
	$ccy_inst = new Currencies();
	$brands_inst = new Brands();
	$veh_inst = new Vehicles();
	
	$ccy_list = $ccy_inst->CCY_ShowAll();
	$brands_list = $brands_inst->BRAND_ShowAll();
	$veh_list = $veh_inst->VEH_ShowAllForDD();
?>

<html lang=es>
	<head>
		<?php
			include "../../../../shared/html_head_setup.php";
			include "../../../../shared/Imports.jQuery_UI.php";
		?>
		
		<link rel=stylesheet href="/shared/extras/jquery/ui.dtpick/jquery.datetimepicker.min.css" />
		
		<title><?php echo a_dsb." - ".a_n_acq; ?></title>
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
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="../"><?php echo a_phman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_n_acq; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_n_acq; ?></h6>
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
			
			<br />
			
			<p>Aquí se registran adquisiciones de vehículos por parte de la empresa, si la marca y modelo del vehículo que adquirió no está listada abajo, es porque no se registró, primero regístrala <a href="../../vehicles/new/">aquí</a>.</p>
			
			<p><?php echo g_snp_reqf ?> = Campos obligatorios.</p>
			
			<form id=id_form_acq_reg method=POST action="./SubmitAct.New.Acq.php">
				<p>Color:</p>
				<div class="input-group input-group-outline">
					<input id=id_field_rgb class="form-control" name=fln_veh_color data-jscolor="{preset: 'dark large', closeButton: true, closeText: 'Cerrar', required: false}" placeholder="Elija el color" />
				</div>
				
				<p>Matrícula:</p>
				<div class="input-group input-group-outline">
					<input id=id_field_lp class=form-control name=fln_veh_lp />
				</div>
				
				<p>Estado del vehículo <?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<textarea class="form-control" name=fln_veh_status_acq placeholder="Describa como se encontraba el vehículo al momento de su adquisición."></textarea>
				</div>
				
				<div class="input-group input-group-outline">
					<label class="form-label">Kilometraje <?php echo g_snp_reqf ?></label>
					<input class="form-control" step=.01 min=0 name=fln_acq_dist type=number />
				</div>
				
				<p>¿Es usado? <?php echo g_snp_reqf ?></p>
				<div class="input-group input-group-outline">
					<input type=radio name=fln_acq_used id=fln_acq_used_1 value=1 />
					<label for=fln_acq_used_1>Sí</label> &emsp;
					
					<input type=radio name=fln_acq_used id=fln_acq_used_0 value=0 />
					<label for=fln_acq_used_0>No</label>
				</div>
				
				<p>Precio <?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<input class=form-control name=fln_veh_cost />
					<select class=form-control name=fln_veh_cost_curr />
						<option value="" selected>Selecciona una divisa</option>
						<?php
							foreach($ccy_list as $cl){
								echo "<option value='$cl->id_moneda'>$cl->nombre</option>";
							}
						?>
					</select>
				</div>
				
				<p>Vehículo <?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<select name=fln_veh_models class=form-control>
						<option value="" selected>Selecciona un vehículo</option>
						<?php
							foreach($veh_list as $vl){
								echo "<option value='$vl->idno'>$vl->mno $vl->modelo</option>";
							}
						?>
					</select>
				</div>
				
				<p>Fecha y hora de adquisición <?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<input id=id_acq_timestamp class=form-control name=fln_acq_timestamp />
					
					<a class="btn btn-warning" id=id_acq_now href=#>Ahora</a>
				</div>
				
				<br />
				
				<button class="btn btn-success" type=submit><i class="material-icons opacity-10">more_time</i> Registrar adquisición</button>
			</form>
		</main>
	
		<?php include "../../../../shared/Imports.Scripts.php"; ?>

		<script src="/shared/extras/jquery/ui/jquery-ui.min.js"></script>
		<script src="/shared/extras/jquery/ui.dtpick/jquery.datetimepicker.full.min.js"></script>
		<script src="/shared/extras/jquery/mask/jquery.mask.min.js"></script>
		<script src="/shared/extras/jquery/validation/jquery.validate.min.js"></script>
		<script src="/shared/extras/jscolor/jscolor.min.js"></script>
		
		<script>
			$('#sidebar-choice-6').addClass("active bg-gradient-primary");

			$('#id_acq_now').click(function(){
				$('#id_acq_timestamp').val(null);
			});
			
			$('#id_acq_timestamp').datetimepicker({
                changeYear: true,
				format: "Y-m-d H:i:s",
				mask: true,
				scrollTime: true,
				theme: "dark",
				todayButton: true,
				yearRange: "1800:c+0"
			});
			
			$("#id_field_lp").mask("AAA 0000",{ placeholder: "ABC 1234" });
			
			$("#id_form_acq_reg").validate({
				rules:{
					fln_veh_status_acq: "required",
					fln_acq_dist: "required",
					fln_acq_used: "required",
					fln_veh_cost: "required",
					fln_veh_cost_curr: "required",
					fln_veh_models: "required"
				},
				messages:{
					fln_veh_status_acq: "Describa el estado del vehículo cuando fue adquirido.",
					fln_acq_dist: "Ingrese el kilometraje.",
					fln_acq_used: "Indique si el vehículo es usado.",
					fln_veh_cost: "Ingrese el costo",
					fln_veh_cost_curr: "Elija la divisa del costo",
					fln_veh_models: "Busque el vehículo adquirido"
				}
			});
		</script>
	</body>
</html>