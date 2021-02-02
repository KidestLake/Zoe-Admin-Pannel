<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
//dashboard routes
Route::get('/dashboard', 'DashboardController@dashboard');

//Advertisement routes
Route::get('Advertisement/addAdvertisement', 'AdvertisementController@addAdvertisement');
Route::post('Advertisement/createAdvertisement', 'AdvertisementController@create');
Route::get('Advertisement/allActiveAdvertisements', 'AdvertisementController@allActiveAdvertisements');
Route::get('Advertisement/activeAdvertisements/{offset}/{pageNumber?}', 'AdvertisementController@activeAdvertisements');
Route::get('Advertisement/allDeactivatedAdvertisements', 'AdvertisementController@allDeactivatedAdvertisements');
Route::get('Advertisement/deactivatedAdvertisements/{offset}/{pageNumber?}', 'AdvertisementController@deactivatedAdvertisements');
Route::get('Advertisement/updateAdvertisement/{id}', 'AdvertisementController@updateAdvertisement');
Route::post('Advertisement/update/{id}/{activation?}', 'AdvertisementController@update');
Route::get('Advertisement/destroy/{id}', 'AdvertisementController@destroy');
Route::get('Advertisement/deactivateAdvertisement/{id}', 'AdvertisementController@deactivateAdvertisement');
Route::get('Advertisement/activateAdvertisement/{id}', 'AdvertisementController@activateAdvertisement');
Route::post('Advertisement/changeDefaultAdBanner', 'AdvertisementController@changeDefaultAdBanner');
Route::get('Advertisement/searchActiveAdvertisement/{searchInput}', 'AdvertisementController@searchActiveAdvertisement');
Route::get('Advertisement/searchDeactivatedAdvertisement/{searchInput}', 'AdvertisementController@searchDeactivatedAdvertisement');

//News routes
Route::get('News/addNews', 'NewsController@addNews');
Route::get('News/getNews/{offset}/{pageNumber?}', 'NewsController@getNews');
Route::get('News', 'NewsController@index');
Route::post('News/createNews', 'NewsController@create');
Route::get('News/delete/{id}', 'NewsController@delete');
Route::get('News/updateNews/{id}', 'NewsController@updateNews');
Route::post('News/update/{id}', 'NewsController@update');

/*Bank Account routes
Route::get('Bank/banks', 'BankController@index');
Route::get('Bank/deactivatedBankAccount', 'BankController@deactivatedBankAccount');
Route::get('Bank/show/{id}', 'BankController@show');
Route::get('Bank/createBankAccount', 'BankController@createBankAccount');
Route::post('Bank/create', 'BankController@create');
Route::get('Bank/delete/{id}', 'BankController@destroy');
Route::get('Bank/activateBankAccount/{id}', 'BankController@activateBankAccount');
Route::get('Bank/deactivateBankAccount/{id}', 'BankController@deactivateBankAccount');*/

//Payment routes
Route::get('Payment/allInternationalPaymentsPayed', 'PaymentController@allInternationalPaymentsPayed');
Route::get('Payment/internationalPaymentsPayed/{offset}/{pageNumber?}', 'PaymentController@internationalPaymentsPayed');
Route::get('Payment/allInternationalPaymentsNotPayed', 'PaymentController@allInternationalPaymentsNotPayed');
Route::get('Payment/internationalPaymentsNotPayed/{offset}/{pageNumber?}', 'PaymentController@internationalPaymentsNotPayed');
Route::get('Payment/allLocalPaymentsPayed', 'PaymentController@allLocalPaymentsPayed');
Route::get('Payment/localPaymentsPayed/{offset}/{pageNumber?}', 'PaymentController@localPaymentsPayed');
Route::get('Payment/allLocalPaymentsNotPayed', 'PaymentController@allLocalPaymentsNotPayed');
Route::get('Payment/localPaymentsNotPayed/{offset}/{pageNumber?}', 'PaymentController@localPaymentsNotPayed');
Route::get('Payment/allTelecomPaymentsPayed', 'PaymentController@allTelecomPaymentsPayed');
Route::get('Payment/telecomPaymentsPayed/{offset}/{pageNumber?}', 'PaymentController@telecomPaymentsPayed');
Route::get('Payment/allTelecomPaymentsNotPayed', 'PaymentController@allTelecomPaymentsNotPayed');
Route::get('Payment/telecomPaymentsNotPayed/{offset}/{pageNumber?}', 'PaymentController@telecomPaymentsNotPayed');

//Users routes
Route::get('User/allActiveArtists', 'UserController@allActiveArtists');
Route::get('User/activeArtists/{offset}/{pageNumber?}', 'UserController@activeArtists');
Route::get('User/allDeactivatedArtists', 'UserController@allDeactivatedArtists');
Route::get('User/deactivatedArtists/{offset}/{pageNumber?}', 'UserController@deactivatedArtists');
Route::get('User/allActiveClients', 'UserController@allActiveClients');
Route::get('User/activeClients/{offset}/{pageNumber?}', 'UserController@activeClients');
Route::get('User/allDeactivatedClients', 'UserController@allDeactivatedClients');
Route::get('User/deactivatedClients/{offset}/{pageNumber?}', 'UserController@deactivatedClients');
Route::get('User/allActiveAdmins', 'UserController@allActiveAdmins');
Route::get('User/activeAdmins/{offset}/{pageNumber?}', 'UserController@activeAdmins');
Route::get('User/allDeactivatedAdmins', 'UserController@allDeactivatedAdmins');
Route::get('User/deactivatedAdmins/{offset}/{pageNumber?}', 'UserController@deactivatedAdmins');
Route::get('User/activateUser/{id}', 'UserController@activateUser');
Route::get('User/deactivateUser/{id}', 'UserController@deactivateUser');
Route::get('User/deleteUser/{id}', 'UserController@destroy');
Route::get('User/registerArtist', 'UserController@registerArtist');
Route::post('User/addArtist', 'UserController@addArtist');
Route::get('User/allActiveChurchAdministrators', 'UserController@allActiveChurchAdministrators');
Route::get('User/activeChurchAdministrators/{offset}/{pageNumber?}', 'UserController@activeChurchAdministrators');
Route::get('User/allDeactivatedChurchAdministrators', 'UserController@allDeactivatedChurchAdministrators');
Route::get('User/deactivatedChurchAdministrators/{offset}/{pageNumber?}', 'UserController@deactivatedChurchAdministrators');
Route::get('User/registerChurchAdmin', 'UserController@registerChurchAdmin');
Route::post('User/addChurchAdmin', 'UserController@addChurchAdmin');

//pending artist
Route::get('PendingArtist/allPendingArtists', 'PendingArtistController@allPendingArtists');
Route::get('PendingArtist/pendingArtists/{offset}/{pageNumber?}', 'PendingArtistController@pendingArtists');
Route::get('PendingArtist/approveArtist/{id}', 'PendingArtistController@approveArtist');
Route::get('PendingArtist/disApproveArtist/{id}', 'PendingArtistController@disApproveArtist');

//church routes
Route::get('Church/addChurch', 'ChurchController@addChurch');
Route::post('Church/create', 'ChurchController@create');
Route::get('Church/index', 'ChurchController@index');
Route::get('Church/getChurches/{offset}/{pageNumber?}', 'ChurchController@getChurches');
Route::get('Church/destroy/{id}', 'ChurchController@destroy');
