<!DOCTYPE html>

<?php
	include "../../../../shared/Utils.Admin.SessionCheck.php";
	
	include "../../../../shared/Constant_Strings[A].php";
	include "../../../../../shared/utils/Utils.Common_Strings.php";
?>

<html lang=es>
	<head>
		<?php include "../../../../shared/html_head_setup.php"; ?>
		
		<title><?php echo a_dsb; ?> - <?php echo a_n_ccy; ?></title>
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
							<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo a_n_ccy; ?></li>
						</ol>
						
						<h6 class="font-weight-bolder mb-0"><?php echo a_n_ccy; ?></h6>
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
			
			<p>Ingresa los datos de la divisa que deseas registrar.</p>
			
			<p><?php echo g_snp_reqf; ?> = Campos obligatorios.</p>
			
			<form id=id_form_ccy_reg method=POST action="./act/SubmitAct.New.CCY.php">
				<div class="input-group input-group-outline">
					<label class=form-label>Nombre <?php echo g_snp_reqf; ?></label>
					<input class=form-control name=fln_ccy_name />
				</div>
				<div class="input-group input-group-outline">
					<label class=form-label>Nomenclatura ISO 4217 <?php echo g_snp_reqf; ?></label>
					<input id=id_field_abr class=form-control name=fln_ccy_abr />
				</div>
				<div class="alert alert-warning" role=alert>Esta es una abreviatura de 3 letras correspondiente a la divisa, más información <a href="https://en.wikipedia.org/wiki/ISO_4217#Alpha_codes" target=_blank>en este artículo</a><br/><br/>Ingrese la abreviatura en letra mayúscula.</div>
				<br/>
				<div class="input-group input-group-outline">
					<label class=form-label>Simbolización <?php echo g_snp_reqf; ?></label>
					<input id=id_field_symbol class=form-control name=fln_ccy_symbol />
				</div>
				<p>Posición del símbolo:</p>
				<div class="input-group input-group-outline">
					<input type=radio name=fln_ccy_symbol_pos value=0 />
					<label for=fln_ccy_symbol_pos_b>Antes</label> &emsp;
					
					<input type=radio name=fln_ccy_symbol_pos value=1 />
					<label for=fln_ccy_symbol_pos_a>Después</label>
				</div>
				<p><b>Vista previa:</b> <span id=id_span_symbol_pos_pw>--</span></p>
				
				<br />
				
				<button class="btn btn-success" type=submit><i class="material-icons opacity-10">card_membership</i> Registrar divisa</button>
			</form>
		</main>
	
		<?php include "../../../../shared/Imports.Scripts.php"; ?>

		<script src="/shared/extras/jquery/mask/jquery.mask.min.js"></script>
		<script src="/shared/extras/jquery/validation/jquery.validate.min.js"></script>
		
		<script>
			$('#sidebar-choice-8').addClass("active bg-gradient-primary");
			
			$().ready(function(){
				$("#id_field_abr").mask("CCC",{
					placeholder: "ABC",
					translation: {
						'C': {
							pattern: /[A-Z]/
						}
					}
				});

				$("#id_form_ccy_reg").validate({
					rules:{
						fln_ccy_name: "required",
						fln_ccy_abr: "required",
						fln_ccy_symbol: "required",
						fln_ccy_symbol_pos: "required"
					},
					messages:{
						fln_ccy_name: "Ingrese el nombre de la divisa.",
						fln_ccy_abr: "Ingrese la abreviatura de la divisa.",
						fln_ccy_symbol: "Ingrese el símbolo de la divisa.",
						fln_ccy_symbol_pos: "Escoja la posición del símbolo."
					}
				});

				$("input[type=radio][name=fln_ccy_symbol_pos]").change(function(){
					var ccy_symbol_get = $("#id_field_symbol").val();
					var ccy_symbol_ex = "";

					if(!ccy_symbol_get)
						ccy_symbol_ex = "$";
					else
						ccy_symbol_ex = ccy_symbol_get;

					// Before value
					if(this.value == 0)
						$("#id_span_symbol_pos_pw").html("<span style=\"color: #fc6000;\">" + ccy_symbol_ex + "</span> 123.456.789,00");
					// After value
					else if(this.value == 1)
						$("#id_span_symbol_pos_pw").html("123.456.789,00 <span style=\"color: #fc6000;\">" + ccy_symbol_ex + "</span>");
				});
			});
		</script>
	</body>
</html>
