<!DOCTYPE html>

<?php
	if(!$_GET["id_slb"]){
		header("Location:../../");
	}

	include "../../../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../../../shared/Constant_Strings[A].php";
	include "../../../../../../../shared/utils/Utils.Common_Strings.php";
	
	$o_slb = new Sellable();
	$o_rvi = new Registered_Veh_Info();
	$o_ccy = new Currencies();
	$o_sll = new Users();

	$o_slb->id_art_venta = $_GET["id_slb"];
	
	$o_slb_data_in = $o_slb->ART_ShowOne();
	$o_rvi_list = $o_rvi->RVI_ShowAllForDD();
	$o_ccy_list = $o_ccy->CCY_ShowAll();
	$o_sll_list = $o_sll->CLI_ShowAllForDD();

	if($o_slb_data_in->vfb == 0)
		$year_fab = "Año desc.";

	else
		$year_fab = $o_slb_data_in->vfb;
	
	$full_model = "$o_slb_data_in->bno $o_slb_data_in->vmo ($year_fab)";
?>

<html lang=es>
	<head>
		<?php include "../../../../../../shared/html_head_setup.php"; ?>
		
		<title><?php echo a_dsb." - ".a_u_slb.$full_model; ?></title>
	</head>

	<body class="g-sidenav-show bg-gray-600 dark-version">
		<!-- Sidebar -->
		<?php include "../../../../../../shared/Snippets.Sidebar.php"; ?>
		
		<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
			<!-- Top bar conents -->
			<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
				<div class="container-fluid py-1 px-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="/admin/"><?php echo a_dsb; ?></a></li>
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="/admin/pages/manage/vehicles/"><?php echo a_vehman; ?></a></li>
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="../../../"></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_u_slb; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_u_slb.$full_model; ?></h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						</div>
						<ul class="navbar-nav justify-content-end ms-md-auto pe-md-3 d-flex align-items-center">
							<?php include "../../../../../../shared/Snippets.Adm_Logout.php"; ?>
							
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

			<p>Ajusta aquí los datos del vehículo &laquo;<?php echo $full_model; ?>&raquo; en venta, publicado por <?php echo "<a href=\"../../../../clients/do/Details.php?id_cli=$o_slb_data_in->vendedor\">$o_slb_data_in->uno</a>"; ?> el <span style="color: #fcc;"><?php echo $o_slb_data_in->momento_pub; ?></span>.</p>
			
			<p><?php echo g_snp_reqf; ?> = Todos los campos son obligatorios.</p>
			
			<form id=id_form_rnt_upd method=POST action="./act/SubmitAct.Edit.Slb.php">
				<input type=hidden name=fln_slb_id value=<?php echo "\"$o_slb_data_in->id_art_venta\""; ?> />

				<p>Vehículo a disponibilizar para la venta<?php echo g_snp_reqf; ?>:</p>
				<div class="input-group input-group-outline">
					<select class=form-control name=fln_slb_reg>
						<?php
							$vfb_str = "";

							foreach($o_rvi_list as $orl){
								if($orl->vfb == 0) $vfb_str = "Año desc.";
								else $vfb_str = $orl->vfb;

								if($orl->id_reg == $o_slb_data_in->id_reg_veh)
									echo "<option value='$orl->id_reg' selected>$orl->bna $orl->vmo ($vfb_str) - Matrícula: $orl->matricula</option>";

								else
									echo "<option value='$orl->id_reg'>$orl->bna $orl->vmo ($vfb_str) - Matrícula: $orl->matricula</option>";
							}
						?>
					</select>
				</div>

				<br />
				<div class="alert alert-warning" role=alert>Si el vehículo a vender no está registrado con su matrícula, <a href="../../../../reg_lp/new/">primero debes agregarlo aquí</a>.</div>

				<p>Detalles<?php echo g_snp_reqf; ?>:</p>
				<div class="input-group input-group-outline">
					<textarea class=form-control name=fln_slb_details><?php echo $o_slb_data_in->detalles; ?></textarea>
				</div>

				<p>Costo al contado<?php echo g_snp_reqf; ?>:</p>
				<div class="input-group input-group-outline">
					<input type=number step=.01 min=0 class=form-control name=fln_slb_cost value=<?php echo "\"$o_slb_data_in->valor_venta\""; ?> />
					<select class=form-control name=fln_slb_cost_curr>
						<?php
							foreach($o_ccy_list as $cl){
								if($cl->id_moneda == $o_slb_data_in->id_divisa)
									echo "<option value='$cl->id_moneda' selected>$cl->nombre</option>";

								else
									echo "<option value='$cl->id_moneda'>$cl->nombre</option>";
							}
						?>
					</select>
				</div>

				<p>Vendedor<?php echo g_snp_reqf; ?>:</p>
				<div class="input-group input-group-outline">
					<select class=form-control name=fln_slb_seller>
						<?php
							foreach($o_sll_list as $sl){
								if($sl->nro_id_u == $o_slb_data_in->vendedor)
									echo "<option value='$sl->nro_id_u' selected>$sl->nombre $sl->apellidos ($sl->nombre_usuario)</option>";

								else
									echo "<option value='$sl->nro_id_u'>$sl->nombre $sl->apellidos ($sl->nombre_usuario)</option>";
							}
						?>
					</select>
				</div>
				
				<br />
				
				<button class="btn btn-success" type=submit><i class="material-icons opacity-10">autorenew</i> Actualizar vendible</button>
			</form>
		</main>
	
		<?php include "../../../../../../shared/Imports.Scripts.php"; ?>

		<script>
			$('#sidebar-choice-4').addClass("active bg-gradient-primary");
		</script>
	</body>
</html>
