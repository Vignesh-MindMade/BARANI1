<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\StaffController;
use App\Http\Controllers\backend\GalleryController;
use App\Http\Controllers\frontend\FrontHomePageController;
use App\Http\Controllers\backend\BackHomePageController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\FoodController;
use App\Http\Controllers\backend\OEMController;
use Illuminate\Support\Facades\Artisan;


// Frontend routes:
Route::get('/', [FrontHomePageController::class, 'index'])->name('homepage');
Route::get('/profile', [FrontHomePageController::class, 'profile'])->name('profiles');
Route::get('/gallery', [FrontHomePageController::class, 'gallery'])->name('galleryfront');
Route::get('/contact', [FrontHomePageController::class, 'contact'])->name('front_end_contact');
Route::post('/contact-us/store', [FoodController::class, 'store'])->name('contactform.store');
Route::get('/textile', [FrontHomePageController::class, 'textile'])->name('front_end_textile');
Route::get('/food', [FrontHomePageController::class, 'food'])->name('front_end_food');
Route::get('/general', [FrontHomePageController::class, 'OEM'])->name('front_end_oem');

// Login & Register (public):
Route::get('/login', [StaffController::class, 'showLoginForm'])->name('login');
Route::post('/login', [StaffController::class, 'login'])->name('login.post');


Route::post('/clear-cache', function () {
    Artisan::call('optimize:clear');
    return response()->json(['status' => 'success', 'message' => 'Application cache cleared!']);
})->name('clear.cache');

// Backend routes with middleware:
Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', [StaffController::class, 'admin'])->name('dashboard');
    // Home Page
    Route::get('/backend-homepage', [BackHomePageController::class, 'index'])->name('banner');
    Route::post('/backend-homepage', [BackHomePageController::class, 'store'])->name('banner.store');
    Route::get('/backend-homepage/{id}/edit', [BackHomePageController::class, 'edit'])->name('banner.edit');
    Route::put('/backend-homepage/{id}', [BackHomePageController::class, 'update'])->name('banner.update');
    Route::delete('/backend-homepage/{id}', [BackHomePageController::class, 'destroy'])->name('banner.destroy');

    Route::get('/backend-homepage-about', [BackHomePageController::class, 'AboutUsCompany'])->name('about-us-company');
    Route::post('/backend-homepage-about-store', [BackHomePageController::class, 'AboutUsCompanyStore'])->name('about-us-company-store');
    Route::put('about-us-company/{id}', [BackHomePageController::class, 'AboutUsCompanyUpdate'])->name('about-us-company-update');

    // Homepage Countsection
    Route::get('/backend-homepage-counts', [BackHomePageController::class, 'HomeCounts'])->name('home-counts');
    Route::post('/backend-homepage-counts-store', [BackHomePageController::class, 'HomeCountsStore'])->name('home-counts-store');
    Route::put('/backend-homepage-counts/{id}', [BackHomePageController::class, 'HomeCountsUpdate'])->name('home-counts-update');

    // Footer
    Route::get('/admin-footer', [BackHomePageController::class, 'FooterContent'])->name('admin.footer');
    Route::post('/admin-footer/store', [BackHomePageController::class, 'FooterContentStore'])->name('admin.footer.store');
    Route::put('/admin-footer/{id}', [BackHomePageController::class, 'FooterContentUpdate'])->name('admin.footer.update');

    // Profile Section
    Route::get('/backend-profile', [BackHomePageController::class, 'ProfileContent'])->name('profile');
    Route::post('/backend-profile/store', [BackHomePageController::class, 'ProfileContentStore'])->name('profile.store');
    Route::get('/backend-profile/{id}/edit', [BackHomePageController::class, 'ProfileContentEdit'])->name('profile.edit');
    Route::put('/backend-profile/{id}', [BackHomePageController::class, 'ProfileContentUpdate'])->name('profile.update');
    Route::delete('/backend-profile/{id}', [BackHomePageController::class, 'ProfileContentDestroy'])->name('profile.destroy');

    // Contact
    Route::get('/backend-contact', [BackHomePageController::class, 'Contact'])->name('contact');
    Route::post('/backend-contact/store', [BackHomePageController::class, 'ContactStore'])->name('contact.store');

    // Our Products
    Route::get('/backend-homepage-products', [BackHomePageController::class, 'HomeProducts'])->name('home-product');
    Route::post('/backend-homepage-products/store', [BackHomePageController::class, 'storeHomeProducts'])->name('home-product.store');
    Route::put('/backend-homepage-products/{id}', [BackHomePageController::class, 'updateHomeProducts'])->name('home-product.update');

    // Gallery
    Route::get('/backend-gallery', [GalleryController::class, 'index'])->name('gallery');
    Route::post('/backend-gallery/store', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/backend-gallery/{id}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('/backend-gallery/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/backend-gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    // Product
    Route::prefix('backend')->group(function () {
    // Category Routes
    Route::post('/categories/store', [ProductController::class, 'categoryStore'])->name('category.store');
    Route::get('/categories/edit/{id}', [ProductController::class, 'categoryEdit'])->name('category.edit');
    Route::put('/categories/update/{id}', [ProductController::class, 'categoryUpdate'])->name('category.update');
    Route::delete('/categories/destroy/{id}', [ProductController::class, 'categoryDestroy'])->name('category.destroy');

    // Product Routes
    Route::get('/textiles', [ProductController::class, 'index'])->name('productstextile');
    Route::post('/textiles/store', [ProductController::class, 'store'])->name('productstextile.store');
    Route::get('/textiles/edit/{id}', [ProductController::class, 'edit'])->name('productstextile.edit');
    Route::put('/textiles/update/{id}', [ProductController::class, 'update'])->name('textile.update');
    Route::delete('/textiles/destroy/{id}', [ProductController::class, 'destroy'])->name('productstextile.destroy');
    });

    // Category Routes
    Route::post('/categories_food/store', [FoodController::class, 'CategoryStorefood'])->name('categories_food.store');
    Route::get('/categories_food/edit/{id}', [FoodController::class, 'categoryEdit'])->name('categories_food.edit');
    Route::put('/categories_food/update/{id}', [FoodController::class, 'categoryUpdate'])->name('categories_food.update');
    Route::delete('/categories_food/destroy/{id}', [FoodController::class, 'categoryDestroy'])->name('categories_food.destroy');

    Route::get('/backend-products-food', [FoodController::class, 'Foodindex'])->name('productsfood');
    Route::post('/backend-products-food/store', [FoodController::class, 'Foodstore'])->name('productsfood.store');
    Route::get('/backend-products-food/edit/{id}', [FoodController::class, 'edit'])->name('productsfood.edit');
    Route::put('/backend-products-food/update/{id}', [FoodController::class, 'update'])->name('food.update');
    Route::delete('/backend-products-food/destroy/{id}', [FoodController::class, 'destroy'])->name('food.destroy');

    // OEM Routes
    Route::get('/backend-products-oem', [OEMController::class, 'OEMindex'])->name('productsoem');
    Route::post('/backend-products-oem/store', [OEMController::class, 'OEMProductStore'])->name('productsoem.store');
    Route::get('/backend-products-oem/edit/{id}', [OEMController::class, 'OEMProductEdit'])->name('productsoem.edit');
    Route::put('/backend-products-oem/update/{id}', [OEMController::class, 'OEMProductUpdate'])->name('productsoem.update');
    Route::delete('/backend-products-oem/destroy/{id}', [OEMController::class, 'OEMProductDestroy'])->name('productsoem.destroy');

    Route::post('/oem/store', [OEMController::class, 'OEMstore'])->name('OEM.store');
    Route::get('/oem/edit/{id}', [OEMController::class, 'OEMedit'])->name('OEM.edit');
    Route::put('/oem/update/{id}', [OEMController::class, 'OEMupdate'])->name('OEM.update');
    Route::delete('/oem/destroy/{id}', [OEMController::class, 'OEMdestroy'])->name('OEM.destroy');

});