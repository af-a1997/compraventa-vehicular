<?php
    if(!isset($_GET["id_cat"])){
        header($_SERVER["DOCUMENT_ROOT"]);
    }
    include $_SERVER["DOCUMENT_ROOT"]."/client/classes/Utils.CliClassLoader.class.php";

    $o_cvcat = new C_VCAT();
    $o_cveh = new C_Vehicles();
    $o_csl = new C_Sellable();

    $o_cvcat_list = $o_cvcat->CVCAT_ShowAllNoD();
    $o_csl_list = $o_csl->CSL_ListAllPub();
?>
<!DOCTYPE html>

<html lang=es>
    <head>
        <?php include  $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Head_Data_Setup.php"; ?>

        <title>Lista de <?php echo $_GET["id_cat"]; ?> - Compraventa de vehículos</title>
    </head>

    <body>
        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Header_Contents.php"; ?>
        <!--
            Won't include [Shared.Top_Links.php] and run the function (for now at least), because there are a few unique elements mixed in-between, most notably the category menu. So...

            TODO: try to find a fix for this later.
        -->

        <!-- Navbar start -->
        <div class="container-fluid mb-5">
            <div class="row border-top px-xl-5">
                <div class="col-lg-3 d-none d-lg-block">
                    <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                        <h6 class="m-0">Categorías</h6>
                        <i class="fa fa-angle-down text-dark"></i>
                    </a>
                    <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                        <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                            <?php
                                foreach($o_cvcat_list as $ovl){
                                    $count_entries = $o_cveh->CVEH_GetCountByVCAT($ovl->id_tipo)[0];

                                    if($ovl->id_tipo == $_GET["id_cat"])
                                        echo "<a href=\"./pages/browse/Category.php?id_cat=$ovl->id_tipo\" class=\"nav-item nav-link active\">$ovl->nombre ($count_entries->total_veh_cat)</a>";
                                    else
                                        echo "<a href=\"./pages/browse/Category.php?id_cat=$ovl->id_tipo\" class=\"nav-item nav-link\">$ovl->nombre ($count_entries->total_veh_cat)</a>";
                                }
                            ?>
                        </div>
                    </nav>
                </div>
                <div class="col-lg-9">
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
                                <a href="/client/pages/articles" class="nav-item nav-link active">En venta</a>
                                <a href="/client/pages/rental" class="nav-item nav-link">Para alquilar</a>
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

                    <p>Desplázate hacia abajo para ver los vehículos de esta categoría.</p>
                </div>
            </div>
        </div>
        <!-- Navbar end -->

        <!-- Shop start -->
        <div class="container-fluid pt-5">
            <div class="row px-xl-5">
                <!-- Shop sidebar start -->
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
                <!-- Shop sidebar end -->

                <!-- Shop products start -->
                <div class="col-lg-9 col-md-12">
                    <div class="row pb-3">
                        <!--
                        <div class="col-12 pb-1">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <form action="">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search by name">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-transparent text-primary">
                                                <i class="fa fa-search"></i>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                                <div class="dropdown ml-4">
                                    <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                                Sort by
                                            </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                        <a class="dropdown-item" href="#">Latest</a>
                                        <a class="dropdown-item" href="#">Popularity</a>
                                        <a class="dropdown-item" href="#">Best Rating</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        -->

                        <!--
                            TODO: Put below "<div class=\"card product-item border-0 mb-4\">" once uploading with pictues has been implemented:

                            _____

                            <div class=\"card-header product-img position-relative overflow-hidden bg-transparent border p-0\">
                                <img class=\"img-fluid w-100\" src=\"\">
                            </div>

                            _____
                        -->

                        <?php
                            $printed = 0;
                            $year_fab = "";

                            foreach($o_csl_list as $ocsll){
                                if($ocsll->vca == $_GET["id_cat"]){

                                    if($ocsll->vyf == 0) $year_fab = "Año desc.";
                                    else $year_fab = $ocsll->vyf;

                                    echo "
                                        <div class=\"col-lg-4 col-md-6 col-sm-12 pb-1\">
                                            <div class=\"card product-item border-0 mb-4\">
                                                <div class=\"card-body border-left border-right text-center p-0 pt-4 pb-3\">
                                                    <h6 class=\"text-truncate mb-3\">$ocsll->bna $ocsll->vmo ($year_fab)</h6>
                                                    <div class=\"d-flex justify-content-center\">
                                                        <h6>$ocsll->valor_venta $ocsll->cab</h6></h6>
                                                    </div>
                                                </div>
                                                <div class=\"card-footer d-flex justify-content-between bg-light border\">
                                                    <a href=\"../article/Details.php?id_art=$ocsll->id_art_venta\" class=\"btn btn-sm text-dark p-0\"><i class=\"fas fa-eye text-primary mr-1\"></i>Detalles</a>
                                                    <a href=\"../article/Purchase.php?id_art=$ocsll->id_art_venta\" class=\"btn btn-sm text-dark p-0\"><i class=\"fas fa-shopping-cart text-primary mr-1\"></i>Comprar</a>
                                                </div>
                                            </div>
                                        </div>
                                    ";

                                    $printed++;
                                }
                            }
                                
                            if($printed == 0){
                                echo "<p style=\"text-align: center;\">No hay resultados, intenta buscar otra categoría.</p>";
                            }
                        ?>

                        <!--
                            TODO: if discounts are implemented, add this after the <h6> containing the price of product:

                            _____

                            <h6 class=\"text-muted ml-2\"><del>[discount price here]</del>

                            _____
                        -->

                        <!--
                        <div class="col-12 pb-1">
                            <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mb-3">
                                <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                                </li>
                            </ul>
                            </nav>
                        </div>
                        -->
                    </div>
                </div>
                <!-- Shop Product End -->
            </div>
        </div>

        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Footer.php"; ?>

        <!-- Back to top -->
        <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Imports.Scripts.php"; ?>
    </body>
</html>