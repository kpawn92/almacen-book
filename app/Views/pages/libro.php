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
    <div class="row" id="formulario-book" style="display: contents;">
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
                    <div class="col-6">
                        <div class="alert alert-primary" role="alert" id="alert3" style="display: none">
                            <i class="dripicons-information me-2"></i>
                            <p id="resp-book"></p>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <form action="" id="form2">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="codigo">C&oacute;digo:</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Entre el c&oacute;digo">
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
                <button class="btn btn-warning" type="button" id="sub_l">Enviar form</button>
                <a class="btn btn-primary" href="#dow-book" id="btn-listbooks">Mostrar Listado <i class="uil-angle-double-down"></i></a>
                </form>
            </div>
        </div>
    </div>
    <div class="row" id="dataTable-book" style="display: none;">
        <div class="col-12">
            <div class="shadow-lg p-3 mb-5 mt-4 bg-body rounded">
                <div class="row">
                    <h4 class="header-title">Libros registrados<button class="btn btn-primary ms-2" id="btn-update-book"><i class="mdi mdi-autorenew"></i></button></h4>
                </div>
                <p class="text-muted font-13">Lorem ipsum <code>{Breve descripcion del DataTable}</code> dolor sit amet
                    consectetur adipisicing elit. Atque iusto cum, vel cupiditate quaerat modi quis porro dolores est
                    incidunt exercitationem quibusdam tempore repudiandae, enim deserunt dolorum eos excepturi rerum.
                    Aut, culpa mollitia hic quidem, vel ex veritatis assumenda vero minus repudiandae dolor inventore
                    accusamus deleniti cum placeat sapiente blanditiis dolorum expedita enim repellendus perspiciatis
                    quasi quae. Quia, accusamus commodi?</p>

                <div class="row">
                    <table id="books" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
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
                <form action="" id="form-editbook">
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
    <form action="<?= base_url('/del_book'); ?>" method="post">
        <input type="hidden" name="id_libro" id="retornoDelB">
    </form>
    <?= $this->include('pages/dependencias/books'); ?>
</div>