<?php
    function outTopHeader($selected_item = 0){
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
                                </div>
                                <div class=\"navbar-nav ml-auto py-0\">".$account_top_links."</div>
                            </div>
                        </nav>
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