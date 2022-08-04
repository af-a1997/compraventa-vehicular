<?php
    if(!isset($_GET["id_rnt"])){
        header($_SERVER["DOCUMENT_ROOT"]);
    }
    include $_SERVER["DOCUMENT_ROOT"]."/client/classes/Utils.CliClassLoader.class.php";

    $o_crnt = new C_Rentable();
    $o_crnt->id_art_alq = $_GET["id_rnt"];

    $o_crnt_info = $o_crnt->CRNT_ShowOne();

    $year_fab = "";
    $transmission_naming = "";
    $fuel_capacity_format = "";

    if($o_crnt_info->vyf == 0) $year_fab = "Año desc.";
    else $year_fab = $o_crnt_info->vyf;

    if($o_crnt_info->vtr == 0) $transmission_naming = "Manual";
    else $transmission_naming = "Automática";

    if($o_crnt_info->vfc == null) $fuel_capacity_format = "Desconocida.";
    else $fuel_capacity_format = "$o_crnt_info->vfc lt.";
?>
<!DOCTYPE html>

<html lang=es>
    <head>
        <?php include  $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Head_Data_Setup.php"; ?>

        <title>Detalles del <?php echo "$o_crnt_info->bna $o_crnt_info->vmo ($year_fab)"; ?> para alquilar - Compraventa de vehículos</title>
    </head>

    <body>
        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Header_Contents.php"; ?>

        <div class="container-fluid py-5">
            <div class="row border-top px-xl-5">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                        <a href="/" class="text-decoration-none d-block d-lg-none">
                            <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">C</span>ompraventa</h1>
                        </a>
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav mr-auto py-0">
                                <a href="/" class="nav-item nav-link">Inicio</a>
                                <a href="/client/pages/articles" class="nav-item nav-link">En venta</a>
                                <a href="/client/pages/rental" class="nav-item nav-link active">Para alquilar</a>
                                <a href="/client/pages/rental/taxicab" class="nav-item nav-link">Remise</a>
                            </div>
                            <div class="navbar-nav ml-auto py-0">
                                <?php
                                    if(!isset($_SESSION["client_session"])){
                                        echo "
                                            <a href=\"/login/client/\" class=\"nav-item nav-link\">Iniciar sesión</a>
                                            <a href=\"/client/pages/register/\" class=\"nav-item nav-link\">Registrarse</a>
                                        ";
                                    }
                                    else{
                                        echo "<a href=\"/login/client/act/Logout.php\" class=\"nav-item nav-link\">Cerrar sesión</a>";
                                    }
                                ?>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        <div class="container-fluid pt-5">
            <div class="row px-xl-5">
                <div class="col-lg-7 pb-5">
                    <h3 class="font-weight-semi-bold"><?php echo "$o_crnt_info->bna $o_crnt_info->vmo ($year_fab)"; ?></h3>
                    <h3 class="font-weight-semi-bold mb-4"><?php echo "$o_crnt_info->valor_diario_alq $o_crnt_info->cab"; ?></h3>

                    <div class="d-flex align-items-center mb-4 pt-2">
                        <button id=id_btn_act_rnt_veh class="btn btn-primary px-3"><i class="fa fa-key mr-1"></i> Alquilar</button>
                    </div>
                </div>
            </div>
            <div class="row px-xl-5">
                <div class="col">
                    <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                        <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Detalles</a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Especificaciones</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Detalles</h4>
                            <p><b>Costo por día:</b> <?php echo "$o_crnt_info->valor_diario_alq"." "."$o_crnt_info->cab"; ?></p>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Especificaciones</h4>
                            <p>Estas son las características del vehículo:</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            <b>Puertas:</b> <?php echo $o_crnt_info->vdo; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Transmisión:</b> <?php echo $transmission_naming; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Tipo de combustible:</b> <?php echo $o_crnt_info->vft; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Capacidad de tanque:</b> <?php echo $fuel_capacity_format; ?>
                                        </li>
                                    </ul> 
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            <b>Motor:</b> <?php echo $o_crnt_info->ven; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Marca:</b> <?php echo $o_crnt_info->bna; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Modelo:</b> <?php echo $o_crnt_info->vmo; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Año:</b> <?php echo $year_fab; ?>
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
    </body>
</html>