<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;

use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //Add To Cart Function
    public function addToCart(Request $request){
      Cart::create([
        'user_id'=>$request->userId,
        'product_id'=>$request->productId,
        'quantity'=>$request->qty
      ]);
      return response()->json(['msg' => 'success']);
    }
    //Clear Cart Function
    public function clearCart(Request $request){
        $userId=$request->userId;
        Cart::where('user_id',$userId)->delete();
        return response()->json(['msg' => 'success']);
    }
    //Clear Current Product Function
    public function clearCurrentProduct(Request $request){
       Cart::where('id',$request->cartId)->delete();
               return response()->json(['msg' => 'success']);

    }
    //Cart List Function
    public function cartList(){
        $carts=Cart::select('carts.*','products.product_name','products.product_price')
                    ->leftJoin('products','carts.product_id','products.id')
                   ->where('carts.user_id',Auth::user()->id)
                    ->orderBy('created_at','desc')->get();
                 
        return view('user.cartList',compact('carts'));
    }
    //Order History Function
    public function orderHistory(){
       //$carts=Cart::where('user_id',Auth::user()->id)->get();

      $orders=Order::orderBy('created_at','desc')->where('user_id',Auth::user()->id)->paginate(5);
      return view('user.orderHistory',compact('orders'));
    }
}
