<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Auth::index');
$routes->post('sign_in', 'Auth::acceder');
$routes->get('log_out', 'Auth::salir');


$routes->get('index', 'Dash::index');
$routes->get('dash', 'Dash::dash');
$routes->get('estudiante', 'Dash::estudiantes');
$routes->get('libros', 'Dash::libros');
$routes->get('entrega', 'Dash::entrega_libros');
$routes->get('venta', 'Dash::venta_libros');
$routes->get('venta', 'Dash::venta_libros');
$routes->post('save_student', 'Dash::save_student');
$routes->post('list_student', 'Dash::list_student');
$routes->post('edit_student', 'Dash::edit_student');
$routes->post('del_student', 'Dash::del_student');
$routes->post('save_book', 'Dash::save_book');
$routes->post('list_book', 'Dash::list_book');
$routes->post('edit_book', 'Dash::edit_book');
$routes->post('del_book', 'Dash::del_book');
$routes->post('ci', 'Dash::ci');
/* Listado de libros pendientes del estudiante */
$routes->post('books', 'Entrega::book');
$routes->post('list_entrega', 'Entrega::list_entrega');
$routes->post('save_entrega', 'Entrega::save_entrega');
$routes->post('id_ci', 'Entrega::id_ci');
$routes->post('del_entrega', 'Entrega::del_entrega');
$routes->post('b_entregados', 'Entrega::b_entregados');
$routes->post('devolution', 'Entrega::devolution');
$routes->post('dispo', 'Entrega::disponibility');
$routes->post('tb_dispo', 'Entrega::tb_dispo');

/* Colaborador */
$routes->get('colab', 'Colab::index');





/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

