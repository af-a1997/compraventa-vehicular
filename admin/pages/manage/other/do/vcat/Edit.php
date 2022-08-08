<!DOCTYPE html>

<?php
	if(!$_GET["id_vcat"]){
		header("Location:../../");
	}
	
	include "../../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../../shared/Constant_Strings[A].php";
	include "../../../../../../shared/utils/Utils.Common_Strings.php";
	
	$o_vcat = new Veh_Cat();
	$o_vcat->id_tipo = $_GET["id_vcat"];
	
	$o_vcat_data_in = $o_vcat->VCAT_ShowOne();
?>

<html lang=es>
	<head>
		<?php
			include "../../../../../shared/html_head_setup.php";
			include "../../../../../shared/Imports.jQuery_UI.php";
		?>

		<link rel=stylesheet href="/shared/extras/jquery/selectboxit/jquery.selectBoxIt.css" />
		
		<title><?php echo a_dsb; ?> - <?php echo a_u_vcat.$o_vcat_data_in->nombre; ?></title>
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
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_u_vcat.$o_vcat_data_in->nombre; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_u_vcat.$o_vcat_data_in->nombre; ?></h6>
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
			
			<p>Acá podés editar los datos de la marca &laquo;<?php echo $o_vcat_data_in->nombre; ?>&raquo;.</p>
			
			<p><?php echo g_snp_reqf ?> = Campos obligatorios.</p>
			
			<form id=id_form_vcat_edit method=POST action="./act/SubmitAct.Edit.VCAT.php">
				<input type=hidden name=fln_vcat_id value=<?php echo "$o_vcat_data_in->id_tipo"; ?> />
				
				<div class="input-group input-group-outline">
					<label class=form-label>Nombre <?php echo g_snp_reqf ?></label>
					<input class=form-control name=fln_vcat_name value=<?php echo "\"$o_vcat_data_in->nombre\""; ?> />
				</div>
				<p><br />Descripción <?php echo g_snp_reqf ?>:</p>
				<div class="input-group input-group-outline">
					<textarea class=form-control name=fln_vcat_desc><?php echo "$o_vcat_data_in->descripcion"; ?></textarea>
				</div>

				<div class="input-group input-group-outline" style="margin-top: 15px;">
					<span>Ícono <?php echo g_snp_reqf ?>:&ensp;</span>
					<select id=id_dd_vcat_icon name=fln_vcat_icon>
						<?php
							include "../../../../../../shared/utils/Utils.VCAT_Icons.php";

							for($x = 0 ; $x < count($icon_set) ; $x++){
								if($icon_set[$x][0] == $o_vcat_data_in->icono_fa)
									echo "<option value=\"".$icon_set[$x][0]."\" data-iconurl=\"".$icon_set[$x][1].".\" selected>".$icon_set[$x][2]."</option>";
								
								else
									echo "<option value=\"".$icon_set[$x][0]."\" data-iconurl=\"".$icon_set[$x][1].".\">".$icon_set[$x][2]."</option>";
							}
						?>
					</select>
				</div>
				
				<br />
				
				<button class="btn btn-success" type=submit><i class="material-icons opacity-10">autorenew</i> Actualizar categoría</button>
			</form>
		</main>
	
		<?php include "../../../../../shared/Imports.Scripts.php"; ?>

		<!-- jQuery UI · script -->
		<script src="/shared/extras/jquery/ui/jquery-ui.min.js"></script>

		<script src="/shared/extras/jquery/validation/jquery.validate.min.js"></script>
		<script src="/shared/extras/jquery/selectboxit/jquery.selectBoxIt.min.js"></script>

		<script>
			$('#sidebar-choice-8').addClass("active bg-gradient-primary");
			
			$().ready(function(){
				$("#id_form_vcat_edit").validate({
					rules:{
						fln_vcat_name: "required",
						fln_vcat_desc: "required"
					},
					messages:{
						fln_vcat_name: "Ingrese el nombre de la categoría.",
						fln_vcat_desc: "Describa la categoría."
					}
				});

				$("#id_dd_vcat_icon").selectBoxIt({
					theme: "jqueryui"
				});
			});
		</script>
	</body>
</html>