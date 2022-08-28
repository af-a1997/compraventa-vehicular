<?php
    include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.CliSessionChecker.php";
    include $_SERVER["DOCUMENT_ROOT"]."/client/classes/Utils.CliClassLoader.class.php";
    include $_SERVER["DOCUMENT_ROOT"]."/shared/utils/Utils.Common_Strings.php";

    $o_cli = new Client();

    // Don't allow client to see admin profile.
    $profile_title = "";
    if(isset($_GET["id_usr"]) && ($_GET["id_usr"] != 1)){
        $o_cli->nro_id_u = $_GET["id_usr"];
        $profile_title = "Detalles del usuario ";
    }
    else{
        $o_cli->nro_id_u = $_SESSION["client_id"];
        $profile_title = "Tu perfil";
    }

    $o_cli_info = $o_cli->PUBCLI_ShowTheirInfo();

    if(isset($_GET["id_usr"]) && ($_GET["id_usr"] != $_SESSION["client_id"]))
        $profile_title .= $o_cli_info->nombre_usuario;
?>

<!DOCTYPE html>

<html lang=es>
    <head>
        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Head_Data_Setup.php"; ?>

        <title><?php echo $profile_title." - ".g_sn; ?></title>
    </head>

    <body>
        <?php
            include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Header_Contents.php";
            include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Top_Links.php";
            
            outTopHeader(5);
        ?>

        <div class="container-fluid pt-5">
            <div class="row px-xl-5">
                <div class="col-lg-7 pb-5">
                    <h3 class="font-weight-semi-bold"><?php echo "$o_cli_info->nombre $o_cli_info->apellidos"; ?></h3>
                    <h3 class="font-weight-semi-bold mb-4"><?php echo "$o_cli_info->nombre_usuario"; ?></h3>

                    <?php
                        // Button to edit profile only shows up for owner of profile that logged in.
                        if(!isset($_GET["id_usr"]) || $_GET["id_usr"] == $_SESSION["client_id"])
                            echo "
                                <div class=\"d-flex align-items-center mb-4 pt-2\">
                                    <button id=id_btn_act_edit_profile class=\"btn btn-primary px-3\"><i class=\"fas fa-pencil mr-1\"></i> Editar tu perfil</button>
                                </div>
                            ";
                        // ---
                    ?>
                </div>
            </div>
            <div class="row px-xl-5">
                <div class="col">
                    <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                        <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Detalles</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Detalles personales</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            <b>Cédula de identidad:</b> <?php echo "$o_cli_info->cedula_identidad"; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Contacto por correo:</b> <a href=<?php echo "\"mailto:".$o_cli_info->email."\""; ?>><?php echo $o_cli_info->email; ?></a>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Residencia:</b> <?php echo $o_cli_info->residencia_actual; ?>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <?php
                                            // Cell numbers in Uruguay always start with "09" and contain 9 digits, in international format, the lead "0" is taken out, which makes the number look like: [+5989XXXXXXX]. There's no lead "0" in home number phones, and no number is taken out, so they remain with 8 digits. Users in this system are assumed to be from Uruguay and can input mock number phones for the time being.
                                            $f_mph = substr($o_cli_info->tel_cel,1);
                                        ?>

                                        <li class="list-group-item px-0">
                                            <b>Celular:</b> <a href=<?php echo "\"tel:+598".$f_mph."\""; ?>><?php echo $o_cli_info->tel_cel; ?></a>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Fijo:</b> <a href=<?php echo "\"tel:+598".$o_cli_info->tel_fijo."\""; ?>><?php echo $o_cli_info->tel_fijo; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Footer.php"; ?>

        <!-- Back to top -->
        <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Imports.Scripts.php"; ?>

        <script>
            $("#id_btn_act_edit_profile").click(function(){
                location.href = "./edit/";
            });
        </script>
    </body>
</html>