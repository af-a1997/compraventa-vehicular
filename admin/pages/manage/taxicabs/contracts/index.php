<!DOCTYPE html>

<!-- Constant strings of text -->
<?php
	include "../../../../shared/Constant_Strings[A].php";
	include "../../../../../shared/utils/Utils.Common_Strings.php";
?>

<html lang="es">
	<head>
		<?php include "../../../../shared/html_head_setup.php"; ?>
		
		<title><?php echo a_dsb; ?> - <?php echo a_txc_con; ?></title>
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
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;"><?php echo a_dsb; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_txc_con; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_txc_con; ?></h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						<ul class="navbar-nav justify-content-end ms-md-auto pe-md-3 d-flex align-items-center">
							<li class="nav-item d-flex align-items-center">
								<a href="./pages/sign-in.html" class="nav-link text-body font-weight-bold px-0">
									<i class="fa fa-user me-sm-1"></i>

									<span class="d-sm-inline d-none"><?php echo g_login; ?></span>
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
			
			<!-- Table listing vehicles obtained by the company. -->
			<div class="container-fluid py-4">
				<div class="row">
					<div class="col-12">
						<div class="card my-4">
							<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
								<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
									<h6 class="text-white text-capitalize ps-3"><?php echo a_txc_con; ?></h6>
								</div>
							</div>
							<div class="card-body px-0 pb-2">
								<div class="table-responsive p-0">
									<table class="table align-items-center mb-0">
										<thead>
											<tr>
												<th class="text-uppercase text-white opacity-8 text-xxs font-weight-bolder ps-2">Matrícula</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Remisero</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Contratador</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Inicio</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Estado</th>
												<th class="text-center text-uppercase text-white opacity-8 text-xxs font-weight-bolder">Acciones</th>
											</tr>
										</thead>
										<!-- TODO: create server-side loop structure to generate rows per car registered in the database. -->
										<tbody>
											<tr>
												<td class="align-middle text-center text-sm">SBS1474</td>
												<td class="align-middle text-center text-sm">Hola</td>
												<td class="align-middle text-center text-sm">Fulano</td>
												<td>
													<p class="text-xs font-weight-bold mb-0">1 de Julio de 2022</p>
													<p class="text-xs text-white opacity-8 mb-0">00:00:00</p>
												</td>
												<td>
													<span class="badge badge-sm bg-gradient-success">Activo</span>
												</td>
												<td>
													<a href="javascript:;" class="text-white opacity-8 font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Detailles del contrato"><i class="material-icons opacity-10">info</i></a>
													<a href="javascript:;" class="text-white opacity-8 font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Abortar contrato"><i class="material-icons opacity-10">stop</i></a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
			
							<button class="btn btn-warning"><i class="material-icons opacity-10">delete_forever</i> Quitar contratos inactivos</button>
						</div>
					</div>
				</div>
			</div>
		</main>
	
		<?php include "../../../../shared/Imports.Scripts.php"; ?>

		<script>
			$('#sidebar-choice-7').addClass("active bg-gradient-primary");
		</script>
	</body>
</html>
