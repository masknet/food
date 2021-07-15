<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
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
$routes->get('/', 'Home::index');


$routes->get('login', 'Login::novo', ['filter' => 'visitante']);
$routes->get('registrar', 'Registrar::novo', ['filter' => 'visitante']);


$routes->group('admin', function($routes) {

    $routes->add('formas', 'Admin\FormasPagamento::index');
    $routes->add('formas/criar', 'Admin\FormasPagamento::criar');
    $routes->add('formas/show/(:num)', 'Admin\FormasPagamento::show/$1');
    $routes->add('formas/editar/(:num)', 'Admin\FormasPagamento::editar/$1');
    $routes->add('formas/desfazerexclusao/(:num)', 'Admin\FormasPagamento::desfazerExclusao/$1');

    /* Para o POST */
    $routes->post('formas/atualizar/(:num)', 'Admin\FormasPagamento::atualizar/$1');
    $routes->post('formas/cadastrar', 'Admin\FormasPagamento::cadastrar');

    $routes->match(['get', 'post'], 'formas/excluir/(:num)', 'Admin\FormasPagamento::excluir/$1');



    $routes->match(['get', 'post'], 'expedientes', 'Admin\Expedientes::expedientes');
});

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
