<?php

use Symfony\Component\Routing;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\RedirectResponse;

$routes = new Routing\RouteCollection();
$app = new GlobalFunc;

// ROUTE APPLICATION START BELOW!!! 
// --------------------------------

$routes->add('home', new Route('/', [
    '_controller' => function (Request $request) {
        global $app;

        return new RedirectResponse('/admin');
    }
]));

// login admin

$routes->add('adminLogin', new Route('/admin', [
    '_controller' => 'App\Login\Controller\LoginController::index',
]));

$routes->add('adminLoginAction', new Route('/admin/login', [
    '_controller' => 'App\Login\Controller\LoginController::login',
]));

$routes->add('adminLogout', new Route('/admin/logout', [
    '_controller' => 'App\Login\Controller\LoginController::logout',
]));

// CRUD Minat
$routes->add('minat', new Route('/minat', [
    '_controller' => 'App\Minat\Controller\MinatController::index',
]));
$routes->add('minatCreate', new Route('/minat/create', [
    '_controller' => 'App\Minat\Controller\MinatController::create',
]));
$routes->add('minatStore', new Route('/minat/store', [
    '_controller' => 'App\Minat\Controller\MinatController::store',
]));
$routes->add('minatEdit', new Route('/minat/{id}/edit', [
    '_controller' => 'App\Minat\Controller\MinatController::edit',
]));
$routes->add('minatDetail', new Route('/minat/{id}', [
    '_controller' => 'App\Minat\Controller\MinatController::detail',
]));
$routes->add('minatUpdate', new Route('/minat/{id}/update', [
    '_controller' => 'App\Minat\Controller\MinatController::update',
]));
$routes->add('minatDelete', new Route('/minat/{id}/delete', [
    '_controller' => 'App\Minat\Controller\MinatController::delete',
]));
$routes->add('minatCancel', new Route('/minat/{id}/cancel', [
    '_controller' => 'App\Minat\Controller\MinatController::cancel',
]));

// List Minat Perstatus
$routes->add('minatStatus', new Route('/minat-status/{status}', [
    '_controller' => 'App\MinatStatus\Controller\MinatStatusController::index',
]));

// CRUD layanan internet
$routes->add('layananInternet', new Route('/layanan-internet', [
    '_controller' => 'App\LayananInternet\Controller\LayananInternetController::index',
]));
$routes->add('layananInternetCreate', new Route('/layanan-internet/create', [
    '_controller' => 'App\LayananInternet\Controller\LayananInternetController::create',
]));
$routes->add('layananInternetStore', new Route('/layanan-internet/store', [
    '_controller' => 'App\LayananInternet\Controller\LayananInternetController::store',
]));
$routes->add('layananInternetEdit', new Route('/layanan-internet/{id}/edit', [
    '_controller' => 'App\LayananInternet\Controller\LayananInternetController::edit',
]));
$routes->add('layananInternetUpdate', new Route('/layanan-internet/{id}/update', [
    '_controller' => 'App\LayananInternet\Controller\LayananInternetController::update',
]));
$routes->add('layananInternetDelete', new Route('/layanan-internet/{id}/delete', [
    '_controller' => 'App\LayananInternet\Controller\LayananInternetController::delete',
]));

// CRUD kecepatan internet
$routes->add('kecepatanInternet', new Route('/kecepatan-internet', [
    '_controller' => 'App\KecepatanInternet\Controller\KecepatanInternetController::index',
]));
$routes->add('kecepatanInternetCreate', new Route('/kecepatan-internet/create', [
    '_controller' => 'App\KecepatanInternet\Controller\KecepatanInternetController::create',
]));
$routes->add('kecepatanInternetStore', new Route('/kecepatan-internet/store', [
    '_controller' => 'App\KecepatanInternet\Controller\KecepatanInternetController::store',
]));
$routes->add('kecepatanInternetEdit', new Route('/kecepatan-internet/{id}/edit', [
    '_controller' => 'App\KecepatanInternet\Controller\KecepatanInternetController::edit',
]));
$routes->add('kecepatanInternetUpdate', new Route('/kecepatan-internet/{id}/update', [
    '_controller' => 'App\KecepatanInternet\Controller\KecepatanInternetController::update',
]));
$routes->add('kecepatanInternetDelete', new Route('/kecepatan-internet/{id}/delete', [
    '_controller' => 'App\KecepatanInternet\Controller\KecepatanInternetController::delete',
]));
$routes->add('kecepatanInternetGet', new Route('/kecepatan/get/{id}', [
    '_controller' => 'App\KecepatanInternet\Controller\KecepatanInternetController::get',
]));

// get biaya layanan
$routes->add('biayaLayananGet', new Route('/biaya/get/{id}', [
    '_controller' => 'App\KecepatanInternet\Controller\KecepatanInternetController::biayaGet',
]));

// CRUD Registrasi User Minat
$routes->add('registrasiMinat', new Route('/registrasi-user-minat', [
    '_controller' => 'App\RegistrasiUserMinat\Controller\RegistrasiUserMinatController::index',
]));
$routes->add('registrasiMinatCreate', new Route('/registrasi-user-minat/{id}/create', [
    '_controller' => 'App\RegistrasiUserMinat\Controller\RegistrasiUserMinatController::create',
]));
$routes->add('registrasiMinatStore', new Route('/registrasi-user-minat/{id}/store', [
    '_controller' => 'App\RegistrasiUserMinat\Controller\RegistrasiUserMinatController::store',
]));
$routes->add('registrasiMinatDetail', new Route('/registrasi-user-minat/detail/{id}', [
    '_controller' => 'App\RegistrasiUserMinat\Controller\RegistrasiUserMinatController::detail',
]));
$routes->add('registrasiMinatEdit', new Route('/registrasi-user-minat/{id}/edit', [
    '_controller' => 'App\RegistrasiUserMinat\Controller\RegistrasiUserMinatController::edit',
]));
$routes->add('registrasiMinatUpdate', new Route('/registrasi-user-minat/{id}/update', [
    '_controller' => 'App\RegistrasiUserMinat\Controller\RegistrasiUserMinatController::update',
]));
$routes->add('registrasiMinatDelete', new Route('/registrasi-user-minat/{id}/delete', [
    '_controller' => 'App\RegistrasiUserMinat\Controller\RegistrasiUserMinatController::delete',
]));

// CRUD regirstasi
$routes->add('registrasi', new Route('/registrasi-user', [
    '_controller' => 'App\RegistrasiUser\Controller\RegistrasiUserController::index',
]));
$routes->add('registrasiCreate', new Route('/registrasi-user/create', [
    '_controller' => 'App\RegistrasiUser\Controller\RegistrasiUserController::create',
]));
$routes->add('registrasiStore', new Route('/registrasi-user/store', [
    '_controller' => 'App\RegistrasiUser\Controller\RegistrasiUserController::store',
]));
$routes->add('registrasiDetail', new Route('/registrasi-user/detail/{id}', [
    '_controller' => 'App\RegistrasiUser\Controller\RegistrasiUserController::detail',
]));
$routes->add('registrasiEdit', new Route('/registrasi-user/{id}/edit', [
    '_controller' => 'App\RegistrasiUser\Controller\RegistrasiUserController::edit',
]));
$routes->add('registrasiUpdate', new Route('/registrasi-user/{id}/update', [
    '_controller' => 'App\RegistrasiUser\Controller\RegistrasiUserController::update',
]));
$routes->add('registrasiStatus', new Route('/registrasi-user/{id}/status', [
    '_controller' => 'App\RegistrasiUser\Controller\RegistrasiUserController::status',
]));
$routes->add('registrasiDelete', new Route('/registrasi-user/{id}/delete', [
    '_controller' => 'App\RegistrasiUser\Controller\RegistrasiUserController::delete',
]));

// Data User
$routes->add('urbanLite', new Route('/urban-lite', [
    '_controller' => 'App\RegistrasiUser\Controller\RegistrasiUserController::lite',
]));
$routes->add('urbanMax', new Route('/urban-max', [
    '_controller' => 'App\RegistrasiUser\Controller\RegistrasiUserController::max',
]));
$routes->add('urbanUltimate', new Route('/urban-ultimate', [
    '_controller' => 'App\RegistrasiUser\Controller\RegistrasiUserController::ultimate',
]));

// Reseller
$routes->add('reseller', new Route('/reseller', [
    '_controller' => 'App\Reseller\Controller\ResellerController::index',
]));
$routes->add('resellerCreate', new Route('/reseller/create', [
    '_controller' => 'App\Reseller\Controller\ResellerController::create',
]));
$routes->add('resellerStore', new Route('/reseller/store', [
    '_controller' => 'App\Reseller\Controller\ResellerController::store',
]));
$routes->add('resellerDetail', new Route('/reseller/detail/{id}', [
    '_controller' => 'App\Reseller\Controller\ResellerController::detail',
]));
$routes->add('resellerEdit', new Route('/reseller/{id}/edit', [
    '_controller' => 'App\Reseller\Controller\ResellerController::edit',
]));
$routes->add('resellerUpdate', new Route('/reseller/{id}/update', [
    '_controller' => 'App\Reseller\Controller\ResellerController::update',
]));
$routes->add('resellerDelete', new Route('/reseller/{id}/delete', [
    '_controller' => 'App\Reseller\Controller\ResellerController::delete',
]));
$routes->add('resellerGet', new Route('/reseller/get/{id}', [
    '_controller' => 'App\Reseller\Controller\ResellerController::get',
]));

// Sales Perorangan
$routes->add('salesPerorangan', new Route('/sales-perorangan', [
    '_controller' => 'App\SalesPerorangan\Controller\SalesPeroranganController::index',
]));
$routes->add('salesPeroranganCreate', new Route('/sales-perorangan/create', [
    '_controller' => 'App\SalesPerorangan\Controller\SalesPeroranganController::create',
]));
$routes->add('salesPeroranganStore', new Route('/sales-perorangan/store', [
    '_controller' => 'App\SalesPerorangan\Controller\SalesPeroranganController::store',
]));
$routes->add('salesPeroranganDetail', new Route('/sales-perorangan/detail/{id}', [
    '_controller' => 'App\SalesPerorangan\Controller\SalesPeroranganController::detail',
]));
$routes->add('salesPeroranganEdit', new Route('/sales-perorangan/{id}/edit', [
    '_controller' => 'App\SalesPerorangan\Controller\SalesPeroranganController::edit',
]));
$routes->add('salesPeroranganUpdate', new Route('/sales-perorangan/{id}/update', [
    '_controller' => 'App\SalesPerorangan\Controller\SalesPeroranganController::update',
]));
$routes->add('salesPeroranganDelete', new Route('/sales-perorangan/{id}/delete', [
    '_controller' => 'App\SalesPerorangan\Controller\SalesPeroranganController::delete',
]));
$routes->add('salesPeroranganGet', new Route('/sales-perorangan/get/{id}', [
    '_controller' => 'App\SalesPerorangan\Controller\SalesPeroranganController::get',
]));

// Data User
$routes->add('dataUser', new Route('/data-user/{nama-layanan}', [
    '_controller' => 'App\DataUser\Controller\DataUserController::index',
]));
$routes->add('dataUserCreate', new Route('/data-user/{nama-layanan}/create', [
    '_controller' => 'App\DataUser\Controller\DataUserController::create',
]));
$routes->add('dataUserStore', new Route('/data-user/{nama-layanan}/store', [
    '_controller' => 'App\DataUser\Controller\DataUserController::store',
]));
$routes->add('dataUserDetail', new Route('/data-user/{nama-layanan}/detail/{id}', [
    '_controller' => 'App\DataUser\Controller\DataUserController::detail',
]));
$routes->add('dataUserEdit', new Route('/data-user/{nama-layanan}/{id}/edit', [
    '_controller' => 'App\DataUser\Controller\DataUserController::edit',
]));
$routes->add('dataUserUpdate', new Route('/data-user/{nama-layanan}/{id}/update', [
    '_controller' => 'App\DataUser\Controller\DataUserController::update',
]));
$routes->add('dataUserDelete', new Route('/data-user/{nama-layanan}/{id}/delete', [
    '_controller' => 'App\DataUser\Controller\DataUserController::delete',
]));
$routes->add('dataUserGet', new Route('/data-user/get/{nama-layanan}/{id}', [
    '_controller' => 'App\DataUser\Controller\DataUserController::get',
]));

// Vendor
$routes->add('vendor', new Route('/vendor', [
    '_controller' => 'App\Vendor\Controller\VendorController::index',
]));
$routes->add('vendorCreate', new Route('/vendor/create', [
    '_controller' => 'App\Vendor\Controller\VendorController::create',
]));
$routes->add('vendorStore', new Route('/vendor/store', [
    '_controller' => 'App\Vendor\Controller\VendorController::store',
]));
$routes->add('vendorDetail', new Route('/vendor/{id}', [
    '_controller' => 'App\Vendor\Controller\VendorController::detail',
]));

$routes->add('vendorEdit', new Route('/vendor/{id}/edit', [
    '_controller' => 'App\Vendor\Controller\VendorController::edit',
]));
$routes->add('vendorUpdate', new Route('/vendor/{id}/update', [
    '_controller' => 'App\Vendor\Controller\VendorController::update',
]));
$routes->add('vendorDelete', new Route('/vendor/{id}/delete', [
    '_controller' => 'App\Vendor\Controller\VendorController::delete',
]));
$routes->add('vendorGet', new Route('/vendor/get/{id}', [
    '_controller' => 'App\Vendor\Controller\VendorController::get',
]));


// Request Survey Soft Vendor
$routes->add('requestSurveyVendor', new Route('/request-survey-vendor', [
    '_controller' => 'App\RequestSurveyVendor\Controller\RequestSurveyVendorController::index',
]));
$routes->add('requestSurveyVendorGet', new Route('/request-survey-vendor/get/{id}', [
    '_controller' => 'App\RequestSurveyVendor\Controller\RequestSurveyVendorController::get',
]));
$routes->add('requestSurveyVendorGetInput', new Route('/request-survey-vendor/getInput/{id}', [
    '_controller' => 'App\RequestSurveyVendor\Controller\RequestSurveyVendorController::getInput',
]));
$routes->add('requestSurveyVendorUpdate', new Route('/request-survey-vendor/{id}/update', [
    '_controller' => 'App\RequestSurveyVendor\Controller\RequestSurveyVendorController::update',
]));

// Input Hasil Soft Survey
$routes->add('inputHasilSoftSurvey', new Route('/input-hasil-soft-survey', [
    '_controller' => 'App\InputHasilSoftSurvey\Controller\InputHasilSoftSurveyController::index',
]));
$routes->add('inputHasilSoftSurveyGet', new Route('/input-hasil-soft-survey/get/{id}', [
    '_controller' => 'App\InputHasilSoftSurvey\Controller\InputHasilSoftSurveyController::get',
]));
$routes->add('inputHasilSoftSurveyUpdate', new Route('/input-hasil-soft-survey/{id}/update', [
    '_controller' => 'App\InputHasilSoftSurvey\Controller\InputHasilSoftSurveyController::update',
]));

// Konfirmasi Hasil Soft Survey
$routes->add('konfirmasiHasilSurvey', new Route('/konfirmasi-hasil-survey', [
    '_controller' => 'App\KonfirmasiHasilSurvey\Controller\KonfirmasiHasilSurveyController::index',
]));
$routes->add('konfirmasiHasilSurveyGet', new Route('/konfirmasi-hasil-survey/get/{id}', [
    '_controller' => 'App\KonfirmasiHasilSurvey\Controller\KonfirmasiHasilSurveyController::get',
]));
$routes->add('konfirmasiHasilSurveyUpdate', new Route('/konfirmasi-hasil-survey/{id}/update', [
    '_controller' => 'App\KonfirmasiHasilSurvey\Controller\KonfirmasiHasilSurveyController::update',
]));



// Atur Tanggal On Site
$routes->add('aturTanggalOnsite', new Route('/atur-tanggal-onsite', [
    '_controller' => 'App\AturTanggalOnsite\Controller\AturTanggalOnsiteController::index',
]));
$routes->add('aturTanggalOnsiteGet', new Route('/atur-tanggal-onsite/get/{id}', [
    '_controller' => 'App\AturTanggalOnsite\Controller\AturTanggalOnsiteController::get',
]));
$routes->add('aturTanggalOnsiteGetInput', new Route('/atur-tanggal-onsite/getInput/{id}', [
    '_controller' => 'App\AturTanggalOnsite\Controller\AturTanggalOnsiteController::getInput',
]));
$routes->add('aturTanggalOnsiteUpdate', new Route('/atur-tanggal-onsite/{id}/update', [
    '_controller' => 'App\AturTanggalOnsite\Controller\AturTanggalOnsiteController::update',
]));

// Input Hasil Survey On Site
$routes->add('inputHasilSurveyOnsite', new Route('/input-hasil-survey-onsite', [
    '_controller' => 'App\InputHasilSurveyOnsite\Controller\InputHasilSurveyOnsiteController::index',
]));
$routes->add('inputHasilSurveyOnsiteGet', new Route('/input-hasil-survey-onsite/get/{id}', [
    '_controller' => 'App\InputHasilSurveyOnsite\Controller\InputHasilSurveyOnsiteController::get',
]));
$routes->add('inputHasilSurveyOnsiteUpdate', new Route('/input-hasil-survey-onsite/{id}/update', [
    '_controller' => 'App\InputHasilSurveyOnsite\Controller\InputHasilSurveyOnsiteController::update',
]));
$routes->add('inputHasilSurveyOnsiteDokumentasi', new Route('/input-hasil-survey-onsite/dokumentasi/{id}', [
    '_controller' => 'App\InputHasilSurveyOnsite\Controller\InputHasilSurveyOnsiteController::dokumentasi',
]));
$routes->add('inputHasilSurveyOnsiteStore', new Route('/input-hasil-survey-onsite/dokumentasi/{id}/store', [
    '_controller' => 'App\InputHasilSurveyOnsite\Controller\InputHasilSurveyOnsiteController::dokumentasiStore',
]));

//Konfirmasi Hasil Survey Onsite
$routes->add('konfirmasiHasilSurveyOnsite', new Route('/konfirmasi-hasil-survey-onsite', [
    '_controller' => 'App\KonfirmasiHasilSurevyOnsite\Controller\KonfirmasiHasilSurveyOnsiteController::index',
]));

// Forecast
$routes->add('forecast', new Route('/forecast', [
    '_controller' => 'App\Forecast\Controller\ForecastController::index',
]));
$routes->add('forecastDetail', new Route('/forecast/{id}', [
    '_controller' => 'App\Forecast\Controller\ForecastController::detail',
]));
$routes->add('forecastGet', new Route('/forecast/get/{id}', [
    '_controller' => 'App\Forecast\Controller\ForecastController::get',
]));


// Import
$routes->add('import', new Route('/import', [
    '_controller' => 'App\Import\Controller\ImportController::prosess',
]));



// group layanan
$routes->add('groupLayanan', new Route('/group-layanan-persyaratan/get/{id}', [
    '_controller' => 'App\GroupLayanan\Controller\GroupLayananController::getPersyaratanLayanan',
]));

// kabupaten
$routes->add('kabupaten', new Route('/kabupaten/get/{id}', [
    '_controller' => 'App\Kabupaten\Controller\KabupatenController::get',
]));

// kecamatan
$routes->add('kecamatan', new Route('/kecamatan/get/{id}', [
    '_controller' => 'App\Kecamatan\Controller\KecamatanController::get',
]));

// kelurahan
$routes->add('kelurahan', new Route('/kelurahan/get/{id}', [
    '_controller' => 'App\Kelurahan\Controller\KelurahanController::get',
]));

// CRUD sales
$routes->add('sales', new Route('/sales', [
    '_controller' => 'App\Sales\Controller\SalesController::index',
]));
$routes->add('salesCreate', new Route('/sales/create', [
    '_controller' => 'App\Sales\Controller\SalesController::create',
]));
$routes->add('salesStore', new Route('/sales/store', [
    '_controller' => 'App\Sales\Controller\SalesController::store',
]));
$routes->add('salesEdit', new Route('/sales/{id}/edit', [
    '_controller' => 'App\Sales\Controller\SalesController::edit',
]));
$routes->add('salesUpdate', new Route('/sales/{id}/update', [
    '_controller' => 'App\Sales\Controller\SalesController::update',
]));
$routes->add('salesDelete', new Route('/sales/{id}/delete', [
    '_controller' => 'App\Sales\Controller\LayananInternetController::delete',
]));


$routes->add('userTelegram', new Route('/daftar/telegram/notif', [
    '_controller' => 'App\Users\Controller\UsersController::telegram',
]));

// CRUD User Management
$routes->add('userManagement', new Route('/user-management', [
    '_controller' => 'App\UserManagement\Controller\UserManagementController::index',
]));
$routes->add('userManagementCreate', new Route('/user-management/create', [
    '_controller' => 'App\UserManagement\Controller\UserManagementController::create',
]));
$routes->add('userManagementStore', new Route('/user-management/store', [
    '_controller' => 'App\UserManagement\Controller\UserManagementController::store',
]));
$routes->add('userManagementEdit', new Route('/user-management/{id}/edit', [
    '_controller' => 'App\UserManagement\Controller\UserManagementController::edit',
]));
$routes->add('userManagementDetail', new Route('/user-management/{id}', [
    '_controller' => 'App\UserManagement\Controller\UserManagementController::detail',
]));
$routes->add('userManagementUpdate', new Route('/user-management/{id}/update', [
    '_controller' => 'App\UserManagement\Controller\UserManagementController::update',
]));
$routes->add('userManagementDelete', new Route('/user-management/{id}/delete', [
    '_controller' => 'App\UserManagement\Controller\UserManagementController::delete',
]));

// User Management Mitra
$routes->add('userMitraManagementEdit', new Route('/user-mitra-management/{id}/editMitra', [
    '_controller' => 'App\UserManagement\Controller\UserManagementController::editMitra',
]));

//Instalasi
$routes->add('instalasi', new Route('/instalasi', [
    '_controller' => 'App\Instalasi\Controller\InstalasiController::index',
]));
$routes->add('instalasiStore', new Route('/instalasi/{id}/store', [
    '_controller' => 'App\Instalasi\Controller\InstalasiController::store',
]));
$routes->add('instalasiUpdate', new Route('/instalasi/{id}/update', [
    '_controller' => 'App\Instalasi\Controller\InstalasiController::update',
]));
$routes->add('instalasiStatus', new Route('/instalasi/{id}/status', [
    '_controller' => 'App\Instalasi\Controller\InstalasiController::status',
]));
$routes->add('instalasiGet', new Route('/instalasi/get/{id}', [
    '_controller' => 'App\Instalasi\Controller\InstalasiController::get',
]));
$routes->add('instalasiDokumentasi', new Route('/instalasi/dokumentasi/{id}', [
    '_controller' => 'App\Instalasi\Controller\InstalasiController::dokumentasi',
]));
$routes->add('instalasiDokumentasiStore', new Route('/instalasi/dokumentasi/{id}/store', [
    '_controller' => 'App\Instalasi\Controller\InstalasiController::dokumentasiStore',
]));


//Aktivasi
$routes->add('aktivasi', new Route('/aktivasi', [
    '_controller' => 'App\Aktivasi\Controller\AktivasiController::index',
]));
$routes->add('aktivasiCreate', new Route('/aktivasi/{id}/create', [
    '_controller' => 'App\Aktivasi\Controller\AktivasiController::create',
]));
$routes->add('aktivasiStore', new Route('/aktivasi/{id}/store', [
    '_controller' => 'App\Aktivasi\Controller\AktivasiController::store',
]));

$routes->add('aktivasiDokumentasi', new Route('/aktivasi/dokumentasi/{id}', [
    '_controller' => 'App\Aktivasi\Controller\AktivasiController::dokumentasi',
]));
$routes->add('aktivasiDokumentasiStore', new Route('/aktivasi/dokumentasi/{id}/store', [
    '_controller' => 'App\Aktivasi\Controller\AktivasiController::dokumentasiStore',
]));

//Aktif
$routes->add('aktif', new Route('/aktif', [
    '_controller' => 'App\Aktif\Controller\AktifController::index',
]));
$routes->add('aktifStore', new Route('/aktif/{id}/store', [
    '_controller' => 'App\Aktif\Controller\AktifController::store',
]));



// URBAN-LITE
// $routes->add('urbanLite', new Route('/urban-lite', [
//     '_controller' => 'App\UrbanLite\Controller\UrbanLiteController::index',
// ]));
// $routes->add('urbanLiteCreate', new Route('/urban-lite/{id}/create', [
//     '_controller' => 'App\UrbanLite\Controller\UrbanLiteController::create',
// ]));
// $routes->add('urbanLiteStore', new Route('/urban-lite/{id}/store', [
//     '_controller' => 'App\UrbanLite\Controller\UrbanLiteController::store',
// ]));
// $routes->add('urbanLiteDetail', new Route('/urban-lite/detail/{id}', [
//     '_controller' => 'App\UrbanLite\Controller\UrbanLiteController::detail',
// ]));
// $routes->add('urbanLiteEdit', new Route('/urban-lite/{id}/edit', [
//     '_controller' => 'App\UrbanLite\Controller\UrbanLiteController::edit',
// ]));
// $routes->add('urbanLiteUpdate', new Route('/urban-lite/{id}/update', [
//     '_controller' => 'App\UrbanLite\Controller\UrbanLiteController::update',
// ]));
// $routes->add('urbanLiteDelete', new Route('/urban-lite/{id}/delete', [
//     '_controller' => 'App\UrbanLite\Controller\UrbanLiteController::delete',
// ]));

// URBAN-MAX
// $routes->add('urbanMax', new Route('/urban-max', [
//     '_controller' => 'App\UrbanMax\Controller\UrbanMaxController::index',
// ]));
// $routes->add('urbanMaxCreate', new Route('/urban-max/{id}/create', [
//     '_controller' => 'App\UrbanMax\Controller\UrbanMaxController::create',
// ]));
// $routes->add('urbanMaxStore', new Route('/urban-max/{id}/store', [
//     '_controller' => 'App\UrbanMax\Controller\UrbanMaxController::store',
// ]));
// $routes->add('urbanMaxDetail', new Route('/urban-max/detail/{id}', [
//     '_controller' => 'App\UrbanMax\Controller\UrbanMaxController::detail',
// ]));
// $routes->add('urbanMaxEdit', new Route('/urban-max/{id}/edit', [
//     '_controller' => 'App\UrbanMax\Controller\UrbanMaxController::edit',
// ]));
// $routes->add('urbanMaxUpdate', new Route('/urban-max/{id}/update', [
//     '_controller' => 'App\UrbanMax\Controller\UrbanMaxController::update',
// ]));
// $routes->add('urbanMaxDelete', new Route('/urban-max/{id}/delete', [
//     '_controller' => 'App\UrbanMax\Controller\UrbanMaxController::delete',
// ]));

// URBAN-ULTIMATE
// $routes->add('UrbanUltimate', new Route('/urban-ultimate', [
//     '_controller' => 'App\UrbanUltimate\Controller\UrbanUltimateController::index',
// ]));
// $routes->add('UrbanUltimateCreate', new Route('/urban-ultimate/{id}/create', [
//     '_controller' => 'App\UrbanUltimate\Controller\UrbanUltimateController::create',
// ]));
// $routes->add('UrbanUltimateStore', new Route('/urban-ultimate/{id}/store', [
//     '_controller' => 'App\UrbanUltimate\Controller\UrbanUltimateController::store',
// ]));
// $routes->add('UrbanUltimateDetail', new Route('/urban-ultimate/detail/{id}', [
//     '_controller' => 'App\UrbanUltimate\Controller\UrbanUltimateController::detail',
// ]));
// $routes->add('UrbanUltimateEdit', new Route('/urban-ultimate/{id}/edit', [
//     '_controller' => 'App\UrbanUltimate\Controller\UrbanUltimateController::edit',
// ]));
// $routes->add('UrbanUltimateUpdate', new Route('/urban-ultimate/{id}/update', [
//     '_controller' => 'App\UrbanUltimate\Controller\UrbanUltimateController::update',
// ]));
// $routes->add('UrbanUltimateDelete', new Route('/urban-ultimate/{id}/delete', [
//     '_controller' => 'App\UrbanUltimate\Controller\UrbanUltimateController::delete',
// ]));


$routes->add('Riwayat', new Route('/riwayat', [
    '_controller' => 'App\Chronology\Controller\ChronologyController::index',
]));


return $routes;
