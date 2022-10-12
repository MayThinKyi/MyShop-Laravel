<?php

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Orders Api
Route::get('/product/list',[RouteController::class,'productList']);
//Cart Api
Route::get('/cart/list',[RouteController::class,'cartList']);
//Categories Api
Route::get('/category/list',[RouteController::class,'categoryList']);
//Contacts Api
Route::get('/contact/list',[RouteController::class,'contactList']);
//Orders Api
Route::get('/order/list',[RouteController::class,'orderList']);
//OrderLists Api
Route::get('/orderlists',[RouteController::class,'orderLists']);
//Rating Api
Route::get('/rating/list',[RouteController::class,'ratingList']);

//Users Api
Route::get('/user/list',[RouteController::class,'userList']);

//Create Contact Data
Route::post('/create/contact',[RouteController::class,'createContactData']); //Create
//Delete Category Data
Route::get('/delete/category/{id}',[RouteController::class,'deleteCategory']);//Delete

//Read Product Detail
Route::get('/product/list/{id}',[RouteController::class,'productListDetail']);//Read

//Update  Category
Route::post('/update/category',[RouteController::class,'updateCategory']);

/*
====== Product List =======
localhost:8000/api/product/list (GET)

====== Cart List =======
localhost:8000/api/cart/list (GET)

====== Category List =======
localhost:8000/api/category/list (GET)

====== Contact List =======
localhost:8000/api/contact/list (GET)

====== OrderList =======
localhost:8000/api/orderlists (GET)

====== Order List =======
localhost:8000/api/order/list (GET)

 ====== Rating List =======
localhost:8000/api/rating/list (GET)

 ====== User List =======
localhost:8000/api/user/list (GET)

====== Create Contact Data =======
localhost:8000/api/create/contact (POST)

====== Delete Category Data =======
localhost:8000/api/delete/category/{id} (POST)

====== Update Category Data =======
localhost:8000/api/update/category  (POST)



*/


