<?php
    /*  Function that prints the top bar right below the header.
     *  
     *  [selected_item] (int) = highlights which ID of item to add an [active] class, to make it show as the selected section.
     *  [attach_carousel] (boolean) = determines if a slideshows appears next to the top bar, this is best used only in the homepage.
     * */
    
    function outTopHeader($selected_item = 0, $attach_carousel = false){
        $account_top_links = "";

        if(!isset($_SESSION["client_session"]))
            $account_top_links = "
                <a href=\"/login/client/\" class=\"nav-item nav-link\">Iniciar sesión</a>
                <a href=\"/client/pages/register/\" class=\"nav-item nav-link\">Registrarse</a>
            ";

        else
            $account_top_links = "<a href=\"/login/client/act/Logout.php\" class=\"nav-item nav-link\">Cerrar sesión</a>";

        echo "
            <div class=\"container-fluid py-5\">
                <div class=\"row border-top px-xl-5\">
                    <div class=\"col-lg-12\">
                        <nav class=\"navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0\">
                            <a href=/ class=\"text-decoration-none d-block d-lg-none\">
                                <h1 class=\"m-0 display-5 font-weight-semi-bold\"><span class=\"text-primary font-weight-bold border px-3 mr-1\">C</span>ompraventa</h1>
                            </a>
                            <button class=navbar-toggler data-toggle=collapse data-target=\"#navbarCollapse\">
                                <span class=navbar-toggler-icon></span>
                            </button>
                            <div class=\"collapse navbar-collapse justify-content-between\" id=navbarCollapse>
                                <div class=\"navbar-nav mr-auto py-0\">
                                    <a id=id_top_links_0 href=/ class=\"nav-item nav-link\">Inicio</a>
                                    <a id=id_top_links_1 href=\"/client/pages/articles\" class=\"nav-item nav-link\">En venta</a>
                                    <a id=id_top_links_2 href=\"/client/pages/rental\" class=\"nav-item nav-link\">Para alquilar</a>
                                    <a id=id_top_links_3 href=\"/client/pages/rental/taxicab\" class=\"nav-item nav-link\">Remise</a>
                                    <a id=id_top_links_4 href=\"/client/pages/directory/vehicles\" class=\"nav-item nav-link\">Directorio veh.</a>
                                </div>
                                <div class=\"navbar-nav ml-auto py-0\">".$account_top_links."</div>
                            </div>
                        </nav>
                    ";

                    // Picture slideshow that appears at the homepage, if the second parameter is true, shows it.
                    if($attach_carousel == true){
                        echo "
                            <div id=\"header-carousel\" class=\"carousel slide\" data-ride=\"carousel\">
                                <div class=\"carousel-inner\">

                                    <!-- Do note that pictures used here are merely examples fetched from Mercado Libre Uruguay, the vehicles in here AREN'T being sold in this page, it's for illustrative purposes. -->

                                    <div class=\"carousel-item active\" style=\"height: 410px;\">
                                        <img class=\"img-fluid\" src=\"/client/assets/img/examples/D_NQ_NP_2X_963447-MLU50810664795_072022-F.jpg\">
                                        <div class=\"carousel-caption d-flex flex-column align-items-center justify-content-center\">
                                            <div class=p-3 style=\"max-width: 700px;\">
                                                <h4 class=\"text-light text-uppercase font-weight-medium mb-3\">Encontrá el vehículo que buscás</h4>
                                                <h3 class=\"display-4 text-white font-weight-semi-bold mb-4\">Usados y 0km</h3>
                                                <a href=\"/client/pages/articles\" class=\"btn btn-light py-2 px-3\">Revisá la tienda</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Doesn't work for some reason, if I figure this out I'll fix it, it's unimportant for now, until more features are implemented onto the site. -->

                                    <!--
                                    <div class=\"carousel-item\" style=\"height: 410px;\">
                                        <img class=img-fluid src=\"/client/assets/img/examples/D_NQ_NP_2X_853138-MLU50906308183_072022-F.jpg\">
                                        <div class=\"carousel-caption d-flex flex-column align-items-center justify-content-center\">
                                            <div class=p-3 style=\"max-width: 700px;\">
                                                <h4 class=\"text-light text-uppercase font-weight-medium mb-3\">10% Off Your First Order</h4>
                                                <h3 class=\"display-4 text-white font-weight-semi-bold mb-4\">Reasonable Price</h3>
                                                <a href=\"\" class=\"btn btn-light py-2 px-3\">Shop Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class=\"carousel-control-prev\" href=\"#header-carousel\" data-slide=prev>
                                    <div class=\"btn btn-dark\" style=\"width: 45px; height: 45px;\">
                                        <span class=\"carousel-control-prev-icon mb-n2\"></span>
                                    </div>
                                </a>
                                <a class=\"carousel-control-next\" href=\"#header-carousel\" data-slide=\"next\">
                                    <div class=\"btn btn-dark\" style=\"width: 45px; height: 45px;\">
                                        <span class=\"carousel-control-next-icon mb-n2\"></span>
                                    </div>
                                </a> -->

                                </div>
                            </div>
                        ";
                    }

                echo "
                    </div>
                </div>
            </div>
        ";

        echo "
            <script>
                window.onload = function(){
                    var l = document.getElementById(\"id_top_links_".$selected_item."\");

                    l.classList.add(\"active\");
                }
            </script>
        ";
    }
?>