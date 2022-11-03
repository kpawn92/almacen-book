<div class="cerodiv row" id="ventaB">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                        <li class="breadcrumb-item active">Venta</li>
                    </ol>
                </div>
                <h4 class="page-title">Revisi&oacute;n de las solicitudes de compra</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div>
            <div class="row" id="dataTable-ventas">
                <div class="col-12">
                    <div class="shadow-lg p-3 mb-5 mt-4 bg-body rounded">
                        <div class="row">
                            <h4><button class="btn btn-warning btn-rounded mb-2 me-2"> <i class="mdi mdi-calendar-edit"></i> Editar fecha</button>
                                <button class="btn btn-danger btn-rounded mb-2 me-2"> <i class="mdi mdi-delete"></i> Cancelar</button>
                                <button class="btn btn-success btn-rounded mb-2 me-2"> <i class="mdi mdi-cart-check"></i> Pagado</button>
                            </h4>
                        </div>                     

                        <div class="row table-responsive">

                            <table id="tb__orders" class="table dt-responsive nowrap w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>Orden ID</th>
                                        <th>Fecha de creaci&oacute;n</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Total</th>
                                        <th>Estado de la &oacute;rden</th>
                                        <th>Fecha aprobado</th>
                                        <th style="width: 125px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <?= $this->include('pages/dependencias/sales'); ?>
</div>