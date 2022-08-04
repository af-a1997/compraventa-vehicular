<?php
    include $_SERVER["DOCUMENT_ROOT"]."/client/classes/Utils.CliClassLoader.class.php";

    $o_ctxc = new C_Taxicabs();

    $o_ctxc_list = $o_ctxc->CTXC_ShowAllForList();
?>

<!DOCTYPE html>

<html lang=es>
    <head>
        <?php include  $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Head_Data_Setup.php"; ?>

        <title>Remises - Compraventa de vehículos</title>
    </head>

    <body>
        <?php
            include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Header_Contents.php";
            include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Top_Links.php";
            
            outTopHeader(3);
        ?>
        
        <div class="container-fluid pt-5">
            <div class="row px-xl-5">
                <div class="col-lg-3 col-md-12">
                    <div class="border-bottom mb-4 pb-4">
                        <h5 class="font-weight-semi-bold mb-4">Filtrar por cuota diaria</h5>
                        <form>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" checked disabled id="price-all">
                                <label class="custom-control-label" for="price-all">Cualquiera</label>
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
                        $avail_flavor_text = "";

                        if($o_ctxc_list != null){
                            foreach($o_ctxc_list as $ocxtcl){
                                if($ocxtcl->vyf == 0) $year_fab = "Año desc.";
                                else $year_fab = $ocxtcl->vyf;
    
                                echo "
                                    <div class=\"col-lg-4 col-md-6 col-sm-12 pb-1\">
                                        <div class=\"card product-item border-0 mb-4\">
                                            <div class=\"card-body border-left border-right text-center p-0 pt-4 pb-3\">
                                                <h6 class=\"text-truncate mb-3\">$ocxtcl->bna $ocxtcl->vmo ($year_fab)</h6>
                                                <div class=\"d-flex justify-content-center\">
                                                    <h6>$ocxtcl->costo_d $ocxtcl->cab <span style=\"font-size: 13px;\">/ día</span></h6>
                                                </div>
                                            </div>
                                            <div class=\"card-footer d-flex justify-content-between bg-light border\">
                                                <a href=\"./do/Details.php?id_txc=$ocxtcl->id_remise\" class=\"btn btn-sm text-dark p-0\"><i class=\"fas fa-eye text-primary mr-1\"></i>Detalles</a>
                                                <a href=\"./do/Request_Services.php?id_txc=$ocxtcl->id_remise\" class=\"btn btn-sm text-dark p-0\"><i class=\"fas fa-key text-primary mr-1\"></i>Alquilar</a>
                                            </div>
                                        </div>
                                    </div>
                                ";
                            }
                        }
                            
                        else{
                            echo "<p style=\"text-align: center;\">No hay remises disponibles.</p>";
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