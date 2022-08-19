<?php
	if(!isset($_GET["id_rnt"]))
		header("location:../../");
	
	include "../../../../../../shared/Utils.Admin.SessionCheck.php";

	include "../../../../../../classes/Utils_ClassLoader.class.php";

	include "../../../../../../shared/Constant_Strings[A].php";
	include "../../../../../../../shared/utils/Utils.Common_Strings.php";

	$o_rnt = new Rentable();
	$o_rnt->id_art_alq = $_GET["id_rnt"];

	$o_rnt_info = $o_rnt->RNT_ShowOne();

	if($o_rnt_info->vfb == 0)
		$year_fab = "Año desc.";

	else
		$year_fab = $o_rnt_info->vfb;
	
	$full_model = "$o_rnt_info->bno $o_rnt_info->vmo ($year_fab)";
?>

<!DOCTYPE html>

<html lang=es>
	<head>
		<?php include "../../../../../../shared/html_head_setup.php"; ?>
		
		<title><?php echo a_dsb." - ".a_r_rnt.$full_model; ?></title>
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
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="../../../"><?php echo a_vehman; ?></a></li>
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="../../"><?php echo a_haman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_r_rnt; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_r_rnt.$full_model; ?></h6>
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
			
			<p>¿Seguro que quieres eliminar el artículo de alquiler &laquo;<?php echo $full_model; ?>&raquo;? <u>Esta acción no se puede deshacer</u>.</p>
			
			<input type=checkbox id=id_del_confirm name=n_del_confirm />
			<label for=n_del_confirm>Consiento que esta acción es irreversible y deseo proceder</label>
			
			<br />
			
            <form method=POST action="./act/SubmitAct.Del.Rnt.php">
                <input type=hidden name=fln_rnt_id_del value=<?php echo $_GET["id_rnt"]; ?>>

                <button type=submit class="btn btn-danger disabled" id=id_del_y name=n_del_n disabled><i class="material-icons opacity-10">delete</i> Sí</button>
                <a href="../../" class="btn btn-success" id=id_del_n name=n_del_n><i class="material-icons opacity-10">undo</i> No</a>
            </form>
		</main>
	
		<?php include "../../../../../../shared/Imports.Scripts.php"; ?>

		<script>
			$('#sidebar-choice-4').addClass("active bg-gradient-primary");
			
			$('#id_del_confirm').prop('checked', false);
			
			$('#id_del_confirm').change(function(){
				if(this.checked){
					$('#id_del_y').prop('disabled', false);
					$('#id_del_y').removeClass('disabled');
				}
				else{
					$('#id_del_y').prop('disabled', true);
					$('#id_del_y').addClass('disabled');
				}
			});
		</script>
	</body>
</html>
