<div class="cerodiv row" id="ventaB">

    <!-- Info OrderID Modal -->
    <div id="info-description" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <input type="hidden" name="id_libros_order" id="id_libros_order">
                    <input type="hidden" value="<?php echo base_url() ?>" id="burl">
                    <div class="text-center">
                        <i class="dripicons-information h1 text-info"></i>
                        <h4 class="mt-2">Descripci&oacute;n de la Orden #BM<span id="header_order"></span></h4>
                        <div class="col-lg-12">
                            <div class="card-body">
                                <h4 class="header-title mb-3"></h4>

                                <div class="table-responsive">
                                    <table class="table mb-0" id="tb_ordenID">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Portada</th>
                                                <th>Libro</th>
                                                <th>Autor</th>
                                                <th>Precio</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tb_order_sales"></tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->

                            </div>
                        </div> <!-- end col -->
                        <button type="button" class="btn btn-info my-2" data-bs-dismiss="modal" id="btn-down-descriptionOrder">Exportar</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Info Pagado Modal -->
    <div id="info-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <form id="form_pay">
                            <input type="hidden" name="id_pay" id="id_pay">
                            <i class="mdi mdi-cart-check h1 text-info"></i>
                            <h4 class="mt-2">Pagado!</h4>
                            <p class="mt-3">En aceptar confirma que el estudiante a liquidado la orden.</p>
                            <button type="submit" class="btn btn-info my-2" data-bs-dismiss="modal">Aceptar</button>
                        </form>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Danger Eliminar Orden Modal -->
    <div id="danger-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled bg-danger">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <form id="form-delOrden">
                            <i class="dripicons-wrong h1"></i>
                            <input type="hidden" id="del-order" name="cancel_order">
                            <h4 class="mt-2">Alerta!</h4>
                            <p class="mt-3">La orden sera cancelada.</p>
                            <button type="submit" class="btn btn-light my-2" data-bs-dismiss="modal">Continuar</button>
                        </form>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Warning Editar Fecha Modal -->
    <div id="warning-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="warning-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-warning">
                    <h3 class="modal-title" id="warning-header-modalLabel"><i class="mdi mdi-calendar-edit h2"></i> Entre la fecha</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div id="msg-danger"></div>
                    <form id="form_edit_modal">
                        <input type="hidden" id="id_book_ok">
                        <!-- Single Date Picker -->
                        <div class="mb-3">
                            <label class="form-label">Fecha de venta</label>
                            <input type="text" class="form-control date" id="birthdatepicker" data-toggle="date-picker" data-single-date-picker="true" name="date_ok">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-warning">Guardar cambios</button>
                        </div>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Warning Editar All Fecha Modal -->
    <div id="editAll-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="warning-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-warning">
                    <h3 class="modal-title" id="warning-header-modalLabel"><i class="mdi mdi-calendar-edit h2"></i> Entre la fecha</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form id="editAllSales">
                        <div class="mb-3">
                            <label class="form-label">Fecha de venta</label>
                            <input type="text" class="form-control date" id="birthdatepicker" data-toggle="date-picker" data-single-date-picker="true" name="fecha_edit">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-warning" data-bs-dismiss="modal">Guardar cambios</button>
                        </div>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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
        <div class="t-inactive alert alert-danger bg-white text-danger" role="alert" id="mensaje_tableSales">
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div>
            <div class="row" id="dataTable-ventas">
                <div class="col-12">
                    <div class="shadow-lg p-3 mb-5 mt-4 bg-body rounded">
                        <div class="row">
                            <h4>
                                <button class="btn btn-primary btn-rounded mb-2 me-2" id="btn-img-ventas"> <i class=" uil-corner-left-down"></i> Export</button>
                                <button class="btn btn-warning btn-rounded mb-2 me-2" data-bs-toggle="modal" data-bs-target="#editAll-modal"> <i class=" uil-corner-left-down"></i> Aprobar orden</button>
                                <button class="btn btn-danger btn-rounded mb-2 me-2" id="cancelOrder"> <i class=" uil-corner-left-down"></i> Cancelar</button>

                                <button class="btn btn-success btn-rounded mb-2 me-2" id="payOrder"> <i class=" uil-corner-left-down"></i> Pagado</button>
                                <button id="up_tbOrder" class="btn btn-info btn-rounded mb-2 me-2"> <i class="mdi mdi-update"></i> Actualizar</button>
                            </h4>
                        </div>

                        <div class="row table-responsive">

                            <table id="tb__orders" class="table dt-responsive nowrap w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="checkAll">
                                                <label class="form-check-label" for="checkAll">&nbsp;&nbsp;&nbsp;</label>
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
                                <tbody id="body_tbsales">
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