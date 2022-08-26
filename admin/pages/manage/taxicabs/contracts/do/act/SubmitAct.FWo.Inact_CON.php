<?php
	if(!isset($_POST['fln_con_fwo_confirmation']) || $_POST['fln_con_fwo_confirmation'] != 1)
		header("location:../../");
	
	include "../../../../../../shared/Utils.Admin.SessionCheck.php";
	include "../../../../../../shared/Utils.Admin.BTL.php";
	
	include "../../../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../../../shared/Constant_Strings[A].php";
	include "../../../../../../../shared/utils/Utils.Common_Strings.php";
?>

<html lang=es>
	<head>
		<?php include "../../../../../../shared/html_head_setup.php"; ?>
		
		<title><?php echo a_dsb." - ".a_w_con; ?></title>
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
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="../../"><?php echo a_phman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_w_con; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_w_con; ?></h6>
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
			
			<br />
			
			<?php
				$o_con = new Taxicab_Contracts();

				$o_con_fwo = $o_con->CON_DeleteAllExpired();

				$link_act_0 = BTL_Gen(0,2);
				$link_act_1 = BTL_Gen(1,1,"Clear_Inactive_CON.php");

				if($o_con_fwo)
					echo "<p>Se eliminaron los contratos con remises finalizados".$link_act_0."</p>";
				else
					echo "<p>No se pudo eliminar ningún contrato".$link_act_1."</p>";
			?>
		</main>
	
		<?php include "../../../../../../shared/Imports.Scripts.php"; ?>
		
		<script>
			$('#sidebar-choice-3').addClass("active bg-gradient-primary");
		</script>
	</body>
</html>