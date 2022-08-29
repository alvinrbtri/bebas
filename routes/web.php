<?php

use App\Http\Controllers\Pagecontroller;
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

Route::get('/', [Pagecontroller::class, 'index'])->name('/');
route::post('/post', [Pagecontroller::class, 'post'])->name('/post');
route::get('/mahasiswa', [Pagecontroller::class, 'mahasiswa'])->name('/mahasiswa');

//edit
Route::match(['get', 'post'], '/edit{id}',  [Pagecontroller::class, 'edit']);

//hapus
route::get('/delete/mahasiswa/{id}', [Pagecontroller::class, 'delete' ]);

//detail
route::post('/show{id}', [Pagecontroller::class, 'show']);