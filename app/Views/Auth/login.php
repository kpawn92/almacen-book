<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In | Nombre del sistema</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="logo/logo.png">

    <!-- App css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
    <link href="assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />

</head>

<body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">

                        <!-- Logo -->
                        <div class="card-header pt-4 pb-4 text-center bg-primary">
                            <a href="index.html">
                                <span><img src="assets/images/logo.png" alt="" height="18"></span>
                            </a>
                        </div>
                        <div class="accordion" id="accordionExample">
                            <div class="card mb-0">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="m-0">
                                        <a class="custom-accordion-title collapsed d-block pt-2 pb-2" data-bs-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Usuario
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="card-body p-4">
                                            <form action="<?php echo base_url('/sign_in'); ?>" method="POST">
                                                <div class="mb-3">
                                                    <input type="hidden" id="usuario" name="usuario" value="usuario">
                                                    <label for="password" class="form-label">N&uacute;mero de carn&eacute;</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="password" id="password" name="password" class="form-control" placeholder="Entre el carn&eacute; de identidad" required="">
                                                        <div class="input-group-text" data-password="false">
                                                            <span class="password-eye"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-0 text-center">
                                                    <button class="btn btn-primary" type="submit">Acceder</button>
                                                </div>
                                            </form>

                                        </div> <!-- end card-body-->
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-0">
                                <div class="card-header" id="headingOne">
                                    <h5 class="m-0">
                                        <a class="custom-accordion-title d-block pt-2 pb-2" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Administraci&oacute;n del sistema
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="card-body p-4">                                            

                                            <form action="<?php echo base_url('/sign_in'); ?>" method="POST">

                                                <div class="mb-3">
                                                    <label for="usuario" class="form-label">Usuario:</label>
                                                    <input class="form-control" type="text" id="usuario" name="usuario" required="" placeholder="Entre el usuario">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="password" id="password" name="password" class="form-control" placeholder="Entre la contraseña">
                                                        <div class="input-group-text" data-password="false">
                                                            <span class="password-eye"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 mb-0 text-center">
                                                    <button class="btn btn-primary" type="submit"> Acceder </button>
                                                </div>

                                            </form>
                                        </div> <!-- end card-body -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt">
        2022 © Almacen de libros - Universidad de Ciencias M&eacute;dicas
    </footer>

    <!-- bundle -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.min.js"></script>

</body>

</html>