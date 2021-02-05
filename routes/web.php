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
/*Route::get('Advertisement/addAdvertisement', 'AdvertisementController@addAdvertisement');
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
Route::get('Advertisement/fetchActiveAdvertisements', 'AdvertisementController@fetchActiveAdvertisements');
*/

Route::get('advertisements/getAdvertisements', 'AdvertisementController@getAdvertisements');
Route::post('advertisements/createAdvertisement', 'AdvertisementController@create');
Route::get('advertisements/allActiveAdvertisements', 'AdvertisementController@allActiveAdvertisements');
Route::get('advertisements/activeAdvertisements/{offset}/{pageNumber?}', 'AdvertisementController@activeAdvertisements');
Route::get('advertisements/allDeactivatedAdvertisements', 'AdvertisementController@allDeactivatedAdvertisements');
Route::get('advertisements/deactivatedAdvertisements/{offset}/{pageNumber?}', 'AdvertisementController@deactivatedAdvertisements');
Route::get('advertisements/updateAdvertisement/{id}', 'AdvertisementController@updateAdvertisement');
Route::put('advertisements/update/{id}/{activation?}', 'AdvertisementController@update');
Route::get('advertisements/destroy/{id}', 'AdvertisementController@destroy');
Route::get('advertisements/deactivateAdvertisement/{id}', 'AdvertisementController@deactivateAdvertisement');
Route::get('advertisements/activateAdvertisement/{id}', 'AdvertisementController@activateAdvertisement');
Route::post('advertisements/changeDefaultAdBanner', 'AdvertisementController@changeDefaultAdBanner');
Route::get('advertisements/searchActiveAdvertisement/{searchInput}', 'AdvertisementController@searchActiveAdvertisement');
Route::get('advertisements/searchDeactivatedAdvertisement/{searchInput}', 'AdvertisementController@searchDeactivatedAdvertisement');


//News routes
Route::get('news/', 'NewsController@news');
Route::get('news/getNews/{offset}/{pageNumber?}', 'NewsController@getNews');
Route::post('news/createNews', 'NewsController@create');
Route::get('news/delete/{id}', 'NewsController@delete');
Route::get('news/updateNews/{id}', 'NewsController@updateNews');
Route::post('news/update/{id}', 'NewsController@update');

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
Route::get('payments/internationalPayments', 'PaymentController@internationalPayments');
Route::get('payments/localPayments', 'PaymentController@localPayments');
Route::get('payments/telecomPayments', 'PaymentController@telecomPayments');
Route::get('payments/internationalPaymentsPayed/{offset}/{pageNumber?}', 'PaymentController@internationalPaymentsPayed');
Route::get('payments/internationalPaymentsNotPayed/{offset}/{pageNumber?}', 'PaymentController@internationalPaymentsNotPayed');
Route::get('payments/localPaymentsPayed/{offset}/{pageNumber?}', 'PaymentController@localPaymentsPayed');
Route::get('payments/localPaymentsNotPayed/{offset}/{pageNumber?}', 'PaymentController@localPaymentsNotPayed');
Route::get('payments/telecomPaymentsPayed/{offset}/{pageNumber?}', 'PaymentController@telecomPaymentsPayed');
Route::get('payments/telecomPaymentsNotPayed/{offset}/{pageNumber?}', 'PaymentController@telecomPaymentsNotPayed');

Route::get('payments/searchINotPayed/{searchInput}', 'PaymentController@searchINotPayed');
Route::get('payments/searchIPayed/{searchInput}', 'PaymentController@searchIPayed');

Route::get('payments/searchLNotPayed/{searchInput}', 'PaymentController@searchLNotPayed');
Route::get('payments/searchLPayed/{searchInput}', 'PaymentController@searchLPayed');

Route::get('payments/searchTNotPayed/{searchInput}', 'PaymentController@searchTNotPayed');
Route::get('payments/searchTPayed/{searchInput}', 'PaymentController@searchTPayed');


//Users routes
Route::get('users/artists', 'UserController@artists');
Route::get('users/clients', 'UserController@clients');
Route::get('users/churchAdmins', 'UserController@churchAdmins');
Route::get('users/allActiveArtists', 'UserController@allActiveArtists');
Route::get('users/activeArtists/{offset}/{pageNumber?}', 'UserController@activeArtists');
Route::get('users/allDeactivatedArtists', 'UserController@allDeactivatedArtists');
Route::get('users/deactivatedArtists/{offset}/{pageNumber?}', 'UserController@deactivatedArtists');
Route::get('users/allActiveClients', 'UserController@allActiveClients');
Route::get('users/activeClients/{offset}/{pageNumber?}', 'UserController@activeClients');
Route::get('users/allDeactivatedClients', 'UserController@allDeactivatedClients');
Route::get('users/deactivatedClients/{offset}/{pageNumber?}', 'UserController@deactivatedClients');
Route::get('users/allActiveAdmins', 'UserController@allActiveAdmins');
Route::get('users/activeAdmins/{offset}/{pageNumber?}', 'UserController@activeAdmins');
Route::get('users/allDeactivatedAdmins', 'UserController@allDeactivatedAdmins');
Route::get('users/deactivatedAdmins/{offset}/{pageNumber?}', 'UserController@deactivatedAdmins');
Route::get('users/activateUser/{id}', 'UserController@activateUser');
Route::get('users/deactivateUser/{id}', 'UserController@deactivateUser');
Route::get('users/deleteUser/{id}', 'UserController@destroy');
Route::get('users/registerArtist', 'UserController@registerArtist');
Route::post('users/addArtist', 'UserController@addArtist');
Route::get('users/allActiveChurchAdministrators', 'UserController@allActiveChurchAdministrators');
Route::get('users/activeChurchAdministrators/{offset}/{pageNumber?}', 'UserController@activeChurchAdministrators');
Route::get('users/allDeactivatedChurchAdministrators', 'UserController@allDeactivatedChurchAdministrators');
Route::get('users/deactivatedChurchAdministrators/{offset}/{pageNumber?}', 'UserController@deactivatedChurchAdministrators');
Route::get('users/registerChurchAdmin', 'UserController@registerChurchAdmin');
Route::post('users/addChurchAdmin', 'UserController@addChurchAdmin');

Route::get('users/searchActiveArtist/{searchInput}', 'UserController@searchActiveArtist');
Route::get('users/searchDeactivatedArtist/{searchInput}', 'UserController@searchDeactivatedArtist');

Route::get('users/searchActiveClient/{searchInput}', 'UserController@searchActiveClient');
Route::get('users/searchDeactivatedClient/{searchInput}', 'UserController@searchDeactivatedClient');

Route::get('users/searchActiveChurchAdmin/{searchInput}', 'UserController@searchActiveChurchAdmin');
Route::get('users/searchDeactivatedChurchAdmin/{searchInput}', 'UserController@searchDeactivatedChurchAdmin');


//pending artist
Route::get('pendingArtists/allPendingArtists', 'PendingArtistController@allPendingArtists');
Route::get('pendingArtists/pendingArtists/{offset}/{pageNumber?}', 'PendingArtistController@pendingArtists');
Route::get('pendingArtists/approveArtist/{id}', 'PendingArtistController@approveArtist');
Route::get('pendingArtists/disApproveArtist/{id}', 'PendingArtistController@disApproveArtist');

Route::get('pendingArtists/searchPendingArtist/{searchInput}', 'PendingArtistController@searchPendingArtist');

//church routes
Route::get('churches', 'ChurchController@churches');
Route::post('churches/create', 'ChurchController@create');
Route::get('churches/getChurches/{offset}/{pageNumber?}', 'ChurchController@getChurches');
Route::get('churches/destroy/{id}', 'ChurchController@destroy');
Route::get('churches/searchChurch/{searchInput}', 'ChurchController@searchChurch');

