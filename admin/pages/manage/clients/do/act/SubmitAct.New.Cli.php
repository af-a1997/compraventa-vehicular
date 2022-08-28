<?php
	include "../../../../shared/Utils.Admin.SessionCheck.php";
	include "../../../../shared/Utils.Admin.BTL.php";
	include "../../../../../shared/utils/Utils.Gen.Time.php";
	
	include "../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../shared/Constant_Strings[A].php";
	include "../../../../../shared/utils/Utils.Common_Strings.php";
	
	$o_cli = new Users();
	
	$o_cli->nombre = $_POST["fln_user_name"];
	$o_cli->apellidos = $_POST["fln_user_surname"];
	$o_cli->nombre_usuario = $_POST["fln_user_un"];
	$o_cli->clave = $_POST["fln_user_pwd"];
	$o_cli->cedula_identidad = $_POST["fln_user_uyid"];
	$o_cli->email = $_POST["fln_user_emailaddr"];
	$o_cli->residencia_actual = $_POST["fln_user_houseloc"];
	$o_cli->tel_cel = str_replace(' ', '', $_POST["fln_user_phone_cel"]);
	$o_cli->tel_fijo = str_replace(' ', '', $_POST["fln_user_phone_home"]);
	$o_cli->momento_registro = $cdt;
	$o_cli->cargo_en_sitio = 2;
	
	// Checks if the username was taken, if yes, returns an error, otherwise proceeds to register the user.
	$check_username_avail = $o_cli->CLI_VerifyUsernameAvail($o_cli->nombre_usuario);
	if($check_username_avail == true)
		header("Location:../../new/?msg=err_username_taken");
	else
		$r_add_cli = $o_cli->CLI_Add();
	
	$full_name = $o_cli->nombre." ".$o_cli->apellidos;
?>

<!DOCTYPE html>

<html lang=es>
	<head>
		<?php include "../../../../shared/html_head_setup.php"; ?>
		
		<title><?php echo a_dsb." - ".a_n_cli.$full_name; ?></title>
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
				$link_act_0 = BTL_Gen(0,1);
				$link_act_1 = BTL_Gen(1,-1);

				if($r_add_cli)
					echo "<p>Cliente &laquo;".$full_name."&raquo; registrado".$link_act_0."</p>";
				else
					echo "<p>No se pudo registrar al cliente".$link_act_1."</p>";
			?>
		</main>
	
		<?php include "../../../../shared/Imports.Scripts.php"; ?>
		
		<script>
			$('#sidebar-choice-2').addClass("active bg-gradient-primary");
		</script>
	</body>
</html>