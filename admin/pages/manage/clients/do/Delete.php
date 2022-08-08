<!DOCTYPE html>

<?php
	if($_GET["id_cli"] == 1){
		header("Location:../?msg=err_main_admin_protected");
	}
	
	if(!$_GET["id_cli"]){
		header("Location:../");
	}
	
	include "../../../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../shared/Constant_Strings[A].php";
	include "../../../../../shared/utils/Utils.Common_Strings.php";
?>

<html lang="es">
	<head>
		<?php include "../../../../shared/html_head_setup.php"; ?>
		
		<title><?php echo a_dsb; ?> - Eliminar cliente</title>
	</head>

	<body class="g-sidenav-show bg-gray-600 dark-version">
		<!-- Sidebar -->
		<?php include "../../../../shared/Snippets.Sidebar.php"; ?>
		
		<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
			<!-- Top bar contents -->
			<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
				<div class="container-fluid py-1 px-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="/admin/"><?php echo a_dsb; ?></a></li>
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="/admin/pages/manage/clients/"><?php echo a_climan; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page">Eliminar</li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0">Eliminar cliente</h6>
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
			
			<p>¿Seguro que quieres eliminar este cliente? Esta acción no se puede deshacer.</p>
			
			<input type=checkbox id=id_del_confirm name=n_del_confirm />
			<label for=n_del_confirm>Consiento que esta acción es irreversible y deseo proceder</label>
			
			<br />
			
			<button class="btn btn-danger disabled" id=id_del_y name=n_del_n disabled><i class="material-icons opacity-10">delete</i> Sí</button>
			<button class="btn btn-success" id=id_del_n name=n_del_n><i class="material-icons opacity-10">undo</i> No</button>
		</main>
	
		<?php include "../../../../shared/Imports.Scripts.php"; ?>

		<script>
			$('#sidebar-choice-1').addClass("active bg-gradient-primary");
			
			// Ensures checkbox is unchecked when page is reloaded normally.
			$('#id_del_confirm').prop('checked', false);
			
			// To make the [yes] button of the prompt available when the confirmation checkbox is enabled, this helps preventing accidental deletion of records.
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
			
			$("#id_del_n").click(function(){
				location.href = "../";
			});
		</script>
		
		<?php echo "
			<script>
				$(\"#id_del_y\").click(function(){
					location.href = \"./act/SubmitAct.Del.Cli.php?id_cli=".$_GET["id_cli"]."\";
				});
			</script>";
		?>
	</body>
</html>
