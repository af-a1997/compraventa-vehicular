<?php
	if(!isset($_GET["id_con"]))
		header("Location:../");

	include "../../../../../shared/Utils.Admin.SessionCheck.php";
	include "../../../../../shared/Utils.Admin.Time.php";
	
	include "../../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../../shared/Constant_Strings[A].php";
	include "../../../../../../shared/utils/Utils.Common_Strings.php";
	include "../../../../../../shared/utils/Utils.TxcCon_StatusBdg.php";
	
	$o_con = new Taxicab_Contracts();
	
	$o_con->id_entrada_reg = $_GET["id_con"];
	
	$o_con_info = $o_con->CON_ShowOne();

	$full_name = $o_con_info->tna." ".$o_con_info->tsn;
?>

<!DOCTYPE html>

<html lang=es>
	<head>
		<?php include "../../../../../shared/html_head_setup.php"; ?>
		
		<title><?php echo a_dsb." - ".a_d_con.$full_name; ?></title>
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
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="../"><?php echo a_tcman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_d_con; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php a_d_con.$full_name; ?></h6>
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
			
			<!-- Table with registered vehicles. -->
			<div class="container-fluid py-4">
				<div class="row">
					<div class="col-12">
						<div class="card my-4">
							<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
								<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
									<h6 class="text-white text-capitalize ps-3"><?php echo a_d_con; ?></h6>
								</div>
							</div>
							<div class="card-body px-0 pb-2">
								<?php
									$contract_end_flavor_text = UTC_GenStBadge($o_con_info->tiempo_fin,$cdt);

									if($o_con_info->tiempo_fin != null)
										$contract_end_flavor_text .= " el ".$o_con_info->tiempo_fin;

									echo "
										<ul class=ul_style_elem_details>
											<li><b>Remisero/a:</b> <a href=\"../../do/Details.php?id_txc=$o_con_info->remisero\" target=_blank>$full_name</a></li>
											<li><b>Detalles de instancia de vehículo:</b> <a href=\"../../../vehicles/reg_lp/do/Details.php?id_reg=$o_con_info->rid\">$o_con_info->rid</a></li>
											<li><b>Contratador:</b> <a href=\"../../../clients/do/Details.php?id_cli=$o_con_info->contratador\">$o_con_info->uun</a></li>
											<li><b>Momento de contratación:</b> $o_con_info->tiempo_inicio</li>
											<li><b>Estado del contrato:</b> $contract_end_flavor_text</li>
											<li><b>Cuota diaria en el momento:</b> $o_con_info->pago_diario_contrato $o_con_info->coin</li>
											<li><b>Cuota de espera por hora en el momento:</b> $o_con_info->pago_horario_contrato $o_con_info->coin</li>
											<li><b>Pago final tras finalización del contrato:</b> $o_con_info->pago_total $o_con_info->coin</li>
										</ul>
									";
								?>
							</div>
			
							<button id=id_btn_head_back class="btn btn-success"><i class="material-icons opacity-10">arrow_back</i> Volver a la lista</button>
							<?php
								if($o_con_info->tiempo_fin == null)
									echo "<button id=id_btn_stop_contract class=\"btn btn-danger\"><i class=\"material-icons opacity-10\">stop</i> Detener</button>";
							?>
						</div>
					</div>
				</div>
			</div>
		</main>
	
		<?php include "../../../../../shared/Imports.Scripts.php"; ?>

		<script>
			$().ready(function(){
				$('#sidebar-choice-3').addClass("active bg-gradient-primary");
			});
			
			$("#id_btn_head_back").click(function(){
				location.href = "../";
			});
		</script>
		<?php
			if($o_con_info->tiempo_fin == null)
				echo "
					<script>
						$(\"#id_btn_stop_contract\").click(function(){
							location.href = \"./Finish.php?id_con=".$_GET["id_con"]."\";
						});
					</script>
				";
			// ---
		?>
	</body>
</html>