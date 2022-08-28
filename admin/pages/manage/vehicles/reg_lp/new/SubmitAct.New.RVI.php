<?php
	include "../../../../../shared/Utils.Admin.SessionCheck.php";
	include "../../../../../../shared/utils/Utils.Gen.Time.php";
	include "../../../../../shared/Utils.Admin.BTL.php";
	
	include "../../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../../shared/Constant_Strings[A].php";
	include "../../../../../../shared/utils/Utils.Common_Strings.php";
	
	$o_rvi = new Registered_Veh_Info();
	
	$o_rvi->ultima_act_info = $cdt;
	$o_rvi->color = $_POST["fln_rvi_color"];
	$o_rvi->matricula = $_POST["fln_rvi_lp"];
	$o_rvi->estado_act = $_POST["fln_rvi_status_act"];
	$o_rvi->kilometraje_act = $_POST["fln_rvi_dist"];
	
	if(isset($_POST["fln_rvi_used_flag"]))
		$o_rvi->usado = $_POST["fln_rvi_used_flag"];
	else $o_rvi->usado = 2;

	$o_rvi->vehiculo_asociado = $_POST["fln_rvi_models"];

	$r_add_rvi = $o_rvi->RVI_Add();
?>

<html lang=es>
	<head>
		<?php
			include "../../../../../shared/html_head_setup.php";
		?>
		
		<title><?php echo a_dsb; ?> - <?php echo a_n_veh; ?></title>
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
			
			<?php
				$link_act_all = BTL_Gen(0,2);

				if($r_add_rvi){
					echo "<p>Registro añadido".$link_act_all."</p>";
				}
				else{
					echo "<p>No se pudo añadir el registro".$link_act_all."</p>";
				}
			?>
		</main>
	
		<?php include "../../../../../shared/Imports.Scripts.php"; ?>
		
		<script>
			$('#sidebar-choice-1').addClass("active bg-gradient-primary");
		</script>
	</body>
</html>