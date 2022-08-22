<?php
	include "../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../shared/Constant_Strings[A].php";
	include "../../../../../shared/utils/Utils.Common_Strings.php";

	$o_rvi = new Registered_Veh_Info();
	$o_ccy = new Currencies();
	
	$o_rvi_list = $o_rvi->RVI_ShowAllForDD();
	$o_ccy_list = $o_ccy->CCY_ShowAll();
?>

<!DOCTYPE html>

<html lang=es>
	<head>
		<?php include "../../../../shared/html_head_setup.php"; ?>
		
		<title><?php echo a_dsb." - ".a_n_cli; ?></title>
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
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="/admin/pages/manage/clients/"><?php echo a_climan; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_n_cli; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_n_cli; ?></h6>
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
			
			<p>En esta página podrás registrar nuevos remises.</p>
			
			<p><?php echo g_snp_reqf; ?> = Campos obligatorios.</p>
			
			<form id=id_form_txc_reg method=POST action="../do/act/SubmitAct.New.TXC.php">
				<div class="input-group input-group-outline">
					<label class=form-label>Nombre(s) <?php echo g_snp_reqf; ?></label>
					<input class=form-control name=fln_txc_name />
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Apellido(s) <?php echo g_snp_reqf; ?></label>
					<input class=form-control name=fln_txc_surname />
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Cédula de Identidad <?php echo g_snp_reqf; ?></label>
					<input class=form-control name=fln_txc_uyid id=validate_format_uypid />
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Correo electrónico<?php echo g_snp_reqf; ?></label>
					<input class=form-control name=fln_txc_emailaddr />
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Clave <?php echo g_snp_reqf; ?></label>
					<input type=password class=form-control name=fln_txc_pwd />
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Dirección de residencia</label>
					<input class=form-control name=fln_txc_houseloc />
				</div>
				<p>Teléfono celular:</p>
				<div class="input-group input-group-outline">
					<input class=form-control name=fln_txc_phone_cel id=validate_format_phone_cel />
				</div>
				<p>Teléfono fijo:</p>
				<div class="input-group input-group-outline">
					<input class=form-control name=fln_txc_phone_home id=validate_format_phone_home />
				</div>
				<p>Cuota <?php echo g_snp_reqf; ?>:</p>
				<div class="input-group input-group-outline">
					<input class=form-control name=fln_txc_cost_daily type=number step=.01 /> / día &emsp;
					<input class=form-control name=fln_txc_cost_hwait type=number step=.01 /> / h (espera) &emsp;

					<select class=form-control name=fln_txc_cost_curr>
						<option value="" selected>Seleccione la divisa para ambos valores...</option>
						<?php
							foreach($o_ccy_list as $cl)
								echo "<option value=\"$cl->id_moneda\">$cl->nombre</option>";
						?>
					</select>
				</div>
				<p>Vehículo propietario <?php echo g_snp_reqf; ?>:</p>
				<div class="input-group input-group-outline">
					<select class=form-control name=fln_txc_reg>
						<option value="" selected>Seleccione el vehículo...</option>
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
				
				<br />
				
				<button class="btn btn-success" type=submit><i class="material-icons opacity-10">add_road</i> <?php echo a_n_txc; ?></button>
				<a href="../" class="btn btn-danger"><i class="material-icons opacity-10">clear</i> Cancelar</a>
			</form>
		</main>
	
		<?php include "../../../../shared/Imports.Scripts.php"; ?>

		<script src="/shared/extras/jquery/mask/jquery.mask.min.js"></script>
		<script src="/shared/extras/jquery/validation/jquery.validate.min.js"></script>
		
		<script>
			$('#sidebar-choice-3').addClass("active bg-gradient-primary");
			
			// Masks
			$("#validate_format_uypid").mask("0.000.000-0",{ placeholder: "1.234.567-8" });
			$("#validate_format_phone_cel").mask("000 000 000",{ placeholder: "09X XXX XXX" });
			$("#validate_format_phone_home").mask("0000 0000",{ placeholder: "XXXX XXXX" });
			
			// Validation
			$("#id_form_txc_reg").validate({
				rules:{
					fln_txc_name: "required",
					fln_txc_surname: "required",
					fln_txc_pwd: "required",
					fln_txc_uyid: "required",
					fln_txc_email: "required",
					fln_txc_pwd: "required",
					fln_txc_cost_daily: "required",
					fln_txc_cost_hwait: "required"
				},
				messages:{
					fln_txc_name: "Nombre(s) requerido(s).",
					fln_txc_surname: "Apellido(s) requerido(s).",
					fln_txc_pwd: "Clave requerida.",
					fln_txc_uyid: "Cédula de Identidad requerida.",
					fln_txc_email: "E-mail requerido.",
					fln_txc_pwd: "Cédula de Identidad requerida.",
					fln_txc_cost_daily: "Ingrese la cuota diaria",
					fln_txc_cost_hwait: "Ingrese el costo de espera por hora"
				}
			});
		</script>
	</body>
</html>
