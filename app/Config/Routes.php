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

$routes->get('trips', 'Trips::index');

/* DETAIL TRIP */
$routes->get('trips/detail/(:num)', 'Trips::detail/$1');

$routes->get('trips/open_trip', 'Trips::byType/open_trip');
$routes->get('trips/one_day_trip', 'Trips::byType/one_day_trip');
$routes->get('trips/private_trip', 'Trips::byType/private_trip');

$routes->get('trips/type/(:segment)', 'Trips::byType/$1');


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

    $routes->get('/', 'DashboardController::index');
    $routes->get('dashboard', 'DashboardController::index');


    /*
    |--------------------------------------------------------------------------
    | TRIP MANAGEMENT
    |--------------------------------------------------------------------------
    */

    $routes->get('trips', 'TripController::index');

    $routes->get('trips/create', 'TripController::create');
    $routes->post('trips/store', 'TripController::store');

    $routes->get('trips/edit/(:num)', 'TripController::edit/$1');
    $routes->post('trips/update/(:num)', 'TripController::update/$1');

    $routes->get('trips/delete/(:num)', 'TripController::delete/$1');


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

    $routes->get('bookings', 'BookingController::index');

    $routes->get('bookings/detail/(:num)', 'BookingController::detail/$1');

    $routes->get('bookings/confirm/(:num)', 'BookingController::confirm/$1');

    $routes->get('bookings/cancel/(:num)', 'BookingController::cancel/$1');


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
    | INCLUDE MANAGEMENT
    |--------------------------------------------------------------------------
    */

    $routes->get('includes', 'Includes::index');

    $routes->get('includes/create', 'Includes::create');
    $routes->post('includes/store', 'Includes::store');
    $routes->post('includes/store-batch', 'Includes::storeBatch');

    $routes->get('includes/edit/(:num)', 'Includes::edit/$1');
    $routes->post('includes/update/(:num)', 'Includes::update/$1');
    $routes->post('includes/update-batch', 'Includes::updateBatch');

    $routes->get('includes/delete/(:num)', 'Includes::delete/$1');

    /*
    |--------------------------------------------------------------------------
    | ITINERARY MANAGEMENT
    |--------------------------------------------------------------------------
    */

    $routes->get('itinerary', 'ItineraryController::index');

    $routes->get('itinerary/create', 'ItineraryController::create');
    $routes->post('itinerary/store', 'ItineraryController::store');
    $routes->post('itinerary/store-batch', 'ItineraryController::storeBatch');

    $routes->get('itinerary/edit/(:num)', 'ItineraryController::edit/$1');
    $routes->post('itinerary/update/(:num)', 'ItineraryController::update/$1');
    $routes->post('itinerary/update-batch', 'ItineraryController::updateBatch');

    $routes->get('itinerary/delete/(:num)', 'ItineraryController::delete/$1');

    /*
|--------------------------------------------------------------------------
| GALLERY MANAGEMENT (ADMIN)
|--------------------------------------------------------------------------
*/

    $routes->get('gallery', 'GalleryController::index');

    $routes->get('gallery/create', 'GalleryController::create');
    $routes->post('gallery/store', 'GalleryController::store');

    $routes->get('gallery/edit/(:num)', 'GalleryController::edit/$1');

    /* FIX UPDATE */
    $routes->post('gallery/update/(:num)', 'GalleryController::update/$1');

    $routes->get('gallery/delete/(:num)', 'GalleryController::delete/$1');

    $routes->get('gallery/albums', 'GalleryController::albums');
    $routes->get('gallery/album/(:any)', 'GalleryController::album/$1');

    $routes->post('gallery/bulk-delete', 'GalleryController::bulkDelete');

    $routes->get('gallery/export', 'GalleryController::export');

    /*
    |--------------------------------------------------------------------------
    | COMMENTS
    |--------------------------------------------------------------------------
    */

    $routes->get('comments', 'Comments::index');

    $routes->get('comments/approve/(:num)', 'Comments::approve/$1');

    $routes->get('comments/reject/(:num)', 'Comments::reject/$1');

    $routes->get('comments/delete/(:num)', 'Comments::delete/$1');


    /*
    |--------------------------------------------------------------------------
    | EXPORT
    |--------------------------------------------------------------------------
    */

    $routes->get('export/bookings', 'BookingController::exportExcel');

    $routes->get('export/bookings/pdf', 'BookingController::exportPdf');


    /*
    |--------------------------------------------------------------------------
    | ABOUT MANAGEMENT
    |--------------------------------------------------------------------------
    */

    $routes->get('about', 'AboutController::index');

    $routes->post('about/update', 'AboutController::update');
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
| EXPORT PUBLIC
|--------------------------------------------------------------------------
*/

$routes->get('booking/exportExcel', 'AdminController::exportExcel');


/*
|--------------------------------------------------------------------------
| ENVIRONMENT ROUTES
|--------------------------------------------------------------------------
*/

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
