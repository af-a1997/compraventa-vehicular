<?php
    include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.CliSessionChecker.php";
    include $_SERVER["DOCUMENT_ROOT"]."/client/classes/Utils.CliClassLoader.class.php";
    include $_SERVER["DOCUMENT_ROOT"]."/shared/utils/Utils.Common_Strings.php";
    include $_SERVER["DOCUMENT_ROOT"]."/shared/utils/Utils.Gen.Time.php";

    isForLoggedInUser(false);

    $o_cli = new Client();

    // Parameters of new account
	$o_cli->nombre = $_POST["fln_usr_name"];
	$o_cli->apellidos = $_POST["fln_usr_sn"];
	$o_cli->nombre_usuario = $_POST["fln_usr_un"];
	$o_cli->clave = $_POST["fln_usr_pwd"];
	$o_cli->cedula_identidad = $_POST["fln_usr_uypid"];
	$o_cli->email = $_POST["fln_usr_email"];
	$o_cli->residencia_actual = $_POST["fln_usr_hloc"];
	$o_cli->tel_cel = str_replace(' ', '', $_POST["fln_usr_mph"]);
	$o_cli->tel_fijo = str_replace(' ', '', $_POST["fln_usr_lph"]);
	$o_cli->momento_registro = $cdt;

	$check_username_avail = $o_cli->PUBCLI_VerifyUsernameAvail($o_cli->nombre_usuario);
	if($check_username_avail == true)
		header("Location:../?msg=err_username_taken");
	else
        $r_cli_mkprof = $o_cli->PUBCLI_RegAcc();
?>

<!DOCTYPE html>

<html lang=es>
    <head>
        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Head_Data_Setup.php"; ?>

        <title><?php echo c_n_reg." - ".g_sn; ?></title>
    </head>

    <body>
        <?php
            include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Header_Contents.php";
            include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Top_Links.php";
            
            outTopHeader(6);
        ?>

        <div class="container-fluid pt-5">
            <div class="text-center mb-4">
                <h2 class="section-title px-5"><span class="px-2"><?php echo c_n_reg; ?></span></h2>
            </div>
            <div class="row px-xl-5">
                <?php
                    if($r_cli_mkprof)
                        echo "Se ha creado tu cuenta,&nbsp;<a href=\"/login/client/\">inicia sesión</a>.";
                    
                    else
                        echo "Hubo un fallo al crear tu cuenta,&nbsp;<a href=\"../\">vuelve a intentarlo</a>.";
                ?>
            </div>
        </div>

        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Footer.php"; ?>

        <!-- Back to top -->
        <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Imports.Scripts.php"; ?>
    </body>
</html>