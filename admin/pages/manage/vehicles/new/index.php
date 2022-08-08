<!DOCTYPE html>

<?php
	include "../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../shared/Constant_Strings[A].php";
	include "../../../../../shared/utils/Utils.Common_Strings.php";
	
	$o_brands = new Brands();
	$o_vcat = new Veh_Cat();
	
	$o_brands_list = $o_brands->BRAND_ShowAll();
	$o_vcat_list = $o_vcat->VCAT_ShowAll();
?>

<html lang=es>
	<head>
		<?php
			include "../../../../shared/html_head_setup.php";
			include "../../../../shared/Imports.jQuery_UI.php";
		?>
		
		<title><?php echo a_dsb; ?> - <?php echo a_n_veh; ?></title>
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
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="../"><?php echo a_vehman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_n_veh; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_n_veh; ?></h6>
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
			
			<p>En esta página podrás registrar nuevos vehículos.</p>
			
			<p><?php echo g_snp_reqf ?> = Campos obligatorios.</p>
			
			<form id=id_form_veh_reg method=POST action="./SubmitAct.New.Veh.php">
				<p>Tipo<?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<select class=form-control name=fln_veh_type>
						<option value="" selected>Selecciona un tipo de vehículo...</option>
						<?php
							foreach($o_vcat_list as $vcatl){
								echo "<option value='$vcatl->id_tipo'>$vcatl->nombre</option>";
							}
						?>
					</select>
				</div>
				<p>Marca<?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<select class=form-control name=fln_veh_brand>
						<option value="" selected>Selecciona la marca del fabricante...</option>
						<?php
							foreach($o_brands_list as $bl){
								echo "<option value='$bl->idno'>$bl->nombre</option>";
							}
						?>
					</select>
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Modelo <?php echo g_snp_reqf ?></label>
					<input class=form-control name=fln_veh_model />
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Stock</label>
					<input class=form-control name=fln_veh_stock type=number min=1 value=1 />
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Año de fabricación</label>
					<input class=form-control id=id_veh_yfab name=fln_veh_yfab />
					
					<a class="btn btn-warning" id=id_yfab_unk href=#>Año desconocido</a>
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Puertas</label>
					<input class=form-control name=fln_veh_doors type=number min=1 value=1 />
				</div>
				<p>Transmisión:</p>
				<div class="input-group input-group-outline">
					<input type=radio name=fln_veh_tr value=1 />
					<label for=fln_acq_tr_a>Automática</label> &emsp;
					
					<input type=radio name=fln_veh_tr value=0 />
					<label for=fln_acq_tr_m>Manual</label>
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Tipo de combustible</label>
					<input class=form-control name=fln_veh_ft />
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Capacidad para combustible</label>
					<input class=form-control name=fln_veh_fc step=.01 type=number min=0 />
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Motor</label>
					<input class=form-control name=fln_veh_eng />
				</div>
				
				<br />
				
				<button class="btn btn-success" type=submit><i class="material-icons opacity-10">add_box</i> Registrar vehículo</button>
			</form>
		</main>
	
		<?php include "../../../../shared/Imports.Scripts.php"; ?>

		<script src="/shared/extras/jquery/mask/jquery.mask.min.js"></script>
		<script src="/shared/extras/jquery/validation/jquery.validate.min.js"></script>
		
		<script>
			$('#sidebar-choice-1').addClass("active bg-gradient-primary");
			
			$().ready(function(){
				$('#id_yfab_unk').click(function(){
					$('#id_veh_yfab').val("0");
				});
				
				// Masks
				$("#id_veh_yfab").mask("0000");
				$("#validate_format_phone_cel").mask("000 000 000",{
					placeholder: "09X XXX XXX"
				});
				$("#validate_format_phone_home").mask("0000 0000",{
					placeholder: "XXXX XXXX"
				});
				
				// Validation
				
				$("#id_form_veh_reg").validate({
					rules:{
						fln_veh_type: "required",
						fln_veh_brand: "required",
						fln_veh_model: "required"
					},
					messages:{
						fln_veh_type: "Especifique el tipo de vehículo.",
						fln_veh_brand: "Especifique la marca del vehículo.",
						fln_veh_model: "Especifique el modelo del vehículo."
					}
				});
			});
		</script>
	</body>
</html>
