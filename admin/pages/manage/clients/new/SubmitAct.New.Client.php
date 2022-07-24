<?php
	include "../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../shared/Constant_Strings[A].php";
	include "../../../../shared/Constant_Strings[G].php";
	
	include "../../../../shared/Utils.Admin.Time.php";

	$credentials = mysqli_connect("localhost","cmman_admin","#V!c2bMr69xo!8%A","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
	
	$o_users = new Users();
	
	$o_users->nombre = $_POST["fln_user_name"];
	$o_users->apellidos = $_POST["fln_user_surname"];
	$o_users->nombre_usuario = $_POST["fln_user_un"];
	$o_users->clave = $_POST["fln_user_pwd"];
	$o_users->cedula_identidad = $_POST["fln_user_uyid"];
	
	// Fields that are optional, if they're empty, send them with null info, if this isn't done, an error will appear instead.
	if(!$_POST["fln_user_emailaddr"]){
		$o_users->email = null;
	}
	else{
		$o_users->email = $_POST["fln_user_emailaddr"];
	}
	if(!$_POST["fln_user_houseloc"]){
		$o_users->residencia_actual = null;
	}
	else{
		$o_users->residencia_actual = $_POST["fln_user_houseloc"];
	}
	if(!$_POST["fln_user_phone_cel"]){
		$o_users->tel_cel = null;
	}
	else{
		$o_users->tel_cel = $_POST["fln_user_phone_cel"];
	}
	if(!$_POST["fln_user_phone_home"]){
		$o_users->tel_fijo = null;
	}
	else{
		$o_users->tel_fijo = $_POST["fln_user_phone_home"];
	}
	
	// Add the rest of the parameters.
	$o_users->momento_registro = $cdt;
	$o_users->cargo_en_sitio = 2;
	
	// Checks if the username was taken, if yes, returns an error, otherwise proceeds to register the user.
	$check_username_avail = $o_users->CLI_VerifyUsernameAvail($o_users->nombre_usuario);
	if($check_username_avail == true){
		header("Location:./?msg=username_taken");
	}
	else{
		$r_add_cli = $o_users->CLI_Add();
	}
?>

<html lang=es>
	<head>
		<?php
			include "../../../../shared/html_head_setup.php";
			include "../../../../shared/Imports.jQuery_UI.php";
		?>
		
		<title>Panel de administrador - <?php echo a_n_cli; ?></title>
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
							<li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="../"><?php echo a_climan; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_n_cli; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_n_cli; ?></h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						<div class="ms-md-auto pe-md-3 d-flex align-items-center">
							<div class="input-group input-group-outline">
								<label class="form-label">Buscar en el panel</label>
								<input type="text" class="form-control">
							</div>
						</div>
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
			
			<br />
			
			<?php
				if($r_add_cli){
					echo "<p>Usuario registrado, <a href=\"../\">pincha aquí para ir a la lista</a>.</p>";
				}
				else{
					echo "<p>No se pudo registrar al usuario, <a href=\"./\">pincha aquí para volver a intentarlo</a>.</p>";
				}
			?>
		</main>
	
		<?php include "../../../../shared/Imports.Scripts.php"; ?>
		
		<script>
			$('#sidebar-choice-2').addClass("active bg-gradient-primary");
		</script>
	</body>
</html>