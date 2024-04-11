<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TopbarController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\NewsandeventsController;
use App\Http\Controllers\LatestvideoController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\PrincipalMessageController;

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
    return view('index');
});
Route::get('/index', function () {
    return view('index');
});


// Menus
Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
Route::delete('/menus/{id}', [MenuController::class, 'destroy'])->name('menus.destroy');


// SubMenus
Route::get('/submenu', [MenuController::class, 'submenu'])->name('menus.submenu');
Route::post('/submenu', [MenuController::class, 'save'])->name('menus.save');


// Topbar
Route::get('/topbar', [TopbarController::class, 'index'])->name('topbar.index');
Route::post('/topbar', [TopbarController::class, 'store'])->name('topbar.store');
Route::put('/topbars/{id}/update', [TopbarController::class, 'update'])->name('topbar.update');
Route::delete('/topbars/{id}/delete', [TopbarController::class, 'delete'])->name('topbar.delete');


// Banners
Route::get('/banner', [BannerController::class, 'index'])->name('banner.index');
Route::post('/banner', [BannerController::class, 'store'])->name('banner.store');
Route::get('/Bgbanner', [BannerController::class, 'banner'])->name('banner.bgbanner');
Route::post('/Bgbanner', [BannerController::class, 'save'])->name('banner.save');

// News and events
Route::get('/newsevents', [NewsandeventsController::class, 'index'])->name('newsevents.index');
Route::post('/newsevents', [NewsandeventsController::class, 'store'])->name('newsevents.store');

// Latest Videos
Route::get('/latestvideos', [LatestvideoController::class, 'index'])->name('latestvideos.index');
Route::post('/latestvideos', [LatestvideoController::class, 'store'])->name('latestvideos.store');


// Testimonials
Route::get('/Testimonials', [TestimonialController::class, 'index'])->name('testimonial.index');
Route::post('/Testimonials', [TestimonialController::class, 'store'])->name('testimonial.store');



Route::get('/Message', [PrincipalMessageController::class, 'index'])->name('message.index');
Route::post('/Message', [PrincipalMessageController::class, 'store'])->name('message.store');
