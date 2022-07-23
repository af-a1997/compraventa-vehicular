<!DOCTYPE html>

<?php
	include "../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../shared/Constant_Strings[A].php";
	include "../../../../shared/Constant_Strings[G].php";
	
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
		
		<title>Panel de administrador - <?php echo a_n_acq; ?></title>
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
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="/admin/pages/manage/purchase_history/"><?php echo a_purchase_history; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_n_acq; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_n_acq; ?></h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						<div class="ms-md-auto pe-md-3 d-flex align-items-center">
							<div class="input-group input-group-outline">
								<label class="form-label">Buscar en el panel</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<ul class="navbar-nav justify-content-end">
							<li class="nav-item d-flex align-items-center">
								<a href="../../../../../login/admin/act/Logout.php" class="nav-link text-body font-weight-bold px-0">
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
			
			<p>Aquí se registran adquisiciones de vehículos por parte de la empresa, si la marca y modelo del vehículo que adquirió no está listada abajo, es porque no se registró, primero regístrala <a href="../../vehicles/new/">aquí</a>.</p>
			
			<p><?php echo g_snp_reqf ?> = Campos obligatorios.</p>
			
			<form id=id_form_acqreg method=POST action="./SubmitAct.New.Acq.php">
				<p>Color:</p>
				<div class="input-group input-group-outline">
					<input class="form-control" name=fln_veh_color data-jscolor="{preset: 'dark large', closeButton: true, closeText: 'Cerrar', required: false}" />
				</div>
				
				<p>Matrícula:</p>
				<div class="input-group input-group-outline">
					<input id=id_field_lp class=form-control name=fln_veh_lp />
				</div>
				
				<p>Estado del vehículo <?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<textarea class="form-control" name=fln_veh_status_acq placeholder="Describa como se encontraba el vehículo al momento de su adquisición." required></textarea>
				</div>
				
				<div class="input-group input-group-outline">
					<label class="form-label">Kilometraje <?php echo g_snp_reqf ?></label>
					<input class="form-control" step=.01 min=0 name=fln_acq_dist type=number required />
				</div>
				
				<p>¿Es usado? <?php echo g_snp_reqf ?></p>
				<div class="input-group input-group-outline">
					<input type=radio name=fln_acq_used id=fln_acq_used_1 value=1 />
					<label for=fln_acq_used_1 required>Sí</label> &emsp;
					
					<input type=radio name=fln_acq_used id=fln_acq_used_0 value=0 />
					<label for=fln_acq_used_0>No</label>
				</div>
				
				<p>Transmisión <?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<input type=radio name=fln_acq_tr id=fln_acq_tr_a_id value="Automática" required />
					<label for=fln_acq_tr_a>Automática</label> &emsp;
					
					<input type=radio name=fln_acq_tr id=fln_acq_tr_m_id value="Manual" />
					<label for=fln_acq_tr_m>Manual</label>
				</div>
				
				<div class="input-group input-group-outline">
					<label class="form-label">Combustible <?php echo g_snp_reqf ?></label>
					<input class="form-control" name=fln_veh_fuel required />*
				</div>
				
				<div class="input-group input-group-outline">
					<label class="form-label">Motor <?php echo g_snp_reqf ?></label>
					<input class="form-control" name=fln_veh_eng required />
				</div>
				
				<p>Precio <?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<input class=form-control style="width: 75%;" name=fln_veh_cost required />
					<select id=id_brands name=fln_veh_cost_curr class=form-control style="width: 20%;" required>
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
					<select id=id_brands name=fln_veh_models class="form-control" required>
						<option value="" selected>Selecciona un vehículo</option>
						<?php
							foreach($veh_list as $vl){
								echo "<option value='$vl->idno'>$vl->mno $vl->modelo</option>";
							}
						?>
					</select>
				</div>
				
				<br />
				
				<button class="btn btn-success" type=submit>Registrar compra</button>
			</form>
		</main>
	
		<?php include "../../../../shared/Imports.Scripts.php"; ?>

		<script src="../../../../res/extras/jscolor/jscolor.min.js"></script>
		<script src="../../../../res/extras/jquery/mask/jquery.mask.min.js"></script>
		
		<script>
			$('#sidebar-choice-6').addClass("active bg-gradient-primary");
			
			$(document).ready(function(){
				$("#id_field_lp").mask("AAA 0000",{
					placeholder: "ABC 1234"
				});
			});
		</script>
	</body>
</html>
