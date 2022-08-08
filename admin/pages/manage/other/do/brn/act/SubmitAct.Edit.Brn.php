<?php
	if(!$_POST["fln_brn_id"]){
		header("Location:../../../");
	}
	
	include "../../../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../../../classes/Utils_ClassLoader.class.php";
	
	include "../../../../../../shared/Constant_Strings[A].php";
	include "../../../../../../../shared/utils/Utils.Common_Strings.php";
	
	$o_brn = new Brands();
	$o_brn->idno = $_POST["fln_brn_id"];
    $o_brn_get_info = $o_brn->BRAND_ShowOne();
    $o_brn_dispinfo = array("$o_brn->idno","$o_brn->nombre");
	
	$o_brn->nombre = $_POST["fln_brn_name"];
	$o_brn->descripcion = $_POST["fln_brn_desc"];

    $logo_update = false;

    // TODO: doesn't do anything, but the logic is there I guess. Fix whenever possible.
    if(isset($_FILES["fln_brn_logo"]["tmp_name"])){
        $logo_path = $_SERVER["DOCUMENT_ROOT"]."/user_uploads/brand_logos/";
        $get_fn = $_FILES["fln_brn_logo"]["name"];
        $placeholder = $_FILES["fln_brn_logo"]["tmp_name"];
        $old_logo = $logo_path.$o_brn->url_img;

        // Remove the old logo and upload a new one, but if the user uploads a file with the same name as the old one, doesn't do anything and just keeps it intact.
        if(file_exists($old_logo))
            unlink($logo_path,$old_logo);

        if($old_logo != $logo_path.$get_fn){
            move_uploaded_file($placeholder,$logo_path.$get_fn);

            $o_brn->url_img = $get_fn;

            $logo_update = true;
        }
    }
    
	$r_upd_brn = $o_brn->BRAND_UpdateOne($logo_update);
?>

<html lang=es>
	<head>
		<?php
			include "../../../../../../shared/html_head_setup.php";
		?>
		
		<title><?php echo a_dsb; ?> - <?php echo a_u_brn.$o_brn_dispinfo[1]; ?></title>
	</head>

	<body class="g-sidenav-show bg-gray-600 dark-version">
		<!-- Sidebar -->
		<?php include "../../../../../../shared/Snippets.Sidebar.php"; ?>
		
		<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
			<!-- Top bar conents -->
			<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
				<div class="container-fluid py-1 px-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;"><?php echo a_dsb; ?></a></li>
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="/admin/pages/manage/other"><?php echo a_oman; ?></a></li>
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_u_brn.$o_brn_dispinfo[1]; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_u_brn.$o_brn_dispinfo[1]; ?></h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						<ul class="navbar-nav justify-content-end ms-md-auto pe-md-3 d-flex align-items-center">
							<?php include "../../../../../../shared/Snippets.Adm_Logout.php"; ?>
							
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
				if($r_upd_brn){
					echo "<p>Marca actualizada, <a href=\"../../../\">pincha aquí para volver a la lista</a>.</p>";
				}
				else{
					echo "<p>No se pudo actualizar esta marca, <a href=\"../Edit.php?id_brn=$o_brn_dispinfo[0]\">pincha aquí para volver a intentarlo</a>.</p>";
				}
			?>
		</main>
	
		<?php include "../../../../../../shared/Imports.Scripts.php"; ?>
		
		<script>
			$('#sidebar-choice-8').addClass("active bg-gradient-primary");
		</script>
	</body>
</html>