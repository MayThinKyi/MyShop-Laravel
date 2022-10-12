<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderList;
use App\Models\Order;
use App\Models\Cart;

use App\Http\Controllers\Response;
class AjaxController extends Controller
{
    //Admin Change Role Function
    public function adminChangeRole(Request $request){
      User::where('id',$request->id)->update(['role'=>$request->role]);
        return response()->json([
            'status' => 'success'
        ]);
       
    }
    //Customer Ajax Sorting Asc/Desc Function
    public function sorting(Request $request){
        if($request->status=='asc'){
            $products=Product::orderBy('created_at','asc')->get();
          return response()->json(['products'=>$products]);
        }
        if($request->status=='desc'){
            $products=Product::orderBy('created_at','desc')->get();
                  return response()->json(['products'=>$products]);
        }
        
    }
    //Customer Order LIst Ajax Function
    public function orderList(Request $request){
         $orderTotalPrice=0;
       foreach($request->all() as $o){
           
            $orderListData=[
                'user_id'=>$o['userId'],
                'product_id'=>$o['productId'],
                'quantity'=>$o['qty'],
                'total_price'=>$o['productTotal'],
                'order_code'=>$o['orderCode']
            ];
           
        
            OrderList::create($orderListData);
           
            $orderTotalPrice+=$o['productTotal'];
           
        }
        
         $orderData=[
                'user_id'=>$request[0]['userId'],
                'order_code'=>$request[0]['orderCode'],
                'total_price'=>$orderTotalPrice+3000,
                'status'=>0
         ];
         Order::create($orderData);
         Cart::where('user_id',Auth::user()->id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
        


    }
    //View COunt FUnction
    public function viewCount(Request $request){
       Product::where('id',$request->productId)->update(['view_count'=>$request->viewCount]);
        return back();
    }
}
