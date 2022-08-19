<!DOCTYPE html>

<?php
	if(!$_GET["id_brn"]){
		header("Location:../../");
	}
	
	include "../../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../../shared/Constant_Strings[A].php";
	include "../../../../../../shared/utils/Utils.Common_Strings.php";
	
	$o_brn = new Brands();
	$o_brn->idno = $_GET["id_brn"];
	
	$o_brn_data_in = $o_brn->BRAND_ShowOne();
?>

<html lang=es>
	<head>
		<?php
			include "../../../../../shared/html_head_setup.php";
		?>
		
		<title><?php echo a_dsb; ?> - <?php echo a_u_brn.$o_brn_data_in->nombre; ?></title>
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
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;"><?php echo a_dsb; ?></a></li>
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="/admin/pages/manage/other"><?php echo a_oman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_u_brn.$o_brn_data_in->nombre; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_u_brn.$o_brn_data_in->nombre; ?></h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						</div>
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
			
			<p>Acá podés editar los datos de la marca &laquo;<?php echo $o_brn_data_in->nombre; ?>&raquo;.</p>
			
			<p><?php echo g_snp_reqf; ?> = Campos obligatorios.</p>
			
			<form id=id_form_brn_edit method=POST action="./act/SubmitAct.Edit.Brn.php">
				<input type=hidden name=fln_brn_id value=<?php echo "$o_brn_data_in->idno"; ?> />
				
				<div class="input-group input-group-outline">
					<label class=form-label>Nombre <?php echo g_snp_reqf; ?></label>
					<input class=form-control name=fln_brn_name value=<?php echo "\"$o_brn_data_in->nombre\""; ?> />
				</div>
				<p><br />Descripción <?php echo g_snp_reqf; ?>:</p>
				<div class="input-group input-group-outline">
					<textarea class=form-control name=fln_brn_desc><?php echo "$o_brn_data_in->descripcion"; ?></textarea>
				</div>

				<p><br />¿Actualizar logotipo? (Opcional):</p>
				<div class="input-group input-group-outline">
					<input type=file name=fln_brn_logo accept="image/*" />
				</div>
				
				<br />
				
				<button class="btn btn-success" type=submit><i class="material-icons opacity-10">autorenew</i> Actualizar marca</button>
			</form>
		</main>
	
		<?php include "../../../../../shared/Imports.Scripts.php"; ?>

		<script src="/shared/extras/jquery/validation/jquery.validate.min.js"></script>

		<script>
			$('#sidebar-choice-8').addClass("active bg-gradient-primary");
			
			$().ready(function(){
				$("#id_form_brn_edit").validate({
					rules:{
						fln_brn_name: "required",
						fln_brn_desc: "required"
					},
					messages:{
						fln_brn_name: "Ingrese el nombre de la marca.",
						fln_brn_desc: "Ingrese una descripción para la marca."
					}
				});
			});
		</script>
	</body>
</html>
