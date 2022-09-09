<div class="cerodiv row" id="estudiante">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                        <li class="breadcrumb-item active">Estudiante</li>
                    </ol>
                </div>
                <h4 class="page-title">Entrada de los estudiantes</h4>
            </div>
        </div>
    </div>
    <!-- Message alert! -->
    <!-- <div class="row">
        <div class="alert alert-info" role="alert" id="alerta-del">
            <i class="dripicons-information me-2"></i>
            <p id="del-respuesta"></p>
        </div>
    </div> -->
    <div class="row" id="formulario-student">
        <div class="col-12">
            <div class="shadow-lg p-3 mb-5 mt-4 bg-body rounded">
                <h4 class="header-title">Formulario</h4>
                <details>
                    <summary class="text-muted font-15">Detalles del formulario</summary>
                    <span class="t-inactive text-success font-12">Texto de prueba</span>
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
                        <div class="t-inactive alert alert-info" role="alert" id="msg-back">
                            <i class="dripicons-information me-2"></i>
                            <p id="resp__back"></p>
                        </div>
                    </div>
                </div>
                <!-- text-danger ->class para los input_span -->
                <div class="tab-content">
                    <form id="form__student">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="nombre">Nombre(s)</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre o nombres">
                                    <span class="t-inactive font-14" id="novalidate__nombre">El campo solo puede contener caracteres alfab&eacute;ticos</span>
                                    <span class="t-inactive font-14" id="validate__nombre">Campo validado</span>
                                    <span class="t-inactive font-14" id="empty__nombre">Campo vac&iacute;o error!</span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="lastname">Apellidos</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Apellidos">
                                    <span class="t-inactive font-14" id="novalidate__lastname">El campo solo puede contener caracteres alfab&eacute;ticos</span>
                                    <span class="t-inactive font-14" id="validate__lastname">Campo validado</span>
                                    <span class="t-inactive font-14" id="empty__lastname">Campo vac&iacute;o error!</span>

                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="ci">CI</label>
                                    <input type="text" class="form_input form-control" data-toggle="input-mask" data-mask-format="00000000000" id="ci" name="ci">
                                    <span class="t-inactive font-14" id="novalidate__ci">El campo es obligatorio</span>
                                    <span class="t-inactive font-14" id="validate__ci">Campo validado</span>
                                    <span class="t-inactive font-14" id="empty__ci">Campo vac&iacute;o error!</span>
                                    <!-- <span class="font-13 text-muted">Ej. "921015xxx81"</span> -->
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Textareas</label>
                                    <p class="text-muted font-13">
                                        Direcci&oacute;n particular
                                    </p>
                                    <textarea data-toggle="maxlength" class="form-control" maxlength="225" rows="2" placeholder="Esta área de texto tiene un límite de 225 caracteres." name="direccion"></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="fk_municipio">Municipio:</label>
                                    <select class="form-control select2" data-toggle="select2" id="fk_municipio" name="fk_municipio">
                                        <optgroup label="Municipios de Granma">
                                            <?php foreach ($municipios as $municipio) : ?>
                                                <option value="<?= $municipio['id']; ?>"><?= $municipio['municipio']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="fk_carrera">Carrera:</label>
                                    <select class="form-control select2" data-toggle="select2" id="fk_carrera" name="fk_carrera">
                                        <optgroup label="Carreras de la Universidad">
                                            <?php foreach ($carreras as $carrera) : ?>
                                                <option value="<?= $carrera['id']; ?>"><?= $carrera['carrera']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="fk_year_academico">A&ntilde;o
                                        Acad&eacute;mico:</label>
                                    <select class="form-control select2" data-toggle="select2" id="fk_year_academico" name="fk_year_academico">
                                        <optgroup label="A&ntilde;os Acad&eacute;micos de la Universidad">
                                            <?php foreach ($academias as $y_academ) : ?>
                                                <option value="<?= $y_academ['id']; ?>"><?= $y_academ['anno_academico']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="fk_brigada">Brigada:</label>
                                    <select class="form-control select2" data-toggle="select2" id="fk_brigada" name="fk_brigada">
                                        <optgroup label="Brigadas de la Universidad">
                                            <?php foreach ($brigadas as $brigada) : ?>
                                                <option value="<?= $brigada['id']; ?>"><?= $brigada['brigada']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <button class="btn btn-warning" id="sub_e">Enviar form</button>
                <a class="btn btn-primary" href="#dow-student" id="btn-liStd">Mostrar Listado <i class="uil-angle-double-down"></i></a>
                </form>
            </div>
        </div>
    </div>
    <div class="t-inactive row" id="dataTable-student">
        <div class="col-12">
            <div class="shadow-lg p-3 mb-5 mt-4 bg-body rounded">
                <div class="row">
                    <h4 class="header-title">Estudiantes registrados<button class="btn btn-primary ms-2" id="btn-update"><i class="mdi mdi-autorenew"></i></button></h4>
                </div>
                <p class="text-muted font-13">Lorem ipsum <code>{Breve descripcion del DataTable}</code> dolor sit amet
                    consectetur adipisicing elit. Atque iusto cum, vel cupiditate quaerat modi quis porro dolores est
                    incidunt exercitationem quibusdam tempore repudiandae, enim deserunt dolorum eos excepturi rerum.
                    Aut, culpa mollitia hic quidem, vel ex veritatis assumenda vero minus repudiandae dolor inventore
                    accusamus deleniti cum placeat sapiente blanditiis dolorum expedita enim repellendus perspiciatis
                    quasi quae. Quia, accusamus commodi?</p>

                <div class="row">
                    <table id="students" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Nombre(s)</th>
                                <th>Apellidos</th>
                                <th>CI</th>
                                <th>Direcci&oacute;n</th>
                                <th>Municipio</th>
                                <th>Carrera</th>
                                <th>A&ntilde;o</th>
                                <th>Brigada</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div id="dow-student"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="editar_estudiante">
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasRightLabel">Editar estudiante:</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="alert alert-info" role="alert" id="alerta" style="display: none">
                    <i class="dripicons-information me-2"></i>
                    <p id="respuesta"></p>
                </div>
                <form action="" id="form-edit">
                    <div class="row">
                        <input type="hidden" id="id" name="id">
                        <div class="mb-3">
                            <label class="form-label" for="nombre">Nombre(s)</label>
                            <input type="text" class="form-control" id="enombre" name="nombre" placeholder="Nombre o nombres">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="lastname">Apellidos</label>
                            <input type="text" class="form-control" id="elastname" name="lastname" placeholder="Apellidos">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="ci">CI</label>
                            <input type="text" class="form-control" data-toggle="input-mask" data-mask-format="00000000000" id="eci" name="ci">
                            <span class="font-13 text-muted">Ej. "921015xxx81"</span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Textareas</label>
                            <p class="text-muted font-13">
                                Direcci&oacute;n particular
                            </p>
                            <textarea data-toggle="maxlength" class="form-control" maxlength="225" rows="2" placeholder="Esta área de texto tiene un límite de 225 caracteres." name="direccion" id="edireccion"></textarea>
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="fk_municipio">Municipio:</label>
                            <select class="form-control" id="efk_municipio" name="fk_municipio">
                                <optgroup label="Municipios de Granma">
                                    <?php foreach ($municipios as $municipio) : ?>
                                        <option value="<?= $municipio['id']; ?>"><?= $municipio['municipio']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="fk_carrera">Carrera:</label>
                            <select class="form-control select2" id="efk_carrera" name="fk_carrera">
                                <optgroup label="Carreras de la Universidad">
                                    <?php foreach ($carreras as $carrera) : ?>
                                        <option value="<?= $carrera['id']; ?>"><?= $carrera['carrera']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="fk_year_academico">A&ntilde;o
                                Acad&eacute;mico:</label>
                            <select class="form-control" id="efk_year_academico" name="fk_year_academico">
                                <optgroup label="A&ntilde;os Acad&eacute;micos de la Universidad">
                                    <?php foreach ($academias as $y_academ) : ?>
                                        <option value="<?= $y_academ['id']; ?>"><?= $y_academ['anno_academico']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="fk_brigada">Brigada:</label>
                            <select class="form-control" id="efk_brigada" name="fk_brigada">
                                <optgroup label="Brigadas de la Universidad">
                                    <?php foreach ($brigadas as $brigada) : ?>
                                        <option value="<?= $brigada['id']; ?>"><?= $brigada['brigada']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>

                    </div>
            </div>
            <button class="btn btn-primary" type="button" id="edit_student">Enviar form</button>
            </form>
        </div>
    </div>
    <form action="<?= base_url('/del_book'); ?>" method="post">
        <input type="hidden" name="id_estudiante" id="retornoDelE">
    </form>
    <?= $this->include('pages/dependencias/students'); ?>
</div>