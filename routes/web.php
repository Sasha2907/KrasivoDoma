<?php

use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConstructorController;
use App\Http\Controllers\FabricController;
use App\Http\Controllers\AdminPreorderController;
use App\Http\Controllers\PreorderController;


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
    return view('main.index');
});
Route::get('/main', function () {
    return view('main.index');
});
//Route::get('main1', [App\Http\Controllers\Admin\ProductController::class, 'exportPDF'])->name('admin.products.exportPDF');

Route::get('/about_us', function () {
    return view('main.about_us');
});


Auth::routes();

Route::get('/catalog', [App\Http\Controllers\CatalogController::class,'index'])->name('catalog.index');


Route::group(['middleware' => 'admin'], function () {
    Route::get('/suppliers', [App\Http\Controllers\SupplierController::class,'index'])->name('supplier.index');
    Route::get('/suppliers/create', [App\Http\Controllers\SupplierController::class,'create'])->name('supplier.create');
    Route::post('/suppliers', [App\Http\Controllers\SupplierController::class,'store'])->name('supplier.store');
    Route::get('/suppliers/{supplier}/edit', [\App\Http\Controllers\SupplierController::class,'edit'])->name('supplier.edit');
    Route::patch('/supplier/{supplier}', [\App\Http\Controllers\SupplierController::class,'update'])->name('supplier.update');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/review/create', [App\Http\Controllers\ReviewController::class,'create'])->name('review.create');
    Route::post('/review', [App\Http\Controllers\ReviewController::class,'store'])->name('review.store');
});
Route::get('/review', [App\Http\Controllers\ReviewController::class,'index'])->name('review.index');
Route::delete('/review/{id}', [App\Http\Controllers\ReviewController::class,'destroy'])->name('review.destroy');


Route::get('/catalog/shtory', [App\Http\Controllers\ShtoryController::class,'index'])->name('shtory.index');
Route::group(['middleware' => 'admin'], function () {
    Route::get('/catalog/shtory/create', [App\Http\Controllers\ShtoryController::class,'create'])->name('shtory.create');
    Route::post('/catalog/shtory/create', [App\Http\Controllers\ShtoryController::class,'store'])->name('shtory.store');
    Route::get('/catalog/shtory/{product}/edit', [\App\Http\Controllers\ShtoryController::class,'edit'])->name('shtory.edit');
    Route::patch('/catalog/shtory/{product}', [\App\Http\Controllers\ShtoryController::class,'update'])->name('shtory.update');
    Route::delete('/catalog/shtory/{product}', [App\Http\Controllers\ShtoryController::class,'destroy'])->name('shtory.destroy');
});
Route::get('/catalog/shtory/{product}', [\App\Http\Controllers\ShtoryController::class,'show'])->name('shtory.show');



Route::get('/catalog/tyl', [App\Http\Controllers\TylController::class,'index'])->name('tyl.index');
Route::group(['middleware' => 'admin'], function () {
    Route::get('/catalog/tyl/create', [App\Http\Controllers\TylController::class,'create'])->name('tyl.create');
    Route::post('/catalog/tyl/create', [App\Http\Controllers\TylController::class,'store'])->name('tyl.store');
    Route::get('/catalog/tyl/{product}/edit', [\App\Http\Controllers\TylController::class,'edit'])->name('tyl.edit');
    Route::patch('/catalog/tyl/{product}', [\App\Http\Controllers\TylController::class,'update'])->name('tyl.update');
    Route::delete('/catalog/tyl/{product}', [App\Http\Controllers\TylController::class,'destroy'])->name('tyl.destroy');
});
Route::get('/catalog/tyl/{product}', [\App\Http\Controllers\TylController::class,'show'])->name('tyl.show');



Route::get('/catalog/rimskie-shtory', [App\Http\Controllers\RimskieShtoryController::class,'index'])->name('rimskieShtory.index');
Route::group(['middleware' => 'admin'], function () {
    Route::get('/catalog/rimskie-shtory/create', [App\Http\Controllers\RimskieShtoryController::class,'create'])->name('rimskieShtory.create');
    Route::post('/catalog/rimskie-shtory/create', [App\Http\Controllers\RimskieShtoryController::class,'store'])->name('rimskieShtory.store');
    Route::get('/catalog/rimskie-shtory/{product}/edit', [\App\Http\Controllers\RimskieShtoryController::class,'edit'])->name('rimskieShtory.edit');
    Route::patch('/catalog/rimskie-shtory/{product}', [\App\Http\Controllers\RimskieShtoryController::class,'update'])->name('rimskieShtory.update');
    Route::delete('/catalog/rimskie-shtory/{product}', [App\Http\Controllers\RimskieShtoryController::class,'destroy'])->name('rimskieShtory.destroy');
});
Route::get('/catalog/rimskie-shtory/{product}', [\App\Http\Controllers\RimskieShtoryController::class,'show'])->name('rimskieShtory.show');



Route::get('/catalog/pocrivala', [App\Http\Controllers\PocrivalaController::class,'index'])->name('pocrivala.index');
Route::group(['middleware' => 'admin'], function () {
    Route::get('/catalog/pocrivala/create', [App\Http\Controllers\PocrivalaController::class,'create'])->name('pocrivala.create');
    Route::post('/catalog/pocrivala/create', [App\Http\Controllers\PocrivalaController::class,'store'])->name('pocrivala.store');
    Route::get('/catalog/pocrivala/{product}/edit', [\App\Http\Controllers\PocrivalaController::class,'edit'])->name('pocrivala.edit');
    Route::patch('/catalog/pocrivala/{product}', [\App\Http\Controllers\PocrivalaController::class,'update'])->name('pocrivala.update');
    Route::delete('/catalog/pocrivala/{product}', [App\Http\Controllers\PocrivalaController::class,'destroy'])->name('pocrivala.destroy');
});
Route::get('/catalog/pocrivala/{product}', [\App\Http\Controllers\PocrivalaController::class,'show'])->name('pocrivala.show');



Route::get('/catalog/decor-podushki', [App\Http\Controllers\DecorPodushkiController::class,'index'])->name('decorPodushki.index');
Route::group(['middleware' => 'admin'], function () {
    Route::get('/catalog/decor-podushki/create', [App\Http\Controllers\DecorPodushkiController::class,'create'])->name('decorPodushki.create');
    Route::post('/catalog/decor-podushki/create', [App\Http\Controllers\DecorPodushkiController::class,'store'])->name('decorPodushki.store');
    Route::get('/catalog/decor-podushki/{product}/edit', [\App\Http\Controllers\DecorPodushkiController::class,'edit'])->name('decorPodushki.edit');
    Route::patch('/catalog/decor-podushki/{product}', [\App\Http\Controllers\DecorPodushkiController::class,'update'])->name('decorPodushki.update');
    Route::delete('/catalog/decor-podushki/{product}', [App\Http\Controllers\DecorPodushkiController::class,'destroy'])->name('decorPodushki.destroy');
});
Route::get('/catalog/decor-podushki/{product}', [\App\Http\Controllers\DecorPodushkiController::class,'show'])->name('decorPodushki.show');


Route::middleware(['auth'])->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/{product}', [FavoriteController::class, 'store'])->name('favorites.toggle');
    Route::delete('/favorites/{product}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::delete('/constructor/{id}', [ConstructorController::class, 'destroy'])->name('constructor.destroy');

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [UserController::class, 'update'])->name('profile.update');

    // Route::get('/constructor', [ConstructorController::class, 'showForm'])->name('constructor.index');
    // Route::post('/constructor', [ConstructorController::class, 'store'])->name('constructor.store');
    Route::get('/constructor', [ConstructorController::class, 'create'])->name('constructor.create');
    Route::post('/constructor', [ConstructorController::class, 'store'])->name('constructor.store');

    Route::get('/preorder', [PreorderController::class, 'create'])->name('preorders.create');
    Route::post('/preorder', [PreorderController::class, 'store'])->name('preorders.store');
    Route::post('/preorder/confirm', [PreorderController::class, 'confirm'])->name('preorders.confirm');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/main'); // Перенаправление на главную после выхода
})->name('logout');

Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', [App\Http\Controllers\Admin\HomeAdminController::class,'index'])->name('admin.index');

    Route::get('/admin/reviews', [App\Http\Controllers\Admin\ReviewController::class,'index'])->name('admin.review.index');
    Route::delete('/admin/review/{id}', [App\Http\Controllers\Admin\ReviewController::class,'destroy'])->name('admin.review.destroy');


    Route::get('/admin/products', [App\Http\Controllers\Admin\ProductController::class,'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [App\Http\Controllers\Admin\ProductController::class,'create'])->name('admin.products.create');
    Route::post('/admin/products/create', [App\Http\Controllers\Admin\ProductController::class,'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}', [App\Http\Controllers\Admin\ProductController::class,'show'])->name('admin.products.show');
    Route::get('/admin/products/{product}/edit', [App\Http\Controllers\Admin\ProductController::class,'edit'])->name('admin.products.edit');
    Route::patch('/admin/products/{product}', [App\Http\Controllers\Admin\ProductController::class,'update'])->name('admin.products.update');
    Route::get('/admin/ccc/pdf', [App\Http\Controllers\Admin\ProductController::class, 'exportPDF'])->name('admin.products.exportPDF');
    Route::delete('/admin/products/{product}', [App\Http\Controllers\Admin\ProductController::class,'destroy'])->name('admin.products.destroy');


    Route::get('/admin/suppliers', [App\Http\Controllers\Admin\SupplierAdminController::class,'index'])->name('admin.suppliers.index');
    Route::get('/admin/suppliers/create', [App\Http\Controllers\Admin\SupplierAdminController::class,'create'])->name('admin.suppliers.create');
    Route::post('/admin/suppliers', [App\Http\Controllers\Admin\SupplierAdminController::class,'store'])->name('admin.suppliers.store');
    Route::get('/admin/suppliers/{supplier}/edit', [App\Http\Controllers\Admin\SupplierAdminController::class,'edit'])->name('admin.suppliers.edit');
    Route::put('/admin/supplier/{supplier}', [App\Http\Controllers\Admin\SupplierAdminController::class,'update'])->name('admin.suppliers.update');

    Route::get('/admin/fabric', [FabricController::class, 'index'])->name('fabrics.index');
    Route::get('/admin/fabric/create', [FabricController::class, 'create'])->name('fabrics.create');
    Route::post('/admin/fabric/', [FabricController::class, 'store'])->name('fabrics.store');
    Route::get('/admin/fabric/{fabric}/edit', [FabricController::class, 'edit'])->name('fabrics.edit');
    Route::put('/admin/fabric/{fabric}', [FabricController::class, 'update'])->name('fabrics.update');
    Route::delete('/admin/fabric/{fabric}', [FabricController::class, 'destroy'])->name('fabrics.destroy');

    Route::get('/admin/preorders', [AdminPreorderController::class, 'index'])->name('admin.preorders.index');
    Route::post('/admin/preorders/{preorder}/approve', [AdminPreorderController::class, 'approve'])->name('admin.preorders.approve');
    Route::post('/admin/preorders/{preorder}/reply', [AdminPreorderController::class, 'reply'])->name('admin.preorders.reply');
    Route::delete('/admin/preorders/{preorder}', [AdminPreorderController::class, 'destroy'])->name('admin.preorders.destroy');
});






