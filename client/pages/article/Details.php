<?php
    if(!isset($_GET["id_art"]))
        header($_SERVER["DOCUMENT_ROOT"]);
    
    include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.CliSessionChecker.php";
    include $_SERVER["DOCUMENT_ROOT"]."/client/classes/Utils.CliClassLoader.class.php";
    include $_SERVER["DOCUMENT_ROOT"]."/shared/utils/Utils.Common_Strings.php";

    $o_csl = new C_Sellable();
    $o_csl->id_art_venta = $_GET["id_art"];

    $o_csl_info = $o_csl->CSL_ArticleDetails();

    $year_fab = "";
    $transmission_naming = "";
    $fuel_capacity_format = "";

    if($o_csl_info->vyf == 0) $year_fab = "Año desc.";
    else $year_fab = $o_csl_info->vyf;

    if($o_csl_info->vtr == 0) $transmission_naming = "Manual";
    else $transmission_naming = "Automática";

    if($o_csl_info->vfc == null) $fuel_capacity_format = "Desconocida.";
    else $fuel_capacity_format = "$o_csl_info->vfc lt.";
?>
<!DOCTYPE html>

<html lang=es>
    <head>
        <?php include  $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Head_Data_Setup.php"; ?>

        <title>Detalles del <?php echo "$o_csl_info->bna $o_csl_info->vmo ($year_fab) - ".g_sn; ?></title>
    </head>

    <body>
        <?php
            include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Header_Contents.php";
            include $_SERVER["DOCUMENT_ROOT"]."/client/shared/Shared.Top_Links.php";

            outTopHeader(1);
        ?>

        <div class="container-fluid py-5">
            <div class="row px-xl-5">
                <!-- TODO: implement multi-picture upload, once it's done, implement slideshow of article pictures. -->
                <!--
                <div class="col-lg-5 pb-5">
                    <div id="product-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner border">
                            <div class="carousel-item active">
                                <img class="w-100 h-100" src="img/product-1.jpg" alt="Image">
                            </div>
                            <div class="carousel-item">
                                <img class="w-100 h-100" src="img/product-2.jpg" alt="Image">
                            </div>
                            <div class="carousel-item">
                                <img class="w-100 h-100" src="img/product-3.jpg" alt="Image">
                            </div>
                            <div class="carousel-item">
                                <img class="w-100 h-100" src="img/product-4.jpg" alt="Image">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                        </a>
                    </div>
                </div>
                -->
                
                <!-- TODO: prepared code to use for showing a single picture, don't use for now. -->
                <!--
                <div class="col-lg-5 pb-5">
                    <div id="product-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner border">
                            <div class="carousel-item active">
                                <img class="w-100 h-100" src= />
                            </div>
                        </div>
                    </div>
                </div>
                -->

                <div class="col-lg-7 pb-5">
                    <h3 class="font-weight-semi-bold"><?php echo "$o_csl_info->bna $o_csl_info->vmo ($year_fab)"; ?></h3>
                    <!-- TODO: I don't think there's a need to implement reviews right now, and even if I did, I feel like it'd make sense only for the sellers or taxicab managers, but not the sellable articles. -->
                    <!--
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">(50 Reviews)</small>
                    </div>
                    -->
                    <h3 class="font-weight-semi-bold mb-4"><?php echo "$o_csl_info->valor_venta $o_csl_info->cab"; ?></h3>
                    <!--
                    <div class="d-flex mb-3">
                        <p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p>
                        <form>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="size-1" name="size">
                                <label class="custom-control-label" for="size-1">XS</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="size-2" name="size">
                                <label class="custom-control-label" for="size-2">S</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="size-3" name="size">
                                <label class="custom-control-label" for="size-3">M</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="size-4" name="size">
                                <label class="custom-control-label" for="size-4">L</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="size-5" name="size">
                                <label class="custom-control-label" for="size-5">XL</label>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex mb-4">
                        <p class="text-dark font-weight-medium mb-0 mr-3">Colors:</p>
                        <form>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="color-1" name="color">
                                <label class="custom-control-label" for="color-1">Black</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="color-2" name="color">
                                <label class="custom-control-label" for="color-2">White</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="color-3" name="color">
                                <label class="custom-control-label" for="color-3">Red</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="color-4" name="color">
                                <label class="custom-control-label" for="color-4">Blue</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="color-5" name="color">
                                <label class="custom-control-label" for="color-5">Green</label>
                            </div>
                        </form>
                    </div>
                    -->

                    <!-- TODO: For now I'll do a basic implementation of a fictional purchase by removing the article and registering the purchase as successful, later I'll refine this if and when I can. -->

                    <div class="d-flex align-items-center mb-4 pt-2">
                        <button id=id_btn_act_buy_veh class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Comprar</button>
                    </div>
                </div>
            </div>
            <div class="row px-xl-5">
                <div class="col">
                    <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                        <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Detalles</a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Especificaciones</a>
                        <!-- <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a> -->
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Detalles</h4>
                            <p><?php echo "$o_csl_info->detalles"; ?></p>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Especificaciones</h4>
                            <p>Estas son las características del vehículo:</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            <b>Puertas:</b> <?php echo $o_csl_info->vdo; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Transmisión:</b> <?php echo $transmission_naming; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Tipo de combustible:</b> <?php echo $o_csl_info->vft; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Capacidad de tanque:</b> <?php echo $fuel_capacity_format; ?>
                                        </li>
                                    </ul> 
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            <b>Motor:</b> <?php echo $o_csl_info->ven; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Marca:</b> <?php echo $o_csl_info->bna; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Modelo:</b> <?php echo $o_csl_info->vmo; ?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <b>Año:</b> <?php echo $year_fab; ?>
                                        </li>
                                    </ul> 
                                </div>
                            </div>
                        </div>

                        <!-- TODO: again, there's no need for reviews until later. -->

                        <!--
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb-4">1 review for "Colorful Stylish Shirt"</h4>
                                    <div class="media mb-4">
                                        <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                            <div class="text-primary mb-2">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="mb-4">Leave a review</h4>
                                    <small>Your email address will not be published. Required fields are marked *</small>
                                    <div class="d-flex my-3">
                                        <p class="mb-0 mr-2">Your Rating * :</p>
                                        <div class="text-primary">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                    </div>
                                    <form>
                                        <div class="form-group">
                                            <label for="message">Your Review *</label>
                                            <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Your Name *</label>
                                            <input type="text" class="form-control" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Your Email *</label>
                                            <input type="email" class="form-control" id="email">
                                        </div>
                                        <div class="form-group mb-0">
                                            <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        -->
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