<?php
    if(!isset($_GET["id_art"])){
        header($_SERVER["DOCUMENT_ROOT"]);
    }
    include $_SERVER["DOCUMENT_ROOT"]."/client/classes/Utils.CliClassLoader.class.php";

    $o_crnt = new C_Rentable();

    $o_crnt_list = $o_crnt->CRNT_ShowAllForList();
?>

<!DOCTYPE html>

<html lang=es>
    <head>
        <?php include  $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Head_Data_Setup.php"; ?>

        <title>Vehículos alquilables - Compraventa de vehículos</title>
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
                <div class="col-lg-3 col-md-12">
                    <div class="border-bottom mb-4 pb-4">
                        <h5 class="font-weight-semi-bold mb-4">Filtrar por precios</h5>
                        <form>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" checked disabled id="price-all">
                                <label class="custom-control-label" for="price-all">Cualquier precio</label>
                                <!-- <span class="badge border font-weight-normal">1000</span> -->
                            </div>
                        </form>

                        <br />
                        <i style="color: red;">No implementado</i>
                    </div>
                </div>

                
                <div class="col-lg-9 col-md-12">
                    <div class="row pb-3">
                    <?php
                        $printed = 0;
                        $year_fab = "";
                        $avail_flavor_text = "";

                        foreach($o_crnt_list as $ocrntl){
                            if($ocrntl->disponibilidad != 0){
                                if($ocrntl->vyf == 0) $year_fab = "Año desc.";
                                else $year_fab = $ocrntl->vyf;

                                if($ocrntl->disponibilidad == 1){
                                    $avail_flavor_text = "<span style=\"color: red;\">¡Último disponible!</span>";
                                }
                                else{
                                    $avail_flavor_text = $ocrntl->disponibilidad." unidades disp.";
                                }
    
                                echo "
                                    <div class=\"col-lg-4 col-md-6 col-sm-12 pb-1\">
                                        <div class=\"card product-item border-0 mb-4\">
                                            <div class=\"card-body border-left border-right text-center p-0 pt-4 pb-3\">
                                                <h6 class=\"text-truncate mb-3\">$ocrntl->bna $ocrntl->vmo ($year_fab)</h6>
                                                <div class=\"d-flex justify-content-center\">
                                                    <h6>$ocrntl->valor_diario_alq $ocrntl->cab</h6>
                                                </div>
                                                <div class=\"d-flex justify-content-center\">
                                                <h6>$avail_flavor_text</h6>
                                                </div>
                                            </div>
                                            <div class=\"card-footer d-flex justify-content-between bg-light border\">
                                                <a href=\"./do/Details.php?id_rnt=$ocrntl->id_art_alq\" class=\"btn btn-sm text-dark p-0\"><i class=\"fas fa-eye text-primary mr-1\"></i>Detalles</a>
                                                <a href=\"./do/Rent.php?id_rnt=$ocrntl->id_art_alq\" class=\"btn btn-sm text-dark p-0\"><i class=\"fas fa-key text-primary mr-1\"></i>Alquilar</a>
                                            </div>
                                        </div>
                                    </div>
                                ";
    
                                $printed++;
                            }
                        }
                            
                        if($printed == 0){
                            echo "<p style=\"text-align: center;\">No hay vehículos disponibles para alquilar.</p>";
                        }
                    ?>
                </div>
            </div>
        </div>

        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Footer.php"; ?>

        <!-- Back to top -->
        <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Imports.Scripts.php"; ?>
    </body>
</html>