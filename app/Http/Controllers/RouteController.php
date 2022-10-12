<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use App\Models\Rating;
use App\Models\User;
class RouteController extends Controller
{
    //Product List
    public function productList(){
         $products=Product::get();
        $data=[
        'products'=>$products
    ]   ;
     return response($data, 200)->header('Content-Type', 'text/html');
    }
    //CartList
    public function cartList(){
        $carts=Cart::get();
            $data=[
                    'carts'=>$carts
                ];
     return response($data, 200)->header('Content-Type', 'text/html');
    }
    //Category List
    public function categoryList(){
         $categories=Category::get();
        $data=[
                'categories'=>$categories
            ];
     return response($data, 200)->header('Content-Type', 'text/html');
    }
    //Contact List
    public function contactList(){
        $contacts=Contact::get();
        $data=[
                'contacts'=>$contacts
            ];
     return response($data, 200)->header('Content-Type', 'text/html');
    }
    //Order List
    public function orderList(){
         $orders=Order::get();
        $data=[
                'orders'=>$orders
            ];
     return response($data, 200)->header('Content-Type', 'text/html');
    }
    //Order Lists
    public function orderLists(){
         $orderlists=OrderList::get();
        $data=[
                'orderlists'=>$orderlists
            ];
     return response($data, 200)->header('Content-Type', 'text/html');
    }
    //Rating List
    public function ratingList(){
        $ratings=Rating::get();
        $data=[
                'ratings'=>$ratings
            ];
     return response($data, 200)->header('Content-Type', 'text/html');
    }
    //User List
    public function userList(){
        $users=User::get();
        $data=[
                'users'=>$users
            ];
     return response($data, 200)->header('Content-Type', 'text/html');
    }
    //Create Contact Data
    public function createContactData(Request $request){
         $data=[
        'user_id'=>$request->user_id,
        'name'=>$request->name,
         'email'=>$request->email,
        'subject'=>$request->subject,
        'message'=>$request->message
    ];
    Contact::create($data);
    return $request->all();
    }
    //Delete Category
    public function deleteCategory($id){
      $data=Category::where('id',$id)->first();
      if(isset($data)){
        Category::where('id',$id)->delete();
        return response()->json(['status' => true, 'message' => "Delete success..."],200);

      }else{
        return response()->json(['status' => false, 'message' => "There is no category..."],500);

      }
    }
    //Read Product Detail
    public function productListDetail($id){
        $data=Product::where('id',$id)->first();
        if(isset($data)){
            $data=Product::where('id',$id)->first();
            return response()->json(['status' => true, 'product' => $data],200);
        }else{
           return response()->json(['status' => false, 'product' => 'There is no product...'],500);

        }
    }
    //Update Category
    public function updateCategory(Request $request){
        $data=Category::where('id',$request->category_id)->first();
        if(isset($data)){
            Category::where('id',$request->category_id)->update([
                'category_name'=>$request->category_name
            ]);
    return response()->json(['status' => true, 'message' => "Category update success..."],200);

        }else{
                return response()->json(['status' => false, 'message' => "There is no category..."],500);

        }
    }
}
