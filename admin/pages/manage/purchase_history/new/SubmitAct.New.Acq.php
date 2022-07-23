<?php
	include "../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../shared/Constant_Strings[A].php";
	include "../../../../shared/Constant_Strings[G].php";
	
	include "../../../../shared/Utils.Admin.Time.php";

	$credentials = mysqli_connect("localhost","cmman_admin","#V!c2bMr69xo!8%A","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
	
	$o_rvi = new Registered_Veh_Info();
	$o_acq = new Acquired_Veh();
	
	$o_rvi->ultima_act_info = $cdt;
	if(!$_POST["fln_veh_color"]){
		$o_rvi->color = null;
	}
	else{
		$o_rvi->color = $_POST["fln_veh_color"];
	}
	if(!$_POST["fln_veh_lp"]){
		$o_rvi->matricula = null;
	}
	else{
		$o_rvi->matricula = $_POST["fln_veh_lp"];
	}
	$o_rvi->matricula = $_POST["fln_veh_lp"];
	$o_rvi->estado_act = $_POST["fln_veh_status_acq"];
	$o_rvi->kilometraje_act = $_POST["fln_acq_dist"];
	$o_rvi->usado = $_POST["fln_acq_used"];
	$o_rvi->vehiculo_asociado = $_POST["fln_veh_models"];
	
	$r_add_rvi = $o_rvi->RVI_Add();
	
	$r_rvi_id = mysqli_query($credentials, "SELECT id_reg FROM registros ORDER BY id_reg DESC LIMIT 1;")->fetch_object()->id_reg;
	
	$o_acq->tiempo = $cdt;
	$o_acq->precio = $_POST["fln_veh_cost"];
	$o_acq->estado_adq = $_POST["fln_veh_status_acq"];
	$o_acq->kilometraje_adq = $_POST["fln_acq_dist"];
	$o_acq->divisa_precio = $_POST["fln_veh_cost_curr"];
	$o_acq->id_del_adquirido = $r_rvi_id;
	
	$r_add_acq = $o_acq->ACQ_Add();
?>

<html lang=es>
	<head>
		<?php
			include "../../../../shared/html_head_setup.php";
			include "../../../../shared/Imports.jQuery_UI.php";
		?>
		
		<title>Panel de administrador - <?php echo a_n_acq; ?></title>
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
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="/admin/pages/manage/purchase_history/"><?php echo a_purchase_history; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_n_acq; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_n_acq; ?></h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						<div class="ms-md-auto pe-md-3 d-flex align-items-center">
							<div class="input-group input-group-outline">
								<label class="form-label">Buscar en el panel</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<ul class="navbar-nav justify-content-end">
							<li class="nav-item d-flex align-items-center">
								<a href="./pages/sign-in.html" class="nav-link text-body font-weight-bold px-0">
									<i class="fa fa-user me-sm-1"></i>

									<span class="d-sm-inline d-none"><?php echo g_login; ?></span>
								</a>
							</li>
							
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
				if($r_add_rvi && $r_add_acq){
					echo "<p>Compra registrada, <a href=\"../\">pincha aquí para ir a la lista</a>.</p>";
				}
				else{
					echo "<p>No se pudo registrar la compra, <a href=\"./new/\">pincha aquí para volver a intentarlo</a>.</p>";
				}
			?>
		</main>
	
		<?php include "../../../../shared/Imports.Scripts.php"; ?>
		
		<script>
			$('#sidebar-choice-6').addClass("active bg-gradient-primary");
		</script>
	</body>
</html>