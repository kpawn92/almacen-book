<div class="cerodiv row" id="dash">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#" class="btn btn-primary ms-2" id="export"><i class="uil-down-arrow"></i> PDF</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Panel de control</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row" id="panel_control">
        <div class="col-xxl-3 col-lg-6">
            <div class="card widget-flat bg-success text-white">
                <div class="card-body">
                    <div class="float-end">
                        <i class="mdi mdi-book-education widget-icon bg-white text-success"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Libros</h6>
                    <h3 class="mt-3 mb-3">0</h3>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-lg-6">
            <div class="card widget-flat bg-primary text-white">
                <div class="card-body">
                    <div class="float-end">
                        <i class="mdi mdi-account-multiple widget-icon bg-white text-primary"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Estudiantes</h6>
                    <h3 class="mt-3 mb-3">0</h3>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-lg-6">
            <div class="card widget-flat bg-danger text-white">
                <div class="card-body">
                    <div class="float-end">
                        <i class="mdi mdi-book-cancel widget-icon bg-white text-danger"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">P&eacute;rdidas</h6>
                    <h3 class="mt-3 mb-3">0</h3>
                </div>
            </div>
        </div> <!-- end col-->
        <div class="col-xxl-3 col-lg-6">
            <div class="card widget-flat bg-warning text-black">
                <div class="card-body">
                    <div class="float-end">
                        <i class="mdi mdi-cash-usd widget-icon bg-white text-warning"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Ventas</h6>
                    <h3 class="mt-3 mb-3">0</h3>
                </div>
            </div>
        </div> <!-- end col-->
    </div>
    <?= $this->include('pages/dependencias/panel'); ?>
</div>