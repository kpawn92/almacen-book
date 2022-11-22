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
        <!-- Indicators -->
        <div class="row">
            <div class="col-xxl-3 col-lg-6">
                <div class="card widget-flat bg-success text-white">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-book-education widget-icon bg-white text-success"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers">Libros</h6>
                        <h3 class="mt-3 mb-3" id="i_libros">0</h3>
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
                        <h3 class="mt-3 mb-3" id="i_estudiantes">0</h3>
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
                        <h3 class="mt-3 mb-3" id="i_perdidas">0</h3>
                    </div>
                </div>
            </div> <!-- end col-->
            <div class="col-xxl-3 col-lg-6">
                <div class="card widget-flat bg-warning text-white">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-cash-usd widget-icon bg-white text-warning"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers">Recaudado</h6>
                        <h3 class="mt-3 mb-3" id="i_ventas">$0</h3>
                    </div>
                </div>
            </div> <!-- end col-->
        </div>
        <!-- Comments -->
        <div class="col-xl-3 col-lg-4 order-lg-1">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div>
                        </div>
                        <h4 class="header-title mb-2">Comentarios</h4>

                        <div data-simplebar="" style="max-height: 419px;">
                            <div class="timeline-alt pb-0" id="comentarios">

                            </div>
                            <!-- end timeline -->
                        </div> <!-- end slimscroll -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafic -->
        <div class="col-xl-3 col-lg-8 order-lg-1">
            <div class="card">
                <div class="card-body" id="caja_grafica">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item" id="indicadores_ventas">Sales Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item" id="grafica">Export Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>
                    <h4 class="header-title">Estado de las &oacute;rdenes</h4>

                    <div id="average-sales" class="apex-charts mb-4 mt-4" data-colors="#727cf5,#0acf97,#fa5c7c,#ffbc00"></div>


                    <div class="chart-widget-list" id="indicators_sales">

                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->


        <!-- Students with orders -->
        <div class="col-xl-6 col-lg-12 order-lg-2 order-xl-1">
            <div class="card">
                <div class="card-body">
                    <a href="#" class="btn btn-sm btn-link float-end" id="e_std_sales">Export
                        <i class="mdi mdi-download ms-1"></i>
                    </a>
                    <h4 class="header-title mt-2 mb-3">Top de Estudiantes con m&aacute;s &oacute;rdenes cerradas</h4>

                    <div class="table-responsive" id="top_estudiante_compras">
                        <input type="hidden" id="host" value="<?= base_url() ?>">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <tbody id="table-students-sales">

                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->

        </div> <!-- end col-->
    </div>



    <script type="text/javascript">
        // Define the function 
        // to screenshot the div
        function takeshot() {
            let div =
                document.getElementById('photo');

            // Use the html2canvas
            // function to take a screenshot
            // and append it
            // to the output div
            html2canvas(div).then(
                function(canvas) {
                    document
                        .getElementById('output')
                        .appendChild(canvas);
                })
        }
    </script>
    <?= $this->include('pages/dependencias/panel'); ?>
</div>