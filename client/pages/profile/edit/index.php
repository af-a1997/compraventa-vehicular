<?php
    include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.CliSessionChecker.php";
    include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.CliStrings.php";
    include $_SERVER["DOCUMENT_ROOT"]."/client/classes/Utils.CliClassLoader.class.php";
    include $_SERVER["DOCUMENT_ROOT"]."/shared/utils/Utils.Common_Strings.php";

    isForLoggedInUser();

    $o_cli = new Client();

    $o_cli->nro_id_u = $_SESSION["client_id"];
    
    $o_cli_info = $o_cli->PUBCLI_ShowTheirInfo();
?>

<!DOCTYPE html>

<html lang=es>
    <head>
        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Head_Data_Setup.php"; ?>

        <title><?php echo c_u_prof." - ".g_sn; ?></title>
    </head>

    <body>
        <?php
            include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Header_Contents.php";
            include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Top_Links.php";
            
            outTopHeader(6);
        ?>

        <div class="container-fluid pt-5">
            <div class="text-center mb-4">
                <h2 class="section-title px-5"><span class="px-2"><?php echo c_u_prof; ?></span></h2>
            </div>
            <div class="row px-xl-5">
                <div class="col-lg-7 mb-5">
                    <div class="contact-form">
                        <form id=id_form_edit_prof method=POST action="act/SubmitAct.Edit.OwnProf.php">
                            <div class="control-group">
                                <label for=fln_usr_name>Nombre(s) <?php echo g_snp_reqf; ?></label>
                                <input name=fln_usr_name class=form-control placeholder="Tu(s) nombre(s)" value=<?php echo "\"$o_cli_info->nombre\""; ?> />
                            </div>
                            <br />
                            <div class="control-group">
                                <label for=fln_usr_sn>Apellido(s) <?php echo g_snp_reqf; ?></label>
                                <input name=fln_usr_sn class=form-control placeholder="Tu(s) apellido(s)" value=<?php echo "\"$o_cli_info->apellidos\""; ?> />
                            </div>
                            <br />
                            <div class="control-group">
                                <label for=fln_usr_uypid>Cédula de Identidad <?php echo g_snp_reqf; ?></label>
                                <input id=id_field_uypid name=fln_usr_uypid class=form-control value=<?php echo "\"$o_cli_info->cedula_identidad\""; ?> />
                            </div>
                            <br />
                            <div class="control-group">
                                <label for=fln_usr_email>E-mail <?php echo g_snp_reqf; ?></label>
                                <input name=fln_usr_email class=form-control placeholder="Tu dirección de correo" value=<?php echo "\"$o_cli_info->email\""; ?> />
                            </div>
                            <br />
                            <div class="control-group">
                                <label for=fln_usr_hloc>Ubicación de residencia <?php echo g_snp_reqf; ?></label>
                                <input name=fln_usr_hloc class=form-control placeholder="Calle y número de tu casa" value=<?php echo "\"$o_cli_info->residencia_actual\""; ?> />
                            </div>
                            <br />
                            <div class="control-group">
                                <label for=fln_usr_mph>Teléfono celular <?php echo g_snp_reqf; ?></label>
                                <input id=id_field_mph name=fln_usr_mph class=form-control value=<?php echo "\"$o_cli_info->tel_cel\""; ?> />
                            </div>
                            <br />
                            <div class="control-group">
                                <label for=fln_usr_lph>Teléfono fijo <?php echo g_snp_reqf; ?></label>
                                <input id=id_field_lph name=fln_usr_lph class=form-control value=<?php echo "\"$o_cli_info->tel_fijo\""; ?> />
                            </div>

                            <br />

                            <div>
                                <button class="btn btn-primary py-2 px-4" type="submit"><i class="fas fa-floppy-disk mr-1"></i>Guardar</button>
                                <a class="btn btn-danger py-2 px-4" href="../"><i class="fas fa-xmark"></i> Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 mb-5">
                    <h5 class="font-weight-semi-bold mb-3"><?php echo g_ab; ?></h5>
                    <p>Aquí podrás editar tu perfil de usuario.</p>
                    <div class="d-flex flex-column mb-3">
                        <h5 class="font-weight-semi-bold mb-3">Recuerda que...</h5>
                        <p class="mb-2"><i class="fas fa-triangle-exclamation text-primary mr-3"></i> Todos los campos marcados con un &laquo;<?php echo g_snp_reqf; ?>&raquo; son obligatorios.</p>
                    </div>
                    <div class="d-flex flex-column">
                        <h5 class="font-weight-semi-bold mb-3">Además...</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Mantén actualizada tu información de contacto y localización para que podamos contactarte y/o recibir nuestros productos en frente de tu casa.</p>
                    </div>
                </div>
            </div>
        </div>

        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Footer.php"; ?>

        <!-- Back to top -->
        <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Imports.Scripts.php"; ?>

		<script src="/shared/extras/jquery/mask/jquery.mask.min.js"></script>
        <script src="/shared/extras/jquery/validation/jquery.validate.min.js"></script>

        <script>
			$().ready(function(){
			    $("#id_field_uypid").mask("0.000.000-0",{ placeholder: "1.234.567-8" });
                $("#id_field_mph").mask("000 000 000",{ placeholder: "09X XXX XXX" });
                $("#id_field_lph").mask("0000 0000",{ placeholder: "XXXX XXXX" });

				$("#id_form_brn_edit").validate({
					rules:{
						fln_usr_name: "required",
						fln_usr_sn: "required",
						fln_usr_uypid: "required",
						fln_usr_email: {
                            email: true,
                            required: true
                        },
						fln_usr_hloc: "required",
						fln_usr_mph: "required",
						fln_usr_lph: "required"
					},
					messages:{
						fln_usr_name: "Ingresa tu nombre.",
						fln_usr_sn: "Ingresa tu apellido.",
						fln_usr_uypid: "Ingresa tu cédula de identidad.",
                        fln_usr_email: "Ingresa una dirección de correo válida.",
                        fln_usr_hloc: "Ingresa tu dirección de residencia.",
                        fln_usr_mph: "Ingresa tu número móvil.",
                        fln_usr_lph: "Ingresa tu número fijo."
					}
				});
			});
        </script>
    </body>
</html>