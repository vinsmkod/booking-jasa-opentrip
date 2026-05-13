<?php

namespace Config;

use CodeIgniter\Config\Services;

$routes = Services::routes();

if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
|--------------------------------------------------------------------------
| ROUTER SETUP
|--------------------------------------------------------------------------
*/

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);


/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

$routes->get('/', 'Home::index');

$routes->get('gallery', 'GalleryController::index');
$routes->get('gallery/trip/(:num)', 'GalleryController::filterByTrip/$1');
$routes->get('gallery/album/(:any)', 'GalleryController::filterByAlbum/$1');
$routes->get('about', 'AboutController::index');

/*
|--------------------------------------------------------------------------
| TRIPS
|--------------------------------------------------------------------------
*/

$routes->get('trips', 'TripController::index');

/* DETAIL TRIP */
$routes->get('trips/detail/(:num)', 'TripController::detail/$1');

$routes->get('trips/open_trip', 'TripController::byType/open_trip');
$routes->get('trips/one_day_trip', 'TripController::byType/one_day_trip');
$routes->get('trips/private_trip', 'TripController::byType/private_trip');

$routes->get('trips/type/(:segment)', 'TripController::byType/$1');


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::processLogin');

$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::processRegister');

$routes->get('logout', 'AuthController::logout');

$routes->get('forgot-password', 'AuthController::forgotPassword');
$routes->post('forgot-password', 'AuthController::processForgotPassword');
$routes->get('reset-password/(:any)', 'AuthController::resetPassword/$1');
$routes->post('reset-password', 'AuthController::processResetPassword');

$routes->get('profile/edit', 'ProfileController::edit');
$routes->post('profile/update', 'ProfileController::update');


/*
|--------------------------------------------------------------------------
| CUSTOMER AREA (LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/

$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->get('dashboard', 'DashboardController::index');

    /*
    |--------------------------------------------------------------------------
    | BOOKING
    |--------------------------------------------------------------------------
    */

    $routes->get('booking/create/(:num)', 'BookingController::create/$1');
    $routes->post('booking/store', 'BookingController::store');

    $routes->get('booking/detail/(:num)', 'BookingController::detail/$1');

    $routes->get('booking/history', 'BookingController::history');

    $routes->get('booking/status', 'BookingController::status');

    $routes->post('booking/upload-document/(:num)', 'BookingController::uploadDocument/$1');


    /*
    |--------------------------------------------------------------------------
    | PAYMENT
    |--------------------------------------------------------------------------
    */

    $routes->get('payment/(:num)', 'PaymentController::pay/$1');


    /*
    |--------------------------------------------------------------------------
    | INVOICE
    |--------------------------------------------------------------------------
    */

    $routes->get('booking/invoice/(:num)', 'InvoiceController::generate/$1');


    /*
    |--------------------------------------------------------------------------
    | COMMENT
    |--------------------------------------------------------------------------
    */

    $routes->post('comment/create', 'Comment::create');
});


/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/

$routes->group('admin', [
    'namespace' => 'App\Controllers\Admin',
    'filter'    => 'admin'
], function ($routes) {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    $routes->get('/', '\App\Controllers\DashboardController::adminIndex');
    $routes->get('dashboard', '\App\Controllers\DashboardController::adminIndex');


    /*
    |--------------------------------------------------------------------------
    | TRIP MANAGEMENT
    |--------------------------------------------------------------------------
    */

    $routes->get('trips', '\App\Controllers\TripController::adminIndex');

    $routes->get('trips/create', '\App\Controllers\TripController::create');
    $routes->post('trips/store', '\App\Controllers\TripController::store');

    $routes->get('trips/edit/(:num)', '\App\Controllers\TripController::edit/$1');
    $routes->post('trips/update/(:num)', '\App\Controllers\TripController::update/$1');

    $routes->get('trips/delete/(:num)', '\App\Controllers\TripController::delete/$1');


    /*
    |--------------------------------------------------------------------------
    | SCHEDULE MANAGEMENT
    |--------------------------------------------------------------------------
    */

    $routes->get('schedules', 'ScheduleController::index');

    $routes->get('schedules/create', 'ScheduleController::create');
    $routes->post('schedules/store', 'ScheduleController::store');

    $routes->get('schedules/edit/(:num)', 'ScheduleController::edit/$1');
    $routes->post('schedules/update/(:num)', 'ScheduleController::update/$1');

    $routes->get('schedules/delete/(:num)', 'ScheduleController::delete/$1');


    /*
    |--------------------------------------------------------------------------
    | BOOKING MANAGEMENT
    |--------------------------------------------------------------------------
    */

    $routes->get('bookings', '\App\Controllers\BookingController::adminIndex');

    $routes->get('bookings/detail/(:num)', '\App\Controllers\BookingController::detail/$1');

    $routes->get('bookings/confirm/(:num)', '\App\Controllers\BookingController::confirm/$1');

    $routes->get('bookings/cancel/(:num)', '\App\Controllers\BookingController::cancel/$1');


    /*
    |--------------------------------------------------------------------------
    | USER MANAGEMENT
    |--------------------------------------------------------------------------
    */

    $routes->get('users', 'UsersController::index');

    $routes->get('users/create', 'UsersController::create');
    $routes->post('users/store', 'UsersController::store');

    $routes->get('users/edit/(:num)', 'UsersController::edit/$1');
    $routes->post('users/update/(:num)', 'UsersController::update/$1');

    $routes->get('users/delete/(:num)', 'UsersController::delete/$1');


    /*
    |--------------------------------------------------------------------------
    | GALLERY MANAGEMENT (ADMIN)
    |--------------------------------------------------------------------------
    */

    $routes->get('gallery', '\App\Controllers\GalleryController::adminIndex');

    $routes->get('gallery/create', '\App\Controllers\GalleryController::create');
    $routes->post('gallery/store', '\App\Controllers\GalleryController::store');

    $routes->get('gallery/edit/(:num)', '\App\Controllers\GalleryController::edit/$1');

    /* FIX UPDATE */
    $routes->post('gallery/update/(:num)', '\App\Controllers\GalleryController::update/$1');

    $routes->get('gallery/delete/(:num)', '\App\Controllers\GalleryController::delete/$1');

    $routes->get('gallery/albums', '\App\Controllers\GalleryController::albums');
    $routes->get('gallery/album/(:any)', '\App\Controllers\GalleryController::album/$1');

    $routes->post('gallery/bulk-delete', '\App\Controllers\GalleryController::bulkDelete');

    $routes->get('gallery/export', '\App\Controllers\GalleryController::export');

    /*
    |--------------------------------------------------------------------------
    | COMMENTS
    |--------------------------------------------------------------------------
    */

    $routes->get('comments', '\App\Controllers\Comment::adminIndex');

    $routes->get('comments/approve/(:num)', '\App\Controllers\Comment::approve/$1');

    $routes->get('comments/reject/(:num)', '\App\Controllers\Comment::reject/$1');

    $routes->get('comments/delete/(:num)', '\App\Controllers\Comment::delete/$1');


    /*
    |--------------------------------------------------------------------------
    | LAPORAN
    |--------------------------------------------------------------------------
    */

    $routes->get('reports',        '\App\Controllers\LaporanController::index');
    $routes->get('reports/export', '\App\Controllers\LaporanController::exportExcel');
});


/*
|--------------------------------------------------------------------------
| API ROUTES
|--------------------------------------------------------------------------
*/

$routes->group('api', function ($routes) {

    $routes->post('login', 'Api\AuthController::login');

    $routes->get('trips', 'Api\TripController::index');
});


/*
|--------------------------------------------------------------------------
| MIDTRANS WEBHOOK
|--------------------------------------------------------------------------
*/

$routes->post('payment/webhook', 'PaymentController::webhook');


/*
|--------------------------------------------------------------------------
| ENVIRONMENT ROUTES
|--------------------------------------------------------------------------
*/

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
