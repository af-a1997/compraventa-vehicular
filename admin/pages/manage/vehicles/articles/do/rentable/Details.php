<?php
	if(!isset($_GET["id_rnt"]))
		header("Location:../../");

	include "../../../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../../../shared/Constant_Strings[A].php";
	include "../../../../../../../shared/utils/Utils.Common_Strings.php";
	
	$o_rnt = new Rentable();
	
	$o_rnt->id_art_alq = $_GET["id_rnt"];
	
	$o_rnt_details = $o_rnt->RNT_ShowOne();

	if($o_rnt_details->vfb == 0)
		$year_fab = "Año desc.";

	else
		$year_fab = $o_rnt_details->vfb;
	
	$full_model = "$o_rnt_details->bno $o_rnt_details->vmo ($year_fab)";
?>

<!DOCTYPE html>

<html lang=es>
	<head>
		<?php include "../../../../../../shared/html_head_setup.php"; ?>
		
		<title><?php echo a_dsb." - ".a_d_rnt.$full_model; ?></title>
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
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="../"><?php echo a_vehman; ?></a></li>
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="../"><?php echo a_haman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_d_rnt; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_d_rnt.$full_model; ?></h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
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
			
			<?php
				$units_text = "";
				
				if($o_rnt_details->disponibilidad == 0) $units_text = "<span class=\"badge badge-sm bg-gradient-danger\">Sin stock</span>";
				else if($o_rnt_details->disponibilidad == 1) $units_text = "<span class=\"badge badge-sm bg-gradient-warning\">1 unidad</span>";
				else if($o_rnt_details->disponibilidad > 1) $units_text = "<span class=\"badge badge-sm bg-gradient-success\">".$o_rnt_details->disponibilidad." unidades</span>";
			?>
			
			<!-- Table with rentable vehicles. -->
			<div class="container-fluid py-4">
				<div class="row">
					<div class="col-12">
						<div class="card my-4">
							<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
								<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
									<h6 class="text-white text-capitalize ps-3">Detalles del <u><?php echo $full_model; ?></u> alquilable</h6>
								</div>
							</div>
							<div class="card-body px-0 pb-2" style="text-align: left;">
								<?php
									echo "
										<ul class=ul_style_elem_details>
											<li><b>Vehículo:</b> <a href=\"../../../reg_lp/do/Details.php?id_reg=$o_rnt_details->id_reg_veh\">$full_model</a></li>
											<li><b>Costo por día:</b> $o_rnt_details->valor_diario_alq $o_rnt_details->cab</li>
											<li><b>Disponibilidad:</b> $units_text</li>
										</ul>
									";
								?>
							</div>
			
							<button id=id_btn_head_back class="btn btn-success"><i class="material-icons opacity-10">arrow_back</i> Volver a la lista</button>
							<button id=id_btn_edit class="btn btn-warning"><i class="material-icons opacity-10">edit</i> Editar</button>
							<button id=id_btn_del class="btn btn-danger"><i class="material-icons opacity-10">delete</i> Eliminar</button>
						</div>
					</div>
				</div>
			</div>
		</main>
	
		<?php include "../../../../../../shared/Imports.Scripts.php"; ?>

		<script>
			$().ready(function(){
				$('#sidebar-choice-4').addClass("active bg-gradient-primary");
			});
			
			$("#id_btn_head_back").click(function(){
				location.href = "../../";
			});
		</script>
		<?php
			echo "
				<script>
					$(\"#id_btn_edit\").click(function(){
						location.href = \"./Edit.php?id_rnt=".$_GET["id_rnt"]."\";
					});
					$(\"#id_btn_del\").click(function(){
						location.href = \"./Delete.php?id_rnt=".$_GET["id_rnt"]."\";
					});
				</script>
			";
		?>
	</body>
</html>
