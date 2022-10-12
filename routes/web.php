<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;


/*|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
  Route::get('/home',[LoginController::class,'home'])->name('login#home');
  //Admin Category FUnction with admin_auth middleware
Route::group(['prefix'=>'/category','middleware'=>'admin_middleware'],function(){
    Route::get('/list',[CategoryController::class,'list'])->name('category#list');
    Route::get('/createPage',[CategoryController::class,'createPage'])->name('category#createPage');
    Route::post('/createCategory',[CategoryController::class,'createCategory'])->name('category#create');
    Route::get('/delete/{id}',[CategoryController::class,'deleteCategory'])->name('category#delete');
    Route::get('/edit/category/{id}',[CategoryController::class,'editCategoryPage'])->name('category#editPage');
    Route::post('update/category/{id}',[CategoryController::class,'updateCategory'])->name('category#update');
});
//Admin Product Page with admin_auth_middleware
Route::group(['prefix'=>'product/','middleware'=>'admin_middleware'],function(){
    Route::get('/list',[ProductController::class,'list'])->name('product#list');
    Route::get('/createPage',[ProductController::class,'createPage'])->name('product#createPage');
    Route::post('/create',[ProductController::class,'createProduct'])->name('product#create');
   Route::get('/read/{id}',[ProductController::class,'readProductPage'])->name('product#readPage');
    Route::get('/delete/product/{id}',[ProductController::class,'deleteProduct'])->name('product#delete');
    Route::get('/edit/productPage/{id}',[ProductController::class,'editProductPage'])->name('product#editPage');
    Route::post('/update/product/{id}',[ProductController::class,'updateProduct'])->name('product#update');
}
);
//Admin Change Profile and Password With admin_auth_middleware +Ajax
Route::group(['prefix'=>'profile','middleware'=>'admin_middleware'],function(){
    Route::get('/changePasswordPage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
    Route::post('/changePassword',[AdminController::class,'changePassword'])->name('profile#changePassword');
    Route::get('/infoPage',[AdminController::class,'infoPage'])->name('admin#profileInfo');
    Route::get('/edit/infoPage',[AdminController::class,'editInfoPage'])->name('admin#editProfilePage');
    Route::post('/update/infoPage',[AdminController::class,'updateInfoPage'])->name('admin#updateProfile');
    Route::get('/adminList',[AdminController::class,'adminListPage'])->name('admin#adminList');
   Route::get('/admin/changeRole',[AjaxController::class,'adminChangeRole'])->name('ajax#changeRole');
});
//Admin Order List Page with admin_auth_middleware
Route::group(['prefix'=>'order/','middleware'=>'admin_middleware'],function(){
    Route::get('/list',[OrderController::class,'orderListPage'])->name('order#list');
    Route::get('/changeOrderStatus',[OrderController::class,'changeOrderStatus'])->name('order#changeStatus');
    Route::get('/filterStatus',[OrderController::class,'filterStatus'])->name('order#filterStatus');
    Route::get('/productInfo/{orderCode}',[OrderController::class,'productInfo'])->name('order#productInfo');
});
//Admin User List Page with admin_auth_middleware
Route::group(['prefix'=>'userList/','middleware'=>'admin_middleware'],function(){
    Route::get('/list',[UserController::class,'userListPage'])->name('user#list');
    Route::get('/changeStatus',[UserController::class,'changeStatus'])->name('user#changeStatus');
    Route::get('/delete/{id}',[UserController::class,'deleteUser'])->name('user#delete');
});
//Admin Contact List Page with admin_auth_middleware
Route::group(['prefix'=>'contact/','middleware'=>'admin_middleware'],function(){
   Route::get('/list',[ContactController::class,'contactListPage'])->name('contact#list');
});






});
Route::group(['middleware'=>'admin_middleware'],function(){
    Route::get('/',function(){
    return view('loginPage');
})->name('loginPage');
Route::get('/loginPage',function(){
    return view('loginPage');
})->name('loginPage');
Route::get('/registerPage',function(){
    return view('registerPage');
})->name('registerPage');

});
Route::group(['middleware'=>'customer_middleware','prefix'=>'customer'],function(){
    Route::get('/home',[CustomerController::class,'homePage'])->name('customer#home');
    Route::get('/changePasswordPage',[CustomerController::class,'changePasswordPage'])->name('customer#changePasswordPage');
    Route::post('/change/Password',[CustomerController::class,'changePassword'])->name('customer#changePassword');
    Route::get('/profilePage',[CustomerController::class,'customerProfilePage'])->name('customer#profilePage');
    Route::post('/update/profile',[CustomerController::class,'updateProfile'])->name('customer#updateProfile');
    Route::get('/filter/category/{id}',[CustomerController::class,'filterCategory'])->name('filter#category');
    Route::get('/detail/{id}',[CustomerController::class,'detailPage'])->name('customer#detail');
    Route::get('/add/cart',[CartController::class,'addToCart'])->name('cart#add');
    Route::get('/clear/cart',[CartController::class,'clearCart'])->name('cart#clear');
    Route::get('/cart/list',[CartController::class,'cartList'])->name('cart#list');
    Route::get('/clear/currentProduct',[CartController::class,'clearCurrentProduct'])->name('clear#currentProduct');
    Route::get('/orderHistory',[CartController::class,'orderHistory'])->name('customer#orderHistory');
    Route::get('/contactPage',[ContactController::class,'contactPage'])->name('customer#contactPage');
    Route::post('/contactForm',[ContactController::class,'contact'])->name('customer#contact');
});
Route::group(['middleware'=>'customer_middleware','prefix'=>'ajax'],function(){
    Route::get('/sorting',[AjaxController::class,'sorting'])->name('ajax#sorting');
    Route::get('/orderList',[AjaxController::class,'orderList'])->name('ajax#orderList');
    Route::get('/viewCount',[AjaxController::class,'viewCount'])->name('ajax#viewCount');
});




