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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;


Route::get('/cache', function () {
    return Cache::get('');
});

Auth::routes();

Route::get('/callback', function (){

});

//home
Route::resource('/','IndexController',[        //todo поменять на get
    'only' => ['index'],
    'names' => ['index' => 'home']
    ]);

//albums
Route::resource('albums', 'AlbumController',    //todo поменять на get
    [
    'only' => ['index', 'show']
    ]);

//blog
Route::resource('posts', 'PostController', [
    'only' => ['index', 'show']
]);

Route::view('about', 'album.about')->name('about');

Route::view('contacts', 'album.contacts')->name('contacts');

//Admin panel
Route::namespace('Admin')->prefix('admin')->group(function (){

    Route::get('/', 'AdminIndexController@index')->name('adminIndex');
    Route::get('album/trash', 'AdminAlbumsController@trash')->name('adminAlbumTrash');
    Route::resource('albums', 'AdminAlbumsController',[
        'except' => ['show'],
        'names' => [
            'index' => 'adminAlbumsIndex',
            'create' => 'adminAlbumCreate',
            'store' => 'adminAlbumStore',
            'destroy' => 'adminAlbumDestroy',
            'update' =>  'adminAlbumUpdate',
            'edit' => 'adminAlbumEdit',
            'trash' => 'adminAlbumTrash'
        ]
    ]);

    Route::resource('/posts', 'AdminPostController',[
        'except' => ['show'],
        'names' => [
            'index' => 'adminPostIndex',
            'create' => 'adminPostCreate',
            'store' => 'adminPostStore',
            'destroy' => 'adminPostDestroy',
            'update' =>  'adminPostUpdate',
            'edit' => 'adminPostEdit'
        ]
    ]);

    Route::resource('/categories', 'AdminCategoryController',[
        'names' => [
            'index' => 'adminCategoryIndex',
            'create' => 'adminCategoryCreate',
            'store' => 'adminCategoryStore',
            'edit' => 'adminCategoryEdit',
            'update' => 'adminCategoryUpdate',
            'destroy' => 'adminCategoryDelete'
        ]
    ]);
});
