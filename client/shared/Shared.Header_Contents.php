<!-- Topbar Start -->
<div class="container-fluid">
    <!-- There's a top header at [/client/shared/Shared.Topbar.php] which may or may not be included later on. -->
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href=/ class="text-decoration-none" title="Página inicial">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">C</span>ompraventa</h1>
            </a>
        </div>
        <div class="col-lg-6 col-6 text-left">
            <form action="/client/pages/directory/vehicles/do/Search.php" method=GET>
                <div class=input-group>
                    <input name=model_name class="form-control" placeholder="Buscar vehículos en el directorio (solo por modelo)">

                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <!-- I may implement cart/bookmarks at some point, but I find it's not needed for a vehicle shop. -->
        <!--
        <div class="col-lg-3 col-6 text-right">
            <a href="" class="btn border">
                <i class="fas fa-heart text-primary"></i>
                <span class="badge">0</span>
            </a>
            <a href="" class="btn border">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge">0</span>
            </a>
        </div>
        -->
    </div>
</div>
<!-- Topbar End -->