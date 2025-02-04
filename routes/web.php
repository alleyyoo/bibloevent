<?php

use App\Helpers\Parasut\Contacts;
use Illuminate\Support\Facades\Route;

use App\Helpers\Iyzico\Iyzico;

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
Route::get('locale/{locale}', 'Controller@locale')->name('locale');

Route::get('search/{search}', 'HomeController@search')->name('search');

Route::prefix('pannel')->name('admin.')->namespace('Admin')->group(function () {

    Route::namespace('Auth')->group(function () {

        // Login Routes
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login')->name('login');
        Route::post('logout', 'LoginController@logout')->name('logout');

    });

    Route::middleware('auth')->group(function () {

        Route::get('/', 'HomeController@index')->name('home');

        Route::post('url-image', 'HomeController@urlImage')->name('url.image');

        // Settings Route
        Route::get('settings', 'SettingController@updateForm')->name('setting.update');
        Route::post('settings', 'SettingController@update')->name('setting.update');

        // User Route
        Route::get('users', 'UserController@index')->name('users');

        Route::get('user/create', 'UserController@createForm')->name('user.create');
        Route::post('user/create', 'UserController@create')->name('user.create');

        Route::get('user/update/{id}', 'UserController@updateForm')->name('user.update');
        Route::post('user/update/{id}', 'UserController@update')->name('user.update');

        Route::post('user/delete/{id}', 'UserController@delete')->name('user.delete');
        Route::post('user/active/{id}', 'UserController@active')->name('user.active');

        Route::get('user/password', 'UserController@passwordForm')->name('password.update');
        Route::post('user/password', 'UserController@password')->name('password.update');

        // Language Route
        Route::get('languages', 'LanguageController@index')->name('languages');

        Route::get('language/create', 'LanguageController@createForm')->name('language.create');
        Route::post('language/create', 'LanguageController@create')->name('language.create');

        Route::get('language/update/{id}', 'LanguageController@updateForm')->name('language.update');
        Route::post('language/update/{id}', 'LanguageController@update')->name('language.update');

        Route::post('language/delete/{id}', 'LanguageController@delete')->name('language.delete');
        Route::post('language/active/{id}', 'LanguageController@active')->name('language.active');
        Route::post('language/default/{id}', 'LanguageController@default')->name('language.default');

        // Page Route
        Route::get('pages/{category_id?}', 'PageController@index')->name('pages');

        Route::get('page/create/{category_id?}/{page_type?}', 'PageController@createForm')->name('page.create');
        Route::post('page/create/{category_id?}', 'PageController@create')->name('page.create');

        Route::get('page/update/{id}', 'PageController@updateForm')->name('page.update');
        Route::post('page/update/{id}', 'PageController@update')->name('page.update');

        Route::post('page/delete/{id}', 'PageController@delete')->name('page.delete');
        Route::post('page/active/{id}', 'PageController@active')->name('page.active');
        Route::post('page/sort/{category_id?}', 'PageController@sort')->name('page.sort');
    });

});

Route::prefix(app()->getLocale())->group(function (){
    Route::get('/sitemap.xml/download', 'SitemapController@index')->name('sitemap.index.download');
    Route::get('/sitemap', 'SitemapController@indexAll')->name('sitemap.indexAll');
    Route::get('/sitemap.xml/{language}', 'SitemapController@language')->name('sitemap.language');
    Route::get('/sitemap.xml/{language}/download', 'SitemapController@language')->name('sitemap.language.download');
    Route::get('/sitemap.xml', 'SitemapController@sitemap')->name('sitemap.index');

    Route::post('newsletter', 'HomeController@newsletter')->name('newsletter');

    Route::get('/', 'HomeController@index')->name('home');

    Route::where(['slug' => '[a-z0-9-/]+'])->group(function () {

        Route::get('{slug?}/thanks', 'HomeController@thanks');

        Route::get('{slug?}', 'HomeController@show');

        Route::post('{slug?}', 'HomeController@send');

    });

});