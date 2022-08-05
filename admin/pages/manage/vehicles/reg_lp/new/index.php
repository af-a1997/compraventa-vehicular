<!DOCTYPE html>

<?php
	include "../../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../../shared/Constant_Strings[A].php";
	include "../../../../../../shared/utils/Utils.Common_Strings.php";
	
	$o_veh = new Vehicles();
	
	$o_veh_list = $o_veh->VEH_ShowAllForDD();
?>

<html lang=es>
	<head>
		<?php
			include "../../../../../shared/html_head_setup.php";
		?>
		
		<title>Panel de administrador - <?php echo a_n_veh; ?></title>
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
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="../"><?php echo a_vehman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_n_veh; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_n_veh; ?></h6>
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
			
			<br />
			
			<p>En esta página podrás crear registros identificadores de vehículos, con sus propiedades únicas como color y matrícula.</p>
			
			<p><?php echo g_snp_reqf ?> = Campos obligatorios.</p>
			
			<form id=id_form_rvi_reg method=POST action="./SubmitAct.New.RVI.php">
				<p>Color:</p>
				<div class="input-group input-group-outline">
					<input id=id_in_rgb class=form-control name=fln_rvi_color data-jscolor="{preset: 'dark large', closeButton: true, closeText: 'Cerrar', required: false}" />
					<a href=# id=id_in_rgb_clear class="btn btn-fill btn-warning"><span class="material-icons opacity-10" title="Sin color">format_color_reset</span></a>
				</div>
				
				<p>Matrícula:</p>
				<div class="input-group input-group-outline">
					<input id=id_field_lp class=form-control name=fln_rvi_lp />
				</div>
				
				<p>Estado del vehículo <?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<textarea class="form-control" name=fln_rvi_status_act placeholder="Describa como se encuentra el vehículo actualmente."></textarea>
				</div>
				
				<div class="input-group input-group-outline">
					<label class="form-label">Kilometraje <?php echo g_snp_reqf ?></label>
					<input class="form-control" step=.01 min=0 name=fln_rvi_dist type=number />
				</div>
				
				<p>¿Es usado? <?php echo g_snp_reqf ?></p>
				<div class="input-group input-group-outline">
					<input type=radio name=fln_rvi_used_flag id=fln_acq_used_1 value=1 />
					<label for=fln_acq_used_1>Sí</label> &emsp;
					
					<input type=radio name=fln_rvi_used_flag id=fln_acq_used_0 value=0 />
					<label for=fln_acq_used_0>No</label>
				</div>
				
				<p>Vehículo <?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<select id=id_brands name=fln_rvi_models class=form-control>
						<option value="" selected>Selecciona un vehículo</option>
						<?php
							$yfb_str = "";

							foreach($o_veh_list as $ovl){
								if($ovl->anho_fab == 0) $yfb_str = "Año desc.";
								else $yfb_str = $ovl->anho_fab;

								echo "<option value='$ovl->idno'>$ovl->mno $ovl->modelo ($yfb_str)</option>";
							}
						?>
					</select>
				</div>
				
				<br />
				
				<button class="btn btn-success" type=submit><i class="material-icons opacity-10">add_box</i> Registrar información</button>
			</form>
		</main>
	
		<?php include "../../../../../shared/Imports.Scripts.php"; ?>

		<script src="/shared/extras/jquery/mask/jquery.mask.min.js"></script>
		<script src="/shared/extras/jquery/validation/jquery.validate.min.js"></script>
		<script src="/shared/extras/jscolor/jscolor.min.js"></script>
		
		<script>
			$('#sidebar-choice-1').addClass("active bg-gradient-primary");
			
			$('#id_in_rgb_clear').click(function(){
				$('#id_in_rgb').val("");
			});
			
			$().ready(function(){
				// Masks
				$("#id_in_rgb").mask("ZZZZZZZ",{
					translation: {
						"Z": {
							pattern: /[#0-9A-Fa-f]/
						}
					}
				}); // Pattern from: < https://regexr.com/2rhm3 >, I adapted it to work on jQuery Mask.
				$("#id_field_lp").mask("AAA 0000", {
					placeholder: "ABC 1234"
				});
				
				// Validation
				$("#id_form_rvi_reg").validate({
					rules:{
						fln_rvi_models: "required"
					},
					messages:{
						fln_rvi_models: "Seleccione el vehículo asociado a este registro."
					}
				});
			});
		</script>
	</body>
</html>
