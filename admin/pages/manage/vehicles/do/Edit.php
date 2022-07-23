<!DOCTYPE html>

<!-- Constant strings of text -->
<?php
	include "../../../../shared/Constant_Strings[A].php";
	include "../../../../shared/Constant_Strings[G].php";
?>

<html lang="es">
	<head>
		<?php
			include "../../../../shared/html_head_setup.php";
			include "../../../../shared/Imports.jQuery_UI.php";
		?>
		
		<title>Panel de administrador - <?php echo a_vehman; ?></title>
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
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="/admin/pages/manage/vehicles/"><?php echo a_vehman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page">Editar</li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0">Editar vehículo</h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						<div class="ms-md-auto pe-md-3 d-flex align-items-center">
							<div class="input-group input-group-outline">
								<label class="form-label">Buscar en el panel</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<ul class="navbar-nav justify-content-end">
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
			
			<br />
			
			<form method=GET action="./edit_act.php">
				<p>Tipo:</p>
				<div class="input-group input-group-outline">
					<select id=id_brands name=fln_veh_type class="form-control">
						<option value=1 selected>Automóvil</option>
					</select>
				</div>
				
				<p>Marca:</p>
				<div class="input-group input-group-outline">
					<select id=id_brands name=fln_veh_brands class="form-control">
						<option value="BMW" selected>BMW</option>
					</select>
				</div>
				
				<div class="input-group input-group-outline">
					<label class="form-label">Modelo</label>
					<input class="form-control" name=fln_veh_model />
				</div>
				
				<div class="input-group input-group-outline">
					<label class="form-label">Stock</label>
					<input class="form-control" type=number name=fln_veh_stock />
				</div>
				
				<p>Año de fabricación:</p>
				<div class="input-group input-group-outline">
					<input class="form-control" id=id_veh_faby name=fln_veh_faby class=inr_datepicker />
				</div>
				
				<div class="input-group input-group-outline">
					<label class="form-label">Puertas</label>
					<input class="form-control" type=number name=fln_veh_doors min=1 max=10 />
				</div>
				
				<div class="input-group input-group-outline">
					<label class="form-label">Transmisión</label>
					<input class="form-control" name=fln_veh_model />
				</div>
				
				<div class="input-group input-group-outline">
					<label class="form-label">Combustible</label>
					<input class="form-control" name=fln_veh_model />
				</div>
				
				<div class="input-group input-group-outline">
					<label class="form-label">Motor</label>
					<input class="form-control" name=fln_veh_model />
				</div>
				
				<button class="btn btn-success" type=submit>Guardar cambios</button>
			</form>
		</main>
	
		<?php include "../../../../shared/Imports.Scripts.php"; ?>

		<!-- jQuery UI · script -->
		<script src="/admin/res/extras/jquery/ui/jquery-ui.min.js"></script>

		<script>
			$('#sidebar-choice-1').addClass("active bg-gradient-primary");
			
			// To make jQuery UI's datepicker pick only years. Code from: https://stackoverflow.com/questions/13528623/jquery-ui-datepicker-to-show-year-only
			$('#id_veh_faby').datepicker({
                changeYear: true,
                dateFormat: 'yy',
                onClose: function(dateText, inst) { 
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, 1));
                },
                showButtonPanel: true,
				yearRange: "c-100:c+100"
			});
			
			$("#id_veh_faby").focus(function(){
				$(".ui-datepicker-month").hide();
				$(".ui-datepicker-calendar").css("visibility", "hidden");
			});
			
			// Code to show only year in datepicker ends here.
		</script>
	</body>
</html>
