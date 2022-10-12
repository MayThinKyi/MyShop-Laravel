<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderList;

use App\Models\User;

class OrderController extends Controller
{
    //orderListPage Function
    public function orderListPage(){
        $orders=Order::select('orders.*','users.name as user_name')
                        ->leftJoin('users','orders.user_id','users.id')
                        ->orderBy('created_at','desc')->get();

        return view('admin.order.orderList',compact('orders'));
    }

    //Change Order Status Function
    public function changeOrderStatus(Request $request){
        Order::where('id',$request->orderId)->update(['status'=>$request->changeStatus]);
             return response()->json(['msg' => 'success']);
    }
    //Filter Order Status Function
    public function filterStatus(Request $request){
        $orders;
        
      if($request->filterStatus==-1){
        $orders=Order::get();
      }else{
         $orders=Order::where('status',$request->filterStatus)->get();

      }
      
      return view('admin.order.orderList',compact('orders'));

    }
    //Order Product Info
    public function productInfo($orderCode){
        $orderLists=OrderList::select('order_lists.*','users.name as user_name','products.product_name','products.product_image')
                            ->leftJoin('users','order_lists.user_id','users.id')
                            ->leftJoin('products','order_lists.product_id','products.id')
                            ->where('order_code',$orderCode)->get();
        $order=Order::select('orders.*','users.name as user_name')
                    ->leftJoin('users','orders.user_id','users.id')
                    ->where('orders.order_code',$orderCode)->first();
                  
        return view('admin.order.orderProductInfo',compact('orderLists','order'));
    }
}
