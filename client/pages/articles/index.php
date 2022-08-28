<?php
    include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.CliSessionChecker.php";
    include $_SERVER["DOCUMENT_ROOT"]."/client/classes/Utils.CliClassLoader.class.php";
    include $_SERVER["DOCUMENT_ROOT"]."/shared/utils/Utils.Common_Strings.php";
    include $_SERVER["DOCUMENT_ROOT"]."/shared/utils/Utils.Price_Fmt.php";

    $o_csll = new C_Sellable();

    $o_csll_list = $o_csll->CSL_ListAllPub();
?>

<!DOCTYPE html>

<html lang=es>
    <head>
        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Head_Data_Setup.php"; ?>

        <title>Lista de vehículos en venta - <?php echo g_sn; ?></title>
    </head>

    <body>
        <?php
            include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Header_Contents.php";
            include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Top_Links.php";
            
            outTopHeader(1);
        ?>

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
                
                <div class="col-lg-9 col-md-12">
                    <div class="row pb-3">
                        <?php
                            $year_fab = "";

                            if($o_csll_list != null)
                                foreach($o_csll_list as $arts){
                                    if($arts->vyf == 0) $year_fab = "Año desc.";
                                    else $year_fab = $arts->vyf;

                                    $veh_cost = PRI_FormatCost($arts->valor_venta,$arts->csy,$arts->cpo);

                                    echo "
                                        <div class=\"col-lg-4 col-md-6 col-sm-12 pb-1\">
                                            <div class=\"card product-item border-0 mb-4\">
                                                <div class=\"card-body border-left border-right text-center p-0 pt-4 pb-3\">
                                                    <h6 class=\"text-truncate mb-3\">$arts->bna $arts->vmo ($year_fab)</h6>
                                                    <div class=\"d-flex justify-content-center\">
                                                        <h6><b>Cont.:</b> $veh_cost</h6>
                                                    </div>
                                                </div>
                                                <div class=\"card-footer d-flex justify-content-between bg-light border\">
                                                    <a href=\"../article/Details.php?id_art=$arts->id_art_venta\" class=\"btn btn-sm text-dark p-0\"><i class=\"fas fa-eye text-primary mr-1\"></i>Detalles</a>
                                                    <a href=\"../article/Purchase.php?id_art=$arts->id_art_venta\" class=\"btn btn-sm text-dark p-0\"><i class=\"fas fa-shopping-cart text-primary mr-1\"></i>Comprar</a>
                                                </div>
                                            </div>
                                        </div>
                                    ";
                                } 
                            else echo "<p style=\"text-align: center;\">No hay vehículos a la venta.</p>";
                        ?>
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