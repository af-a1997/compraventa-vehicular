<!DOCTYPE html>

<?php
	if(!$_GET["id_rnt"]){
		header("Location:../../../");
	}

	include "../../../../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../../../../shared/Constant_Strings[A].php";
	include "../../../../../../../shared/Constant_Strings[G].php";
	
	$o_rnt = new Rentable();
	$o_rvi = new Registered_Veh_Info();
	$o_ccy = new Currencies();

	$o_rnt->id_art_alq = $_GET["id_rnt"];
	
	$o_rnt_data_in = $o_rnt->RNT_ShowOne();
	$o_rvi_list = $o_rvi->RVI_ShowAllForDD();
	$o_ccy_list = $o_ccy->CCY_ShowAll();
?>

<html lang=es>
	<head>
		<?php
			include "../../../../../../../shared/html_head_setup.php";
		?>
		
		<title>Panel de administrador - <?php echo a_vehman; ?></title>
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
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="../../../"><?php echo a_haman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page">Editar</li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0">Editar vehículo alquilable</h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						</div>
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
			
			<p><?php echo g_snp_reqf ?> = Todos los campos son obligatorios.</p>
			
			<form id=id_form_rnt_upd method=POST action="./SubmitAct.Edit.Rnt.php">
				<input type=hidden name=fln_rnt_id value=<?php echo "\"$o_rnt_data_in->id_art_alq\""; ?> />

				<p>Vehículo a disponibilizar para alquiler<?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<select class=form-control name=fln_rnt_reg>
						<?php
							$vfb_str = "";

							foreach($o_rvi_list as $orl){
								if($orl->vfb == 0) $vfb_str = "Año desc.";
								else $vfb_str = $orl->vfb;

								if($orl->id_reg == $o_rnt_data_in->id_reg_veh)
									echo "<option value='$orl->id_reg' selected>$orl->bna $orl->vmo ($vfb_str) - Matrícula: $orl->matricula</option>";

								else
									echo "<option value='$orl->id_reg'>$orl->bna $orl->vmo ($vfb_str) - Matrícula: $orl->matricula</option>";
							}
						?>
					</select>
				</div>

				<p>Estado de disponibilidad<?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<select class=form-control name=fln_rnt_availst>
						<?php
							include "../../../../../../../../shared/utils/Utils.Veh_Statuses.php";
							
							while($x < $em){
								if($x == $o_rnt_data_in->disponibilidad)
									echo "<option value=$x selected>$e[$x]</option>";
								else
									echo "<option value=$x>$e[$x]</option>";
								
								$x++;
							}
						?>
					</select>
				</div>

				<p>Cuota diaria<?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<input type=number step=.01 min=0 class=form-control name=fln_rnt_dcost value=<?php echo "\"$o_rnt_data_in->valor_diario_alq\""; ?> />
					<select id=id_sel_dcost_curr class=form-control name=fln_rnt_dcost_curr>
						<?php
							foreach($o_ccy_list as $cl){
								if($cl->id_moneda == $o_rnt_data_in->id_divisa)
									echo "<option value='$cl->id_moneda' selected>$cl->nombre</option>";

								else
									echo "<option value='$cl->id_moneda'>$cl->nombre</option>";
							}
						?>
					</select>
				</div>
				
				<br />
				
				<button class="btn btn-success" type=submit><i class="material-icons opacity-10">autorenew</i> Actualizar alquilable</button>
			</form>
		</main>
	
		<?php include "../../../../../../../shared/Imports.Scripts.php"; ?>

		<script>
			$('#sidebar-choice-4').addClass("active bg-gradient-primary");
		</script>
	</body>
</html>
