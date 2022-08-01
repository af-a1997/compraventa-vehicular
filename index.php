<?php
    include $_SERVER["DOCUMENT_ROOT"]."/client/classes/Utils.CliClassLoader.class.php";

    $o_cvcat = new C_VCAT();
    $o_cveh = new C_Vehicles();
    $o_cvcat_list = $o_cvcat->CVCAT_ShowAllNoD();
?>
<!DOCTYPE html>

<html lang=es>
    <head>
        <?php include "./client/shared/Shared.Head_Data_Setup.php"; ?>

        <title>Compraventa de vehículos</title>
    </head>

    <body>
        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Header_Contents.php"; ?>

        <!-- Navbar Start -->
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
                                    echo "<a href=\"./client/pages/browse/Category.php?id_cat=$ovl->id_tipo\" class=\"nav-item nav-link\">$ovl->nombre</a>";
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
                                <a href="/" class="nav-item nav-link active">Inicio</a>
                                <a href="/client/pages/articles" class="nav-item nav-link">En venta</a>
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
                    <div id="header-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <!-- Do note that pictures used here are merely examples fetched from Mercado Libre Uruguay, the vehicles in here AREN'T being sold in this page, it's for illustrative purposes. -->
                            <div class="carousel-item active" style="height: 410px;">
                                <img class="img-fluid" src="/client/assets/img/examples/D_NQ_NP_2X_963447-MLU50810664795_072022-F.jpg" alt="Image">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h4 class="text-light text-uppercase font-weight-medium mb-3">Encontrá el vehículo que buscás</h4>
                                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Usados y 0km</h3>
                                        <a href="/client/pages/articles" class="btn btn-light py-2 px-3">Revisá la tienda</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Doesn't work for some reason, if I figure this out I'll fix it, it's unimportant for now, until more features are implemented onto the site. -->
                            <!--
                            <div class="carousel-item" style="height: 410px;">
                                <img class="img-fluid" src="/client/assets/img/examples/D_NQ_NP_2X_853138-MLU50906308183_072022-F.jpg" alt="Image">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4>
                                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Reasonable Price</h3>
                                        <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                                <span class="carousel-control-prev-icon mb-n2"></span>
                            </div>
                        </a>
                        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                                <span class="carousel-control-next-icon mb-n2"></span>
                            </div>
                        </a>
                            -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar End -->

        <!-- Featured Start -->
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
        <!-- Featured End -->


        <!-- Categories Start -->
        <div class="container-fluid pt-5">
            <h2>Explora las categorías disponibles</h2>

            <div class="row px-xl-5 pb-3">
                <?php
                    // TODO: proper icon selection, maybe by adding an icon column to vehicle category, since categories could be added/removed, but for testing purposes, this'll be kept in the meantime.
                    $cat_icons = array("<i class=\"fas fa-car\" style=\"font-size: 64px;\"></i>","<i class=\"fas fa-van-shuttle\" style=\"font-size: 64px;\"></i>","<i class=\"fas fa-truck\" style=\"font-size: 64px;\"></i>","<i class=\"fas fa-motorcycle\" style=\"font-size: 64px;\"></i>");
                    $cat_icons_x = 0;

                    foreach($o_cvcat_list as $ovl2){
                        $count_entries = $o_cveh->CVEH_GetCountByVCAT($ovl2->id_tipo)[0];

                        echo "
                            <div class=\"col-lg-4 col-md-6 pb-1\">
                                <div class=\"cat-item d-flex flex-column border mb-4\" style=\"padding: 30px;\">
                                    <p class=\"text-right\">$count_entries->total_veh_cat</p>
                                    <a href=\"./pages/browse/category.php?id_cat=$ovl2->id_tipo\" class=\"cat-img position-relative overflow-hidden mb-3\">
                                        $cat_icons[$cat_icons_x]
                                    </a>
                                    <h5 class=\"font-weight-semi-bold m-0\">$ovl2->nombre</h5>
                                </div>
                            </div>
                        ";

                        $cat_icons_x++;
                    }
                ?>
            </div>
        </div>
        <!-- Categories End -->

        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Footer.php"; ?>

        <!-- Back to top -->
        <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

        <?php include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Imports.Scripts.php"; ?>
    </body>
</html>