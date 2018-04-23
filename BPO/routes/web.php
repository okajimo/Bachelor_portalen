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
Route::get('/kontakt_info', 'PagesController@kontakt_info')->name('kontakt_info');
Route::get('/prosjektforslag', 'PagesController@prosjektforslag')->name('prosjektforslag');
Route::get('/tidligere_prosjekter', 'PagesController@tidligere_prosjekter')->name('tidligere_prosjekter');
Route::get('/grupper', 'PagesController@grupper')->name('grupper');
Route::get('/informasjon', 'PagesController@informasjon')->name('info');

// statiske sider for sensorer
Route::get('/sensorer', 'PagesController@sensorer');

// statiske sider for studenter
Route::get('/studenter', 'PagesController@studenter');
Route::get('/dokumentasjon', 'PagesController@dokumentasjon');
Route::get('/lastNed/{file}', 'PagesController@lastNed');
Route::get('/veiledning', 'PagesController@veiledning');
Route::get('/forprosjekt', 'PagesController@forprosjekt');
Route::get('/prosjektrapport', 'PagesController@prosjektrapport');
Route::get('/evaluering', 'PagesController@evaluering');
Route::get('/statusrapport', 'PagesController@statusrapport');
Route::get('/prosjektskisse', 'PagesController@prosjektskisse');

// statiske sider for oppdragsgivere
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
Route::post('gg', 'GruppeController@meld_inn');
Route::get('/lastOppUrl', 'GruppeController@lastOppUrlView')->name('Last');
Route::post('/lastOppUrl', 'GruppeController@lastOppUrl');
Route::get('/news', 'GruppeController@news')->name('news');

Route::get('/les_dokumenter', 'LesDokumenterController@les_dokumenter')->name('dokumenter');
Route::put('/les_dokumenter', 'LesDokumenterController@rediger_dokument');

//dashboard
Route::get('/dashboard/admin', 'DashboardController@Admin')->name('admin'); //disse skal kun vise dashboard i urlen -ivo
Route::get('/dashboard/group', 'DashboardController@Group')->name('gruppe');

//Opplasting av dokumenter
Route::get('/lastOppStatus', 'OpplastningController@showUploadFormS')->name('lastOppS');
Route::get('/lastOppSkisse', 'OpplastningController@showUploadFormP')->name('lastOppP');
Route::post('/lastOppDok', 'OpplastningController@lastOppDok');

//Dato vedlikehold
Route::get('/dato', 'Admin\DateController@showDateMaintenance')->name('dato');
Route::post('/datoOpprett', 'Admin\DateController@createDate');
Route::post('/datoEndring', 'Admin\DateController@editDate');

Route::get('/epostView', 'Admin\EpostController@epostView')->name('epost');
Route::post('/1', 'Admin\EpostController@sendEpostAlleStud');
Route::post('/2','Admin\EpostController@sendEpostSensorVeileder');

Route::get('/studentVedlikehold', 'Admin\AdminController@studentVedlikehold')->name('student');
Route::get('/vedlikeholdAvSensorOgVeileder', 'Admin\AdminController@vedlikeholdSensorVeileder')->name('senvei');

Route::post('/t', 'Tidligere_prosjekterController@opprett_html_sider');
Route::post('/tt', 'Tidligere_prosjekterController@showTidligereProsjekter');
Route::post('/ttt', 'Tidligere_prosjekterController@publiserPresentasjonsplan');
Route::get('/presentasjonsplanView', 'Tidligere_prosjekterController@hvisPresentasjonsplan')->name('presentasjonsplan');

Route::post('/gge', 'Admin\AdminController@importerStud');
Route::post('/s', 'Admin\AdminController@regSensorVeileder');
Route::post('/d', 'Admin\AdminController@endreStudPoeng');
Route::delete('/ggse', 'Admin\AdminController@slettSenvei');

//Vedlikehold nyheter
Route::get('vnews', 'Admin\AdminController@vnews')->name('vnews');
Route::post('/gff', 'Admin\AdminController@lagNyhet');
Route::post('/gffgd', 'Admin\AdminController@slettNyhet');

//simuler student
Route::get('/simuler', 'SimulerController@index')->name('simuler');
Route::post('/simuler', 'SimulerController@simuler');
Route::post('/', 'SimulerController@avsimuler');

//room
Route::resource('room', 'RoomController');

//Prosjektforslag
Route::get('/vedlikehold_Prosjektforslag', 'Admin\ProsjektforslagController@showUploadForm')->name('Pforslag');
Route::post('/lastOppPf', 'Admin\ProsjektforslagController@uploadFile');
Route::delete('/slettPf', 'Admin\ProsjektforslagController@destroy');

//Tildel veileder 
Route::get('/administrer_gruppe', 'VeilederController@index')->name('Agruppe');
Route::post('/administrer_gruppe', 'VeilederController@store');
Route::delete('/administrer_gruppe/{id}', 'VeilederController@destroy');

//presentasjonsplan
Route::get('/presentasjonsplan', 'PresentasjonController@index')->name('presentasjon2');
Route::post('/presentasjonsplan', 'PresentasjonController@delete');
Route::post('/presentasjonsplan/dato', 'PresentasjonController@store');
Route::get('/presentasjonsplan/endre', 'PresentasjonController@show');
Route::post('/presentasjonsplan/edit', 'PresentasjonController@edit');
