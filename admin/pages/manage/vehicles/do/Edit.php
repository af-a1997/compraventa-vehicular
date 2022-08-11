<!DOCTYPE html>

<?php
	include "../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../shared/Constant_Strings[A].php";
	include "../../../../../shared/utils/Utils.Common_Strings.php";
	
	$o_veh = new Vehicles();
	$o_veh->idno = $_GET["id_veh"];
	
	$o_vcat = new Veh_Cat();
	$o_brands = new Brands();
	
	$o_veh_data_in = $o_veh->VEH_ShowOne();
	$o_vcat_list = $o_vcat->VCAT_ShowAll();
	$o_brands_list = $o_brands->BRAND_ShowAll();
	
	$year_fab = "";
	if($o_veh_data_in->anho_fab == 0)
		$year_fab = "Año desc.";

	else
		$year_fab = $o_veh_data_in->anho_fab;
	$full_model = "$o_veh_data_in->mno $o_veh_data_in->modelo ($year_fab)";
?>

<html lang=es>
	<head>
		<?php
			include "../../../../shared/html_head_setup.php";
			include "../../../../shared/Imports.jQuery_UI.php";
		?>
		
		<title><?php echo a_dsb." - ".a_u_veh.$full_model; ?></title>
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
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="/admin/pages/manage/vehicles/"><?php echo a_vehman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_u_veh; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_dsb." - ".a_u_veh.$full_model; ?></h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						</div>
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
			
			<form method=POST action="./act/SubmitAct.Edit.Veh.php">
				<input type=hidden name=fln_veh_id value=<?php echo "\"$o_veh_data_in->idno\""; ?> />
			
				<p>Tipo<?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<select class=form-control name=fln_veh_type>
						<?php
							foreach($o_vcat_list as $vcatl){
								if($vcatl->id_tipo == $o_veh_data_in->categorizacion)
									echo "<option value='$vcatl->id_tipo' selected>$vcatl->nombre</option>";
								
								else
									echo "<option value='$vcatl->id_tipo'>$vcatl->nombre</option>";
							}
						?>
					</select>
				</div>
				<p>Marca<?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<select class=form-control name=fln_veh_brand>
						<?php
							foreach($o_brands_list as $bl){
								if($bl->idno == $o_veh_data_in->marca)
									echo "<option value='$bl->idno' selected>$bl->nombre</option>";
								
								else
									echo "<option value='$bl->idno'>$bl->nombre</option>";
							}
						?>
					</select>
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Modelo <?php echo g_snp_reqf ?></label>
					<input class=form-control name=fln_veh_model value=<?php echo "\"$o_veh_data_in->modelo\""; ?> />
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Stock</label>
					<input class=form-control name=fln_veh_stock type=number min=1 value=<?php echo "\"$o_veh_data_in->unidades\""; ?> />
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Año de fabricación</label>
					<input class=form-control id=id_veh_yfab name=fln_veh_yfab value=<?php echo "\"$o_veh_data_in->anho_fab\""; ?> />
					
					<a class="btn btn-warning" id=id_yfab_unk href=#>Año desconocido</a>
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Puertas</label>
					<input class=form-control name=fln_veh_doors type=number min=1 value=<?php echo "\"$o_veh_data_in->puertas\""; ?> />
				</div>
				<p>Transmisión:</p>
				<div class="input-group input-group-outline">
					<?php
						if($o_veh_data_in->transmision == 0){
							echo "
								<input type=radio name=fln_veh_tr value=1 />
								<label for=fln_acq_tr_a>Automática</label> &emsp;
								
								<input type=radio name=fln_veh_tr value=0 checked />
								<label for=fln_acq_tr_m>Manual</label>
							";
						}
						else if($o_veh_data_in->transmision == 1){
							echo "
								<input type=radio name=fln_veh_tr value=1 checked />
								<label for=fln_acq_tr_a>Automática</label> &emsp;
								
								<input type=radio name=fln_veh_tr value=0 />
								<label for=fln_acq_tr_m>Manual</label>
							";
						}
						else{
							echo "
								<input type=radio name=fln_veh_tr value=1 />
								<label for=fln_acq_tr_a>Automática</label> &emsp;
								
								<input type=radio name=fln_veh_tr value=0 />
								<label for=fln_acq_tr_m>Manual</label>
							";
						}
					?>
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Tipo de combustible</label>
					<input class=form-control name=fln_veh_ft value=<?php echo "\"$o_veh_data_in->combustible_tipo\""; ?> />
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Capacidad para combustible</label>
					<input class=form-control name=fln_veh_fc step=.01 type=number min=0 value=<?php echo "\"$o_veh_data_in->combustible_capac\""; ?> />
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Motor</label>
					<input class=form-control name=fln_veh_eng value=<?php echo "\"$o_veh_data_in->motor\""; ?> />
				</div>
				
				<br />
				
				<button class="btn btn-success" type=submit><i class="material-icons opacity-10">autorenew</i> Actualizar vehículo</button>
				<a href="../" class="btn btn-danger"><i class="material-icons opacity-10">clear</i> Cancelar</a>
			</form>
		</main>
	
		<?php include "../../../../shared/Imports.Scripts.php"; ?>

		<script src="/shared/extras/jquery/ui/jquery-ui.min.js"></script>
		<script src="/shared/extras/jquery/validation/jquery.validate.min.js"></script>

		<script>
			$('#sidebar-choice-1').addClass("active bg-gradient-primary");

			// Assigns value "0" to fabrication year field, in the case it is not known.
			$('#id_yfab_unk').click(function(){
				$('#id_veh_yfab').val("0");
			});
			
			// To make jQuery UI's datepicker pick only years. Code from: https://stackoverflow.com/questions/13528623/jquery-ui-datepicker-to-show-year-only
			$('#id_veh_yfab').datepicker({
                changeYear: true,
                dateFormat: 'yy',
                onClose: function(dateText, inst) { 
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, 1));
                },
                showButtonPanel: true,
				yearRange: "1800:c+0"
			});
			$("#id_veh_yfab").focus(function(){
				$(".ui-datepicker-month").hide();
				$(".ui-datepicker-calendar").css("visibility", "hidden");
			});
			
			// Code to show only year in datepicker ends here.
			
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
		</script>
	</body>
</html>
