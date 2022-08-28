<?php
    if(!isset($_GET["id_cat"]))
        header("Location:/");
    
    include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.CliSessionChecker.php";
    include $_SERVER["DOCUMENT_ROOT"]."/client/classes/Utils.CliClassLoader.class.php";
    include $_SERVER["DOCUMENT_ROOT"]."/shared/utils/Utils.Common_Strings.php";

    $o_cvcat = new C_VCAT();
    $o_cveh = new C_Vehicles();

    $o_cveh->categorizacion = $_GET["id_cat"];
    $o_cvcat->id_tipo = $_GET["id_cat"];

    $o_cvcat_info = $o_cvcat->CVCAT_ShowOne();
    $o_cvcat_all = $o_cvcat->CVCAT_ShowAllNoD();
    $o_cveh_list = $o_cveh->CVEH_ShowAllOfCat();
?>

<!DOCTYPE html>

<html lang=es>
    <head>
        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Head_Data_Setup.php"; ?>

        <title>Lista de vehículos en la categoría &laquo;<?php echo $o_cvcat_info->nombre."&raquo; - ".g_sn; ?></title>
    </head>

    <body>
        <?php
            include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Header_Contents.php";
            include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Top_Links.php";
            
            outTopHeader(4);
        ?>

        <div class="row px-xl-5 pb-3">
            <?php
                if($o_cvcat_all != null)
                    foreach($o_cvcat_all as $ovl2){
                        $count_entries = $o_cveh->CVEH_GetCountByVCAT($ovl2->id_tipo);

                        echo "
                            <div class=\"col-lg-3 col-md-6 pb-1\">
                                <div class=\"cat-item d-flex flex-column border mb-3\" style=\"padding: 30px;\">
                                    <p class=\"text-right\">$count_entries->total_veh_cat</p>
                                    <a href=\"./Category.php?id_cat=$ovl2->id_tipo\" class=\"cat-img position-relative overflow-hidden mb-3\">
                                        <i class=\"fas $ovl2->icono_fa\" style=\"font-size: 64px;\"></i>
                                    </a>
                                    <h5 class=\"font-weight-semi-bold m-0\">$ovl2->nombre</h5>
                                </div>
                            </div>
                        ";
                    }
                else echo "<p>No hay categorías registradas</p>";
            ?>
        </div>

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

                        <br/>

                        <h5 class="font-weight-semi-bold mb-4">Filtrar por marca</h5>
                        <form>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" checked disabled id="price-all">
                                <label class="custom-control-label" for="price-all">Cualquier marca</label>
                                <!-- <span class="badge border font-weight-normal">1000</span> -->
                            </div>
                        </form>

                        <br/>

                        <h5 class="font-weight-semi-bold mb-4">Filtrar por año</h5>
                        <form>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" checked disabled id="price-all">
                                <label class="custom-control-label" for="price-all">Cualquier año</label>
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
                    <div class=row>
                        <div class="col-12">
                            <div class="alert alert-info" role=alert><i class=<?php echo "\"fas ".$o_cvcat_info->icono_fa."\""; ?>></i> <b><?php echo $o_cvcat_info->nombre; ?></b>: <?php echo $o_cvcat_info->descripcion; ?></div>
                        </div>
                    </div>
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
                            TODO: Put below "<div class=\"card product-item border-0 mb-4\">" once uploading with pictures has been implemented:

                            _____

                            <div class=\"card-header product-img position-relative overflow-hidden bg-transparent border p-0\">
                                <img class=\"img-fluid w-100\" src=\"\">
                            </div>

                            _____
                        -->

                        <?php
                            $year_fab = "";

                            if($o_cveh_list != null)
                                foreach($o_cveh_list as $en_v){
                                    if($en_v->categorizacion == $_GET["id_cat"]){

                                        if($en_v->anho_fab == 0) $year_fab = "Año desc.";
                                        else $year_fab = $en_v->anho_fab;

                                        echo "
                                            <div class=\"col-lg-4 col-md-6 col-sm-12 pb-1\">
                                                <div class=\"card product-item border-0 mb-4\">
                                                    <div class=\"card-body border-left border-right text-center p-0 pt-4 pb-3\">
                                                        <h6 class=\"text-truncate mb-3\">$en_v->bna $en_v->modelo ($year_fab)</h6>
                                                        <div class=\"d-flex justify-content-center\">
                                                            <h6>--</h6>
                                                        </div>
                                                    </div>
                                                    <div class=\"card-footer d-flex justify-content-between bg-light border\">
                                                        <a href=\"../directory/vehicle/do/Details.php?id_art=$en_v->idno\" class=\"btn btn-sm text-dark p-0\"><i class=\"fas fa-eye text-primary mr-1\"></i>Detalles</a>
                                                        <a href=\"../articles/?by_veh_id=$en_v->idno\" class=\"btn btn-sm text-dark p-0\"><i class=\"fas fa-shopping-cart text-primary mr-1\"></i>En venta (?)</a>
                                                    </div>
                                                </div>
                                            </div>
                                        ";
                                    }
                                }
                                
                            else echo "<p style=\"text-align: center;\">No hay resultados, intenta buscar otra categoría.</p>";
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