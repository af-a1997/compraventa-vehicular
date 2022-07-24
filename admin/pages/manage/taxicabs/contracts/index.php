<!DOCTYPE html>

<!-- Constant strings of text -->
<?php
	include "../../../../shared/Constant_Strings[A].php";
	include "../../../../shared/Constant_Strings[G].php";
?>

<html lang="es">
	<head>
		<?php include "../../../../shared/html_head_setup.php"; ?>
		
		<title>Panel de administrador - <?php echo a_taxicab_cs; ?></title>
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
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_taxicab_cs; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_taxicab_cs; ?></h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						<div class="ms-md-auto pe-md-3 d-flex align-items-center">
							<div class="input-group input-group-outline">
								<label class="form-label">Buscar en el panel</label>
								<input type="text" class="form-control">
							</div>
						</div>
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
							
							<li class="nav-item px-3 d-flex align-items-center">
								<a href="javascript:;" class="nav-link text-body p-0">
									<i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
								</a>
							</li>
							<li class="nav-item dropdown pe-2 d-flex align-items-center">
								<a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="fa fa-bell cursor-pointer"></i>
								</a>

								<ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
									<li class="mb-2">
										<a class="dropdown-item border-radius-md" href="javascript:;">
											<div class="d-flex py-1">
												<div class="my-auto">
													<img src="./assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
												</div>
												<div class="d-flex flex-column justify-content-center">
													<h6 class="text-sm font-weight-normal mb-1">
														<span class="font-weight-bold">New message</span> from Laur
													</h6>
													<p class="text-xs text-white opacity-8 mb-0">
														<i class="fa fa-clock me-1"></i> 13 minutes ago
													</p>
												</div>
											</div>
										</a>
									</li>
									<li class="mb-2">
										<a class="dropdown-item border-radius-md" href="javascript:;">
											<div class="d-flex py-1">
												<div class="my-auto">
													<img src="./assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark me-3 " />
												</div>
												<div class="d-flex flex-column justify-content-center">
													<h6 class="text-sm font-weight-normal mb-1"> <span class="font-weight-bold">New album</span> by Travis Scott</h6>
													<p class="text-xs text-white opacity-8 mb-0">
														<i class="fa fa-clock me-1"></i> 1 day
													</p>
												</div>
											</div>
										</a>
									</li>
									<li>
										<a class="dropdown-item border-radius-md" href="javascript:;">
											<div class="d-flex py-1">
												<div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
													<svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <title>credit-card</title> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero"> <g transform="translate(1716.000000, 291.000000)"> <g transform="translate(453.000000, 454.000000)"> <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path> <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path> </g> </g> </g> </g> </svg>
												</div>
												<div class="d-flex flex-column justify-content-center">
													<h6 class="text-sm font-weight-normal mb-1"> Payment successfully completed</h6>
													<p class="text-xs text-white opacity-8 mb-0">
														<i class="fa fa-clock me-1"></i> 2 days</p>
												</div>
											</div>
										</a>
									</li>
								</ul>
							</li>
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
									<h6 class="text-white text-capitalize ps-3"><?php echo a_taxicab_cs; ?></h6>
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
