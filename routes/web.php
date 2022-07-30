<?php

use App\Http\Livewire\CartComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\DetailsComponent;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminEditProductComponent;

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

Route::get("/",HomeComponent::class);
Route::get("/shop",ShopComponent::class)->name("shop");
Route::get("/cart",CartComponent::class)->name("cart");
Route::get("/checkout",CheckoutComponent::class)->name("checkout");
Route::get("/product/{slug}",DetailsComponent::class)->name("product.detail");
Route::post("/cart/store",[CartController::class,'store'])->name("cart.store");
Route::put("/cart/qty-in/{product:slug}",[CartController::class,'qtyincrease'])->name("cart.qtyin");
Route::put("/cart/qty-dec/{product:slug}",[CartController::class,'qtydecrease'])->name("cart.qtydec");
Route::put("/cart/increase/{product}",[CartController::class,'increaseQty'])->name("cart.increase");
Route::put("/cart/decrease/{product}",[CartController::class,'decreaseQty'])->name("cart.decrease");
Route::delete("/cart/delete/{product}",[CartController::class,'destroy'])->name("cart.destroy");
Route::get("/cart/delete-all",[CartController::class,'destroyAll'])->name("cart.destroyAll");

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

//for user or customer
Route::middleware(['auth:sanctum','verified'])->group(function(){
    Route::get('/user/dashboard',UserDashboardComponent::class)->name('user.dashboard');
});

//for admin
Route::middleware(['auth:sanctum','verified','authAdmin'])->group(function(){
    Route::get('/admin/dashboard',AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get("admin/products",AdminProductComponent::class)->name('admin.products');
    Route::get("admin/products/add",AdminAddProductComponent::class)->name('admin.addProducts');
    Route::post("admin/add/products",[ProductController::class,'store'])->name("product.add");
    Route::put("admin/update/{product:slug}/products",[ProductController::class,'update'])->name("product.update");
    Route::get("admin/products/edit/{product:slug}",AdminEditProductComponent::class)->name("admin.editProduct");

});