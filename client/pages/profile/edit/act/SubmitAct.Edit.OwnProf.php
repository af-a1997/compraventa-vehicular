<?php
    include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.CliSessionChecker.php";
    include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.CliStrings.php";
    include $_SERVER["DOCUMENT_ROOT"]."/client/classes/Utils.CliClassLoader.class.php";
    include $_SERVER["DOCUMENT_ROOT"]."/shared/utils/Utils.Common_Strings.php";

    isForLoggedInUser();

    $o_cli = new Client();

    // Parameters to update
	$o_cli->nombre = $_POST["fln_usr_name"];
	$o_cli->apellidos = $_POST["fln_usr_sn"];
	$o_cli->cedula_identidad = $_POST["fln_usr_uypid"];
	$o_cli->email = $_POST["fln_usr_email"];
	$o_cli->residencia_actual = $_POST["fln_usr_hloc"];
	$o_cli->tel_cel = str_replace(' ', '', $_POST["fln_usr_mph"]);
	$o_cli->tel_fijo = str_replace(' ', '', $_POST["fln_usr_lph"]);

    // ID of user that logged in to update, access check is already performed on first include and called function.
    $o_cli->nro_id_u = $_SESSION["client_id"];

    $r_cli_upd = $o_cli->PUBCLI_EditTheirInfo();
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
                <?php
                    if($r_cli_upd)
                        echo "Tu perfil ha sido actualizado.";
                    
                    else
                        echo "Hubo un fallo al actualizar tu perfil.";
                ?>
            </div>
        </div>

        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Footer.php"; ?>

        <!-- Back to top -->
        <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Imports.Scripts.php"; ?>
    </body>
</html>