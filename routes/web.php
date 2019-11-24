<?php
use Illuminate\Support\Facades\Input;
use App\City;
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

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified', 'admin'], 'prefix' => 'dashboard'], function() {
    Route::resource('provinces', 'ProvinceController');
    Route::resource('cities', 'CityController');
    Route::resource('hotels', 'HotelController');
    Route::resource('contracts', 'ContractController');
    Route::resource('payments', 'PaymentController');
    Route::resource('finances', 'FinanceController');
    Route::resource('contacts', 'ContactController');
    Route::resource('notes', 'NoteController');
    Route::get('/users', 'HomeController@users');
    //Route::apiResource('provinces', 'ProvinceController');
    
});

Route::get('/ajax-city', function(){
    $province_id = Input::get('province_id');
    $cities = City::where('province_id', '=', $province_id)->get();
    return Response::json($cities);
});

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'dashboard'], function() {
    Route::resource('rooms', 'RoomController');
    Route::resource('events', 'EventController');
    Route::resource('meals', 'MealController');
    Route::resource('resourcs', 'ResourcController');
    Route::resource('photos', 'GalleryController');
    Route::view('unfinished', 'admin.unfinished');
    Route::get('/profile', 'HomeController@profile');
    Route::get('/home', 'HomeController@dashboard');
    Route::get('/', 'HomeController@dashboard');
    Route::post('/update-profile', 'HomeController@updateprofile');
    Route::get('/visits', 'VisitController@index');
    Route::post('/changepassword', 'HomeController@changepassword');
    Route::get('/messages', 'MessagesController@messagesList');
    Route::get('/makeCover/{id}', 'GalleryController@makeCover');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/city/{id}', 'HomeController@citySet');
Route::post('/messages/send', 'MessagesController@send');
Route::get('/clear-place', 'HomeController@clearPlace');
Route::get('/central-de-ajuda', 'HomeController@help');
Route::get('/termos-e-condicoes', 'HomeController@tc');
Route::get('/gethotels/{city_id}', 'HotelController@gethotels');
Route::get('/gethotel/{id}', 'HotelController@gethotel');
Route::get('/getcities', 'CityController@getcities');
Route::get('/{id}', 'HotelController@show');
