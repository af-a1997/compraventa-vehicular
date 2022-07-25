<!DOCTYPE html>

<?php
	include "../../../../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../../../../shared/Constant_Strings[A].php";
	include "../../../../../../../shared/Constant_Strings[G].php";
	
	$o_rvi = new Registered_Veh_Info();
	$o_ccy = new Currencies();
	$o_usr = new Users();
	
	$o_rvi_list = $o_rvi->RVI_ShowAllForDD();
	$o_ccy_list = $o_ccy->CCY_ShowAll();
	$o_usr_list = $o_usr->CLI_ShowAllForDD();
?>

<html lang=es>
	<head>
		<?php
			include "../../../../../../../shared/html_head_setup.php";
		?>
		
		<title>Panel de administrador - <?php echo a_artman; ?></title>
	</head>

	<body class="g-sidenav-show bg-gray-600 dark-version">
		<!-- Sidebar -->
		<?php include "../../../../../../../shared/Snippets.Sidebar.php"; ?>
		
		<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
			<!-- Top bar conents -->
			<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
				<div class="container-fluid py-1 px-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="/admin/"><?php echo a_dsb; ?></a></li>
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="/admin/pages/manage/vehicles/"><?php echo a_vehman; ?></a></li>
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="../../../"><?php echo a_artman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page">Añadir vendible</li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_artman; ?></h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						<ul class="navbar-nav justify-content-end ms-md-auto pe-md-3 d-flex align-items-center">
							<?php include "../../../../../../../shared/Snippets.Adm_Logout.php"; ?>
							
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
			
			<p>En esta página podrás registrar nuevos vehículos para vender por parte de un usuario.</p>
			
			<p><?php echo g_snp_reqf ?> = Todos los campos son obligatorios.</p>
			
			<form id=id_form_veh_reg method=POST action="./SubmitAct.New.Slb.php">
				<p>Vehículo a disponibilizar para la venta<?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<select class=form-control name=fln_slb_reg>
						<option value="" selected>Selecciona un vehículo registrado...</option>
						<?php
							$vfb_str = "";

							foreach($o_rvi_list as $orl){
								if($orl->vfb == 0) $vfb_str = "Año desc.";
								else $vfb_str = $orl->vfb;

								echo "<option value='$orl->id_reg'>$orl->bna $orl->vmo ($vfb_str) - Matrícula: $orl->matricula</option>";
							}
						?>
					</select>
				</div>

				<p>Costo al contado<?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<input type=number step=.01 min=0 class=form-control name=fln_slb_dcost />
					<select id=id_brands class=form-control name=fln_slb_dcost_curr>
						<option value="" selected>Selecciona una divisa...</option>
						<?php
							foreach($o_ccy_list as $cl){
								echo "<option value='$cl->id_moneda'>$cl->nombre</option>";
							}
						?>
					</select>
				</div>

				<p>Detalles/descripción sobre el artículo<?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<textarea class=form-control name=fln_slb_details></textarea>
				</div>

				<p>Vendedor<?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<select id=id_brands class=form-control name=fln_slb_seller>
						<option value="" selected>Selecciona un vendedor...</option>
						<?php
							foreach($o_usr_list as $oul){
								echo "<option value='$oul->nro_id_u'>$oul->nombre $oul->apellidos ($oul->nombre_usuario)</option>";
							}
						?>
					</select>
				</div>
				
				<br />
				
				<button class="btn btn-success" type=submit><i class="material-icons opacity-10">add_box</i> Registrar vendible</button>
			</form>
		</main>
	
		<?php include "../../../../../../../shared/Imports.Scripts.php"; ?>

		<script src="../../../../../../../res/extras/jquery/mask/jquery.mask.min.js"></script>
		<script src="../../../../../../../res/extras/jquery/validation/jquery.validate.min.js"></script>
		
		<script>
			$('#sidebar-choice-4').addClass("active bg-gradient-primary");
			
			$('#id_veh_yfab_unknown').click(function(){
				$('#id_veh_yfab').val(null);
			});
			
			$().ready(function(){
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
						fln_slb_reg: {
							required: true
						},
						fln_slb_availst: {
							required: true
						},
						fln_slb_dcost: {
							required: true
						},
						fln_slb_cost_curr: {
							required: true
						}
					},
					messages:{
						fln_slb_reg: "Especifique el vehículo registrado.",
						fln_slb_availst: "Especifique el estado de disponiblidad.",
						fln_slb_dcost: "Especifique el costo diario del alquiler.",
						fln_slb_cost_curr: "Especifique la moneda del costo diario."
					}
				});
			});
		</script>
	</body>
</html>
