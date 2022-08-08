<?php
	if(!$_GET['id_rhi']){
		header("location:../../");
	}
	
	include "../../../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../../../shared/Constant_Strings[A].php";
	include "../../../../../../../shared/utils/Utils.Common_Strings.php";
?>

<html lang=es>
	<head>
		<?php
			include "../../../../../../shared/html_head_setup.php";
			include "../../../../../../shared/Imports.jQuery_UI.php";
		?>
		
		<title><?php echo a_dsb; ?> - <?php echo a_hvman; ?></title>
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
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="/admin/pages/manage/purchase_history/"><?php echo a_hvman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page">Eliminar</li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0">Eliminar registro de venta</h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						<ul class="navbar-nav justify-content-end ms-md-auto pe-md-3 d-flex align-items-center">
							<li class="nav-item d-flex align-items-center">
								<a href="/login/admin/act/Logout.php" class="nav-link text-body font-weight-bold px-0">
									<i class="fa fa-user me-sm-1"></i>

									<span class="d-sm-inline d-none"><?php echo g_logout; ?></span>
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
				if($_GET['id_rhi']){
					$id_2del = $_GET['id_rhi'];
					
					$o_rhi = new Rented();
					$o_rhi->id_hst_alq = $id_2del;
					
					$r_rhi_del = $o_rhi->RHI_DeleteOne();
	
					if($r_veh_del){
						echo "<p>Registro de venta eliminado, <a href=\"../../\">pincha aquí para volver a la lista</a>.</p>";
					}
					else{
						echo "<p>No se pudo eliminar el registro de venta, <a href=\"../../\">pincha aquí para volver a la lista</a>.</p>";
					}
				}
				else echo "<p>No se especificó una ID válida de registro de venta a eliminar.";
			?>
		</main>
	
		<?php include "../../../../../../shared/Imports.Scripts.php"; ?>
		
		<script>
			$('#sidebar-choice-1').addClass("active bg-gradient-primary");
		</script>
	</body>
</html>