<?php
	if(!$_POST["fln_ccy_id"]){
		header("Location:../../../");
	}
	
	include "../../../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../../../shared/Constant_Strings[A].php";
	include "../../../../../../../shared/utils/Utils.Common_Strings.php";
	
	$o_ccy = new Currencies();
	$o_ccy->id_moneda = $_POST["fln_ccy_id"];
    $o_ccy_get_info = $o_ccy->CCY_ShowOne();
	
	$o_ccy->nombre = $_POST["fln_ccy_name"];
	$o_ccy->abr = $_POST["fln_ccy_abr"];
	$o_ccy->simbolizacion = $_POST["fln_ccy_symbol"];
	$o_ccy->pos_sim = $_POST["fln_ccy_symbol_pos"];
	
    $o_ccy_dispinfo = array("$o_ccy->id_moneda","$o_ccy->nombre");
    
	$r_upd_ccy = $o_ccy->CCY_EditOne();
?>

<html lang=es>
	<head>
		<?php
			include "../../../../../../shared/html_head_setup.php";
		?>
		
		<title><?php echo a_dsb; ?> - <?php echo a_u_ccy.$o_ccy_dispinfo[1]; ?></title>
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
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;"><?php echo a_dsb; ?></a></li>
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="/admin/pages/manage/other"><?php echo a_oman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_u_ccy.$o_ccy_dispinfo[1]; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_u_ccy.$o_ccy_dispinfo[1]; ?></h6>
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
				if($r_upd_ccy){
					echo "<p>Divisa &laquo;".$o_ccy_dispinfo[1]."&raquo; actualizada, <a href=\"../../../\">pincha aquí para volver a la lista</a>.</p>";
				}
				else{
					echo "<p>No se pudo actualizar esta categoría, <a href=\"../Edit.php?id_vcat=$o_ccy_dispinfo[0]\">pincha aquí para volver a intentarlo</a>.</p>";
				}
			?>
		</main>
	
		<?php include "../../../../../../shared/Imports.Scripts.php"; ?>
		
		<script>
			$('#sidebar-choice-8').addClass("active bg-gradient-primary");
		</script>
	</body>
</html>