<!DOCTYPE html>

<?php
	include "../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../shared/Constant_Strings[A].php";
	include "../../../../shared/utils/Utils.Common_Strings.php";
	
	include "../../../classes/Utils_ClassLoader.class.php";
	
	$cli_instance = new Users();
	
	$cli_list = $cli_instance->CLI_ShowAll();
?>

<html lang=es>
	<head>
		<?php include "../../../shared/html_head_setup.php"; ?>
		
		<title>Panel de administrador - <?php echo a_climan; ?></title>
	</head>

	<body class="g-sidenav-show bg-gray-600 dark-version">
		<!-- Sidebar -->
		<?php include "../../../shared/Snippets.Sidebar.php"; ?>
		
		<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
			<!-- Top bar conents -->
			<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
				<div class="container-fluid py-1 px-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;"><?php echo a_dsb; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_climan; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_climan; ?></h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						<ul class="navbar-nav justify-content-end ms-md-auto pe-md-3 d-flex align-items-center">
							<?php include "../../../shared/Snippets.Adm_Logout.php"; ?>
							
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
				if(isset($_GET['msg']) && ($_GET['msg']) == "err_main_admin_protected"){
					echo "
						<div class=\"alert alert-danger\" role=alert>Si has visto este mensaje, es porque estabas tratanto de editar al administrador principal ingresando su ID en la URL, esto no es posible.</div>
					";
				}
			?>
			
			<!-- Table containing clients list. -->
			<div class="container-fluid py-4">
				<div class="row">
					<div class="col-12">
						<div class="card my-4">
							<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
								<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
									<h6 class="text-white text-capitalize ps-3"><?php echo a_climan; ?></h6>
								</div>
							</div>
							<div class="card-body px-0 pb-2">
								<div class="table-responsive p-0">
									<table class="table align-items-center mb-0">
										<thead>
											<tr>
												<th class="text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Nombre completo</th>
												<th class="text-uppercase text-white opacity-8 text-xxs font-weight-bolder ps-2">Nombre de usuario</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Contactos</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Rol en sitio</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Acciones</th>
											</tr>
										</thead>
										<!-- TODO: create server-side loop structure to generate rows per car registered in the database. -->
										<tbody>
											<?php
												/*
													The following code was below the first <div> in the [echo] command below, but has been decided to be taken out unless profile pictures are implemented later:
												
													<div><img src=\"../../../assets/img/team-2.jpg\" class=\"avatar avatar-sm me-3 border-radius-lg\" alt=\"user1\"></div>
												*/
												foreach($cli_list as $o){
													if($o->nro_id_u == 1){
														echo "
															<tr>
																<td>
																	<div class=\"d-flex px-2 py-1\">
																		<div class=\"d-flex flex-column justify-content-center\">
																			<h6 class=\"mb-0 text-sm\">$o->nombre</h6>
																			<p class=\"text-xs text-white opacity-8 mb-0\">$o->apellidos</p>
																		</div>
																	</div>
																</td>
																<td class=\"align-middle text-center text-sm\">$o->nombre_usuario</td>
																<td>
																	<p class=\"text-xs font-weight-bold mb-0\">$o->tel_cel</p>
																	<p class=\"text-xs text-white opacity-8 mb-0\">$o->email</p>
																</td>
																<td class=\"align-middle text-center text-sm\">$o->cargo_en_sitio</td>
																<td class=\"align-middle text-center font-weight-bold text-xs\">NO DISPONIBLE</td>
															</tr>
														";

													}
													else{
														echo "
															<tr>
																<td>
																	<div class=\"d-flex px-2 py-1\">
																		<div class=\"d-flex flex-column justify-content-center\">
																			<h6 class=\"mb-0 text-sm\">$o->nombre</h6>
																			<p class=\"text-xs text-white opacity-8 mb-0\">$o->apellidos</p>
																		</div>
																	</div>
																</td>
																<td class=\"align-middle text-center text-sm\">$o->nombre_usuario</td>
																<td>
																	<p class=\"text-xs font-weight-bold mb-0\">$o->tel_cel</p>
																	<p class=\"text-xs text-white opacity-8 mb-0\">$o->email</p>
																</td>
																<td class=\"align-middle text-center text-sm\">$o->cargo_en_sitio</td>
																<td class=\"align-middle text-center\">
																	<a href=\"./do/Details.php?id_cli=$o->nro_id_u\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=\"tooltip\" data-original-title=\"Detalles\"><i class=\"material-icons opacity-10\">info</i></a>
																	<a href=\"./do/Edit.php?id_cli=$o->nro_id_u\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=\"tooltip\" data-original-title=\"Editar\"><i class=\"material-icons opacity-10\">edit</i></a>
																	<a href=\"./do/Delete.php?id_cli=$o->nro_id_u\" class=\"text-white opacity-8 font-weight-bold text-xs\" data-toggle=\"tooltip\" data-original-title=\"Eliminar\"><i class=\"material-icons opacity-10\">delete</i></a>
																</td>
															</tr>
														";
													}
												}
											?>
										</tbody>
									</table>
								</div>
							</div>
			
							<button id=id_btn_reg_user class="btn btn-success"><i class="material-icons opacity-10">person_add</i> Registrar cliente</button>
						</div>
					</div>
				</div>
			</div>
		</main>
	
		<?php include "../../../shared/Imports.Scripts.php"; ?>

		<script>
			$('#sidebar-choice-2').addClass("active bg-gradient-primary");
			
			$("#id_btn_reg_user").click(function(){
				location.href = "./new";
			});
		</script>
	</body>
</html>
