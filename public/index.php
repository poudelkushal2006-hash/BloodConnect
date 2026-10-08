<?php
// public/index.php

// Error reporting for development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../app/core/Router.php';

$router = new Router();

// Routes
$router->get('/', 'HomeController@index');
$router->get('/search', 'HomeController@search');

$router->get('/register', 'DonorController@create');
$router->post('/register', 'DonorController@store');

$router->get('/donor/phone', 'DonorController@phone');

// Donor Auth and Profile Routes
$router->get('/donor/login', 'DonorAuthController@showLogin');
$router->post('/donor/authenticate', 'DonorAuthController@authenticate');
$router->get('/donor/logout', 'DonorAuthController@logout');
$router->get('/donor/profile', 'DonorController@manage');
$router->post('/donor/update', 'DonorController@update');

// Admin Auth Routes
$router->get('/admin/login', 'AuthController@showLogin');
$router->post('/admin/authenticate', 'AuthController@authenticate');
$router->get('/admin/logout', 'AuthController@logout');

// Admin Dashboard Routes
$router->get('/admin/dashboard', 'AdminController@dashboard');
$router->get('/admin/donor/edit', 'AdminController@editDonor');
$router->post('/admin/donor/update', 'AdminController@updateDonor');
$router->post('/admin/donor/delete', 'AdminController@deleteDonor');

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
