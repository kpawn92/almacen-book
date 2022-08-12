<div class="cerodiv row" id="entrega">
    <section id="entrega-devolution">
        <!-- start page title -->
        <div class="row" id="title-entrega">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                            <li class="breadcrumb-item active">Pr&eacute;stamo</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Proceso para el pr&eacute;stamo de libros</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="col-12 shadow-lg p-3 mb-5 mt-4 bg-body rounded" id="panel-entrega">
            <div id="selector">
                <h4 class="page-title">
                    <button type="button" class="btn btn-primary btn-rounded" id="g-entrega"><i class="uil-file-search-alt"></i> Generar entrega</button>
                    <button type="button" class="btn btn-warning btn-rounded" id="load-ci"><i class=" uil-users-alt "></i>+ CI</button>
                    <button type="button" class="t-inactive btn btn-dark btn-rounded" id="close-entrega"><i class="mdi mdi-window-close"></i> Cerrar</button>
                </h4>
                <div class="mb-3 col-md-3 col-sm-12" id="select-entrega">
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
                            <label class="form-label" for="id_book">Libro <code>(c&oacute;digo|t&iacute;tulo)</code>:</label>
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
                                <input type="checkbox" class="form-check-input" id="customCheckcolor3" name="check">
                                <label class="form-check-label" for="customCheckcolor3">Extraviado(s)</label>
                            </div>
                            <!-- Single Date Picker -->
                            <div class="mb-3">
                                <label class="form-label">Fecha de devolci&oacute;n</label>
                                <input type="text" class="form-control date" id="birthdatepicker" name="fechaD" data-toggle="date-picker" data-single-date-picker="true">
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" id="send-devol">Actualizar</button>
                                <button type="button" class="btn btn-secondary" id="load-prestamo">Volver</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-9 col-lg-9 col-sm-12" id="dataTable-entrega">
                    <div class="shadow-lg p-3 mb-5 mt-4 bg-body rounded">
                        <div class="row">
                            <h4 class="header-title"><button class="btn btn-info" id="copy-devolution"><i class=" uil-books "></i></button> Libros pendientes:</h4>
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
        <!-- <form action="<? //= base_url('/list_entrega'); 
                            ?>" method="POST">
            <input type="text" name="f" value="listarEntregados">
            <input type="submit">
        </form> -->
        <?= $this->include('pages/dependencias/entrega_devol'); ?>
    </section>
</div>