<!DOCTYPE html>

<!-- Constant strings of text -->
<?php
	include "../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../shared/Constant_Strings[A].php";
	include "../../../../../shared/utils/Utils.Common_Strings.php";
	
	$o_veh = new Vehicles();
	
	$o_veh->idno = $_GET["id_veh"];
	
	$o_veh_details = $o_veh->VEH_ShowOne();

	if($o_veh_details->anho_fab == 0)
		$year_fab = "Año desc.";

	else
		$year_fab = $o_veh_details->anho_fab;
	
	$full_model = "$o_veh_details->mno $o_veh_details->modelo ($year_fab)";
?>

<html lang="es">
	<head>
		<?php include "../../../../shared/html_head_setup.php"; ?>
		
		<title><?php echo a_dsb." - ".a_d_veh.$full_model; ?></title>
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
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="../"><?php echo a_vehman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_d_veh; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_d_veh.$full_model; ?></h6>
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
			
			<?php
				$units_text = "";
				$transmission_to_text = "";
				
				if($o_veh_details->unidades == 0) $units_text = "<span class=\"badge badge-sm bg-gradient-danger\">Sin stock</span>";
				else if($o_veh_details->unidades == 1) $units_text = "<span class=\"badge badge-sm bg-gradient-warning\">1 unidad</span>";
				else if($o_veh_details->unidades > 1) $units_text = "<span class=\"badge badge-sm bg-gradient-success\">".$o_veh_details->unidades." unidades</span>";
				
				if($o_veh_details->transmision == 0) $transmission_to_text = "Manual";
				else $transmission_to_text = "Automática";
			?>
			
			<!-- Table with registered vehicles. -->
			<div class="container-fluid py-4">
				<div class="row">
					<div class="col-12">
						<div class="card my-4">
							<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
								<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
									<h6 class="text-white text-capitalize ps-3">Detalles del <u><?php echo "$o_veh_details->mno $o_veh_details->modelo ($year_fab)"; ?></u></h6>
								</div>
							</div>
							<div class="card-body px-0 pb-2" style="text-align: left;">
								<?php
									echo "
										<ul class=ul_style_elem_details>
											<li><b>Fabricante:</b> <a href=\"../../other/do/brn/List_By_Brand.php?id_brn=$o_veh_details->marca\">$o_veh_details->mno</a></li>
											<li><b>Stock:</b> $units_text</li>
											<li><b>Total de puertas:</b> $o_veh_details->puertas</li>
											<li><b>Transmisión:</b> $transmission_to_text</li>
											<li><b>Tipo de combustible:</b> $o_veh_details->combustible_tipo</li>
											<li><b>Capacidad de combustible:</b> $o_veh_details->combustible_capac</li>
											<li><b>Motor:</b> $o_veh_details->motor</li>
											<li><b>Tipo:</b> $o_veh_details->tvo</li>
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
	
		<?php include "../../../../shared/Imports.Scripts.php"; ?>

		<script>
			$().ready(function(){
				$('#sidebar-choice-1').addClass("active bg-gradient-primary");
			});
			
			$("#id_btn_head_back").click(function(){
				location.href = "../";
			});
		</script>
		<?php
			echo "
				<script>
					$(\"#id_btn_edit\").click(function(){
						location.href = \"./Edit.php?id_veh=".$_GET["id_veh"]."\";
					});
					$(\"#id_btn_del\").click(function(){
						location.href = \"./Delete.php?id_veh=".$_GET["id_veh"]."\";
					});
				</script>
			";
		?>
	</body>
</html>
