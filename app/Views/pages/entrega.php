<div class="cerodiv row" id="entrega">
    <article>
        <!-- Warning Alert Modal -->
        <div id="warning-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <i class="dripicons-warning h1 text-warning"></i>
                            <h4 class="mt-2">Informaci&oacute;n</h4>
                            <p class="mt-3">La cantidad seleccionada ser&aacute; restadas de los disponibles para pr&eacute;stamos. Estas seguro que deseas continuar?</p>
                            <button type="button" id="continue" class="btn btn-warning my-2" data-bs-dismiss="modal">Continuar</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </article>
    <section id="entrega-devolution">
        <!-- start page title -->
        <div class="row" id="title-entrega">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Hyper</li>
                            <li class="lista breadcrumb-item active" id="aPrestamo">Pr&eacute;stamo</li>
                            <li class="lista cursore breadcrumb-item active" id="aDispo">Disponibilidad</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Formularios operacionales</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="col-3 shadow-lg p-3 mb-5 mt-4 bg-body rounded" id="panel-entrega">
            <div id="selector">
                <h4 class="page-title">
                    <button type="button" class="btn btn-primary" id="g-entrega"><i class="uil-file-search-alt"></i> Generar entrega</button>
                    <button type="button" class="btn btn-warning" id="load-ci"><i class=" uil-users-alt "></i>+</button>
                    <button type="button" class="t-inactive btn btn-dark" id="close-entrega"><i class="mdi mdi-window-close"></i> Cerrar</button>
                </h4>
                <div class="mb-3" id="select-entrega">
                    <!-- Single Select -->
                    <label class="form-label" for="id_student">Seleccione el <strong>carne de identidad</strong></label>
                    <select class="form-control select2" data-toggle="select2" id="selectCI" name="id_student">
                    </select>
                </div>
            </div>
            <div class="t-inactive caja row col-12" id="content-prestamo">
                <div class="col-3" id="entreg">
                    <form id="form-entrega">
                        <h4 class="page-title">
                            Entrega de libros
                        </h4>
                        <input type="hidden" id="diEstudiant" name="fk_student">
                        <div class="t-inactive alert alert-success" role="alert" id="div-alertEntrega">
                            <strong id="alert-entrega">Registro</strong>
                        </div>

                        <div class="mb-3" id="select-libro">
                            <!-- Single Select -->
                            <label class="form-label" for="id_book">Libro <code>(c&oacute;digo|t&iacute;tulo|cantidad)</code>:</label>
                            <select class="form-control select2" data-toggle="select2" id="idLibro" name="id_book">
                            </select>
                        </div>

                        <div class="mb-3 position-relative" id="datepicker1">
                            <label class="form-label">Fecha de entrega</label>
                            <input type="text" class="form-control form_input " data-provide="datepicker" data-date-container="#datepicker1" id="dateEntrega">
                        </div>

                        <div class="mb-3">
                            <button type="button" class="btn btn-primary" id="send-entrega">Enviar</button>
                            <button class="t-inactive btn btn-secondary" id="load-devolution">Generar devoluci&oacute;n</button>
                        </div>
                    </form>
                </div>
                <div class="t-inactive col-3" id="devol">
                    <div class="col-12 mb-3">
                        <form id="form-devolution">
                            <h4 class="page-title">
                                Devoluci&oacute;n de los libros
                            </h4>
                            <!-- Todo-->
                            <div class="card" id="to-do">
                                <div class="card-body">
                                    <div class="dropdown float-end">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        </div>
                                    </div>
                                    <h4 class="header-title mb-2">Libros <code>(c&oacute;digo|t&iacute;tutlo)</code>:</h4>

                                    <div class="todoapp">
                                        <div data-simplebar="" style="max-height: 224px">
                                            <ul class="list-group list-group-flush todo-list" id="todo-list"></ul>
                                        </div>
                                    </div> <!-- end .todoapp-->

                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                            <div class="col-4 form-check form-checkbox-primary mb-3" style="margin-top: 15px;">
                                <input type="checkbox" class="form-check-input" id="check__perdido" name="check">
                                <label id="label1" class="form-check-label" for="check__perdido">Extraviado(s)</label>
                            </div>
                            <!-- Single Date Picker -->
                            <div class="mb-3">
                                <label class="form-label">Fecha de devolci&oacute;n</label>
                                <input type="text" class="form-control date" id="birthdatepicker" name="fechaD" data-toggle="date-picker" data-single-date-picker="true">
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-warning" id="send-devol">Actualizar</button>
                                <button type="button" class="btn btn-secondary" id="load-prestamo">Volver</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-9 col-lg-9 col-sm-12" id="dataTable-entrega">
                    <div class="shadow-lg p-3 mb-5 mt-4 bg-body rounded">
                        <div class="row">
                            <h4 class="header-title">
                                <button class="btn btn-sm btn-warning" id="copy-devolution"><i class=" uil-list-ul "></i></button>
                                <button class="btn btn-sm btn-primary" id="upto-dev"><i class="mdi mdi-autorenew"></i></button>
                                Libros pendientes:
                            </h4>
                        </div>
                        <p class="text-muted font-13">Lorem ipsum <code>{Breve descripcion del DataTable}</code> dolor sit amet
                            consectetur adipisicing elit. Atque iusto cum, vel cupiditate quaerat modi quis porro dolores est
                            incidunt exercitatidolorum expedita enim repellendus perspiciatis
                            quasi quae. Quia, accusamus commodi?
                        </p>
                        <div class="row">
                            <table id="prestamosBook" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Accion</th>
                                        <th>CI</th>
                                        <th>Codigo</th>
                                        <th>T&iacute;tulo</th>
                                        <th>F/ entrega</th>
                                        <th>F/ devoluci&oacute;n</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <div id="dow-entrega"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <picture>
            <div class="t-inactive col-12 shadow-lg p-3 mb-5 mt-4 bg-body rounded" id="panel-dispo">
                <div class="chart-content-bg">
                    <div class="row text-center">
                        <div class="col-md-6">
                            <p class="text-muted mb-0 mt-3">Libros</p>
                            <h2 class="fw-normal mb-3">
                                <span id="t-libros">0</span>
                            </h2>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-0 mt-3">Por recaudar</p>
                            <h2 class="fw-normal mb-3">
                                <span id="t-recauda"></span>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <form id="formDispo">
                            <div class="mb-3" id="message">
                            </div>
                            <div class="mb-3" id="selector-libro">
                                <!-- Single Select -->
                                <label class="form-label" for="id_b">Libro <code>(c&oacute;digo|t&iacute;tulo|cantidad)</code>:</label>
                                <select class="form-control select2" data-toggle="select2" id="idL" name="id_b">
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cantVenta" class="form-label">Cantidad a vender</label>
                                <input type="number" id="cantVenta" class="form-control" name="cantidadL" placeholder="Entre la cantidad" pattern="^[0-9]$" required>
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-warning" id="modal-dispo" data-bs-toggle="modal" data-bs-target="#warning-alert-modal">Actualizar</button>
                                <button class="t-inactive btn btn-warning" id="send-dispo">Actualizar</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-8 mb-3">
                        <table class="table table-sm table-centered mb-0" id="tb-dispo">
                            <thead>
                                <tr>
                                    <th>T&iacute;tulo</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </picture>
        <?= $this->include('pages/dependencias/entrega_devol'); ?>
    </section>
</div>