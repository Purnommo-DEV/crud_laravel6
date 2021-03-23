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

Route::get('/', 'SiteController@home');
Route::get('/register', 'SiteController@register');
Route::get('/about', 'SiteController@about');
Route::post('/postregister', 'SiteController@postregister');

// /login atau /postlogin /siswa dll -> PATH
Route::get('/login', 'AuthController@login')->name('login'); //-name('login') login berasal dari HTTP>Middleware>Autenticate
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');

//->middleware('auth'); //Tidak bisa secara langsung akses DASHBOARD jadi harus login terlebih dahulu, salah satu fungsi dari MIDDLEWARE
//->middleware('auth'); Mencegah user Mengakses halaman TANPA LOGIN
// auth -> mengecek apakah user sudah login/belum
//checkRole:admin berarti hanya admin saja yang dapat mengakses Halaman tersebut
Route::group(['middleware'=>['auth','checkRole:admin']],function(){
    //Semua yang ada di Route harus melewati MIDDLEWARE AUTH jika ingin di akses
    Route::get('/siswa', 'SiswaController@index');
    Route::post('/siswa/create', 'SiswaController@create'); 
    Route::get('/siswa/{id}/edit', 'SiswaController@edit'); 
    Route::post('/siswa/{id}/update', 'SiswaController@update'); 
    Route::get('/siswa/{id}/delete', 'SiswaController@delete');
    Route::get('/siswa/{id}/profil', 'SiswaController@profil');
    Route::post('/siswa/{id}/addnilai', 'SiswaController@addnilai'); 
    Route::get('/siswa/{id}/{idmapel}/deletenilai', 'SiswaController@deletenilai');
    Route::get('/siswa/exportExel', 'SiswaController@exportExel');
    Route::get('/guru/{id}/profil', 'GuruController@profil');
    Route::get('/posts', 'PostController@index')->name('posts.index');
    Route::get('posts/add',[
        'uses' => 'PostController@add',
        'as' => 'posts.add'  
    ]);
    Route::post('posts/create',[
        'uses' => 'PostController@create',
        'as' => 'posts.create'  
    ]);
});

Route::group(['middleware'=>['auth','checkRole:admin,siswa']],function(){
    //Semua yang ada di Route harus melewati MIDDLEWARE AUTH jika ingin di akses
    Route::get('/dashboard', 'DashboardController@index'); 
});

Route::get('/{slug}',[
    'uses' => 'SiteController@singlepost',
    'as' => 'site.single.post'  
]);
