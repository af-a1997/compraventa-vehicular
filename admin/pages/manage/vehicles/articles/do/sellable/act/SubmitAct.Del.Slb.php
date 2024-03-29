<?php
	if(!isset($_POST["fln_slb_id_del"]))
		header("location:../../../");
	
	include "../../../../../../../shared/Utils.Admin.SessionCheck.php";
	include "../../../../../../../shared/Utils.Admin.BTL.php";

	include "../../../../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../../../../shared/Constant_Strings[A].php";
	include "../../../../../../../../shared/utils/Utils.Common_Strings.php";

	$o_slb = new Sellable();
	$o_slb->id_art_venta = $_POST["fln_slb_id_del"];

	$o_slb_info = $o_slb->ART_ShowOne();

	if($o_slb_info->vfb == 0)
		$year_fab = "Año desc.";

	else
		$year_fab = $o_slb_info->vfb;
	
	$full_model = "$o_slb_info->bno $o_slb_info->vmo ($year_fab)";
?>

<html lang=es>
	<head>
		<?php include "../../../../../../../shared/html_head_setup.php"; ?>
		
		<title><?php echo a_dsb." - ".a_r_slb.$full_model; ?></title>
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
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="/admin/pages/manage/purchase_history/"><?php echo a_phman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_r_slb; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_r_slb.$full_model; ?></h6>
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
			
			<?php
				$link_act_0 = BTL_Gen(0,3);
				$link_act_1 = BTL_Gen(1,1,"Delete.php?id_slb=".$o_slb_info->id_art_venta);
				
				$r_slb_del = $o_slb->ART_DeleteOne();

				if($r_slb_del)
					echo "<p>Vehículo en venta &laquo;".$full_model."&raquo; eliminado".$link_act_0."</p>";
				else
					echo "<p>No se pudo eliminar el vehículo en venta".$link_act_1."</p>";
			?>
		</main>
	
		<?php include "../../../../../../../shared/Imports.Scripts.php"; ?>
		
		<script>
			$('#sidebar-choice-4').addClass("active bg-gradient-primary");
		</script>
	</body>
</html>