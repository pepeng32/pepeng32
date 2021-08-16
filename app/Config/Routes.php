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

//root
$routes->get('/', 'Mahasiswa::index');

//delete method
$routes->delete('/mhs/(:any)', 'Mahasiswa::delete/$1');

//get link
$routes->get('/mhs', 'Mahasiswa::index');
$routes->get('/mhs/create', 'Mahasiswa::create');
$routes->get('/mhs/edit/(:any)', 'Mahasiswa::edit/$1');
$routes->get('/mhs/detail/(:any)', 'Mahasiswa::detail/$1');

//post link
$routes->post('/mhs', 'Mahasiswa::index');
$routes->post('/mhs/save', 'Mahasiswa::save');
$routes->post('/mhs/update/(:any)', 'Mahasiswa::update/$1');

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
