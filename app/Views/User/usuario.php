<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Contro de los libros | UCM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="logo/logo.png">

    <!-- third party css -->
    <link href="assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css">
    <link href="assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css">
    <!-- third party css end -->

    <!-- App css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style">
    <link href="assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style">

    <!-- Datatables css -->
    <link href="assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />

</head>

<body class="loading" data-layout-config='{"darkMode":false}'>

    <!-- Success Alert Modal -->
    <div id="success-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled bg-success">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-checkmark h1"></i>
                        <h6 class="text-uppercase mt-0">Total a pagar en cup:</h6>
                        <h2 class="my-2" id="cuenta"></h2>
                        <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal" id="modal">Continue</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- NAVBAR START -->
    <nav class="navbar navbar-expand-lg py-lg-3 navbar-dark">
        <div class="container">

            <!-- logo -->
            <a href="index.html" class="navbar-brand me-lg-5">
                <img src="assets/images/logo.png" alt="" class="logo-dark" height="18">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <i class="mdi mdi-menu"></i>
            </button>

            <!-- menus -->
            <div class="collapse navbar-collapse" id="navbarNavDropdown">

                <!-- left menu -->
                <ul class="navbar-nav me-auto align-items-center">
                    <li class="nav-item mx-lg-1">
                        <a class="nav-link active" href="">Home</a>
                    </li>
                    <li class="nav-item mx-lg-1">
                        <a class="nav-link" href="#selection__books">Disponibles</a>
                    </li>
                    <li class="nav-item mx-lg-1">
                        <a class="nav-link" href="#bookSlope">Entregas</a>
                    </li>
                    <li class="nav-item mx-lg-1">
                        <a class="nav-link" href="">Contact</a>
                    </li>
                    <li class="nav-item mx-lg-1" id="salir">
                        <a class="nav-link" href="<?php echo base_url('/log_out'); ?>">Salir</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <!-- NAVBAR END -->

    <!-- START HERO -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="mt-md-4">
                        <div>
                            <span class="badge bg-danger rounded-pill">New</span>
                            <span class="text-white-50 ms-1" id="idname"></span>
                        </div>
                        <h2 class="text-white fw-normal mb-4 mt-3 hero-title">
                            Gestiona tus libros universitarios
                        </h2>

                        <p class="mb-4 font-16 text-white-50">En la secci&oacute;n <b>Disponibles</b> podr&aacute; seleccionar los libros que desea reservar</p>

                        <a href="#selection__books" class="btn btn-success">Empezar <i class="mdi mdi-arrow-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="text-md-end mt-3 mt-md-0">
                        <img src="assets/images/startup.svg" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END HERO -->

    <!-- START SERVICES -->
    <section class="py-5" id="selection__books">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h3>Libros<span class="text-primary"> disponibles</span></h3>
                        <details>
                            <summary class="text-muted font-15">Detalles de la tabla</summary>
                            <p class="text-muted font-13">Lorem ipsum <code>{Breve descripcion de la tabla}</code> dolor sit amet
                                consectetur adipisicing elit. Atque iusto cum, vel cupiditate quaerat modi quis porro dolores est
                                incidunt exercitationem quibusdam tempore repudiandae, enim deserunt dolorum eos excepturi rerum.
                                Aut, culpa mollitia hic quidem, vel ex veritatis assumenda vero minus repudiandae dolor inventore
                                accusamus deleniti cum placeat sapiente blanditiis dolorum expedita enim repellendus perspiciatis
                                quasi quae. Quia, accusamus commodi?
                            </p>
                        </details>
                        <br>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <button class="btn btn-danger mb-2" id="btn_gn" data-bs-toggle="modal" data-bs-target="#success-alert-modal"><i class="mdi mdi-truck-fast me-1"></i> Generar solicitud</button>
                                </div>
                                <div class="col-sm-8">
                                    <div class="text-sm-end">
                                        <button type="button" class="btn btn-success mb-2 me-1">Total a pagar: <i class=" uil-dollar-sign-alt"></i><span id="pagar"></span></button>
                                    </div>
                                </div><!-- end col-->
                            </div>

                            <input type="hidden" id="baseUrl" value="<?= base_url(); ?>">

                            <div class="table-responsive">
                                <table class="table table-hover table-centered w-100 dt-responsive nowrap" id="books-disponibles">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="all" style="width: 20px;">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck1">
                                                    <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th>Portada</th>
                                            <th>Title</th>
                                            <th>Price</th>
                                            <th>Autor</th>
                                        </tr>
                                    </thead>
                                    <tbody id="available">
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
        </div>
    </section>
    <!-- END SERVICES -->

    <!-- START SLOPE BOOKS  -->
    <section class="py-5 bg-light-lighten border-top border-bottom border-light" id="bookSlope">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h3>Historial de<span class="text-primary"> libros recibidos</span></h3>
                        <details>
                            <summary class="text-muted font-15">Detalles de la tabla</summary>
                            <p class="text-muted font-13">Lorem ipsum <code>{Breve descripcion de la tabla}</code> dolor sit amet
                                consectetur adipisicing elit. Atque iusto cum, vel cupiditate quaerat modi quis porro dolores est
                                incidunt exercitationem quibusdam tempore repudiandae, enim deserunt dolorum eos excepturi rerum.
                                Aut, culpa mollitia hic quidem, vel ex veritatis assumenda vero minus repudiandae dolor inventore
                                accusamus deleniti cum placeat sapiente blanditiis dolorum expedita enim repellendus perspiciatis
                                quasi quae. Quia, accusamus commodi?
                            </p>
                        </details>
                        <br>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-centered w-100 dt-responsive nowrap" id="books-borrowed">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Portada</th>
                                            <th>Title</th>
                                            <th>Autor</th>
                                            <th>Recibidos</th>
                                            <th>Devueltos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
        </div>
    </section>
    <!-- END CONTACT -->


    <!-- START CONTACT -->
    <section class="py-5 bg-light-lighten border-top border-bottom border-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h3>Get In <span class="text-primary">Touch</span></h3>
                        <p class="text-muted mt-2">Please fill out the following form and we will get back to you shortly. For more
                            <br>information please contact us.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mt-3">
                <div class="col-md-4">
                    <p class="text-muted"><span class="fw-bold">Customer Support:</span><br> <span class="d-block mt-1">+1 234 56 7894</span></p>
                    <p class="text-muted mt-4"><span class="fw-bold">Email Address:</span><br> <span class="d-block mt-1">info@gmail.com</span></p>
                    <p class="text-muted mt-4"><span class="fw-bold">Office Address:</span><br> <span class="d-block mt-1">4461 Cedar Street Moro, AR 72368</span></p>
                    <p class="text-muted mt-4"><span class="fw-bold">Office Time:</span><br> <span class="d-block mt-1">9:00AM To 6:00PM</span></p>
                </div>

                <div class="col-md-8">
                    <form>
                        <div class="row mt-4">
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="fullname" class="form-label">Your Name</label>
                                    <input class="form-control form-control-light" type="text" id="fullname" placeholder="Name...">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="emailaddress" class="form-label">Your Email</label>
                                    <input class="form-control form-control-light" type="email" required="" id="emailaddress" placeholder="Enter you email...">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <div class="mb-2">
                                    <label for="subject" class="form-label">Your Subject</label>
                                    <input class="form-control form-control-light" type="text" id="subject" placeholder="Enter subject...">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <div class="mb-2">
                                    <label for="comments" class="form-label">Message</label>
                                    <textarea id="comments" rows="4" class="form-control form-control-light" placeholder="Type your message here..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12 text-end">
                                <button class="btn btn-primary">Send a Message <i class="mdi mdi-telegram ms-1"></i> </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- END CONTACT -->



    <!-- START FOOTER -->
    <footer class="bg-dark py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img src="assets/images/logo.png" alt="" class="logo-dark" height="18">
                    <p class="text-muted mt-4">Hyper makes it easier to build better websites with
                        <br> great speed. Save hundreds of hours of design
                        <br> and development by using it.
                    </p>

                    <ul class="social-list list-inline mt-3">
                        <li class="list-inline-item text-center">
                            <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                        </li>
                        <li class="list-inline-item text-center">
                            <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                        </li>
                        <li class="list-inline-item text-center">
                            <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                        </li>
                        <li class="list-inline-item text-center">
                            <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                        </li>
                    </ul>

                </div>

                <div class="col-lg-2 mt-3 mt-lg-0">
                    <h5 class="text-light">Company</h5>

                    <ul class="list-unstyled ps-0 mb-0 mt-3">
                        <li class="mt-2"><a href="javascript: void(0);" class="text-muted">About Us</a></li>
                        <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Documentation</a></li>
                        <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Blog</a></li>
                        <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Affiliate Program</a></li>
                    </ul>

                </div>

                <div class="col-lg-2 mt-3 mt-lg-0">
                    <h5 class="text-light">Apps</h5>

                    <ul class="list-unstyled ps-0 mb-0 mt-3">
                        <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Ecommerce Pages</a></li>
                        <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Email</a></li>
                        <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Social Feed</a></li>
                        <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Projects</a></li>
                        <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Tasks Management</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 mt-3 mt-lg-0">
                    <h5 class="text-light">Discover</h5>

                    <ul class="list-unstyled ps-0 mb-0 mt-3">
                        <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Help Center</a></li>
                        <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Our Products</a></li>
                        <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Privacy</a></li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="mt-5">
                        <p class="text-muted mt-4 text-center mb-0">© 2018 - 2021 Hyper. Design and coded by
                            Coderthemes</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->



    <!-- bundle -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.min.js"></script>

    <!-- third party js -->
    <script src="assets/js/vendor/jquery.dataTables.min.js"></script>
    <script src="assets/js/vendor/dataTables.bootstrap5.js"></script>
    <script src="assets/js/vendor/dataTables.responsive.min.js"></script>
    <script src="assets/js/vendor/responsive.bootstrap5.min.js"></script>
    <script src="assets/js/vendor/dataTables.checkboxes.min.js"></script>
    

    <!-- third party js ends -->
    <?= $this->include('User/dependence/userJs'); ?>

</body>

</html>