<!DOCTYPE html>

<?php
	include "../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../shared/Constant_Strings[A].php";
	include "../../../../../shared/utils/Utils.Common_Strings.php";
?>

<html lang=es>
	<head>
		<?php
			include "../../../../shared/html_head_setup.php";
			include "../../../../shared/Imports.jQuery_UI.php";
		?>

		<link rel=stylesheet href="/shared/extras/jquery/selectboxit/jquery.selectBoxIt.css" />
		
		<title><?php echo a_dsb; ?> - <?php echo a_n_vcat; ?></title>
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
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="/admin/pages/manage/other/"><?php echo a_oman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_n_vcat; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_n_vcat; ?></h6>
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
				if(isset($_GET['msg']) && ($_GET['msg']) == "err_no_icon_selected"){
					echo "
						<div class=\"alert alert-danger\" role=alert>No has seleccionado un ícono.<br><br>Además, como la validación no funciona con el selector de ícono, estás viendo este mensaje en su lugar.</div>
					";
				}
			?>
			
			<p>Ingresa los datos de la categoría que deseas registrar.</p>
			
			<p><?php echo g_snp_reqf ?> = Campos obligatorios.</p>
			
			<form id=id_form_vcat_reg method=POST action="./act/SubmitAct.New.VCAT.php">
				<div class="input-group input-group-outline">
					<label class=form-label>Nombre <?php echo g_snp_reqf ?></label>
					<input class=form-control name=fln_vcat_name />
				</div>
				<p><br />Descripción <?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<textarea class=form-control name=fln_vcat_desc></textarea>
				</div>

				<div class="input-group input-group-outline" style="margin-top: 15px;">
					<span>Ícono <?php echo g_snp_reqf ?>:&ensp;</span>
					<select id=id_dd_vcat_icon name=fln_vcat_icon>
						<option value="" data-iconurl="/shared/img/icons/stock_right(gnome-2.10.1).png">Seleccionar...</option>
						<?php
							include $_SERVER["DOCUMENT_ROOT"]."/shared/utils/Utils.VCAT_Icons.php";

							for($x = 0 ; $x < count($icon_set) ; $x++)
								echo "<option value=\"".$icon_set[$x][0]."\" data-iconurl=\"".$icon_set[$x][1].".\">".$icon_set[$x][2]."</option>";
						?>
					</select>
				</div>
				
				<br />
				
				<button class="btn btn-success" type=submit><i class="material-icons opacity-10">playlist_add_check</i> Registrar categoría</button>
			</form>
		</main>
	
		<?php include "../../../../shared/Imports.Scripts.php"; ?>

		<script src="/shared/extras/jquery/validation/jquery.validate.min.js"></script>

		<!-- jQuery UI · script -->
		<script src="/shared/extras/jquery/ui/jquery-ui.min.js"></script>

		<script src="/shared/extras/jquery/validation/jquery.validate.min.js"></script>
		<script src="/shared/extras/jquery/selectboxit/jquery.selectBoxIt.min.js"></script>
		
		<script>
			$('#sidebar-choice-8').addClass("active bg-gradient-primary");
			
			$().ready(function(){
				$("#id_form_vcat_reg").validate({
					rules:{
						fln_vcat_name: "required",
						fln_vcat_desc: "required",
						fln_vcat_icon: "required"
					},
					messages:{
						fln_vcat_name: "Ingrese el nombre de la categoría.",
						fln_vcat_desc: "Ingrese una descripción para la categoría.",
						fln_vcat_icon: "Escoja un ícono para la categoría."
					}
				});

				$("#id_dd_vcat_icon").selectBoxIt({
					theme: "jqueryui"
				});
			});
		</script>
	</body>
</html>
