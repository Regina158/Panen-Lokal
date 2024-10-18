<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->post('/', 'Login::login_action');
$routes->get('/logout', 'Login::logout');
$routes->get('/dashboard', 'Home::index');
$routes->get('/register', 'Register::index');
$routes->post('/register/store', 'Register::store');
// Produk
$routes->get('/produk-pertanian', 'ManajemenProduk\ProdukPertanian::index');
$routes->get('/produk-pertanian/create', 'ManajemenProduk\ProdukPertanian::create');
$routes->post('/produk-pertanian/store', 'ManajemenProduk\ProdukPertanian::store');
$routes->get('/produk-pertanian/edit/(:num)', 'ManajemenProduk\ProdukPertanian::edit/$1');
$routes->post('/produk-pertanian/update/(:num)', 'ManajemenProduk\ProdukPertanian::update/$1');
$routes->post('/produk-pertanian/(:num)', 'ManajemenProduk\ProdukPertanian::delete/$1');

// Kategori
$routes->get('/kategori-pertanian', 'ManajemenProduk\KategoriPertanian::index');
$routes->get('/kategori-pertanian/create', 'ManajemenProduk\KategoriPertanian::create');
$routes->post('/kategori-pertanian/store', 'ManajemenProduk\KategoriPertanian::store');
$routes->get('/kategori-pertanian/edit/(:num)', 'ManajemenProduk\KategoriPertanian::edit/$1');
$routes->post('/kategori-pertanian/update/(:num)', 'ManajemenProduk\KategoriPertanian::update/$1');
$routes->post('/kategori-pertanian/(:num)', 'ManajemenProduk\KategoriPertanian::delete/$1');
// Manajemen Supplier
$routes->get('/kategori-pertanian', 'ManajemenProduk\KategoriPertanian::index');
$routes->get('/kategori-pertanian/create', 'ManajemenProduk\KategoriPertanian::create');
$routes->post('/kategori-pertanian/store', 'ManajemenProduk\KategoriPertanian::store');
$routes->get('/kategori-pertanian/edit/(:num)', 'ManajemenProduk\KategoriPertanian::edit/$1');
$routes->post('/kategori-pertanian/update/(:num)', 'ManajemenProduk\KategoriPertanian::update/$1');
$routes->post('/kategori-pertanian/(:num)', 'ManajemenProduk\KategoriPertanian::delete/$1');
// $routes->get('/blog', 'Home::index');
