<?php

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

Route::get('/', 'PagesController@Index');
Route::get('/kontakt_info', 'PagesController@kontakt_info');
Route::get('/prosjektforslag', 'PagesController@prosjektforslag');
Route::get('/tidligere_prosjekter', 'PagesController@tidligere_prosjekter');
Route::get('/grupper', 'PagesController@grupper');
Route::get('/informasjon', 'PagesController@informasjon');
    Route::get('/sensorer', 'PagesController@sensorer');
    Route::get('/studenter', 'PagesController@studenter');
        Route::get('/dokumentasjon', 'PagesController@dokumentasjon');
            Route::get('/lastNed/{file}', 'PagesController@lastNed');
        Route::get('/veiledning', 'PagesController@veiledning');
        Route::get('/forprosjekt', 'PagesController@forprosjekt');
        Route::get('/prosjektrapport', 'PagesController@prosjektrapport');
        Route::get('/evaluering', 'PagesController@evaluering');
    Route::get('/oppdragsgivere', 'PagesController@oppdragsgivere');
        Route::get('/oppdragProsjekt', 'PagesController@oppdragProsjekt');
        Route::get('/oppdragStudent', 'PagesController@oppdragStudent');
        Route::get('/oppdragSammarbeid', 'PagesController@oppdragSammarbeid');
        Route::get('/oppdragBedrift', 'PagesController@oppdragBedrift');
        Route::get('/oppdragKontakt', 'PagesController@oppdragKontakt');

Route::get('/login', 'LoginController@visLoggInn')->name('login');
Route::post('/login', 'LoginController@loggInn');
Route::get('/inc/navbar', 'LoginController@logout')->name('logout');

Route::get('/vgruppe', 'GruppeController@vedlikehold_gruppe')->name('group');
Route::post('/vgruppe', 'GruppeController@lag_gruppe');

Route::put('/vgruppe', 'GruppeController@sett_leder');
Route::delete('/vgruppe', 'GruppeController@fjern_student');

//dashboard
Route::get('/dashboard/student', 'DashboardController@Admin'); //disse skal kun vise dashboard i urlen -ivo
Route::get('/dashboard/admin', 'DashboardController@Student'); //disse skal kun vise dashboard i urlen -ivo
Route::get('/dashboard/group', 'DashboardController@Group');

Route::get('/lastOppDok', 'GruppeController@showUploadForm')->name('lastopp');
Route::post('/lastOppDok', 'GruppeController@lastOppDok');


