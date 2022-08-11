<!DOCTYPE html>

<?php
	if(!$_GET["id_reg"]){
		header("Location:../../");
	}
	
	include "../../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../../shared/Constant_Strings[A].php";
	include "../../../../../../shared/utils/Utils.Common_Strings.php";
	
	$o_rvi = new Registered_Veh_info();
	$o_veh = new Vehicles();
	$o_rvi->id_reg = $_GET["id_reg"];
	
	$o_rvi_data_in = $o_rvi->RVI_ShowOne();
	$o_veh_list = $o_veh->VEH_ShowAllForDD();
?>

<html lang=es>
	<head>
		<?php
			include "../../../../../shared/html_head_setup.php";
		?>
		
		<title><?php echo a_dsb." - ".a_u_reg.$o_rvi->id_reg; ?></title>
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
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="/admin/pages/manage/vehicles/"><?php echo a_regman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_u_reg; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_u_reg.$o_rvi_data_in->id_reg; ?></h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						</div>
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
			
			<form method=POST action="./act/SubmitAct.Edit.RVI.php">
				<input type=hidden name=fln_rvi_edit_id value=<?php echo "\"$o_rvi_data_in->id_reg\""; ?> />
				<p>Color:</p>
				<div class="input-group input-group-outline">
					<input id=id_in_rgb class=form-control name=fln_rvi_edit_color data-jscolor="{preset: 'dark large', closeButton: true, closeText: 'Cerrar', required: false}" value=<?php echo "\"$o_rvi_data_in->color\""; ?>  />
					<a href=# id=id_in_rgb_clear class="btn btn-fill btn-warning"><span class="material-icons opacity-10" title="Sin color">format_color_reset</span></a>
				</div>
				
				<p>Matrícula:</p>
				<div class="input-group input-group-outline">
					<input id=id_field_lp class=form-control name=fln_rvi_edit_lp value=<?php echo "\"$o_rvi_data_in->matricula\""; ?>  />
				</div>
				
				<p>Estado del vehículo <?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<textarea class="form-control" name=fln_rvi_edit_status_act placeholder="Describa como se encuentra el vehículo actualmente."><?php echo "$o_rvi_data_in->estado_act"; ?></textarea>
				</div>
				
				<div class="input-group input-group-outline">
					<label class="form-label">Kilometraje <?php echo g_snp_reqf ?></label>
					<input class="form-control" step=.01 min=0 name=fln_rvi_edit_dist type=number value=<?php echo "\"$o_rvi_data_in->kilometraje_act\""; ?> />
				</div>
				
				<p>¿Es usado? <?php echo g_snp_reqf ?></p>
				<div class="input-group input-group-outline">
					<?php
						if($o_rvi_data_in->usado == 1){
							echo "
								<input type=radio name=fln_rvi_edit_used_flag id=fln_acq_used_1 value=1 checked />
								<label for=fln_acq_used_1>Sí</label> &emsp;
								
								<input type=radio name=fln_rvi_edit_used_flag id=fln_acq_used_0 value=0 />
								<label for=fln_acq_used_0>No</label>
							";
						}
						else{
							echo "
								<input type=radio name=fln_rvi_edit_used_flag id=fln_acq_used_1 value=1 />
								<label for=fln_acq_used_1>Sí</label> &emsp;
								
								<input type=radio name=fln_rvi_edit_used_flag id=fln_acq_used_0 value=0 checked />
								<label for=fln_acq_used_0>No</label>
							";
						}
					?>
					
				</div>
				
				<p>Vehículo <?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<select id=id_sel_model_rvi name=fln_rvi_edit_assocveh class=form-control>
						<?php
							$yfb_str = "";

							foreach($o_veh_list as $ovl){
								if($ovl->anho_fab == 0) $yfb_str = "Año desc.";
								else $yfb_str = $ovl->anho_fab;

								if($ovl->idno == $o_rvi_data_in->vehiculo_asociado)
									echo "<option value='$ovl->idno' selected>$ovl->mno $ovl->modelo ($yfb_str)</option>";

								else
									echo "<option value='$ovl->idno'>$ovl->mno $ovl->modelo ($yfb_str)</option>";
							}
						?>
					</select>
				</div>
				
				<br />
				
				<button class="btn btn-success" type=submit><i class="material-icons opacity-10">autorenew</i> Actualizar registro</button>
			</form>
		</main>
	
		<?php include "../../../../../shared/Imports.Scripts.php"; ?>

		<script src="/shared/extras/jquery/mask/jquery.mask.min.js"></script>
		<script src="/shared/extras/jquery/validation/jquery.validate.min.js"></script>
		<script src="/shared/extras/jscolor/jscolor.min.js"></script>

		<script>
			$('#sidebar-choice-1').addClass("active bg-gradient-primary");
			
			$("#id_field_lp").mask("AAA 0000",{
				placeholder: "AAA 0000"
			});
			$("#id_in_rgb").mask("ZZZZZZZ",{
				translation: {
					"Z": {
						pattern: /[#0-9A-Fa-f]/
					}
				}
			});
				
			$("#id_form_rvi_edit").validate({
				rules:{
					fln_rvi_edit_models: "required"
				},
				messages:{
					fln_rvi_edit_models: "Elija un modelo de vehículo.."
				}
			});

			$("#id_in_rgb_clear").click(function(){
				$("#id_in_rgb").val(null);
			});
		</script>
	</body>
</html>
