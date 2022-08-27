<?php
    include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.CliSessionChecker.php";
    include $_SERVER["DOCUMENT_ROOT"]."/client/classes/Utils.CliClassLoader.class.php";
    include $_SERVER["DOCUMENT_ROOT"]."/shared/utils/Utils.Common_Strings.php";

    $o_cvcat = new C_VCAT();
    $o_cveh = new C_Vehicles();
    $o_cvcat_list = $o_cvcat->CVCAT_ShowAllNoD();
?>

<!DOCTYPE html>

<html lang=es>
    <head>
        <?php include "./client/shared/Shared.Head_Data_Setup.php"; ?>

        <title><?php echo g_sn; ?></title>
    </head>

    <body>
        <?php
            include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Header_Contents.php";
            include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Top_Links.php";
            
            outTopHeader(0,true);
        ?>

        <!-- Features start -->
        <div class="container-fluid pt-5">
            <div class="row px-xl-5 pb-3">
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                        <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                        <h5 class="font-weight-semi-bold m-0">Compra fácil</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                        <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                        <h5 class="font-weight-semi-bold m-0">Garantía de estado</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                        <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                        <h5 class="font-weight-semi-bold m-0">Financiables</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                        <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                        <h5 class="font-weight-semi-bold m-0">Soporte 24/7</h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- Features end -->

        <!-- Categories start -->
        <div class="container-fluid pt-5">
            <h2>Explorá las categorías disponibles</h2>

            <div class="row px-xl-5 pb-3">
                <?php
                    foreach($o_cvcat_list as $ovl2){
                        $count_entries = $o_cveh->CVEH_GetCountByVCAT($ovl2->id_tipo);

                        echo "
                            <div class=\"col-lg-4 col-md-6 pb-1\">
                                <div class=\"cat-item d-flex flex-column border mb-4\" style=\"padding: 30px;\">
                                    <p class=\"text-right\">$count_entries->total_veh_cat</p>
                                    <a href=\"./pages/browse/category.php?id_cat=$ovl2->id_tipo\" class=\"cat-img position-relative overflow-hidden mb-3\">
                                        <i class=\"fas $ovl2->icono_fa\" style=\"font-size: 64px;\"></i>
                                    </a>
                                    <h5 class=\"font-weight-semi-bold m-0\">$ovl2->nombre</h5>
                                </div>
                            </div>
                        ";
                    }
                ?>
            </div>
        </div>
        <!-- Categories end -->

        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Footer.php"; ?>

        <!-- Back to top -->
        <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Imports.Scripts.php"; ?>
    </body>
</html>