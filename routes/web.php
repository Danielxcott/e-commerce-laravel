<?php

use App\Http\Livewire\CartComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\DetailsComponent;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\WishlistComponent;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Livewire\Admin\AdminCouponsComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminAddCouponsComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminEditCouponsComponent;
use App\Http\Livewire\Admin\AdminEditProductComponent;
use App\Http\Livewire\Admin\AdminOrderComponent;
use App\Http\Livewire\Admin\AdminOrderDetailComponent;
use App\Http\Livewire\Admin\AdminSaleComponent;
use App\Http\Livewire\ThankyouComponent;
use App\Http\Livewire\User\UserOrderDetailsComponent;
use App\Http\Livewire\User\UserOrdersComponent;
use App\Http\Livewire\User\UserReviewComponent;
use App\Models\Category;

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
Route::get("/wishlist",WishlistComponent::class)->name("wishlist");
Route::get("/checkout",CheckoutComponent::class)->middleware(['auth:sanctum','verified'])->name("checkout");
Route::get("/product/{slug}",DetailsComponent::class)->name("product.detail");
Route::post("/cart/store",[CartController::class,'store'])->name("cart.store");
Route::put("/cart/qty-in/{product:slug}",[CartController::class,'qtyincrease'])->name("cart.qtyin");
Route::put("/cart/qty-dec/{product:slug}",[CartController::class,'qtydecrease'])->name("cart.qtydec");
Route::put("/cart/increase/{product}",[CartController::class,'increaseQty'])->name("cart.increase");
Route::put("/cart/decrease/{product}",[CartController::class,'decreaseQty'])->name("cart.decrease");
Route::delete("/cart/delete/{product}",[CartController::class,'destroy'])->name("cart.destroy");
Route::get("/cart/delete-all",[CartController::class,'destroyAll'])->name("cart.destroyAll");
Route::post("/wishlist/add",[CartController::class,'addtowish'])->name("add.wishlist");
Route::post("/wishlist/remove/{product:id}",[CartController::class,'removewishlist'])->name("remove.wishlist");
Route::post("/wishlist/move/{product:id}",[CartController::class,'moveItemFromWishToCart'])->name("move.wishlistToCart");
Route::post("/cart/save-for-later/{product:id}",[CartController::class,'saveForLater'])->name("cart.saveforlater");
Route::post("/cart/save-for-later/move/{product:id}",[CartController::class,'moveToCart'])->name("cart.moveFromSaveToCart");
Route::delete("/cart/delete/save-for-later/{product:id}",[CartController::class,"deleteFromSaveForLater"])->name("cart.deletefromsaveforlater");
Route::get("/cart/checkout",[CartController::class,"checkout"])->name("cartTocheckout");

//checkout
Route::post("/checkout/store",[CheckoutController::class,"store"])->name("checkout.store");
Route::get("/thank-you",ThankyouComponent::class)->name("thankyou");


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
    Route::get("/user/orders",UserOrdersComponent::class)->name("user.orders");
    Route::get("/user/orders/detail/{order}",UserOrderDetailsComponent::class)->name("user.ordersDetail");
    Route::delete("/user/order-delete/{order:id}",[OrderController::class,"userOrderDestroy"])->name("user.orderDelete");
    Route::put("/user/order-status-cancel/{order}",[OrderController::class,"orderCancelStatus"])->name("user.orderCancelStatus");
    Route::get("/user/review/{order_item_id}",UserReviewComponent::class)->name("user.review");
    Route::post("/user/review-store",[ReviewController::class,"store"])->name("user.writeReview");
});

//for admin
Route::middleware(['auth:sanctum','verified','authAdmin'])->group(function(){
    Route::get('/admin/dashboard',AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get("admin/products",AdminProductComponent::class)->name('admin.products');
    Route::get("admin/products/add",AdminAddProductComponent::class)->name('admin.addProducts');
    Route::post("admin/add/products",[ProductController::class,'store'])->name("product.add");
    Route::put("admin/update/{product:slug}/products",[ProductController::class,'update'])->name("product.update");
    Route::get("admin/products/edit/{product:slug}",AdminEditProductComponent::class)->name("admin.editProduct");

    Route::get("admin/categories",AdminCategoryComponent::class)->name("admin.categories");
    Route::delete("admin/categories-delete/{category}",[CategoryController::class,"destroy"])->name("admin.deleteCategory");

    Route::get("/admin/coupons",AdminCouponsComponent::class)->name("admin.coupons");
    Route::get("/admin/coupons/add",AdminAddCouponsComponent::class)->name("admin.addCoupons");
    Route::get("/admin/coupons/{coupon}/edit",AdminEditCouponsComponent::class)->name("admin.editCoupons");

    Route::delete("/admin/coupon/{coupon:id}/delete/",[CouponController::class,"destroy"])->name("coupon.destroy");
    Route::post("/admin/add/coupons",[CouponController::class,"store"])->name("admin.storeCoupon");
    Route::put("/admin/coupons/{coupon}/update",[CouponController::class,"update"])->name("admin.updateCoupon");
    Route::get("/admin/get/coupon",[CartController::class,"getCoupon"])->name("get.coupon");

    Route::get("/admin/customers-orders",AdminOrderComponent::class)->name("admin.orderAll");
    Route::get("/admin/customers-orders-detail/{order}",AdminOrderDetailComponent::class)->name("admin.orderdetail");
    Route::delete("/admin/customers-order-delete/{order:id}",[OrderController::class,"destroy"])->name("admin.orderDelete");
    Route::put("/admin/customers-order-update/{order}",[OrderController::class,"updateOrderStatus"])->name("admin.updateOrder");
    Route::get("/admin/sale",AdminSaleComponent::class)->name("admin.sale");
    Route::post("/admin/sale-store",[ProductController::class,"saleStore"])->name("admin.saleStore");
});