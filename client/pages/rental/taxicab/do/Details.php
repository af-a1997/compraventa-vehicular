<?php
    if(!isset($_GET["id_txc"])){
        header($_SERVER["DOCUMENT_ROOT"]);
    }
    include $_SERVER["DOCUMENT_ROOT"]."/client/classes/Utils.CliClassLoader.class.php";

    $o_ctxc = new C_Taxicabs();
    $o_ctxc->id_remise = $_GET["id_txc"];

    $o_ctxc_info = $o_ctxc->CTXC_ShowOne();

    $year_fab = "";
    $transmission_naming = "";
    $fuel_capacity_format = "";

    if($o_ctxc_info->vyf == 0) $year_fab = "Año desc.";
    else $year_fab = $o_ctxc_info->vyf;

    if($o_ctxc_info->vtr == 0) $transmission_naming = "Manual";
    else $transmission_naming = "Automática";

    if($o_ctxc_info->vfc == null) $fuel_capacity_format = "Desconocida.";
    else $fuel_capacity_format = "$o_ctxc_info->vfc lt.";
?>
<!DOCTYPE html>

<html lang=es>
    <head>
        <?php include  $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Head_Data_Setup.php"; ?>

        <title>Detalles del remise <?php echo "$o_ctxc_info->nombres $o_ctxc_info->apellidos"; ?> - Compraventa de vehículos</title>
    </head>

    <body>
        <?php
            include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Header_Contents.php";
            include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Top_Links.php";
            
            outTopHeader(3);
        ?>

        <div class="container-fluid pt-5">
            <div class="row px-xl-5">
                <div class="col-lg-7 pb-5">
                    <h3 class="font-weight-semi-bold"><?php echo "$o_ctxc_info->bna $o_ctxc_info->vmo ($year_fab)"; ?></h3>
                    <h3 class="font-weight-semi-bold mb-4"><?php echo "$o_ctxc_info->costo_d $o_ctxc_info->cab"; ?></h3>

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
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            <b>Nombre completo del remisero:</b> <?php echo "$o_ctxc_info->nombres"." "."$o_ctxc_info->apellidos"; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Correo electrónico:</b> <?php echo "$o_ctxc_info->email"; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Residencia:</b> <?php echo "$o_ctxc_info->ubicacion_residencia"; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Teléfonos:</b> <?php echo "$o_ctxc_info->tel_cel"." "."$o_ctxc_info->tel_fijo"; ?>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            <b>Vehículo:</b> <?php echo "$o_ctxc_info->bna"." "."$o_ctxc_info->vmo ($year_fab)"; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Matrícula:</b> <?php echo "$o_ctxc_info->mat"; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Cuota diaria:</b> <?php echo "$o_ctxc_info->costo_d"." "."$o_ctxc_info->cab"; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Costo espera por hora:</b> <?php echo "$o_ctxc_info->costo_espera_h"." "."$o_ctxc_info->cab"; ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Especificaciones</h4>
                            <p>Estas son las características del vehículo:</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            <b>Marca:</b> <?php echo $o_ctxc_info->bna; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Modelo:</b> <?php echo $o_ctxc_info->vmo; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Año:</b> <?php echo $year_fab; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Puertas:</b> <?php echo $o_ctxc_info->vdo; ?>
                                        </li>
                                    </ul> 
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            <b>Motor:</b> <?php echo $o_ctxc_info->ven; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Transmisión:</b> <?php echo $transmission_naming; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Tipo de combustible:</b> <?php echo $o_ctxc_info->vft; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Capacidad de tanque:</b> <?php echo $fuel_capacity_format; ?>
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