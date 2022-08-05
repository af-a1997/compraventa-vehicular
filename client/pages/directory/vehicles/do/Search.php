<?php
    if(!isset($_GET["model_name"])){
        header($_SERVER["DOCUMENT_ROOT"]);

        echo "
            <script>
                window.onload = function(){
                    alert(\"Acción inesperada, el usuario es regresado al inicio.\");
                }
            </script>
        ";
    }
    include $_SERVER["DOCUMENT_ROOT"]."/client/classes/Utils.CliClassLoader.class.php";

    $o_cveh = new C_Vehicles();

    $o_cveh_list = $o_cveh->CVEH_Search($_GET["model_name"]);
?>

<!DOCTYPE html>

<html lang=es>
    <head>
        <?php include  $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Head_Data_Setup.php"; ?>

        <title>Vehículos alquilables - Compraventa de vehículos</title>
    </head>

    <body>
        <?php
            include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Header_Contents.php";
            include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Top_Links.php";
            
            outTopHeader(4);
        ?>
        
        <div class="container-fluid pt-5">
            <div class="row px-xl-5">
                <div class="col-lg-9 col-md-12">
                    <div class="row pb-3">
                    <?php
                        $year_fab = "";

                        if($o_cveh_list != null){
                            foreach($o_cveh_list as $ove){
                                if($ove->anho_fab == 0) $year_fab = "Año desc.";
                                else $year_fab = $ove->anho_fab;
    
                                echo "
                                    <div class=\"col-lg-4 col-md-6 col-sm-12 pb-1\">
                                        <div class=\"card product-item border-0 mb-4\">
                                            <div class=\"card-body border-left border-right text-center p-0 pt-4 pb-3\">
                                                <h6 class=\"text-truncate mb-3\">$ove->bna $ove->modelo ($year_fab)</h6>
                                                <div class=\"d-flex justify-content-center\">
                                                    <h6>$ove->vty</h6>
                                                </div>
                                            </div>
                                            <div class=\"card-footer d-flex justify-content-between bg-light border\">
                                                <a href=\"./Details.php?id_veh=$ove->idno\" class=\"btn btn-sm text-dark p-0\"><i class=\"fas fa-eye text-primary mr-1\"></i>Detalles</a>
                                                <a href=\"./Availability.php?id_veh=$ove->idno\" class=\"btn btn-sm text-dark p-0\"><i class=\"fas fa-list-check text-primary mr-1\"></i>Disponibilidad</a>
                                            </div>
                                        </div>
                                    </div>
                                ";
                            }
                        }
                        
                        else{
                            echo "<p style=\"text-align: center;\">No se encontraron coincidencias.</p>";
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