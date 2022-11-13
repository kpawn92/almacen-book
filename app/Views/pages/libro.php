<div class="cerodiv row" id="libros">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                        <li class="breadcrumb-item active">Libros</li>
                    </ol>
                </div>
                <h4 class="page-title">Entrada de los libros</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row" id="formulario-book">
        <div class="col-12">
            <div class="shadow-lg p-3 mb-5 mt-4 bg-body rounded">
                <h4 class="header-title">Formulario</h4>
                <details>
                    <summary class="text-muted font-15">Detalles del formulario</summary>
                    <p class="text-muted font-13">Lorem ipsum <code>{Breve descripcion del form}</code> dolor sit amet
                        consectetur adipisicing elit. Atque iusto cum, vel cupiditate quaerat modi quis porro dolores est
                        incidunt exercitationem quibusdam tempore repudiandae, enim deserunt dolorum eos excepturi rerum.
                        Aut, culpa mollitia hic quidem, vel ex veritatis assumenda vero minus repudiandae dolor inventore
                        accusamus deleniti cum placeat sapiente blanditiis dolorum expedita enim repellendus perspiciatis
                        quasi quae. Quia, accusamus commodi?
                    </p>
                </details>
                <br>
                <div class="row">
                    <div class="col-6" id="resp__book">
                    </div>
                </div>
                <div class="tab-content">
                    <form id="form__book">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="codigo">C&oacute;digo:</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Entre el c&oacute;digo">
                                </div>
                                <div class="mb-3">
                                    <label for="portada" class="form-label">Portada:</label>
                                    <input type="file" id="portada" name="portada" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="titulo">T&iacute;tulo:</label>
                                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Entre el titulo">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="precio">Precio:</label>
                                    <input type="text" class="form-control" id="precio" name="precio" placeholder="Entre el precio">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="autor">Autor:</label>
                                    <input type="text" class="form-control" id="autor" name="autor" placeholder="Entre el autor">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="isbn">ISBN:</label>
                                    <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Entre el isbn">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="cantidad">Cantidad en existencia:</label>
                                    <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Entre la cantidad">
                                </div>
                            </div>
                        </div>
                </div>
                <button class="btn btn-warning" id="sub_l">Enviar form</button>
                <a class="btn btn-primary" href="#dow-book" id="btn-listbooks">Mostrar Listado <i class="uil-angle-double-down"></i></a>
                </form>
            </div>
        </div>
    </div>
    <div class="row t-inactive" id="dataTable-book">
        <div class="col-12">
            <div class="shadow-lg p-3 mb-5 mt-4 bg-body rounded">
                <div class="row">
                    <h4 class="header-title">Libros registrados
                        <button class="btn btn-primary ms-2" id="btn-update-book"><i class="mdi mdi-autorenew"></i></button>
                        <button class="btn btn-warning ms-2" id="btn-down-books"><i class="uil-down-arrow"></i></button>
                    </h4>
                </div>
                <p class="text-muted font-13">Lorem ipsum <code>{Breve descripcion del DataTable}</code> dolor sit amet
                    consectetur adipisicing elit. Atque iusto cum, vel cupiditate quaerat modi quis porro dolores est
                    incidunt exercitationem quibusdam tempore repudiandae, enim deserunt dolorum eos excepturi rerum.
                    Aut, culpa mollitia hic quidem, vel ex veritatis assumenda vero minus repudiandae dolor inventore
                    accusamus deleniti cum placeat sapiente blanditiis dolorum expedita enim repellendus perspiciatis
                    quasi quae. Quia, accusamus commodi?</p>

                <div class="row table-responsive">
                    <input type="hidden" id="base_url" value="<?= base_url(); ?>">
                    <input type="hidden" id="retornoDelB">

                    <table id="books" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Portada</th>
                                <th>Codigo</th>
                                <th>T&iacute;tulo</th>
                                <th>Precio</th>
                                <th>Autor</th>
                                <th>ISBN</th>
                                <th>Cantidad</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div id="dow-book"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="editar_libro">
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRightLibro" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasRightLabel">Editar libro:</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="alert alert-info" role="alert" id="alerta2" style="display: none">
                    <i class="dripicons-information me-2"></i>
                    <p id="respuesta-book"></p>
                </div>
                <form id="form-editbook">
                    <div class="row">
                        <input type="hidden" id="id_libro" name="id">
                        <div class="mb-3">
                            <label class="form-label" for="ecodigo">C&oacute;digo:</label>
                            <input type="text" class="form-control" id="ecodigo" name="codigo" placeholder="Entre el c&oacute;digo">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="etitulo">T&iacute;tulo:</label>
                            <input type="text" class="form-control" id="etitulo" name="titulo" placeholder="Entre el titulo">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="eprecio">Precio:</label>
                            <input type="text" class="form-control" id="eprecio" name="precio" placeholder="Entre el precio">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="eautor">Autor:</label>
                            <input type="text" class="form-control" id="eautor" name="autor" placeholder="Entre el autor">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="eisbn">ISBN:</label>
                            <input type="text" class="form-control" id="eisbn" name="isbn" placeholder="Entre el isbn">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="ecantidad">Cantidad en existencia:</label>
                            <input type="number" class="form-control" id="ecantidad" name="cantidad" placeholder="Entre la cantidad">
                        </div>

                    </div>
            </div>
            <button class="btn btn-primary" type="button" id="edit_book">Enviar form</button>
            </form>
        </div>
    </div>
    <?= $this->include('pages/dependencias/books'); ?>
</div>