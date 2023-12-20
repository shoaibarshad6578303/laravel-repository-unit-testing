<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Cache;

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

Route::get('set-cache', function () {
    
    $value = Cache::remember('key', 60, function () {
        return 'This is the data to be cached.';
    });
    return $value;
});

Route::get('get-cache', function () {
    // Cache::get
    $value = Cache::get('key');
    return $value;
});

Route::resource('orders', OrderController::class);
// Route::get('/home', [PhotoController::class, 'index'])->name('home');
Route::post('temp', [OrderController::class, 'temp']);
Route::get('one', [OrderController::class, 'one']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/api-call', [App\Http\Controllers\ThirdApiCallController::class, 'index']);
